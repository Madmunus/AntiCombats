<?php
/**
 * DbSimple_PDO: MySQL database via PDO.
 * Compatible with PHP 8.3
 */
require_once dirname(__FILE__) . '/Generic.php';

/**
 * Database class for MySQL using PDO.
 */
class DbSimple_PDO extends DbSimple_Generic_Database
{
    /** @var PDO|null */
    private $pdo = null;

    /**
     * constructor(string $dsn)
     * Connect to MySQL via PDO.
     */
    function __construct($dsn)
    {
        $p = DbSimple_Generic::parseDSN($dsn);
        
        if (!class_exists('PDO')) {
            return $this->_setLastError("-1", "PDO extension is not loaded", "PDO");
        }

        try {
            $pdoDsn = 'mysql:host=' . $p['host'];
            if (!empty($p['port'])) {
                $pdoDsn .= ';port=' . $p['port'];
            }
            if (!empty($p['path'])) {
                $dbName = preg_replace('{^/}s', '', $p['path']);
                if ($dbName) {
                    $pdoDsn .= ';dbname=' . $dbName;
                }
            }
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => true,
            ];
            
            if (isset($p["charset"])) {
                $pdoDsn .= ';charset=' . $p["charset"];
            } else {
                $pdoDsn .= ';charset=utf8mb4';
            }

            $this->pdo = new PDO($pdoDsn, $p['user'], $p['pass'], $options);
            $this->_resetLastError();
        } catch (PDOException $e) {
            return $this->_setLastError($e->getCode(), $e->getMessage(), "PDO::__construct");
        }
    }

    function _performEscape($s, $isIdent = false)
    {
        if (!$isIdent) {
            if ($this->pdo) {
                return $this->pdo->quote($s);
            }
            return "'" . addslashes($s) . "'";
        } else {
            return "`" . str_replace('`', '``', $s) . "`";
        }
    }

    function _performTransaction($parameters = null)
    {
        if (!$this->pdo) {
            return false;
        }
        return $this->pdo->beginTransaction();
    }

    function &_performNewBlob($blobid = null)
    {
        $obj = new DbSimple_PDO_Blob($this, $blobid);
        return $obj;
    }

    function _performGetBlobFieldNames($result)
    {
        $blobFields = [];
        if ($result && $result instanceof PDOStatement) {
            for ($i = 0; $i < $result->columnCount(); $i++) {
                $meta = $result->getColumnMeta($i);
                if ($meta && isset($meta['native_type'])) {
                    $type = strtoupper($meta['native_type']);
                    if (strpos($type, "BLOB") !== false || 
                        strpos($type, "TEXT") !== false ||
                        $type === 'MEDIUMBLOB' || $type === 'LONGBLOB') {
                        $blobFields[] = $meta['name'];
                    }
                }
            }
        }
        return $blobFields;
    }

    function _performGetPlaceholderIgnoreRe()
    {
        return '
            "   (?> [^"\\\\]+|\\\\")*    "   |
            \'  (?> [^\'\\\\]+|\\\\\')* \'   |
            `   (?> [^`]+ | ``)*              `   |   # backticks
            /\\* .*?                          \\*/      # comments
        ';
    }

    function _performCommit()
    {
        if (!$this->pdo) {
            return false;
        }
        return $this->pdo->commit();
    }

    function _performRollback()
    {
        if (!$this->pdo) {
            return false;
        }
        return $this->pdo->rollBack();
    }

    function _performTransformQuery(&$queryMain, $how)
    {
        switch ($how) {
            case 'CALC_TOTAL':
                $m = null;
                if (preg_match('/^(\s* SELECT)(.*)/six', $queryMain[0], $m)) {
                    $queryMain[0] = $m[1] . ' SQL_CALC_FOUND_ROWS' . $m[2];
                }
                return true;

            case 'GET_TOTAL':
                $queryMain = ['SELECT FOUND_ROWS()'];
                return true;
        }

        return false;
    }

    function _performQuery($queryMain)
    {
        $this->_lastQuery = $queryMain;
        $this->_expandPlaceholders($queryMain, false);

        if (!$this->pdo) {
            return $this->_setLastError("-1", "Database connection not established", $queryMain[0]);
        }

        try {
            $stmt = $this->pdo->query($queryMain[0]);
            
            if ($stmt === false) {
                $error = $this->pdo->errorInfo();
                return $this->_setLastError($error[1] ?? 0, $error[2] ?? 'Unknown error', $queryMain[0]);
            }

            // INSERT queries return generated ID.
            if (preg_match('/^\s* INSERT \s+/six', $queryMain[0])) {
                return (int)$this->pdo->lastInsertId();
            }

            // Non-SELECT queries return number of affected rows
            if ($stmt->rowCount() >= 0 && !preg_match('/^\s* SELECT \s+/six', $queryMain[0])) {
                return $stmt->rowCount();
            }

            return $stmt;
        } catch (PDOException $e) {
            return $this->_setLastError($e->getCode(), $e->getMessage(), $queryMain[0]);
        }
    }

    function _performFetch($result)
    {
        if (!$result || !$result instanceof PDOStatement) {
            return null;
        }

        try {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($row === false) {
                return null;
            }
            return $row;
        } catch (PDOException $e) {
            return $this->_setLastError($e->getCode(), $e->getMessage(), $this->_lastQuery);
        }
    }

    function _setDbError($query)
    {
        if ($this->pdo) {
            $error = $this->pdo->errorInfo();
            return $this->_setLastError($error[1] ?? 0, $error[2] ?? 'Unknown error', $query);
        } else {
            return $this->_setLastError(0, 'No database connection', $query);
        }
    }

    function _calcFoundRowsAvailable()
    {
        return true;
    }

    /**
     * Get PDO instance for direct access if needed
     * @return PDO|null
     */
    public function getPDO()
    {
        return $this->pdo;
    }
}

class DbSimple_PDO_Blob extends DbSimple_Generic_Blob
{
    var $blobdata = null;
    var $curSeek = 0;

    function __construct(&$database, $blobdata = null)
    {
        $this->blobdata = $blobdata;
        $this->curSeek = 0;
    }

    function read($len)
    {
        $p = $this->curSeek;
        $this->curSeek = min($this->curSeek + $len, strlen($this->blobdata));
        return substr($this->blobdata, $this->curSeek, $len);
    }

    function write($data)
    {
        $this->blobdata .= $data;
    }

    function close()
    {
        return $this->blobdata;
    }

    function length()
    {
        return strlen($this->blobdata);
    }
}
