/*
SQLyog Enterprise - MySQL GUI v7.14 
MySQL - 5.0.45-community-nt-log : Database - abk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`abk` /*!40100 DEFAULT CHARACTER SET cp1251 */;

USE `abk`;

/*Table structure for table `admin_menu` */

DROP TABLE IF EXISTS `admin_menu`;

CREATE TABLE `admin_menu` (
  `id` int(4) NOT NULL default '0',
  `href` varchar(30) character set cp1251 default NULL,
  `name` varchar(40) character set cp1251 NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `battles` */

DROP TABLE IF EXISTS `battles`;

CREATE TABLE `battles` (
  `id` int(4) NOT NULL auto_increment,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `type` varchar(30) NOT NULL default '',
  `win` varchar(30) NOT NULL default '',
  `status` varchar(30) NOT NULL default '',
  `creator_id` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`),
  KEY `id_5` (`id`),
  KEY `id_6` (`id`),
  KEY `id_7` (`id`),
  KEY `id_8` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=cp1251;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `img` varchar(30) default NULL,
  `mass` varchar(30) default NULL,
  `price` varchar(30) default NULL,
  `min_intellekt` varchar(30) default NULL,
  `min_vospriyatie` varchar(30) default NULL,
  `min_level` varchar(30) default NULL,
  `add_intellekt` varchar(30) default NULL,
  `add_mana` varchar(30) default NULL,
  `iznos_min` varchar(30) default NULL,
  `iznos_max` varchar(30) default NULL,
  `type` varchar(30) default NULL,
  `mountown` varchar(30) default NULL,
  `orden` varchar(30) default NULL,
  `add_water` varchar(30) NOT NULL default '',
  `add_earth` varchar(30) NOT NULL default '',
  `add_fire` varchar(30) NOT NULL default '',
  `add_air` varchar(30) NOT NULL default '',
  `pages` varchar(30) NOT NULL default '',
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

/*Table structure for table `bot_temp` */

DROP TABLE IF EXISTS `bot_temp`;

CREATE TABLE `bot_temp` (
  `id` bigint(20) NOT NULL auto_increment,
  `bot_name` varchar(30) NOT NULL default '',
  `hp` varchar(30) NOT NULL default '',
  `hp_all` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  `prototype` varchar(30) NOT NULL default '',
  `team` varchar(30) NOT NULL default '',
  `mana` varchar(30) NOT NULL default '',
  `mana_all` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=cp1251;

/*Table structure for table `character_bank` */

DROP TABLE IF EXISTS `character_bank`;

CREATE TABLE `character_bank` (
  `id` int(11) NOT NULL auto_increment,
  `guid` int(11) NOT NULL,
  `password` varchar(40) character set cp1251 NOT NULL default '',
  `cash` double NOT NULL default '0',
  `euro` double NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `character_bars` */

DROP TABLE IF EXISTS `character_bars`;

CREATE TABLE `character_bars` (
  `guid` int(11) unsigned NOT NULL,
  `stat` varchar(3) NOT NULL default '2|1',
  `mod` varchar(3) NOT NULL default '3|1',
  `power` varchar(3) NOT NULL default '0',
  `def` varchar(3) NOT NULL default '0',
  `set` varchar(3) NOT NULL default '0',
  `btn` varchar(3) NOT NULL default '0',
  PRIMARY KEY  (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `character_equip` */

DROP TABLE IF EXISTS `character_equip`;

CREATE TABLE `character_equip` (
  `guid` int(11) NOT NULL auto_increment,
  `helmet` int(11) NOT NULL default '0',
  `bracer` int(11) NOT NULL default '0',
  `hand_r` int(11) NOT NULL default '0',
  `hand_r_free` tinyint(3) NOT NULL default '1',
  `hand_r_type` varchar(30) NOT NULL default 'phisic',
  `cloak` int(11) NOT NULL default '0',
  `armor` int(11) NOT NULL default '0',
  `shirt` int(11) NOT NULL default '0',
  `belt` int(11) NOT NULL default '0',
  `earring` int(11) NOT NULL default '0',
  `amulet` int(11) NOT NULL default '0',
  `ring1` int(11) NOT NULL default '0',
  `ring2` int(11) NOT NULL default '0',
  `ring3` int(11) NOT NULL default '0',
  `gloves` int(11) NOT NULL default '0',
  `hand_l` int(11) NOT NULL default '0',
  `hand_l_free` tinyint(3) NOT NULL default '1',
  `hand_l_type` varchar(30) NOT NULL default 'phisic',
  `pants` int(11) NOT NULL default '0',
  `boots` int(11) NOT NULL default '0',
  PRIMARY KEY  (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=cp1251;

/*Table structure for table `character_info` */

DROP TABLE IF EXISTS `character_info`;

CREATE TABLE `character_info` (
  `guid` int(11) NOT NULL default '0',
  `name` varchar(30) character set cp1251 default NULL,
  `icq` varchar(30) character set cp1251 default NULL,
  `hide_icq` tinyint(3) unsigned NOT NULL default '0',
  `url` varchar(50) character set cp1251 default NULL,
  `town` varchar(30) character set cp1251 default NULL,
  `birthday` varchar(30) character set cp1251 default NULL,
  `color` varchar(30) character set cp1251 default NULL,
  `deviz` varchar(30) character set cp1251 default NULL,
  `hobie` longtext character set cp1251,
  `bank_note` longtext,
  `state` varchar(32) NOT NULL default '',
  `date` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `character_inventory` */

DROP TABLE IF EXISTS `character_inventory`;

CREATE TABLE `character_inventory` (
  `id` int(11) NOT NULL auto_increment,
  `guid` int(11) NOT NULL,
  `item_template` int(11) NOT NULL default '0',
  `wear` tinyint(3) NOT NULL default '0',
  `tear_cur` double NOT NULL default '0',
  `tear_max` double NOT NULL default '0',
  `inc_count_p` tinyint(3) NOT NULL default '0',
  `inc_str` tinyint(3) NOT NULL default '0',
  `inc_dex` tinyint(3) NOT NULL default '0',
  `inc_con` tinyint(3) NOT NULL default '0',
  `inc_int` tinyint(3) NOT NULL default '0',
  `is_modified` tinyint(2) NOT NULL default '0',
  `gift` varchar(30) character set cp1251 default NULL,
  `gift_author` varchar(30) character set cp1251 default NULL,
  `is_personal` varchar(30) character set cp1251 default NULL,
  `personal_owner` varchar(30) character set cp1251 default NULL,
  `locked` varchar(30) character set cp1251 default NULL,
  `password` varchar(30) character set cp1251 default NULL,
  `pages_used` tinyint(3) NOT NULL default '0',
  `mailed` tinyint(3) NOT NULL default '0',
  `date` bigint(20) NOT NULL default '0',
  `made_in` varchar(30) NOT NULL,
  `last_update` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=330 DEFAULT CHARSET=utf8;

/*Table structure for table `character_sets` */

DROP TABLE IF EXISTS `character_sets`;

CREATE TABLE `character_sets` (
  `guid` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `helmet` int(11) NOT NULL default '0',
  `bracer` int(11) NOT NULL default '0',
  `hand_r` int(11) NOT NULL default '0',
  `cloak` int(11) NOT NULL default '0',
  `armor` int(11) NOT NULL default '0',
  `shirt` int(11) NOT NULL default '0',
  `belt` int(11) NOT NULL default '0',
  `earring` int(11) NOT NULL default '0',
  `amulet` int(11) NOT NULL default '0',
  `ring1` int(11) NOT NULL default '0',
  `ring2` int(11) NOT NULL default '0',
  `ring3` int(11) NOT NULL default '0',
  `gloves` int(11) NOT NULL default '0',
  `hand_l` int(11) NOT NULL default '0',
  `pants` int(11) NOT NULL default '0',
  `boots` int(11) NOT NULL default '0',
  PRIMARY KEY  (`guid`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=cp1251;

/*Table structure for table `character_stats` */

DROP TABLE IF EXISTS `character_stats`;

CREATE TABLE `character_stats` (
  `guid` int(11) unsigned NOT NULL auto_increment,
  `hp_cure` bigint(20) default '0',
  `hp_all` int(10) NOT NULL default '48',
  `hp_regen` int(10) NOT NULL default '100' COMMENT '%',
  `mp_cure` bigint(20) default '0',
  `mp_all` int(10) NOT NULL default '0',
  `mp_regen` int(10) NOT NULL default '100' COMMENT '%',
  `str` int(10) NOT NULL default '3',
  `dex` int(10) NOT NULL default '3',
  `con` int(10) NOT NULL default '3',
  `vit` int(10) NOT NULL default '3',
  `int` int(10) NOT NULL default '0',
  `wis` int(10) NOT NULL default '0',
  `spi` int(10) NOT NULL default '0',
  `ups` int(10) NOT NULL default '3',
  `trade` double NOT NULL default '0',
  `speed` int(10) NOT NULL,
  `cast` int(10) NOT NULL,
  `walk` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `phisic` int(10) NOT NULL default '0',
  `hand_r_phisic` int(10) NOT NULL default '0',
  `hand_l_phisic` int(10) NOT NULL default '0',
  `sword` int(10) NOT NULL default '0',
  `hand_r_sword` int(10) NOT NULL default '0',
  `hand_l_sword` int(10) NOT NULL default '0',
  `axe` int(10) NOT NULL default '0',
  `hand_r_axe` int(10) NOT NULL default '0',
  `hand_l_axe` int(10) NOT NULL default '0',
  `fail` int(10) NOT NULL default '0',
  `hand_r_fail` int(10) NOT NULL default '0',
  `hand_l_fail` int(10) NOT NULL default '0',
  `knife` int(10) NOT NULL default '0',
  `hand_r_knife` int(10) NOT NULL default '0',
  `hand_l_knife` int(10) NOT NULL default '0',
  `staff` int(10) NOT NULL default '0',
  `shot` int(10) NOT NULL default '0',
  `fire` int(10) NOT NULL default '0',
  `water` int(10) NOT NULL default '0',
  `air` int(10) NOT NULL default '0',
  `earth` int(10) NOT NULL default '0',
  `light` int(10) NOT NULL default '0',
  `gray` int(10) NOT NULL default '0',
  `dark` int(10) NOT NULL default '0',
  `skills` int(10) NOT NULL default '1',
  `def_h_min` int(10) NOT NULL default '0',
  `def_h_max` int(10) NOT NULL default '0',
  `def_a_min` int(10) NOT NULL default '0',
  `def_a_max` int(10) NOT NULL default '0',
  `def_b_min` int(10) NOT NULL default '0',
  `def_b_max` int(10) NOT NULL default '0',
  `def_l_min` int(10) NOT NULL default '0',
  `def_l_max` int(10) NOT NULL default '0',
  `resist_sting` double NOT NULL default '4.5',
  `resist_sting_h` double NOT NULL default '0',
  `resist_sting_a` double NOT NULL default '0',
  `resist_sting_b` double NOT NULL default '0',
  `resist_sting_l` double NOT NULL default '0',
  `resist_slash` double NOT NULL default '4.5',
  `resist_slash_h` double NOT NULL default '0',
  `resist_slash_a` double NOT NULL default '0',
  `resist_slash_b` double NOT NULL default '0',
  `resist_slash_l` double NOT NULL default '0',
  `resist_crush` double NOT NULL default '4.5',
  `resist_crush_h` double NOT NULL default '0',
  `resist_crush_a` double NOT NULL default '0',
  `resist_crush_b` double NOT NULL default '0',
  `resist_crush_l` double NOT NULL default '0',
  `resist_sharp` double NOT NULL default '4.5',
  `resist_sharp_h` double NOT NULL default '0',
  `resist_sharp_a` double NOT NULL default '0',
  `resist_sharp_b` double NOT NULL default '0',
  `resist_sharp_l` double NOT NULL default '0',
  `resist_fire` double NOT NULL default '4.5',
  `resist_water` double NOT NULL default '4.5',
  `resist_air` double NOT NULL default '4.5',
  `resist_earth` double NOT NULL default '4.5',
  `resist_light` double NOT NULL default '4.5',
  `resist_gray` double NOT NULL default '4.5',
  `resist_dark` double NOT NULL default '4.5',
  `repres_all_magic` int(10) NOT NULL default '0',
  `repres_fire` int(10) NOT NULL default '0',
  `repres_water` int(10) NOT NULL default '0',
  `repres_air` int(10) NOT NULL default '0',
  `repres_earth` int(10) NOT NULL default '0',
  `mf_fire` double NOT NULL default '0',
  `mf_water` double NOT NULL default '0',
  `mf_air` double NOT NULL default '0',
  `mf_earth` double NOT NULL default '0',
  `mf_light` double NOT NULL default '0',
  `mf_gray` double NOT NULL default '0',
  `mf_dark` double NOT NULL default '0',
  `mf_sting` int(10) NOT NULL default '0',
  `hand_r_sting` int(10) NOT NULL default '0',
  `hand_l_sting` int(10) NOT NULL default '0',
  `mf_slash` int(10) NOT NULL default '0',
  `hand_r_slash` int(10) NOT NULL default '0',
  `hand_l_slash` int(10) NOT NULL default '0',
  `mf_crush` int(10) NOT NULL default '0',
  `hand_r_crush` int(10) NOT NULL default '0',
  `hand_l_crush` int(10) NOT NULL default '0',
  `mf_sharp` int(10) NOT NULL default '0',
  `hand_r_sharp` int(10) NOT NULL default '0',
  `hand_l_sharp` int(10) NOT NULL default '0',
  `mf_crit` int(10) NOT NULL default '21',
  `hand_r_crit` int(10) NOT NULL default '0',
  `hand_l_crit` int(10) NOT NULL default '0',
  `mf_critpower` int(10) NOT NULL,
  `hand_r_critpower` int(10) NOT NULL,
  `hand_l_critpower` int(10) NOT NULL,
  `mf_anticrit` int(10) NOT NULL default '9',
  `mf_uvorot` int(10) NOT NULL default '21',
  `mf_antiuvorot` int(10) NOT NULL default '9',
  `hand_r_antiuvorot` int(10) NOT NULL default '0',
  `hand_l_antiuvorot` int(10) NOT NULL default '0',
  `mf_piercearmor` int(10) NOT NULL default '0',
  `hand_r_piercearmor` int(10) NOT NULL default '0',
  `hand_l_piercearmor` int(10) NOT NULL default '0',
  `mf_contr` int(10) NOT NULL default '0',
  `mf_parry` int(10) NOT NULL default '0',
  `mf_blockshield` int(10) NOT NULL default '0',
  `wp_min` int(10) NOT NULL default '4',
  `hand_r_hitmin` int(10) NOT NULL default '0',
  `hand_l_hitmin` int(10) NOT NULL default '0',
  `wp_max` int(10) NOT NULL default '6',
  `hand_r_hitmax` int(10) NOT NULL default '0',
  `hand_l_hitmax` int(10) NOT NULL default '0',
  PRIMARY KEY  (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Table structure for table `characters` */

DROP TABLE IF EXISTS `characters`;

CREATE TABLE `characters` (
  `guid` int(11) unsigned NOT NULL auto_increment,
  `login` varchar(32) character set cp1251 NOT NULL default '',
  `login_sec` varchar(32) character set cp1251 NOT NULL default '',
  `password` varchar(40) character set cp1251 NOT NULL default '',
  `level` tinyint(3) unsigned NOT NULL default '0',
  `exp` int(10) NOT NULL default '0',
  `next_up` int(10) NOT NULL default '20',
  `admin_level` tinyint(3) unsigned NOT NULL default '0',
  `money` double NOT NULL default '0',
  `money_euro` double NOT NULL default '0',
  `city` varchar(30) character set cp1251 NOT NULL default '',
  `room` varchar(30) character set cp1251 NOT NULL default 'km_1',
  `clan` varchar(30) character set cp1251 default NULL,
  `orden` smallint(3) unsigned NOT NULL default '0',
  `rang` smallint(3) unsigned NOT NULL default '0',
  `hp` int(10) NOT NULL default '48',
  `mp` int(10) NOT NULL default '0',
  `win` int(10) NOT NULL default '0',
  `lose` int(10) NOT NULL default '0',
  `draw` int(10) NOT NULL default '0',
  `mass` double NOT NULL default '0',
  `maxmass` double NOT NULL default '43',
  `glava` varchar(30) character set cp1251 default NULL,
  `chin` varchar(30) character set cp1251 default NULL,
  `passport` varchar(30) character set cp1251 default NULL,
  `status` varchar(11) character set cp1251 default 'Рекрут',
  `shut` bigint(20) NOT NULL default '0',
  `prision` bigint(20) NOT NULL default '0',
  `prision_reason` varchar(255) character set cp1251 default NULL,
  `block` tinyint(3) NOT NULL default '0',
  `block_reason` varchar(255) character set cp1251 default NULL,
  `travm` bigint(20) NOT NULL default '0',
  `travm_stat` varchar(30) character set cp1251 default NULL,
  `travm_var` varchar(30) character set cp1251 default NULL,
  `travm_old_stat` varchar(30) character set cp1251 default NULL,
  `battle` varchar(30) character set cp1251 default NULL,
  `weapon_type` varchar(30) character set cp1251 default NULL,
  `reg_ip` varchar(30) character set cp1251 NOT NULL default '',
  `battle_pos` varchar(30) character set cp1251 default NULL,
  `battle_team` varchar(30) character set cp1251 default NULL,
  `battle_opponent` varchar(30) character set cp1251 NOT NULL default '',
  `stat_rang` varchar(40) character set cp1251 NOT NULL default '',
  `clan_short` varchar(30) character set cp1251 NOT NULL default '',
  `clan_take` varchar(30) character set cp1251 NOT NULL default '',
  `dealer` tinyint(3) NOT NULL default '0',
  `otdel` varchar(30) character set cp1251 NOT NULL default '',
  `metka` varchar(30) character set cp1251 NOT NULL default '',
  `profession` varchar(30) character set cp1251 NOT NULL default '',
  `acsess1` varchar(30) character set cp1251 NOT NULL default '',
  `acsess2` varchar(30) character set cp1251 NOT NULL default '',
  `animal` varchar(30) character set cp1251 NOT NULL default '',
  `chat_s` varchar(30) character set cp1251 NOT NULL default '',
  `navik_wood` varchar(30) character set cp1251 NOT NULL default '',
  `vote` tinyint(3) NOT NULL default '0',
  `add_resourses` int(4) NOT NULL default '0',
  `podval` varchar(30) character set cp1251 NOT NULL default '',
  `semija` varchar(30) character set cp1251 NOT NULL default '',
  `sex` varchar(30) character set cp1251 default NULL,
  `mail` text character set cp1251,
  `shape` varchar(30) character set cp1251 default NULL,
  `transfers` tinyint(3) unsigned NOT NULL default '0',
  `delo` text character set cp1251,
  `afk` tinyint(3) unsigned NOT NULL default '0',
  `dnd` tinyint(3) unsigned NOT NULL default '0',
  `message` text,
  `return_time` int(10) NOT NULL default '1800',
  `next_shape` bigint(20) NOT NULL default '0',
  `last_go` bigint(20) NOT NULL default '0',
  `last_room` varchar(30) NOT NULL,
  `last_return` bigint(20) NOT NULL default '0',
  `last_time` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Table structure for table `city_chat` */

DROP TABLE IF EXISTS `city_chat`;

CREATE TABLE `city_chat` (
  `id` int(11) NOT NULL auto_increment,
  `city` varchar(30) character set cp1251 NOT NULL default '',
  `room` varchar(30) character set cp1251 NOT NULL default '',
  `sender` varchar(32) NOT NULL,
  `to` longtext NOT NULL,
  `msg` longtext character set cp1251 NOT NULL,
  `class` varchar(30) character set cp1251 NOT NULL default '',
  `date_stamp` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`,`city`,`room`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=906 DEFAULT CHARSET=utf8;

/*Table structure for table `city_mail_items` */

DROP TABLE IF EXISTS `city_mail_items`;

CREATE TABLE `city_mail_items` (
  `id` int(11) NOT NULL auto_increment,
  `sender` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` double NOT NULL default '0',
  `delivery_time` bigint(20) NOT NULL,
  `date` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=cp1251;

/*Table structure for table `city_rooms` */

DROP TABLE IF EXISTS `city_rooms`;

CREATE TABLE `city_rooms` (
  `room` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `from` text NOT NULL,
  `time_to_go` tinyint(3) NOT NULL default '0',
  `min_level` tinyint(3) NOT NULL default '0',
  `need_orden` tinyint(3) NOT NULL default '0',
  `sex` varchar(6) NOT NULL,
  `description` longtext,
  `shop` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`room`,`city`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `city_stella_main` */

DROP TABLE IF EXISTS `city_stella_main`;

CREATE TABLE `city_stella_main` (
  `id` int(4) NOT NULL auto_increment,
  `question` varchar(250) NOT NULL default '',
  `min_level` tinyint(3) NOT NULL,
  `open` tinyint(3) NOT NULL default '0',
  `city` varchar(32) NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

/*Table structure for table `city_stella_question` */

DROP TABLE IF EXISTS `city_stella_question`;

CREATE TABLE `city_stella_question` (
  `id` int(4) NOT NULL auto_increment,
  `question` int(4) NOT NULL default '0',
  `answer` varchar(250) NOT NULL default '',
  `count` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`,`question`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

/*Table structure for table `clan` */

DROP TABLE IF EXISTS `clan`;

CREATE TABLE `clan` (
  `id` bigint(30) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `name_short` varchar(30) NOT NULL default '',
  `glava` varchar(30) NOT NULL default '',
  `site` varchar(30) NOT NULL default '',
  `story` longtext NOT NULL,
  `orden` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

/*Table structure for table `clan_zayavka` */

DROP TABLE IF EXISTS `clan_zayavka`;

CREATE TABLE `clan_zayavka` (
  `name` varchar(30) NOT NULL default '',
  `name_short` varchar(5) NOT NULL default '',
  `site` varchar(50) NOT NULL default '',
  `znak` varchar(30) NOT NULL default '',
  `history` mediumtext NOT NULL,
  `orden` varchar(30) NOT NULL default '',
  `glava` varchar(30) NOT NULL default '',
  `glava_fio` varchar(30) NOT NULL default '',
  `sovet1` varchar(30) NOT NULL default '',
  `sovet1_fio` varchar(30) NOT NULL default '',
  `sovet2` varchar(30) NOT NULL default '',
  `sovet2_fio` varchar(30) NOT NULL default '',
  `sovet3` varchar(30) NOT NULL default '',
  `sovet3_fio` varchar(30) NOT NULL default '',
  `sovet4` varchar(30) NOT NULL default '',
  `sovet4_fio` varchar(30) NOT NULL default '',
  `date` varchar(30) NOT NULL default '',
  `confirm` varchar(30) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `comok` */

DROP TABLE IF EXISTS `comok`;

CREATE TABLE `comok` (
  `id` int(4) NOT NULL auto_increment,
  `owner` varchar(30) default NULL,
  `price` int(30) default '0',
  `price_ekr` varchar(30) NOT NULL default '0',
  `object_id` varchar(30) default NULL,
  `object_type` varchar(30) default NULL,
  `object_razdel` varchar(30) default NULL,
  `iznos` int(30) default NULL,
  `iznos_max` varchar(30) default NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `term` varchar(30) NOT NULL default '',
  `is_modified` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `forums` */

DROP TABLE IF EXISTS `forums`;

CREATE TABLE `forums` (
  `id` int(2) NOT NULL default '0',
  `name` varchar(15) NOT NULL default '',
  `title` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `gift` */

DROP TABLE IF EXISTS `gift`;

CREATE TABLE `gift` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `img` varchar(30) NOT NULL default '',
  `price` varchar(30) NOT NULL default '',
  `wish` varchar(255) NOT NULL default '',
  `mass` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default '',
  `is_random` varchar(30) NOT NULL default '',
  `g_type` varchar(30) NOT NULL default '',
  `g_id` varchar(30) NOT NULL default '',
  `mountown` varchar(10) NOT NULL default '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `goers` */

DROP TABLE IF EXISTS `goers`;

CREATE TABLE `goers` (
  `id` bigint(30) NOT NULL auto_increment,
  `login` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `destenation` varchar(30) NOT NULL default '',
  `dest_game` varchar(30) NOT NULL default '',
  `len` varchar(30) NOT NULL default '',
  `len_done` varchar(30) NOT NULL default '',
  `napr` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `history_auth` */

DROP TABLE IF EXISTS `history_auth`;

CREATE TABLE `history_auth` (
  `id` bigint(20) NOT NULL auto_increment,
  `guid` int(11) NOT NULL,
  `action` tinyint(2) NOT NULL,
  `ip` varchar(30) NOT NULL default '',
  `city` varchar(32) NOT NULL,
  `comment` varchar(32) default NULL,
  `date` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`,`guid`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=266 DEFAULT CHARSET=cp1251;

/*Table structure for table `history_bank` */

DROP TABLE IF EXISTS `history_bank`;

CREATE TABLE `history_bank` (
  `id` bigint(20) NOT NULL auto_increment,
  `credit` int(10) NOT NULL default '0',
  `credit2` int(10) NOT NULL default '0',
  `cash` double NOT NULL default '0',
  `euro` double NOT NULL default '0',
  `operation` tinyint(3) NOT NULL default '0',
  `date` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`,`credit`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

/*Table structure for table `history_mail` */

DROP TABLE IF EXISTS `history_mail`;

CREATE TABLE `history_mail` (
  `id` int(11) NOT NULL auto_increment,
  `guid` int(11) NOT NULL,
  `receive` varchar(30) NOT NULL default '',
  `action` varchar(30) NOT NULL default '',
  `item` longtext NOT NULL,
  `ip` varchar(30) NOT NULL default '',
  `date` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`,`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=cp1251;

/*Table structure for table `history_transfers` */

DROP TABLE IF EXISTS `history_transfers`;

CREATE TABLE `history_transfers` (
  `id` int(11) NOT NULL auto_increment,
  `guid` int(11) NOT NULL,
  `receive` varchar(30) NOT NULL default '',
  `action` varchar(30) NOT NULL default '',
  `item` longtext NOT NULL,
  `ip` varchar(30) NOT NULL default '',
  `date` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`,`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=352 DEFAULT CHARSET=cp1251;

/*Table structure for table `hit_temp` */

DROP TABLE IF EXISTS `hit_temp`;

CREATE TABLE `hit_temp` (
  `attack` varchar(30) NOT NULL default '',
  `defend` varchar(30) NOT NULL default '',
  `def_hit1` varchar(30) NOT NULL default '',
  `def_hit2` varchar(30) NOT NULL default '',
  `def_block1` varchar(30) NOT NULL default '',
  `def_block2` varchar(30) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `item_amount` */

DROP TABLE IF EXISTS `item_amount`;

CREATE TABLE `item_amount` (
  `entry` int(11) unsigned NOT NULL default '0',
  `dem-shop` smallint(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`entry`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `item_template` */

DROP TABLE IF EXISTS `item_template`;

CREATE TABLE `item_template` (
  `entry` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `img` varchar(30) NOT NULL default '',
  `section` varchar(11) NOT NULL default '',
  `type` varchar(11) NOT NULL default '',
  `item_flags` int(11) unsigned NOT NULL default '0',
  `mass` double unsigned NOT NULL default '0',
  `price` double NOT NULL default '0',
  `price_euro` double NOT NULL default '0',
  `tear` int(3) unsigned NOT NULL default '0',
  `min_level` tinyint(3) unsigned NOT NULL default '0',
  `min_str` tinyint(3) unsigned NOT NULL default '0',
  `min_dex` tinyint(3) unsigned NOT NULL default '0',
  `min_con` tinyint(3) unsigned NOT NULL default '0',
  `min_vit` tinyint(3) unsigned NOT NULL default '0',
  `min_int` tinyint(3) unsigned NOT NULL default '0',
  `min_wis` tinyint(3) unsigned NOT NULL default '0',
  `min_sword` tinyint(3) unsigned NOT NULL default '0',
  `min_axe` tinyint(3) unsigned NOT NULL default '0',
  `min_fail` tinyint(3) unsigned NOT NULL default '0',
  `min_knife` tinyint(3) unsigned NOT NULL default '0',
  `min_staff` tinyint(3) unsigned NOT NULL default '0',
  `min_shot` tinyint(3) unsigned NOT NULL default '0',
  `min_fire` tinyint(3) unsigned NOT NULL default '0',
  `min_water` tinyint(3) unsigned NOT NULL default '0',
  `min_air` tinyint(3) unsigned NOT NULL default '0',
  `min_earth` tinyint(3) unsigned NOT NULL default '0',
  `min_light` tinyint(3) unsigned NOT NULL default '0',
  `min_gray` tinyint(3) unsigned NOT NULL default '0',
  `min_dark` tinyint(3) unsigned NOT NULL default '0',
  `min_mp_all` tinyint(3) unsigned NOT NULL default '0',
  `add_str` tinyint(3) NOT NULL default '0',
  `add_dex` tinyint(3) NOT NULL default '0',
  `add_con` tinyint(3) NOT NULL default '0',
  `add_int` tinyint(3) NOT NULL default '0',
  `add_hp` tinyint(3) NOT NULL default '0',
  `add_mp` tinyint(3) NOT NULL default '0',
  `mpcons` int(3) NOT NULL default '0',
  `hpreco` int(3) NOT NULL default '0',
  `mpreco` int(3) NOT NULL default '0',
  `def_h_min` tinyint(3) NOT NULL default '0',
  `def_h_max` tinyint(3) NOT NULL default '0',
  `def_a_min` tinyint(3) NOT NULL default '0',
  `def_a_max` tinyint(3) NOT NULL default '0',
  `def_b_min` tinyint(3) NOT NULL default '0',
  `def_b_max` tinyint(3) NOT NULL default '0',
  `def_l_min` tinyint(3) NOT NULL default '0',
  `def_l_max` tinyint(3) NOT NULL default '0',
  `resist_all_magic` int(3) NOT NULL default '0',
  `resist_fire` int(3) NOT NULL default '0',
  `resist_water` int(3) NOT NULL default '0',
  `resist_air` int(3) NOT NULL default '0',
  `resist_earth` int(3) NOT NULL default '0',
  `resist_light` int(3) NOT NULL default '0',
  `resist_gray` int(3) NOT NULL default '0',
  `resist_dark` int(3) NOT NULL default '0',
  `resist_all_damage` int(3) NOT NULL default '0',
  `resist_all_damage_h` int(3) NOT NULL default '0',
  `resist_all_damage_a` int(3) NOT NULL default '0',
  `resist_all_damage_b` int(3) NOT NULL default '0',
  `resist_all_damage_l` int(3) NOT NULL default '0',
  `resist_sting` int(3) NOT NULL default '0',
  `resist_sting_h` int(3) NOT NULL default '0',
  `resist_sting_a` int(3) NOT NULL default '0',
  `resist_sting_b` int(3) NOT NULL default '0',
  `resist_sting_l` int(3) NOT NULL default '0',
  `resist_slash` int(3) NOT NULL default '0',
  `resist_slash_h` int(3) NOT NULL default '0',
  `resist_slash_a` int(3) NOT NULL default '0',
  `resist_slash_b` int(3) NOT NULL default '0',
  `resist_slash_l` int(3) NOT NULL default '0',
  `resist_crush` int(3) NOT NULL default '0',
  `resist_crush_h` int(3) NOT NULL default '0',
  `resist_crush_a` int(3) NOT NULL default '0',
  `resist_crush_b` int(3) NOT NULL default '0',
  `resist_crush_l` int(3) NOT NULL default '0',
  `resist_sharp` int(3) NOT NULL default '0',
  `resist_sharp_h` int(3) NOT NULL default '0',
  `resist_sharp_a` int(3) NOT NULL default '0',
  `resist_sharp_b` int(3) NOT NULL default '0',
  `resist_sharp_l` int(3) NOT NULL default '0',
  `mf_all_damage` int(3) NOT NULL default '0',
  `mf_all_damage_h` int(3) NOT NULL default '0',
  `mf_sting` int(3) NOT NULL default '0',
  `mf_sting_h` int(3) NOT NULL default '0',
  `mf_slash` int(3) NOT NULL default '0',
  `mf_slash_h` int(3) NOT NULL default '0',
  `mf_crush` int(3) NOT NULL default '0',
  `mf_crush_h` int(3) NOT NULL default '0',
  `mf_sharp` int(3) NOT NULL default '0',
  `mf_sharp_h` int(3) NOT NULL default '0',
  `mf_all_magic` int(3) NOT NULL default '0',
  `mf_fire` int(3) NOT NULL default '0',
  `mf_water` int(3) NOT NULL default '0',
  `mf_air` int(3) NOT NULL default '0',
  `mf_earth` int(3) NOT NULL default '0',
  `mf_light` int(3) NOT NULL default '0',
  `mf_gray` int(3) NOT NULL default '0',
  `mf_dark` int(3) NOT NULL default '0',
  `mf_crit` int(3) NOT NULL default '0',
  `mf_crit_h` int(3) NOT NULL default '0',
  `mf_critpower` int(3) NOT NULL default '0',
  `mf_critpower_h` int(3) NOT NULL default '0',
  `mf_anticrit` int(3) NOT NULL default '0',
  `mf_uvorot` int(3) NOT NULL default '0',
  `mf_antiuvorot` int(3) NOT NULL default '0',
  `mf_antiuvorot_h` int(3) NOT NULL default '0',
  `mf_piercearmor` int(3) NOT NULL default '0',
  `mf_piercearmor_h` int(3) NOT NULL default '0',
  `mf_contr` int(3) NOT NULL default '0',
  `mf_parry` int(3) NOT NULL default '0',
  `mf_blockshield` int(3) NOT NULL default '0',
  `all_magic` int(3) NOT NULL default '0',
  `fire` int(3) NOT NULL default '0',
  `water` int(3) NOT NULL default '0',
  `air` int(3) NOT NULL default '0',
  `earth` int(3) NOT NULL default '0',
  `light` int(3) NOT NULL default '0',
  `gray` int(3) NOT NULL default '0',
  `dark` int(3) NOT NULL default '0',
  `all_mastery` int(3) NOT NULL default '0',
  `sword` int(3) NOT NULL default '0',
  `sword_h` int(3) NOT NULL default '0',
  `axe` int(3) NOT NULL default '0',
  `axe_h` int(3) NOT NULL default '0',
  `fail` int(3) NOT NULL default '0',
  `fail_h` int(3) NOT NULL default '0',
  `knife` int(3) NOT NULL default '0',
  `knife_h` int(3) NOT NULL default '0',
  `staff` int(3) NOT NULL default '0',
  `shot` int(3) NOT NULL default '0',
  `min_attack` int(2) NOT NULL default '0',
  `max_attack` int(2) NOT NULL default '0',
  `add_attack_min` int(2) NOT NULL default '0',
  `add_attack_max` int(2) NOT NULL default '0',
  `repres_all_magic` int(3) NOT NULL default '0',
  `repres_fire` int(3) NOT NULL default '0',
  `repres_water` int(3) NOT NULL default '0',
  `repres_air` int(3) NOT NULL default '0',
  `repres_earth` int(3) NOT NULL default '0',
  `chance_sting` tinyint(3) NOT NULL default '0',
  `chance_slash` tinyint(3) NOT NULL default '0',
  `chance_crush` tinyint(3) NOT NULL default '0',
  `chance_sharp` tinyint(3) NOT NULL default '0',
  `chance_fire` tinyint(3) NOT NULL default '0',
  `chance_water` tinyint(3) NOT NULL default '0',
  `chance_air` tinyint(3) NOT NULL default '0',
  `chance_earth` tinyint(3) NOT NULL default '0',
  `chance_light` tinyint(3) NOT NULL default '0',
  `chance_dark` tinyint(3) NOT NULL default '0',
  `inc_count` tinyint(3) NOT NULL default '0',
  `personal_owner` varchar(30) default NULL,
  `block` tinyint(3) NOT NULL default '0',
  `orden` tinyint(3) NOT NULL default '0',
  `sex` varchar(30) default NULL,
  `itemset` int(11) NOT NULL default '0',
  `hands` tinyint(3) NOT NULL default '0',
  `description` longtext,
  `validity` bigint(20) NOT NULL default '0',
  `add_speed` varchar(30) NOT NULL default '',
  `add_cast` varchar(30) NOT NULL default '',
  `add_trade` varchar(30) NOT NULL default '',
  `add_walk` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`entry`),
  KEY `id` (`entry`)
) ENGINE=MyISAM AUTO_INCREMENT=1055 DEFAULT CHARSET=cp1251;

/*Table structure for table `lotto` */

DROP TABLE IF EXISTS `lotto`;

CREATE TABLE `lotto` (
  `id` bigint(10) NOT NULL auto_increment,
  `name` varchar(10) NOT NULL default '',
  `number` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=cp1251;

/*Table structure for table `lotto_fond` */

DROP TABLE IF EXISTS `lotto_fond`;

CREATE TABLE `lotto_fond` (
  `fond` varchar(30) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `medal` */

DROP TABLE IF EXISTS `medal`;

CREATE TABLE `medal` (
  `id` bigint(30) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `img` varchar(30) NOT NULL default '',
  `msg` varchar(255) NOT NULL default '',
  `type` varchar(30) NOT NULL default '',
  `price` varchar(30) NOT NULL default '',
  `disc` longtext NOT NULL,
  `add_l` varchar(30) NOT NULL default '',
  `add_u` varchar(30) NOT NULL default '',
  `mass` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

/*Table structure for table `miners` */

DROP TABLE IF EXISTS `miners`;

CREATE TABLE `miners` (
  `login` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `resource` varchar(30) NOT NULL default '',
  `cell` varchar(30) NOT NULL default '',
  `count` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `theme` varchar(60) character set cp1251 NOT NULL default '',
  `msg` text character set cp1251 NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `online` */

DROP TABLE IF EXISTS `online`;

CREATE TABLE `online` (
  `guid` varchar(32) character set cp1251 NOT NULL default '',
  `login_display` varchar(32) character set cp1251 NOT NULL default '',
  `city` varchar(30) character set cp1251 NOT NULL default '',
  `room` varchar(30) character set cp1251 NOT NULL default '',
  `ip` varchar(30) character set cp1251 NOT NULL default '',
  `last_time` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `player_exp_for_level` */

DROP TABLE IF EXISTS `player_exp_for_level`;

CREATE TABLE `player_exp_for_level` (
  `up` int(11) NOT NULL default '0',
  `level` tinyint(3) unsigned NOT NULL default '0',
  `exp` int(11) NOT NULL default '0',
  `ups` tinyint(3) unsigned NOT NULL default '0',
  `skills` tinyint(3) unsigned NOT NULL default '0',
  `money` double NOT NULL default '0',
  `vit` int(11) NOT NULL default '0',
  `add_bars` varchar(32) NOT NULL default '',
  `status` varchar(30) default '',
  PRIMARY KEY  (`up`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `player_shapes` */

DROP TABLE IF EXISTS `player_shapes`;

CREATE TABLE `player_shapes` (
  `id` int(4) NOT NULL auto_increment,
  `sex` varchar(11) NOT NULL default '',
  `img` varchar(30) NOT NULL,
  `level` tinyint(3) unsigned NOT NULL default '0',
  `str` tinyint(3) unsigned NOT NULL default '0',
  `dex` tinyint(3) unsigned NOT NULL default '0',
  `con` tinyint(3) unsigned NOT NULL default '0',
  `vit` tinyint(3) unsigned NOT NULL default '0',
  `int` tinyint(3) unsigned NOT NULL default '0',
  `wis` tinyint(3) unsigned NOT NULL default '0',
  `sword` tinyint(3) unsigned NOT NULL default '0',
  `axe` tinyint(3) unsigned NOT NULL default '0',
  `fail` tinyint(3) unsigned NOT NULL default '0',
  `knife` tinyint(3) unsigned NOT NULL default '0',
  `fire` tinyint(3) unsigned NOT NULL default '0',
  `water` tinyint(3) unsigned NOT NULL default '0',
  `earth` tinyint(3) unsigned NOT NULL default '0',
  `air` tinyint(3) unsigned NOT NULL default '0',
  `light` tinyint(3) unsigned NOT NULL default '0',
  `dark` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=cp1251;

/*Table structure for table `podval` */

DROP TABLE IF EXISTS `podval`;

CREATE TABLE `podval` (
  `number` varchar(40) NOT NULL default '',
  `type` varbinary(40) NOT NULL default '                                        '
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL auto_increment,
  `top_id` bigint(20) NOT NULL default '0',
  `text` text NOT NULL,
  `date` varchar(255) NOT NULL default '',
  `poster` varchar(40) NOT NULL default '',
  `p_id` bigint(20) NOT NULL default '0',
  `p_rank` int(2) NOT NULL default '0',
  `p_tribe` varchar(255) NOT NULL default '0',
  `p_level` int(11) NOT NULL default '0',
  `p_rase` int(2) NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  KEY `top_id` (`top_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1176923677 DEFAULT CHARSET=cp1251;

/*Table structure for table `protocol` */

DROP TABLE IF EXISTS `protocol`;

CREATE TABLE `protocol` (
  `id` bigint(30) NOT NULL auto_increment,
  `login` varchar(30) NOT NULL default '',
  `templier` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default '',
  `reason` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=cp1251;

/*Table structure for table `protocol_adm` */

DROP TABLE IF EXISTS `protocol_adm`;

CREATE TABLE `protocol_adm` (
  `id` int(4) NOT NULL auto_increment,
  `date_time` varchar(30) NOT NULL default '',
  `login` varchar(30) NOT NULL default '',
  `target` varchar(30) NOT NULL default '',
  `msg` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

/*Table structure for table `res` */

DROP TABLE IF EXISTS `res`;

CREATE TABLE `res` (
  `locate` varchar(30) NOT NULL default '',
  `resource` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `riba` */

DROP TABLE IF EXISTS `riba`;

CREATE TABLE `riba` (
  `id` bigint(30) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `img` varchar(30) NOT NULL default '',
  `price` varchar(30) NOT NULL default '',
  `mass` varchar(30) NOT NULL default '',
  `mountown` varchar(30) NOT NULL default '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10001 DEFAULT CHARSET=cp1251;

/*Table structure for table `river` */

DROP TABLE IF EXISTS `river`;

CREATE TABLE `river` (
  `login` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `resource` varchar(30) NOT NULL default '',
  KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `sapojn` */

DROP TABLE IF EXISTS `sapojn`;

CREATE TABLE `sapojn` (
  `id` int(7) NOT NULL auto_increment,
  `login` varchar(30) default NULL,
  `money` varchar(30) NOT NULL default '0',
  `num` varchar(30) NOT NULL default '0',
  `zarplata` varchar(30) NOT NULL default '0.2',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

/*Table structure for table `scroll` */

DROP TABLE IF EXISTS `scroll`;

CREATE TABLE `scroll` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `img` varchar(30) default NULL,
  `mass` int(4) default NULL,
  `price` int(6) default NULL,
  `veroyat` char(3) NOT NULL default '',
  `min_vospriyatie` int(2) default NULL,
  `min_intellekt` int(2) default NULL,
  `min_level` int(2) default NULL,
  `iznos_min` int(3) default NULL,
  `iznos_max` int(3) default NULL,
  `mana` varchar(30) NOT NULL default '',
  `file` varchar(30) NOT NULL default '',
  `orden` varchar(30) NOT NULL default '',
  `mountown` varchar(30) NOT NULL default '',
  `min_sila2` varchar(30) NOT NULL default '',
  `add_arm_l` varchar(30) NOT NULL default '',
  `add_arm_m` varchar(30) NOT NULL default '',
  `add_arm_h` varchar(30) NOT NULL default '',
  `add_water` varchar(30) NOT NULL default '',
  `add_air` varchar(30) NOT NULL default '',
  `add_earth` varchar(30) NOT NULL default '',
  `add_cast` varchar(30) NOT NULL default '',
  `add_trade` varchar(30) NOT NULL default '',
  `add_cure` varchar(30) NOT NULL default '',
  `add_walk` varchar(30) NOT NULL default '',
  `min_lovkost2` varchar(30) NOT NULL default '',
  `min_udacha2` varchar(30) NOT NULL default '',
  `min_power2` varchar(30) NOT NULL default '',
  `min_intellekt2` varchar(30) NOT NULL default '',
  `min_vospriyatie2` varchar(30) NOT NULL default '',
  `min_level2` varchar(30) NOT NULL default '',
  `school` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `server_cities` */

DROP TABLE IF EXISTS `server_cities`;

CREATE TABLE `server_cities` (
  `city` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY  (`city`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `server_commands` */

DROP TABLE IF EXISTS `server_commands`;

CREATE TABLE `server_commands` (
  `name` varchar(32) NOT NULL default '',
  `security` int(2) NOT NULL default '0',
  `help` longtext NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `server_errors` */

DROP TABLE IF EXISTS `server_errors`;

CREATE TABLE `server_errors` (
  `id` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  `warning` tinyint(3) unsigned NOT NULL default '1',
  `hyphen` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `server_info` */

DROP TABLE IF EXISTS `server_info`;

CREATE TABLE `server_info` (
  `login` tinyint(3) unsigned NOT NULL,
  `registration` tinyint(3) unsigned NOT NULL,
  `password` tinyint(3) unsigned NOT NULL,
  `last_transfer` bigint(20) NOT NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `server_language` */

DROP TABLE IF EXISTS `server_language`;

CREATE TABLE `server_language` (
  `key` varchar(32) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `team1` */

DROP TABLE IF EXISTS `team1`;

CREATE TABLE `team1` (
  `player` varchar(30) NOT NULL default '',
  `ip` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `hitted` varchar(30) NOT NULL default '',
  `over` varchar(5) NOT NULL default '',
  KEY `player` (`player`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `team1_history` */

DROP TABLE IF EXISTS `team1_history`;

CREATE TABLE `team1_history` (
  `id` bigint(20) NOT NULL auto_increment,
  `player` varchar(30) NOT NULL default '',
  `ip` varchar(30) NOT NULL default '',
  `hitted` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`),
  KEY `id_5` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=cp1251;

/*Table structure for table `team2` */

DROP TABLE IF EXISTS `team2`;

CREATE TABLE `team2` (
  `player` varchar(30) NOT NULL default '',
  `ip` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `hitted` varchar(30) NOT NULL default '',
  `over` varchar(5) NOT NULL default '',
  KEY `player` (`player`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `team2_history` */

DROP TABLE IF EXISTS `team2_history`;

CREATE TABLE `team2_history` (
  `id` bigint(20) NOT NULL auto_increment,
  `player` varchar(30) NOT NULL default '',
  `ip` varchar(30) NOT NULL default '',
  `hitted` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`),
  KEY `id_5` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=cp1251;

/*Table structure for table `thing_book` */

DROP TABLE IF EXISTS `thing_book`;

CREATE TABLE `thing_book` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `img` varchar(30) default NULL,
  `mass` varchar(30) default NULL,
  `price` varchar(30) default NULL,
  `min_intellekt` varchar(30) default NULL,
  `min_vospriyatie` varchar(30) default NULL,
  `min_level` varchar(30) default NULL,
  `add_intellekt` varchar(30) default NULL,
  `add_mana` varchar(30) default NULL,
  `iznos_min` varchar(30) default NULL,
  `iznos_max` varchar(30) default NULL,
  `type` varchar(30) default NULL,
  `mountown` varchar(30) default NULL,
  `orden` varchar(30) default NULL,
  `add_water` varchar(30) NOT NULL default '',
  `add_earth` varchar(30) NOT NULL default '',
  `add_fire` varchar(30) NOT NULL default '',
  `add_air` varchar(30) NOT NULL default '',
  `pages` varchar(30) NOT NULL default '',
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

/*Table structure for table `thing_scroll` */

DROP TABLE IF EXISTS `thing_scroll`;

CREATE TABLE `thing_scroll` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `img` varchar(30) default NULL,
  `mass` int(4) default NULL,
  `price` int(6) default NULL,
  `veroyat` char(3) NOT NULL default '',
  `min_vospriyatie` int(2) default NULL,
  `min_intellekt` int(2) default NULL,
  `min_level` int(2) default NULL,
  `iznos_min` int(3) default NULL,
  `iznos_max` int(3) default NULL,
  `mana` varchar(30) NOT NULL default '',
  `file` varchar(30) NOT NULL default '',
  `orden` varchar(30) NOT NULL default '',
  `mountown` varchar(30) NOT NULL default '',
  `min_sila2` varchar(30) NOT NULL default '',
  `add_arm_l` varchar(30) NOT NULL default '',
  `add_arm_m` varchar(30) NOT NULL default '',
  `add_arm_h` varchar(30) NOT NULL default '',
  `add_water` varchar(30) NOT NULL default '',
  `add_air` varchar(30) NOT NULL default '',
  `add_earth` varchar(30) NOT NULL default '',
  `add_cast` varchar(30) NOT NULL default '',
  `add_trade` varchar(30) NOT NULL default '',
  `add_cure` varchar(30) NOT NULL default '',
  `add_walk` varchar(30) NOT NULL default '',
  `min_lovkost2` varchar(30) NOT NULL default '',
  `min_udacha2` varchar(30) NOT NULL default '',
  `min_power2` varchar(30) NOT NULL default '',
  `min_intellekt2` varchar(30) NOT NULL default '',
  `min_vospriyatie2` varchar(30) NOT NULL default '',
  `min_level2` varchar(30) NOT NULL default '',
  `school` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `thread` */

DROP TABLE IF EXISTS `thread`;

CREATE TABLE `thread` (
  `id` bigint(20) NOT NULL auto_increment,
  `topic` varchar(30) NOT NULL default '',
  `thr` varchar(30) NOT NULL default '',
  `topic_id` varchar(30) NOT NULL default '',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `creator` varchar(30) NOT NULL default '',
  `clan` varchar(30) NOT NULL default '',
  `clan_s` varchar(30) NOT NULL default '',
  `orden` varchar(30) NOT NULL default '',
  `level` varchar(30) NOT NULL default '',
  `last_post` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=cp1251;

/*Table structure for table `timeout` */

DROP TABLE IF EXISTS `timeout`;

CREATE TABLE `timeout` (
  `id` int(10) NOT NULL auto_increment,
  `lasthit` varchar(30) NOT NULL default '',
  `creator` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=cp1251;

/*Table structure for table `topic` */

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic` (
  `id` bigint(20) NOT NULL auto_increment,
  `msg` longtext NOT NULL,
  `topic_id` varchar(30) NOT NULL default '',
  `login` varchar(30) NOT NULL default '',
  `orden` varchar(30) NOT NULL default '',
  `clan` varchar(30) NOT NULL default '',
  `clan_s` varchar(30) NOT NULL default '',
  `level` varchar(30) NOT NULL default '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=cp1251;

/*Table structure for table `topics` */

DROP TABLE IF EXISTS `topics`;

CREATE TABLE `topics` (
  `id` bigint(20) NOT NULL auto_increment,
  `last_update` bigint(20) NOT NULL default '0',
  `fixed` int(1) NOT NULL default '0',
  `cat` varchar(15) NOT NULL default 'main',
  `title` varchar(255) NOT NULL default '',
  `icon` int(2) NOT NULL default '0',
  `text` text NOT NULL,
  `date` varchar(255) NOT NULL default '',
  `poster` varchar(40) NOT NULL default '',
  `p_id` bigint(20) NOT NULL default '0',
  `p_rank` int(2) NOT NULL default '0',
  `p_tribe` varchar(255) NOT NULL default '0',
  `p_level` int(11) NOT NULL default '0',
  `p_rase` int(2) NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  KEY `cat` (`cat`)
) ENGINE=MyISAM AUTO_INCREMENT=1176923604 DEFAULT CHARSET=cp1251;

/*Table structure for table `wood` */

DROP TABLE IF EXISTS `wood`;

CREATE TABLE `wood` (
  `id` bigint(30) NOT NULL auto_increment,
  `name` varchar(30) character set cp1251 NOT NULL default '',
  `img` varchar(30) character set cp1251 NOT NULL default '',
  `price` varchar(30) character set cp1251 NOT NULL default '',
  `mass` varchar(30) character set cp1251 NOT NULL default '',
  `mountown` varchar(30) character set cp1251 NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `zayavka` */

DROP TABLE IF EXISTS `zayavka`;

CREATE TABLE `zayavka` (
  `id` int(30) NOT NULL auto_increment,
  `status` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default '',
  `date` varchar(5) default NULL,
  `timeout` varchar(30) NOT NULL default '',
  `battle` varchar(30) NOT NULL default '',
  `creator` varchar(30) NOT NULL default '',
  `minlev1` varchar(30) NOT NULL default '',
  `maxlev1` varchar(30) NOT NULL default '',
  `minlev2` varchar(30) NOT NULL default '',
  `maxlev2` varchar(30) NOT NULL default '',
  `limit1` varchar(30) NOT NULL default '',
  `limit2` varchar(30) NOT NULL default '',
  `wait` varchar(30) NOT NULL default '',
  `all_z` varchar(30) NOT NULL default '',
  `comment` varchar(225) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `player1` (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=cp1251;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
