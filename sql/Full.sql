/*
SQLyog Ultimate v11.52 (64 bit)
MySQL - 5.5.28 : Database - abk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`abk` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `abk`;

/*Table structure for table `admin_item_create` */

DROP TABLE IF EXISTS `admin_item_create`;

CREATE TABLE `admin_item_create` (
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `section` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `item_flags` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mass` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `price` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `price_euro` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `tear` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_level` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_dex` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_con` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_str` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_vit` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_int` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_wis` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_sword` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_axe` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_fail` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_knife` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_staff` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_light` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_gray` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_dark` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `min_mp_all` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_str` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_dex` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_con` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_int` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_hp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_mp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mp_cons` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `hp_regen` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mp_regen` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `def_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `def_a` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `def_b` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `def_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `attack` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `brick` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_hit_min` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `add_hit_max` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_magic` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_light` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_gray` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_dark` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_dmg` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_dmg_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_dmg_a` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_dmg_b` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_dmg_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sting` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sting_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sting_a` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sting_b` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sting_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_slash` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_slash_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_slash_a` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_slash_b` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_slash_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_crush` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_crush_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_crush_a` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_crush_b` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_crush_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sharp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sharp_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sharp_a` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sharp_b` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `res_sharp_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_dmg` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_dmg_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_sting` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_sting_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_slash` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_slash_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_crush` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_crush_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_sharp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_sharp_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_magic` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_light` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_gray` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_dark` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_acrit` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_adodge` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_adodge_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_parry` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_dodge` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_contr` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_crit` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_crit_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_critp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_critp_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_parmour` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_parmour_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `mf_shieldb` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `all_magic` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `light` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `gray` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `dark` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `all_mastery` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `sword` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `sword_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `axe` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `axe_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `fail` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `fail_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `knife` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `knife_h` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `staff` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `rep_magic` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `rep_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `rep_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `rep_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `rep_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_sting` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_slash` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_crush` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_sharp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_light` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `ch_dark` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `inc_count` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `personal_owner` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `block` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `orden` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `sex` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `itemset` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `hands` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `description` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `validity` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `admin_item_create` */

LOCK TABLES `admin_item_create` WRITE;

insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','amulet','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','sword','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','axe','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','fail','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','knife','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','staff','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','armor','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','belt','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','1','0','0','1','1','1','1','1','1','1','1','1','1','1','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','helmet','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','gloves','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','shield','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','1','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','boots','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','1','0','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('1','1','item','ring','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_level`,`min_dex`,`min_con`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mp_cons`,`hp_regen`,`mp_regen`,`def_h`,`def_a`,`def_b`,`def_l`,`attack`,`brick`,`add_hit_min`,`add_hit_max`,`res_magic`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`res_dmg`,`res_dmg_h`,`res_dmg_a`,`res_dmg_b`,`res_dmg_l`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`mf_dmg`,`mf_dmg_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_acrit`,`mf_adodge`,`mf_adodge_h`,`mf_parry`,`mf_dodge`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critp`,`mf_critp_h`,`mf_parmour`,`mf_parmour_h`,`mf_shieldb`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`ch_sting`,`ch_slash`,`ch_crush`,`ch_sharp`,`ch_fire`,`ch_water`,`ch_air`,`ch_earth`,`ch_light`,`ch_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`) values ('Название','Изображение','item','lang','Флаги','Масса','Цена','Цена (екр)','Долговечность','Уровень','Ловкость','Интуиция','Сила','Выносливость','Интеллект','Мудрость','Меч','Топор','Дубина','Нож','Посох','Огонь','Вода','Воздух','Земля','Свет','Серая','Тьма','Мана','+ Сила','+ Ловкость','+ Интуиция','+ Интеллект','+ HP','+ MP','MPcons','Regen HP','Regen MP','Голова','Тело','Пояс','Ноги','Удар','Кубик','+ Урон мин','+ Урон мах','Магия','Огонь','Вода','Воздух','Земля','Свет','Серая','Тьма','Урон','H dmg','A dmg','B dmg','L dmg','Колющий','H sting','A sting','B sting','L sting','Рубящий','H slash','A slash','B slash','L slash','Дробящий','H slash','A slash','B slash','L slash','Режущий','H sharp','A sharp','B sharp','L sharp','Удара','Удара Р','Колющий','Колющий Р','Рубящий','Рубящий Р','Дробящий','Дробящий Р','Режущий','Режущий Р','Магии','Огня','Воды','Воздуха','Земли','Света','Серы','Тьмы','Антикрита','Антиуворота','Антиуворота Р','Парирования','Уворота','Контрудара','Крита','Крита Р','Критсилы','Критсилы Р','Пронзания','Пронзания Р','Блокщитом','Магия','Огонь','Вода','Воздух','Земля','Свет','Серая','Тьма','Оружие','Меч','Меч Р','Топор','Топор Р','Дубина','Дубина Р','Нож','Нож Р','Посох','Магии','Огня','Воды','Воздуха','Земли','Колющий','Рубящий','Дробящий','Режущий','Огонь','Вода','Воздух','Земля','Свет','Тьма','Увеличения','Персональн','Блоки','Орден','Пол','Сет','Руки','Описание','Долговечность');

UNLOCK TABLES;

/*Table structure for table `admin_menu` */

DROP TABLE IF EXISTS `admin_menu`;

CREATE TABLE `admin_menu` (
  `id` int(4) NOT NULL DEFAULT '0',
  `href` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `name` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `admin_menu` */

LOCK TABLES `admin_menu` WRITE;

insert  into `admin_menu`(`id`,`href`,`name`) values (1,'none','Интро');
insert  into `admin_menu`(`id`,`href`,`name`) values (2,'phpinfo','Phpinfo');
insert  into `admin_menu`(`id`,`href`,`name`) values (3,'coder','Кодирование');
insert  into `admin_menu`(`id`,`href`,`name`) values (4,'chars','Персонажи');
insert  into `admin_menu`(`id`,`href`,`name`) values (5,'online','Персонажи онлайн');
insert  into `admin_menu`(`id`,`href`,`name`) values (6,'room_all','Переброска игроков среди комнат');
insert  into `admin_menu`(`id`,`href`,`name`) values (7,'room','Переброска одного игрока среди комнат');
insert  into `admin_menu`(`id`,`href`,`name`) values (8,'kick_all','Вытащить всех из боя');
insert  into `admin_menu`(`id`,`href`,`name`) values (9,'kick','Вытащить одного игрока из боя');
insert  into `admin_menu`(`id`,`href`,`name`) values (10,'unwear_all','Раздеть всех персонажей');
insert  into `admin_menu`(`id`,`href`,`name`) values (11,'unwear','Раздеть персонажа');
insert  into `admin_menu`(`id`,`href`,`name`) values (12,'travm_all','Вылечить у всех персонажей травмы');
insert  into `admin_menu`(`id`,`href`,`name`) values (13,'travm','Вылечить у персонажа травму');
insert  into `admin_menu`(`id`,`href`,`name`) values (14,'hpmp','Вылечить персонажа (HP, MP)');
insert  into `admin_menu`(`id`,`href`,`name`) values (15,'add','Добавление вещей');
insert  into `admin_menu`(`id`,`href`,`name`) values (16,'mer','Меню Свадьбы');
insert  into `admin_menu`(`id`,`href`,`name`) values (17,'metka','Проверка Персонажа');
insert  into `admin_menu`(`id`,`href`,`name`) values (18,'new','Переброска вещей между персонажими');
insert  into `admin_menu`(`id`,`href`,`name`) values (19,'stat_admin','Подданство и Статус');
insert  into `admin_menu`(`id`,`href`,`name`) values (20,'team1','ID бой');
insert  into `admin_menu`(`id`,`href`,`name`) values (21,'team2','ID бой часть II');

UNLOCK TABLES;

/*Table structure for table `battles` */

DROP TABLE IF EXISTS `battles`;

CREATE TABLE `battles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `win` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `status` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `creator_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`),
  KEY `id_5` (`id`),
  KEY `id_6` (`id`),
  KEY `id_7` (`id`),
  KEY `id_8` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `battles` */

LOCK TABLES `battles` WRITE;

UNLOCK TABLES;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `img` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `mass` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `price` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `min_intellekt` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `min_vospriyatie` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `min_level` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `add_intellekt` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `add_mana` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `iznos_min` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `iznos_max` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `type` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `mountown` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `orden` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `add_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `pages` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `desc` text CHARACTER SET cp1251 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `book` */

LOCK TABLES `book` WRITE;

UNLOCK TABLES;

/*Table structure for table `bot_temp` */

DROP TABLE IF EXISTS `bot_temp`;

CREATE TABLE `bot_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bot_name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `hp` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `hp_all` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `prototype` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `team` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mana` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mana_all` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `bot_temp` */

LOCK TABLES `bot_temp` WRITE;

UNLOCK TABLES;

/*Table structure for table `character_bank` */

DROP TABLE IF EXISTS `character_bank`;

CREATE TABLE `character_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guid` int(11) unsigned NOT NULL,
  `password` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `cash` double NOT NULL DEFAULT '0',
  `euro` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `character_bank` */

LOCK TABLES `character_bank` WRITE;

UNLOCK TABLES;

/*Table structure for table `character_bars` */

DROP TABLE IF EXISTS `character_bars`;

CREATE TABLE `character_bars` (
  `guid` int(11) unsigned NOT NULL,
  `stat` varchar(3) CHARACTER SET cp1251 NOT NULL DEFAULT '1|1',
  `mod` varchar(3) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `power` varchar(3) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `def` varchar(3) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `set` varchar(3) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `btn` varchar(3) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `character_bars` */

LOCK TABLES `character_bars` WRITE;

UNLOCK TABLES;

/*Table structure for table `character_effects` */

DROP TABLE IF EXISTS `character_effects`;

CREATE TABLE `character_effects` (
  `guid` int(11) unsigned NOT NULL,
  `effect_id` int(11) unsigned NOT NULL,
  `end_time` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`,`effect_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `character_effects` */

LOCK TABLES `character_effects` WRITE;

UNLOCK TABLES;

/*Table structure for table `character_equip` */

DROP TABLE IF EXISTS `character_equip`;

CREATE TABLE `character_equip` (
  `guid` int(11) unsigned NOT NULL,
  `helmet` int(11) NOT NULL DEFAULT '0',
  `bracer` int(11) NOT NULL DEFAULT '0',
  `hand_r` int(11) NOT NULL DEFAULT '0',
  `hand_r_free` tinyint(3) NOT NULL DEFAULT '1',
  `hand_r_type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT 'phisic',
  `cloak` int(11) NOT NULL DEFAULT '0',
  `armor` int(11) NOT NULL DEFAULT '0',
  `shirt` int(11) NOT NULL DEFAULT '0',
  `belt` int(11) NOT NULL DEFAULT '0',
  `earring` int(11) NOT NULL DEFAULT '0',
  `amulet` int(11) NOT NULL DEFAULT '0',
  `ring1` int(11) NOT NULL DEFAULT '0',
  `ring2` int(11) NOT NULL DEFAULT '0',
  `ring3` int(11) NOT NULL DEFAULT '0',
  `gloves` int(11) NOT NULL DEFAULT '0',
  `hand_l` int(11) NOT NULL DEFAULT '0',
  `hand_l_free` tinyint(3) NOT NULL DEFAULT '1',
  `hand_l_type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT 'none',
  `pants` int(11) NOT NULL DEFAULT '0',
  `boots` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `character_equip` */

LOCK TABLES `character_equip` WRITE;

insert  into `character_equip`(`guid`,`helmet`,`bracer`,`hand_r`,`hand_r_free`,`hand_r_type`,`cloak`,`armor`,`shirt`,`belt`,`earring`,`amulet`,`ring1`,`ring2`,`ring3`,`gloves`,`hand_l`,`hand_l_free`,`hand_l_type`,`pants`,`boots`) values (1,0,0,0,1,'phisic',0,0,0,0,0,0,0,0,0,0,0,1,'phisic',0,0);
insert  into `character_equip`(`guid`,`helmet`,`bracer`,`hand_r`,`hand_r_free`,`hand_r_type`,`cloak`,`armor`,`shirt`,`belt`,`earring`,`amulet`,`ring1`,`ring2`,`ring3`,`gloves`,`hand_l`,`hand_l_free`,`hand_l_type`,`pants`,`boots`) values (2,0,0,0,1,'phisic',0,0,0,0,0,0,0,0,0,0,0,1,'phisic',0,0);
insert  into `character_equip`(`guid`,`helmet`,`bracer`,`hand_r`,`hand_r_free`,`hand_r_type`,`cloak`,`armor`,`shirt`,`belt`,`earring`,`amulet`,`ring1`,`ring2`,`ring3`,`gloves`,`hand_l`,`hand_l_free`,`hand_l_type`,`pants`,`boots`) values (3,0,0,0,1,'phisic',0,0,0,0,0,0,0,0,0,0,0,1,'phisic',0,0);

UNLOCK TABLES;

/*Table structure for table `character_info` */

DROP TABLE IF EXISTS `character_info`;

CREATE TABLE `character_info` (
  `guid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `secretquestion` text,
  `secretanswer` text,
  `icq` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `hide_icq` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `url` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `town` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `birthday` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `color` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `motto` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `hobie` longtext CHARACTER SET cp1251,
  `bank_note` longtext,
  `state` varchar(32) NOT NULL DEFAULT '',
  `date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `character_info` */

LOCK TABLES `character_info` WRITE;

insert  into `character_info`(`guid`,`name`,`secretquestion`,`secretanswer`,`icq`,`hide_icq`,`url`,`town`,`birthday`,`color`,`motto`,`hobie`,`bank_note`,`state`,`date`) values (1,'Мироздатель',NULL,NULL,NULL,0,'','','01.01.1985','black','','',NULL,'dem',1276727334);
insert  into `character_info`(`guid`,`name`,`secretquestion`,`secretanswer`,`icq`,`hide_icq`,`url`,`town`,`birthday`,`color`,`motto`,`hobie`,`bank_note`,`state`,`date`) values (2,'Смотритель',NULL,NULL,NULL,0,'','Capital','22.10.1989','black','','',NULL,'dem',1276727334);
insert  into `character_info`(`guid`,`name`,`secretquestion`,`secretanswer`,`icq`,`hide_icq`,`url`,`town`,`birthday`,`color`,`motto`,`hobie`,`bank_note`,`state`,`date`) values (3,'Комментатор',NULL,NULL,NULL,0,NULL,NULL,'01.01.1985','black',NULL,NULL,NULL,'cap',1276727334);

UNLOCK TABLES;

/*Table structure for table `character_inventory` */

DROP TABLE IF EXISTS `character_inventory`;

CREATE TABLE `character_inventory` (
  `id` int(11) unsigned NOT NULL,
  `guid` int(11) unsigned NOT NULL,
  `item_entry` int(11) unsigned NOT NULL DEFAULT '0',
  `wear` tinyint(3) NOT NULL DEFAULT '0',
  `tear_cur` double NOT NULL DEFAULT '0',
  `tear_max` double NOT NULL DEFAULT '0',
  `inc_count_p` tinyint(3) NOT NULL DEFAULT '0',
  `inc_str` tinyint(3) NOT NULL DEFAULT '0',
  `inc_dex` tinyint(3) NOT NULL DEFAULT '0',
  `inc_con` tinyint(3) NOT NULL DEFAULT '0',
  `inc_int` tinyint(3) NOT NULL DEFAULT '0',
  `is_modified` tinyint(2) NOT NULL DEFAULT '0',
  `gift` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `gift_author` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `is_personal` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `personal_owner` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `locked` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `password` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `pages_used` tinyint(3) NOT NULL DEFAULT '0',
  `mailed` tinyint(3) NOT NULL DEFAULT '0',
  `date` bigint(20) NOT NULL DEFAULT '0',
  `made_in` varchar(30) NOT NULL,
  `last_update` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=625 DEFAULT CHARSET=utf8;

/*Data for the table `character_inventory` */

LOCK TABLES `character_inventory` WRITE;

UNLOCK TABLES;

/*Table structure for table `character_sets` */

DROP TABLE IF EXISTS `character_sets`;

CREATE TABLE `character_sets` (
  `guid` int(11) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `helmet` int(11) NOT NULL DEFAULT '0',
  `bracer` int(11) NOT NULL DEFAULT '0',
  `hand_r` int(11) NOT NULL DEFAULT '0',
  `cloak` int(11) NOT NULL DEFAULT '0',
  `armor` int(11) NOT NULL DEFAULT '0',
  `shirt` int(11) NOT NULL DEFAULT '0',
  `belt` int(11) NOT NULL DEFAULT '0',
  `earring` int(11) NOT NULL DEFAULT '0',
  `amulet` int(11) NOT NULL DEFAULT '0',
  `ring1` int(11) NOT NULL DEFAULT '0',
  `ring2` int(11) NOT NULL DEFAULT '0',
  `ring3` int(11) NOT NULL DEFAULT '0',
  `gloves` int(11) NOT NULL DEFAULT '0',
  `hand_l` int(11) NOT NULL DEFAULT '0',
  `pants` int(11) NOT NULL DEFAULT '0',
  `boots` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `character_sets` */

LOCK TABLES `character_sets` WRITE;

UNLOCK TABLES;

/*Table structure for table `character_stats` */

DROP TABLE IF EXISTS `character_stats`;

CREATE TABLE `character_stats` (
  `guid` int(11) unsigned NOT NULL,
  `hp` int(10) unsigned NOT NULL DEFAULT '0',
  `hp_cure` bigint(20) DEFAULT '0',
  `hp_all` int(10) unsigned NOT NULL DEFAULT '0',
  `hp_regen` int(10) NOT NULL DEFAULT '0' COMMENT '%',
  `mp` int(10) unsigned NOT NULL DEFAULT '0',
  `mp_cure` bigint(20) DEFAULT '0',
  `mp_all` int(10) unsigned NOT NULL DEFAULT '0',
  `mp_regen` int(10) NOT NULL DEFAULT '0' COMMENT '%',
  `mp_cons` int(10) NOT NULL DEFAULT '0' COMMENT '%',
  `str` int(10) unsigned NOT NULL DEFAULT '0',
  `dex` int(10) unsigned NOT NULL DEFAULT '0',
  `con` int(10) unsigned NOT NULL DEFAULT '0',
  `vit` int(10) unsigned NOT NULL DEFAULT '0',
  `int` int(10) unsigned NOT NULL DEFAULT '0',
  `wis` int(10) unsigned NOT NULL DEFAULT '0',
  `spi` int(10) unsigned NOT NULL DEFAULT '0',
  `ups` int(10) unsigned NOT NULL DEFAULT '0',
  `speed` int(10) NOT NULL DEFAULT '0',
  `cast` int(10) NOT NULL DEFAULT '0',
  `walk` int(10) NOT NULL DEFAULT '0',
  `cost` int(10) NOT NULL DEFAULT '0',
  `mass` double unsigned NOT NULL DEFAULT '0',
  `maxmass` double unsigned NOT NULL DEFAULT '0',
  `phisic` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_phisic` int(10) NOT NULL DEFAULT '0',
  `hand_l_phisic` int(10) NOT NULL DEFAULT '0',
  `sword` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_sword` int(10) NOT NULL DEFAULT '0',
  `hand_l_sword` int(10) NOT NULL DEFAULT '0',
  `bow` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_bow` int(10) NOT NULL DEFAULT '0',
  `hand_l_bow` int(10) NOT NULL DEFAULT '0',
  `crossbow` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_crossbow` int(10) NOT NULL DEFAULT '0',
  `hand_l_crossbow` int(10) NOT NULL DEFAULT '0',
  `axe` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_axe` int(10) NOT NULL DEFAULT '0',
  `hand_l_axe` int(10) NOT NULL DEFAULT '0',
  `fail` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_fail` int(10) NOT NULL DEFAULT '0',
  `hand_l_fail` int(10) NOT NULL DEFAULT '0',
  `knife` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_knife` int(10) NOT NULL DEFAULT '0',
  `hand_l_knife` int(10) NOT NULL DEFAULT '0',
  `staff` int(10) unsigned NOT NULL DEFAULT '0',
  `hand_r_staff` int(10) NOT NULL DEFAULT '0',
  `fire` int(10) unsigned NOT NULL DEFAULT '0',
  `water` int(10) unsigned NOT NULL DEFAULT '0',
  `air` int(10) unsigned NOT NULL DEFAULT '0',
  `earth` int(10) unsigned NOT NULL DEFAULT '0',
  `light` int(10) unsigned NOT NULL DEFAULT '0',
  `gray` int(10) unsigned NOT NULL DEFAULT '0',
  `dark` int(10) unsigned NOT NULL DEFAULT '0',
  `skills` int(10) unsigned NOT NULL DEFAULT '0',
  `def_h_min` int(10) NOT NULL DEFAULT '0',
  `def_h_max` int(10) NOT NULL DEFAULT '0',
  `def_a_min` int(10) NOT NULL DEFAULT '0',
  `def_a_max` int(10) NOT NULL DEFAULT '0',
  `def_b_min` int(10) NOT NULL DEFAULT '0',
  `def_b_max` int(10) NOT NULL DEFAULT '0',
  `def_l_min` int(10) NOT NULL DEFAULT '0',
  `def_l_max` int(10) NOT NULL DEFAULT '0',
  `res_sting` double NOT NULL DEFAULT '0',
  `res_sting_h` double NOT NULL DEFAULT '0',
  `res_sting_a` double NOT NULL DEFAULT '0',
  `res_sting_b` double NOT NULL DEFAULT '0',
  `res_sting_l` double NOT NULL DEFAULT '0',
  `res_slash` double NOT NULL DEFAULT '0',
  `res_slash_h` double NOT NULL DEFAULT '0',
  `res_slash_a` double NOT NULL DEFAULT '0',
  `res_slash_b` double NOT NULL DEFAULT '0',
  `res_slash_l` double NOT NULL DEFAULT '0',
  `res_crush` double NOT NULL DEFAULT '0',
  `res_crush_h` double NOT NULL DEFAULT '0',
  `res_crush_a` double NOT NULL DEFAULT '0',
  `res_crush_b` double NOT NULL DEFAULT '0',
  `res_crush_l` double NOT NULL DEFAULT '0',
  `res_sharp` double NOT NULL DEFAULT '0',
  `res_sharp_h` double NOT NULL DEFAULT '0',
  `res_sharp_a` double NOT NULL DEFAULT '0',
  `res_sharp_b` double NOT NULL DEFAULT '0',
  `res_sharp_l` double NOT NULL DEFAULT '0',
  `res_fire` double NOT NULL DEFAULT '0',
  `res_water` double NOT NULL DEFAULT '0',
  `res_air` double NOT NULL DEFAULT '0',
  `res_earth` double NOT NULL DEFAULT '0',
  `res_light` double NOT NULL DEFAULT '0',
  `res_gray` double NOT NULL DEFAULT '0',
  `res_dark` double NOT NULL DEFAULT '0',
  `rep_magic` int(10) NOT NULL DEFAULT '0',
  `rep_fire` int(10) NOT NULL DEFAULT '0',
  `rep_water` int(10) NOT NULL DEFAULT '0',
  `rep_air` int(10) NOT NULL DEFAULT '0',
  `rep_earth` int(10) NOT NULL DEFAULT '0',
  `mf_fire` double NOT NULL DEFAULT '0',
  `mf_water` double NOT NULL DEFAULT '0',
  `mf_air` double NOT NULL DEFAULT '0',
  `mf_earth` double NOT NULL DEFAULT '0',
  `mf_light` double NOT NULL DEFAULT '0',
  `mf_gray` double NOT NULL DEFAULT '0',
  `mf_dark` double NOT NULL DEFAULT '0',
  `mf_sting` int(10) NOT NULL DEFAULT '0',
  `hand_r_sting` int(10) NOT NULL DEFAULT '0',
  `hand_l_sting` int(10) NOT NULL DEFAULT '0',
  `mf_slash` int(10) NOT NULL DEFAULT '0',
  `hand_r_slash` int(10) NOT NULL DEFAULT '0',
  `hand_l_slash` int(10) NOT NULL DEFAULT '0',
  `mf_crush` int(10) NOT NULL DEFAULT '0',
  `hand_r_crush` int(10) NOT NULL DEFAULT '0',
  `hand_l_crush` int(10) NOT NULL DEFAULT '0',
  `mf_sharp` int(10) NOT NULL DEFAULT '0',
  `hand_r_sharp` int(10) NOT NULL DEFAULT '0',
  `hand_l_sharp` int(10) NOT NULL DEFAULT '0',
  `mf_crit` int(10) NOT NULL DEFAULT '0',
  `hand_r_crit` int(10) NOT NULL DEFAULT '0',
  `hand_l_crit` int(10) NOT NULL DEFAULT '0',
  `mf_critp` int(10) NOT NULL DEFAULT '0',
  `hand_r_critp` int(10) NOT NULL DEFAULT '0',
  `hand_l_critp` int(10) NOT NULL DEFAULT '0',
  `mf_acrit` int(10) NOT NULL DEFAULT '0',
  `mf_dodge` int(10) NOT NULL DEFAULT '0',
  `mf_adodge` int(10) NOT NULL DEFAULT '0',
  `hand_r_adodge` int(10) NOT NULL DEFAULT '0',
  `hand_l_adodge` int(10) NOT NULL DEFAULT '0',
  `mf_parmour` int(10) NOT NULL DEFAULT '0',
  `hand_r_parmour` int(10) NOT NULL DEFAULT '0',
  `hand_l_parmour` int(10) NOT NULL DEFAULT '0',
  `mf_contr` int(10) NOT NULL DEFAULT '0',
  `mf_parry` int(10) NOT NULL DEFAULT '0',
  `mf_shieldb` int(10) NOT NULL DEFAULT '0',
  `hitmin` int(10) NOT NULL DEFAULT '0',
  `hand_r_hitmin` int(10) NOT NULL DEFAULT '0',
  `hand_l_hitmin` int(10) NOT NULL DEFAULT '0',
  `hitmax` int(10) NOT NULL DEFAULT '0',
  `hand_r_hitmax` int(10) NOT NULL DEFAULT '0',
  `hand_l_hitmax` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;

/*Data for the table `character_stats` */

LOCK TABLES `character_stats` WRITE;

insert  into `character_stats`(`guid`,`hp`,`hp_cure`,`hp_all`,`hp_regen`,`mp`,`mp_cure`,`mp_all`,`mp_regen`,`mp_cons`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`spi`,`ups`,`speed`,`cast`,`walk`,`cost`,`mass`,`maxmass`,`phisic`,`hand_r_phisic`,`hand_l_phisic`,`sword`,`hand_r_sword`,`hand_l_sword`,`bow`,`hand_r_bow`,`hand_l_bow`,`crossbow`,`hand_r_crossbow`,`hand_l_crossbow`,`axe`,`hand_r_axe`,`hand_l_axe`,`fail`,`hand_r_fail`,`hand_l_fail`,`knife`,`hand_r_knife`,`hand_l_knife`,`staff`,`hand_r_staff`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`skills`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_sting`,`hand_r_sting`,`hand_l_sting`,`mf_slash`,`hand_r_slash`,`hand_l_slash`,`mf_crush`,`hand_r_crush`,`hand_l_crush`,`mf_sharp`,`hand_r_sharp`,`hand_l_sharp`,`mf_crit`,`hand_r_crit`,`hand_l_crit`,`mf_critp`,`hand_r_critp`,`hand_l_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`hand_r_adodge`,`hand_l_adodge`,`mf_parmour`,`hand_r_parmour`,`hand_l_parmour`,`mf_contr`,`mf_parry`,`mf_shieldb`,`hitmin`,`hand_r_hitmin`,`hand_l_hitmin`,`hitmax`,`hand_r_hitmax`,`hand_l_hitmax`) values (1,57,0,57,100,6,0,6,100,100,1000,1000,30,1000,7,1,0,0,0,0,0,0,0,75,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,4.5,4.5,4.5,4.5,4.5,4.5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,15,0,0,0,0,0,15,15,15,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `character_stats`(`guid`,`hp`,`hp_cure`,`hp_all`,`hp_regen`,`mp`,`mp_cure`,`mp_all`,`mp_regen`,`mp_cons`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`spi`,`ups`,`speed`,`cast`,`walk`,`cost`,`mass`,`maxmass`,`phisic`,`hand_r_phisic`,`hand_l_phisic`,`sword`,`hand_r_sword`,`hand_l_sword`,`bow`,`hand_r_bow`,`hand_l_bow`,`crossbow`,`hand_r_crossbow`,`hand_l_crossbow`,`axe`,`hand_r_axe`,`hand_l_axe`,`fail`,`hand_r_fail`,`hand_l_fail`,`knife`,`hand_r_knife`,`hand_l_knife`,`staff`,`hand_r_staff`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`skills`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_sting`,`hand_r_sting`,`hand_l_sting`,`mf_slash`,`hand_r_slash`,`hand_l_slash`,`mf_crush`,`hand_r_crush`,`hand_l_crush`,`mf_sharp`,`hand_r_sharp`,`hand_l_sharp`,`mf_crit`,`hand_r_crit`,`hand_l_crit`,`mf_critp`,`hand_r_critp`,`hand_l_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`hand_r_adodge`,`hand_l_adodge`,`mf_parmour`,`hand_r_parmour`,`hand_l_parmour`,`mf_contr`,`mf_parry`,`mf_shieldb`,`hitmin`,`hand_r_hitmin`,`hand_l_hitmin`,`hitmax`,`hand_r_hitmax`,`hand_l_hitmax`) values (2,142,0,142,100,101,0,101,100,100,15,13,13,7,5,0,0,0,0,0,0,0,0,45,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,4.5,4.5,4.5,4.5,4.5,4.5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,501,0,0,0,0,0,501,401,251,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `character_stats`(`guid`,`hp`,`hp_cure`,`hp_all`,`hp_regen`,`mp`,`mp_cure`,`mp_all`,`mp_regen`,`mp_cons`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`spi`,`ups`,`speed`,`cast`,`walk`,`cost`,`mass`,`maxmass`,`phisic`,`hand_r_phisic`,`hand_l_phisic`,`sword`,`hand_r_sword`,`hand_l_sword`,`bow`,`hand_r_bow`,`hand_l_bow`,`crossbow`,`hand_r_crossbow`,`hand_l_crossbow`,`axe`,`hand_r_axe`,`hand_l_axe`,`fail`,`hand_r_fail`,`hand_l_fail`,`knife`,`hand_r_knife`,`hand_l_knife`,`staff`,`hand_r_staff`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`skills`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`res_sting`,`res_sting_h`,`res_sting_a`,`res_sting_b`,`res_sting_l`,`res_slash`,`res_slash_h`,`res_slash_a`,`res_slash_b`,`res_slash_l`,`res_crush`,`res_crush_h`,`res_crush_a`,`res_crush_b`,`res_crush_l`,`res_sharp`,`res_sharp_h`,`res_sharp_a`,`res_sharp_b`,`res_sharp_l`,`res_fire`,`res_water`,`res_air`,`res_earth`,`res_light`,`res_gray`,`res_dark`,`rep_magic`,`rep_fire`,`rep_water`,`rep_air`,`rep_earth`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_sting`,`hand_r_sting`,`hand_l_sting`,`mf_slash`,`hand_r_slash`,`hand_l_slash`,`mf_crush`,`hand_r_crush`,`hand_l_crush`,`mf_sharp`,`hand_r_sharp`,`hand_l_sharp`,`mf_crit`,`hand_r_crit`,`hand_l_crit`,`mf_critp`,`hand_r_critp`,`hand_l_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`hand_r_adodge`,`hand_l_adodge`,`mf_parmour`,`hand_r_parmour`,`hand_l_parmour`,`mf_contr`,`mf_parry`,`mf_shieldb`,`hitmin`,`hand_r_hitmin`,`hand_l_hitmin`,`hitmax`,`hand_r_hitmax`,`hand_l_hitmax`) values (3,2680,0,2680,100,0,0,0,100,100,153,110,110,151,101,0,0,0,0,0,0,0,0,43,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,0,0,0,0,4.5,4.5,4.5,4.5,4.5,4.5,4.5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,15,0,0,0,0,0,15,15,15,0,0,0,0,0,0,0,0,5,0,0,7,0,0);

UNLOCK TABLES;

/*Table structure for table `character_travms` */

DROP TABLE IF EXISTS `character_travms`;

CREATE TABLE `character_travms` (
  `guid` int(11) unsigned NOT NULL,
  `travm_id` int(11) NOT NULL DEFAULT '0',
  `stats` text CHARACTER SET cp1251,
  `end_time` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`,`travm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `character_travms` */

LOCK TABLES `character_travms` WRITE;

UNLOCK TABLES;

/*Table structure for table `characters` */

DROP TABLE IF EXISTS `characters`;

CREATE TABLE `characters` (
  `guid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `login_sec` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `password` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `exp` int(10) NOT NULL DEFAULT '0',
  `next_up` int(10) NOT NULL DEFAULT '20',
  `admin_level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '0',
  `city` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `room` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT 'novice',
  `clan` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `orden` smallint(3) unsigned NOT NULL DEFAULT '0',
  `rang` smallint(3) unsigned NOT NULL DEFAULT '0',
  `win` int(10) NOT NULL DEFAULT '0',
  `lose` int(10) NOT NULL DEFAULT '0',
  `draw` int(10) NOT NULL DEFAULT '0',
  `glava` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `chin` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `passport` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `prison` bigint(20) NOT NULL DEFAULT '0',
  `prison_reason` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `block` tinyint(3) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `battle` varchar(30) CHARACTER SET cp1251 DEFAULT '0',
  `weapon_type` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `reg_ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_pos` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `battle_team` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `battle_opponent` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `clan_short` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `clan_take` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `dealer` tinyint(3) NOT NULL DEFAULT '0',
  `otdel` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `checkup` bigint(20) NOT NULL DEFAULT '0',
  `acsess1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `acsess2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `animal` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `navik_wood` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `vote` tinyint(3) NOT NULL DEFAULT '0',
  `add_resourses` int(4) NOT NULL DEFAULT '0',
  `podval` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `semija` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sex` tinyint(3) NOT NULL DEFAULT '0',
  `mail` text CHARACTER SET cp1251,
  `shape` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `transfers` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delo` text CHARACTER SET cp1251,
  `afk` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `dnd` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `message` text,
  `chat_shut` bigint(20) NOT NULL DEFAULT '0',
  `chat_filter` tinyint(3) NOT NULL DEFAULT '0',
  `chat_sys` tinyint(3) NOT NULL DEFAULT '1',
  `chat_update` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `chat_translit` tinyint(3) NOT NULL DEFAULT '0',
  `chat_list` tinyint(3) NOT NULL DEFAULT '0',
  `return_time` int(10) NOT NULL DEFAULT '1800',
  `next_shape` bigint(20) NOT NULL DEFAULT '0',
  `last_go` bigint(20) NOT NULL DEFAULT '0',
  `last_room` varchar(30) NOT NULL DEFAULT '',
  `last_return` bigint(20) NOT NULL DEFAULT '0',
  `last_time` bigint(20) NOT NULL DEFAULT '0',
  `next_change` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `characters` */

LOCK TABLES `characters` WRITE;

insert  into `characters`(`guid`,`login`,`login_sec`,`password`,`level`,`exp`,`next_up`,`admin_level`,`money`,`city`,`room`,`clan`,`orden`,`rang`,`win`,`lose`,`draw`,`glava`,`chin`,`passport`,`prison`,`prison_reason`,`block`,`block_reason`,`battle`,`weapon_type`,`reg_ip`,`battle_pos`,`battle_team`,`battle_opponent`,`clan_short`,`clan_take`,`dealer`,`otdel`,`checkup`,`acsess1`,`acsess2`,`animal`,`navik_wood`,`vote`,`add_resourses`,`podval`,`semija`,`sex`,`mail`,`shape`,`transfers`,`delo`,`afk`,`dnd`,`message`,`chat_shut`,`chat_filter`,`chat_sys`,`chat_update`,`chat_translit`,`chat_list`,`return_time`,`next_shape`,`last_go`,`last_room`,`last_return`,`last_time`,`next_change`) values (1,'Мироздатель','Мироздатель','',21,0,20,1,99,'dem','hall_1',NULL,0,0,93,7,0,NULL,NULL,NULL,0,NULL,0,NULL,'0',NULL,'',NULL,NULL,'','','',0,'',0,'','','','0',0,0,'','',0,'hacik@aldems.lv','creator.gif',200,NULL,0,0,NULL,0,0,1,10,0,0,1800,1274637594,1274647674,'',1276032127,1274649186,0);
insert  into `characters`(`guid`,`login`,`login_sec`,`password`,`level`,`exp`,`next_up`,`admin_level`,`money`,`city`,`room`,`clan`,`orden`,`rang`,`win`,`lose`,`draw`,`glava`,`chin`,`passport`,`prison`,`prison_reason`,`block`,`block_reason`,`battle`,`weapon_type`,`reg_ip`,`battle_pos`,`battle_team`,`battle_opponent`,`clan_short`,`clan_take`,`dealer`,`otdel`,`checkup`,`acsess1`,`acsess2`,`animal`,`navik_wood`,`vote`,`add_resourses`,`podval`,`semija`,`sex`,`mail`,`shape`,`transfers`,`delo`,`afk`,`dnd`,`message`,`chat_shut`,`chat_filter`,`chat_sys`,`chat_update`,`chat_translit`,`chat_list`,`return_time`,`next_shape`,`last_go`,`last_room`,`last_return`,`last_time`,`next_change`) values (2,'Мусорщик','Мусорщик','',0,0,20,1,99,'dem','hall_1',NULL,0,0,11,0,0,NULL,NULL,NULL,0,NULL,0,NULL,'0',NULL,'',NULL,NULL,'','','',0,'',0,'','','','',0,0,'','',0,'watcher@antibk.com','dustman.gif',200,NULL,0,0,NULL,0,0,1,10,0,0,1800,1274637594,1274647674,'',1276032127,1274649186,0);
insert  into `characters`(`guid`,`login`,`login_sec`,`password`,`level`,`exp`,`next_up`,`admin_level`,`money`,`city`,`room`,`clan`,`orden`,`rang`,`win`,`lose`,`draw`,`glava`,`chin`,`passport`,`prison`,`prison_reason`,`block`,`block_reason`,`battle`,`weapon_type`,`reg_ip`,`battle_pos`,`battle_team`,`battle_opponent`,`clan_short`,`clan_take`,`dealer`,`otdel`,`checkup`,`acsess1`,`acsess2`,`animal`,`navik_wood`,`vote`,`add_resourses`,`podval`,`semija`,`sex`,`mail`,`shape`,`transfers`,`delo`,`afk`,`dnd`,`message`,`chat_shut`,`chat_filter`,`chat_sys`,`chat_update`,`chat_translit`,`chat_list`,`return_time`,`next_shape`,`last_go`,`last_room`,`last_return`,`last_time`,`next_change`) values (3,'Комментатор','Комментатор','',18,0,20,1,0,'cap','hall_1',NULL,1,1,2769,278,2,NULL,NULL,NULL,0,NULL,0,NULL,'0',NULL,'',NULL,NULL,'','','',0,'',0,'','','','',0,0,'','',0,NULL,'10014.gif',200,NULL,0,0,NULL,0,0,1,10,0,0,1800,1274637594,1274647674,'',1276032127,1274649186,0);

UNLOCK TABLES;

/*Table structure for table `city_chat` */

DROP TABLE IF EXISTS `city_chat`;

CREATE TABLE `city_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `room` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sender` varchar(32) NOT NULL,
  `to` longtext NOT NULL,
  `msg` longtext CHARACTER SET cp1251 NOT NULL,
  `class` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date_stamp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`city`,`room`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1530 DEFAULT CHARSET=utf8;

/*Data for the table `city_chat` */

LOCK TABLES `city_chat` WRITE;

UNLOCK TABLES;

/*Table structure for table `city_mail_items` */

DROP TABLE IF EXISTS `city_mail_items`;

CREATE TABLE `city_mail_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` double NOT NULL DEFAULT '0',
  `delivery_time` bigint(20) NOT NULL,
  `date` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `city_mail_items` */

LOCK TABLES `city_mail_items` WRITE;

UNLOCK TABLES;

/*Table structure for table `city_rooms` */

DROP TABLE IF EXISTS `city_rooms`;

CREATE TABLE `city_rooms` (
  `room` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `city` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `from` text CHARACTER SET cp1251 NOT NULL,
  `time` tinyint(3) NOT NULL DEFAULT '0',
  `min_level` tinyint(3) NOT NULL DEFAULT '0',
  `max_level` tinyint(3) NOT NULL DEFAULT '12',
  `need_orden` tinyint(3) NOT NULL DEFAULT '0',
  `sex` tinyint(3) DEFAULT NULL,
  `desc1` longtext CHARACTER SET cp1251,
  `desc1_need` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `desc2` longtext CHARACTER SET cp1251,
  `desc2_need` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `desc3` longtext CHARACTER SET cp1251,
  `desc3_need` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `buttons` text CHARACTER SET cp1251,
  `flags` int(11) NOT NULL DEFAULT '0',
  `shop_section` varchar(32) CHARACTER SET cp1251 DEFAULT NULL,
  PRIMARY KEY (`room`,`city`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `city_rooms` */

LOCK TABLES `city_rooms` WRITE;

insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('club',38,'Бойцовский Клуб','hall_1,hall_2,hall_3,boudoir,club2,centsquare',15,0,12,0,NULL,'Благородный дон желает стоять как столб посреди комнаты, и пугать своим видом новичков, или все-таки поднимется на второй этаж, где творятся настоящие дела?',NULL,NULL,NULL,'Прямо пойдешь – съедят. Налево пойдешь – съедят. Назад пойдешь – съедят. В Будуар не пустят... Тяжела жизнь новичка в этом нелегком мире.',NULL,'return,map,forum,hint',0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('hall_1',38,'Зал воинов','club',0,0,12,0,NULL,'Возможно, вы ошиблись этажом - настоящие сражения проходят выше.',NULL,NULL,NULL,'Вы уже знаете для чего вам кулаки и достигли некоторых успехов в Клубе. Зал Воинов приветствует вас и ждет ваших боев. Какими бы они ни были.',NULL,'fights,return,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('hall_2',38,'Зал воинов 2','club,passage',0,0,12,0,NULL,'Если вы пришли сюда не за завтраком, обедом или ужином, то может быть вы ошиблись этажом?',NULL,NULL,NULL,'Вам все время кажется что за вами следят? Чудится, что случайный попутчик мечтает всадить вам топор в спину? При совершении очередной покупки в гос. магазине мучает ощущение, что вас обманули? Кажется, что симпатичная девушка напротив смотрит на вас как на пищу? Успокойтесь, это не паранойя. Это реалии города Девилса. Города Тьмы.',NULL,'fights,return,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('hall_3',38,'Зал воинов 3','club',0,0,12,0,NULL,'Если вы пришли сюда не за завтраком, обедом или ужином, то может быть вы ошиблись этажом?',NULL,NULL,NULL,'Вам все время кажется что за вами следят? Чудится, что случайный попутчик мечтает всадить вам топор в спину? При совершении очередной покупки в гос. магазине мучает ощущение, что вас обманули? Кажется, что симпатичная девушка напротив смотрит на вас как на пищу? Успокойтесь, это не паранойя. Это реалии города Девилса. Города Тьмы.',NULL,'fights,return,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('boudoir',38,'Будуар','club',5,0,12,0,1,'Если вы пришли сюда не за завтраком, обедом или ужином, то может быть вы ошиблись этажом?',NULL,NULL,NULL,NULL,NULL,'fights,return,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('club2',38,'Этаж 2','club,km_6,km_7',10,2,12,0,NULL,'Если есть желание купить, продать, лечить, точить – посетите Торговый Зал. Если есть желание изменить себя, освоить новые умения и поправить расшатанное эликсирами здоровье - пройдите в комнату Знахаря. Если есть желание драться, то вам в Рыцарский Зал. Если есть желание драться, драться, драться и ещё раз драться, обсуждая в перерывах превосходство мощного крита в репу над всякой магической заумью, то вам в Башню Рыцарей Магов.',NULL,NULL,NULL,NULL,NULL,'return,map,forum,hint',0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('km_6',38,'Рыцарский Зал','club2',5,0,12,0,NULL,'Вы уже не новичок. Вы уже боец. И не просто боец а Боец с большой буквы. Осталось объяснить это вооон тому артнику...',NULL,NULL,NULL,NULL,NULL,'fights,return,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('km_7',38,'Торговый Зал','club2',5,4,12,0,NULL,'Ищете лекаря? Ваш доспех вам жмет и вы хотите другой? Нужен умелый наемник? Вы попали по адресу. Именно здесь можно купить или продать любой товар или услугу. Здешние умельцы и оденут и обуют вас в один момент.<br>Орден света предупреждает – настоящий воин должен быть немногословным.',NULL,NULL,NULL,NULL,NULL,'fights,return,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('centsquare',32,'Центральная Площадь','club,shop,stella,station,comok,mail,fairstreet,prison',15,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'return,forum,hint',0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('fairstreet',32,'Страшилкина улица','centsquare,bank',30,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'return,forum,hint',0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('bank',38,'Банк','fairstreet',15,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('shop',38,'Магазин','centsquare',15,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'knife');
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('stella',32,'Стела Выбора','centsquare',15,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('comok',32,'Комиссионка','centsquare',5,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('mail',38,'Почтовое отделение','centsquare',15,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('prison',32,'Тюрьма','',5,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('novice',38,'Комната для новичков','perehod',5,0,3,0,NULL,'Любые грандиозные замыслы и честолюбивые планы теряются на фоне такого количества копошащихся новичков. Делать здесь явно нечего, идите в Комнату Перехода.','level=1','В этих залах, отгороженных от основного Бойцовского Клуба, можно спокойно разобраться в преимуществах и недостатках разных тактик боя, познакомиться с интересными людьми. Разобраться в законах Бойцовского Клуба. И даже к душераздирающим крикам и лязгу железа, раздающемуся из БК можно привыкнуть в этих уютных залах.','exp=45','Бойцовский Клуб приветствует Вас, <b>%1$s</b>.<br>\r\nЧтобы сражаться с остальными на равных, вам нужно распределить начальные характеристики.<br>\r\nДля этого нажмите на <a href=\'#\' id=\'link\' link=\'skills\' class=\'nick\' style=\'font-size: 7pt;\'>Способности</a>, а затем, нажимая на <img src=\'img/icon/plus.gif\' width=\'11\' height=\'11\'>, сформируйте своего персонажа.<br>\r\nПодробнее о значении характеристик можно узнать в <a href=\'http://capitalcity.combats.ru/encicl/11_2.html\' target=\'_blank\' class=\'nick\' style=\'font-size: 7pt;\'>Библиотеке</a>.<br>\r\nРаспределив все характеристики нажмите на кнопку <input type=\'button\' class=\'btn2\' value=\'Вернуться\' disabled><br>\r\nДля проведения боя нажмите на кнопку <input type=\'button\' value=\'Поединки\' class=\'btn2\' disabled><br>\r\nВыберите раздел \"1 на 1\".<br>\r\nБолее подробно о поединках можно прочитать в <a target=\'_blank\' href=\'http://capitalcity.combats.ru/encicl/3_2.html\' class=\'nick\' style=\'font-size: 7pt;\'>Библиотеке</a><br>',NULL,'fights,map,forum,hint',1,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('passage',38,'Комната перехода','novice',5,1,12,0,NULL,NULL,NULL,NULL,NULL,'Это серьезный шаг в твоей жизни воин. Шаг, сделав который ты навсегда расстанешься с уютными новичковыми залами и очутишься в мире, где суровые громилы нападают на Центральной площади, а злые вампиры пьют энергию. Где каждый второй торговец норовит купить у тебя твои доспехи за полцены, а оставшиеся – сбыть тебе ненужную вещь за дикие деньги. Может ну его к черту и обратно в «песочницу»? Нет говоришь? Ну тогда смелей, темный город ждет тебя. В смысле вампиры уже проголодались.',NULL,'fights,return,map,forum,hint',0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('centsquare',6,'Центральная Площадь','club,shop,comission,station,repare,mail,stella,fairstreet,prison',15,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'return,forum,hint',0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time`,`min_level`,`max_level`,`need_orden`,`sex`,`desc1`,`desc1_need`,`desc2`,`desc2_need`,`desc3`,`desc3_need`,`buttons`,`flags`,`shop_section`) values ('fairstreet',6,'Страшилкина улица','centsquare,bank',30,0,12,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'return,forum,hint',0,NULL);

UNLOCK TABLES;

/*Table structure for table `city_stella_main` */

DROP TABLE IF EXISTS `city_stella_main`;

CREATE TABLE `city_stella_main` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `min_level` tinyint(3) NOT NULL,
  `open` tinyint(3) NOT NULL DEFAULT '0',
  `city` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `city_stella_main` */

LOCK TABLES `city_stella_main` WRITE;

UNLOCK TABLES;

/*Table structure for table `city_stella_question` */

DROP TABLE IF EXISTS `city_stella_question`;

CREATE TABLE `city_stella_question` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `question` int(4) NOT NULL DEFAULT '0',
  `answer` varchar(250) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `count` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`question`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `city_stella_question` */

LOCK TABLES `city_stella_question` WRITE;

UNLOCK TABLES;

/*Table structure for table `clan` */

DROP TABLE IF EXISTS `clan`;

CREATE TABLE `clan` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `name_short` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `glava` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `site` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `story` longtext CHARACTER SET cp1251 NOT NULL,
  `orden` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `clan` */

LOCK TABLES `clan` WRITE;

UNLOCK TABLES;

/*Table structure for table `clan_zayavka` */

DROP TABLE IF EXISTS `clan_zayavka`;

CREATE TABLE `clan_zayavka` (
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `name_short` varchar(5) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `site` varchar(50) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `znak` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `history` mediumtext CHARACTER SET cp1251 NOT NULL,
  `orden` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `glava` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `glava_fio` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet1_fio` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet2_fio` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet3` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet3_fio` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet4` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sovet4_fio` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `confirm` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `clan_zayavka` */

LOCK TABLES `clan_zayavka` WRITE;

UNLOCK TABLES;

/*Table structure for table `comok` */

DROP TABLE IF EXISTS `comok`;

CREATE TABLE `comok` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `owner` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `price` int(30) DEFAULT '0',
  `price_ekr` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `object_id` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `object_type` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `object_razdel` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `iznos` int(30) DEFAULT NULL,
  `iznos_max` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `term` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `is_modified` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `comok` */

LOCK TABLES `comok` WRITE;

UNLOCK TABLES;

/*Table structure for table `forum_language` */

DROP TABLE IF EXISTS `forum_language`;

CREATE TABLE `forum_language` (
  `key` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `ru` text CHARACTER SET cp1251 NOT NULL,
  `en` text CHARACTER SET cp1251 NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `forum_language` */

LOCK TABLES `forum_language` WRITE;

insert  into `forum_language`(`key`,`ru`,`en`) values ('lang','Язык','Lang');
insert  into `forum_language`(`key`,`ru`,`en`) values ('nologin','Не авторизованы','Nonauthorized');
insert  into `forum_language`(`key`,`ru`,`en`) values ('conf','Конференция','Conference');
insert  into `forum_language`(`key`,`ru`,`en`) values ('smiles','Cмайлы','Smiles');
insert  into `forum_language`(`key`,`ru`,`en`) values ('legal','Разрешенные смайлы на форуме.','Legal forum smiles.');
insert  into `forum_language`(`key`,`ru`,`en`) values ('smilelimit','Уважаемые игроки! В одном сообщении не может быть более трех смайлов.','Dear players! No more than three smiles in one message.');
insert  into `forum_language`(`key`,`ru`,`en`) values ('home','На главную','Home');
insert  into `forum_language`(`key`,`ru`,`en`) values ('image','Изображение','Image');
insert  into `forum_language`(`key`,`ru`,`en`) values ('text','Код','Text code');
insert  into `forum_language`(`key`,`ru`,`en`) values ('atext','Другой код','Another text code');
insert  into `forum_language`(`key`,`ru`,`en`) values ('onlyread','Только для чтения','Only for reading');
insert  into `forum_language`(`key`,`ru`,`en`) values ('rss','Отслеживать эту конференцию в','Watch this conference at');

UNLOCK TABLES;

/*Table structure for table `forum_menu_en` */

DROP TABLE IF EXISTS `forum_menu_en`;

CREATE TABLE `forum_menu_en` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `main` int(3) DEFAULT '0',
  `prev` int(3) DEFAULT NULL,
  `name` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `text` longtext CHARACTER SET cp1251,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `forum_menu_en` */

LOCK TABLES `forum_menu_en` WRITE;

insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (1,0,NULL,'Common','Here you can discuss only Anti Fight Club’s themes. You must be 8 level and not to be in chaos to write replies here or create new topics. About things which are connected with buying/selling write <a href=\"../forum/?cat=7\">here</a>. All out of AFC subjects can be discussed right in <a href=\"../forum/?cat=2\">conference</a>. Do not break rules of AFC here!!!');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (2,0,NULL,'About anything','About anything, but do not break AFC rules.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (3,0,NULL,'Creative','You can show your talents, share your artistic work about AFC or not with thankful public here.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (4,0,NULL,'Elections','Elections of Mayor.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (5,0,NULL,'Suggestions','Suggestions, notes, ideas, advices about structure of Anti Fight Club.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (6,0,NULL,'Complaints','If someone has deceived or robbed you... if you want to write a complaints to Paladins this section is for you ;)');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (7,0,NULL,'Deals','Here you can make a deals, buy/sell items, scrolls etc.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (8,0,NULL,'Job','This place is for vacations from Administration of Anti Fight Club. The job for which you can get credits..<br>Attention! Forum is <u>only</u> for reading, the results of your work send to email: <a href=\"mailto:job@anticombats.ru\">job@anticombats.ru</a>');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (9,0,NULL,'Bug report','Here you can report about found errors or read news about technical problems.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (10,0,NULL,'News','Here you can read about new things in Anti Fight Club.<br>Attention! You can’t make topics here, you can write your suggestions <a href=\"../forum/?cat=5\">here</a>, but you can express your opinion about new things here.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (11,0,NULL,'Paladins inform','This section is for information from Paladins (only Paladins can write here)');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (12,0,NULL,'Guilds','Discussions about guilds and everything which has something in common with it.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (13,0,NULL,'Alt. Intellect','Topics of people with alternative mind are being moved here. ;-)');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (14,0,NULL,'Trash','AFC is an entertaining project. Entertainment - time spending with getting positive (as it used to be) emotions. But some unhumanoid persons get satisfaction from negative emotions.  In case you are somehow bored in game - you should consider that the reason is in you, but not in games.  You have a possibility of giving a way to spite, anger, internal stress and other negative emotions in massive social games which cannot be controlled in real life by any reasons.  It’s more easier to get displeasure than pleasure.   Unhumanoid persons give a way to their negative emotions, show their \"right point of view\", \"true knowledge\" of things that have nothing in common with game process at forums.  For those who chose such a variant of game there is a special section at forum. The name of it is \"Trash\".  You can express negative emotions here. Maybe it will help to someone 8)');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (22,9,9,'News','Choose needed section.');
insert  into `forum_menu_en`(`id`,`main`,`prev`,`name`,`text`) values (23,9,9,'General questions','');

UNLOCK TABLES;

/*Table structure for table `forum_menu_ru` */

DROP TABLE IF EXISTS `forum_menu_ru`;

CREATE TABLE `forum_menu_ru` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `main` int(3) DEFAULT '0',
  `prev` int(3) DEFAULT NULL,
  `name` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `text` longtext CHARACTER SET cp1251,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `forum_menu_ru` */

LOCK TABLES `forum_menu_ru` WRITE;

insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (1,0,0,'Общая','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для создания топиков и ответов требуется не быть хаосником и быть восьмым уровнем. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить в соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!!<br><br><br><button id=\"gototech\" class=\"btnRed\">Технические вопросы</button>');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (2,0,0,'Города','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (3,0,0,'Классы','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (4,0,0,'Ангелы','Ангелы.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (5,0,0,'Обо всем','О чем угодно, но в рамках законов Анти Бойцовского Клуба.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (6,0,0,'Радио АнтиБК','Все, касающееся радио АнтиБК. Ответы на некоторые вопросы вы можете найти здесь.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (7,0,0,'Мнения','Обсуждение вопросов в рамках тем топиков.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (8,0,0,'Конкурсы','Различные простые и сложные конкурсы.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (9,0,0,'Творчество','Здесь вы можете делиться своими художественными произведениями как о АнтиБК, так и по темам отдаленным, с благодарной публикой.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (10,0,0,'Торговая реклама','Здесь вы можете на свой страх и риск договариваться о совершении различных сделок, продаже/покупке предметов, заклинаний и т.п.<br><br><b>ВНИМАНИЕ!</b> Админия не отвечает за совершённые вами сделки, потому жалобы по этой теме юстициарами и Админией не рассматриваются.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (11,0,0,'Технические вопросы','В этот раздел необходимо сообщать <b>только о <u>технических проблемах</u>, связанных с доступностью сервисов/городов проекта либо по лагам/зависаниям в игре</b>.<br>\r\n<b>ВНИМАНИЕ!</b> Все остальные вопросы по логике игры будут игнорироваться и удаляться без предупреждения.<br> \r\nЭтот раздел носит уведомительный характер. Это означает, что не по каждому сообщению будет дан ответ или комментарий со стороны технических специалистов проекта, хотя в отдельных случаях, по необходимости, подобная обратная связь и будет осуществляться.\r\n<br><br>\r\nПри размещении сообщения о технической проблеме, просим Вас строго придерживаться установленной формы:<br>\r\n* Место возникновения проблемы (город, локация), например: <i>Демонс, вход в пещеру</i>;<br>\r\n* Операционная система, например: <i>Windows XP, Windows Vista (32/64), Windows 7 (32/64), Windows 8.1 (32/64), Linux RFRemix 20 (32/64), Apple MacOS...</i>;<br>\r\n* Браузер, например: <i>Internet Eplorer 8/9/10/11, Opera 20+, Chrome 35+, Safari 4+, FireFox 32, Yandex...</i>;<br>\r\n* Наличие файрвола и/или антивируса, например: <i>Kaspersky Internet Security 15.0.0.463(a)</i>;<br>\r\n* Тип подключения к интернету и скорость канала, например: <i>adsl, ethernet, мобильное... Скорость канала получение(входящая)/передача(исходящая) (Мбит/с): 50/50.</i><br>Скорость канала можно определить, например, <a target=\"_blank\" href=\"http://www.speedtest.net/ru/\">здесь</a> или <a target=\"_blank\" href=\"http://2ip.ru/speed/\">здесь</a> или <a target=\"_blank\" href=\"http://speedtest.south.rt.ru/\">здесь</a>;<br>\r\n* В случае проблем с откликом игры (лаги) укажите здесь результат работы программы <a target=\"_blank\" href=\"http://winmtr.net/download-winmtr/\">WinMTR</a> в момент возникновения проблемы. В качестве <i>Host</i> в программе укажите адрес города, в котором возникла проблема, например: <i>suncity.anticombats.com</i> (без префикса http:// ). Запустите трассировку. Дайте поработать WinMTR минут 5, после чего нажмите на кнопку <i>\"Copy Text to clipboard\"</i> и вставьте из буфера обмена содержимое трассировки утилиты WinMTR.<br>В ОС типа <i>Linux</i> запустите в консоли утилиту <i>mtr</i>, например: <i>#mtr suncity.anticombats.com</i>;<br>\r\n* Описание проблемы (в произвольной форме, своими словами).<br>Описание проблемы по-возможности сопроводите скриншотами, которые можно расположить у себя в фотоскроллах.  Здесь же укажите только гиперссылки на скриншоты.<br> Скриншот можно сделать, нажав на клавишу <i>PrtScr</i> (весь экран) или <i>Alt+PrtScr</i> (только активное окно). После чего, открыв любой графический редактор, например, <i>MS Paint</i> вставить из буфера снятый скриншот. Создайте в графическом редакторе новую картинку (пустую) и далее, вставьте из буфера, снятый ранее скриншот, нажав на <i>CTRL+V</i>. Полученную картинку сохраните на диск в формате <i>JPG</i> или <i>PNG</i> и потом загрузите картинку в свой фотоскролл.<br>Для удобства снятия скриншотов можно так же воспользоваться сторонним программным обеспечением, например, <a target=\"_blank\" href=\"https://disk.yandex.ru/download/YandexDiskSetup.exe/\">редактором скриншотов в Яндекс.Диске</a>.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (12,0,0,'Кроссбраузерность','Конференция по кроссбраузерности.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (13,0,0,'Работа','Здесь сообщаются о вакансиях от администрации Бойцовского клуба. Работа, выполнив которую, вы можете заработать кредиты.<br>Внимание! Форум <u>только</u> для прочтения, результаты работы отсылайте на email: <a href=\"mailto:job@anticombats.ru\">job@anticombats.ru</a>');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (14,0,0,'Кланы','Обсуждение кланов и все, что с ними связанно...');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (15,0,0,'Аlt. Интеллект','Сюда переносятся топики людей с альтернативным мышлением и мировоззрением. ;-)');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (16,0,0,'Модераторы','Служебная конференция клана модераторс');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (17,0,0,'Поной-ка','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (18,0,0,'Помойка','АнтиБк - развлекательный проект. Развлечение - времяпрепровождение с целью получения положительных (как правило) эмоций. Некоторые «негуманоидные» сущности развлекают себя тем, что получают удовольствие от отрицательных эмоций  - это тоже развлечение. Если по каким -то причинам становится скучно в игре - обычно приходиться признать, что причины надо искать в себе, а не в играх.  В массово-социальных играх есть возможность скинуть внутреннее напряжение, раздражение, злобу, гнев и другие негативные эмоции, которые, в силу тех или иных причин, человек не может контролировать в реальной жизни.  «Неудовольствие» получать гораздо проще, чем удовольствие.   «Негуманоидных» сущностей буквально тошнит на форумах «своими мнением», «истинным знанием», «пониманием» тем, не относящихся непосредственно к игровому процессу.  Для тех, кто выбрал для себя такой вариант игры - добро пожаловать на новую ветку форума. Называется «Помойка».  В «Помойку» можно сливать  все негативные эмоции, вдруг поможет кому-то 8)');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (19,0,0,'Архив','Хранилище устаревших неактуальных конференций форума.');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (20,1,1,'Общая [6]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (21,1,1,'Общая [7]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (22,1,1,'Общая [8]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (23,1,1,'Общая [9]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (24,1,1,'Общая [10]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (25,1,1,'Общая [11]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (26,1,1,'Общая [12]','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (27,1,1,'Опросы','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (28,2,2,'Capital city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом, для всех склонностей и уровней. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>. Законы Клуба имеют действия и здесь!!! ');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (29,2,2,'Angels city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном городе Ангелов, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (30,2,2,'Demons city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Demons city, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (31,2,2,'Devils city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Devils city, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (32,2,2,'Suncity','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Suncity, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (33,2,2,'Emeralds city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Emeralds city, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (34,2,2,'Sandcity','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Sandcity, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (35,2,2,'Mooncity','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Mooncity, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (36,2,2,'Abandoned Plain','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Abandoned Plain, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (37,2,2,'Dreams city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Dreams city, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (38,2,2,'Low city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Low city, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (39,2,2,'Old city','Здесь можно обсуждать вопросы связанные только с Анти Бойцовским Клубом в славном Old city, для всех склонностей и уровней выше первого. По вопросам покупки/продажи предметов пишите <a href=\"../forum/?cat=10\">сюда</a>. Все вопросы не связанные с клубом, можно обсудить соответствующей <a href=\"../forum/?cat=5\">конференции</a>.<br>Законы Клуба имеют действия и здесь!!!');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (40,3,3,'Воин','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (41,3,3,'Стрелок','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (42,3,3,'Маг','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (43,3,40,'Силовик','');
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (44,3,40,'Уворот',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (45,3,40,'Критовик',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (46,3,40,'Танк',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (47,3,41,'Арбалет',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (48,3,41,'Лук',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (49,3,42,'Маг земли',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (50,3,42,'Маг воздуха',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (51,3,42,'Маг огня',NULL);
insert  into `forum_menu_ru`(`id`,`main`,`prev`,`name`,`text`) values (52,3,42,'Маг воды',NULL);

UNLOCK TABLES;

/*Table structure for table `forum_posts` */

DROP TABLE IF EXISTS `forum_posts`;

CREATE TABLE `forum_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `top_id` bigint(20) NOT NULL DEFAULT '0',
  `text` text CHARACTER SET cp1251 NOT NULL,
  `date` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `poster` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `p_id` bigint(20) NOT NULL DEFAULT '0',
  `p_rank` int(2) NOT NULL DEFAULT '0',
  `p_tribe` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `p_level` int(11) NOT NULL DEFAULT '0',
  `p_rase` int(2) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  KEY `top_id` (`top_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1176923677 DEFAULT CHARSET=utf8;

/*Data for the table `forum_posts` */

LOCK TABLES `forum_posts` WRITE;

UNLOCK TABLES;

/*Table structure for table `forum_smiles` */

DROP TABLE IF EXISTS `forum_smiles`;

CREATE TABLE `forum_smiles` (
  `text` varchar(32) NOT NULL,
  `atext` varchar(32) DEFAULT NULL,
  `img` varchar(15) NOT NULL,
  PRIMARY KEY (`text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `forum_smiles` */

LOCK TABLES `forum_smiles` WRITE;

insert  into `forum_smiles`(`text`,`atext`,`img`) values (':agree:','&nbsp;','agree.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':alch:','&nbsp;','alch.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':alien:','&nbsp;','alien.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':angel2:','&nbsp;','angel2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':angel:','O:-)','angel.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':baby:',':-*','baby.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':beer:','*DRINK*','beer.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':beggar: 	','&nbsp;','beggar.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':boks2:','&nbsp;','boks2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':boks:','&nbsp;','boks.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':bow:','&nbsp;','bow.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':bye:','*BYE*','bye.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':carreat:','&nbsp;','carreat.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':cat:','&nbsp;','cat.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':chtoza:','&nbsp;','chtoza.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':confused:','&nbsp;','confused.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':creator:','&nbsp;','creator.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':cry:','&nbsp;','cry.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':crying:',':\'(','crying.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':dance1:','&nbsp;','dance1.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':dance2:','&nbsp;','dance2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':dedmoroz:','&nbsp;','dedmoroz.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':devil:','&nbsp;','devil.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':doc2:','&nbsp;','doc2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':doc:','&nbsp;','doc.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':dont:','*STOP*','dont.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':drink:','&nbsp;','drink.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':duel:','&nbsp;','duel.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':dustman:','&nbsp;','dustman.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':eek:','=-O','eek.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':elix:','&nbsp;','elix.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':fie:','&nbsp;','fie.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':fingal:','&nbsp;','fingal.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':fire:',']:->','fire.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':flowers:','&nbsp;','flowers.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':friday:','&nbsp;','friday.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':gangam:','&nbsp;','gangam.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':gent:','&nbsp;','gent.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':grace:','&nbsp;','grace.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':grenade:','@=','grenade.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':grust:',':(','grust.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':gun:','&nbsp;','gun.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':hello:','&nbsp;','hello.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':help:','*HELP*','help.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':hi:','*HI*','hi.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':hlw:','&nbsp;','hlw.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':horse:','&nbsp;','horse.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':hug:','&nbsp;','hug.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':icon7:','&nbsp;','icon7.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':idea:','*YAHOO*','idea.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':inv:','&nbsp;','inv.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':invis:','&nbsp;','invis.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':jeer:','*ROFL*','jeer.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':king2:','&nbsp;','king2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':king:','&nbsp;','king.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':kiss2:','&nbsp;','kiss2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':kiss3:','&nbsp;','kiss3.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':kiss4:','&nbsp;','kiss4.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':kiss:','*KISSING*','kiss.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':kruger:','&nbsp;','kruger.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':lady:','&nbsp;','lady.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':laugh:',':-D','laugh.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':lick:','&nbsp;','lick.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':lightfly:','&nbsp;','lightfly.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':lordhaos:','&nbsp;','lordhaos.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':love2:','&nbsp;','love2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':love:','*IN LOVE*','love.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':loveya:','&nbsp;','loveya.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':mad:','&nbsp;','mad.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':mag:','&nbsp;','mag.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':maniac:','&nbsp;','maniac.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':mdr:','&nbsp;','mdr.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':mol:','&nbsp;','mol.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':naem2:','&nbsp;','naem2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':naem3:','&nbsp;','naem3.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':naem:','&nbsp;','naem.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':nail:','&nbsp;','nail.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':ninja:','&nbsp;','ninja.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':nnn:','&nbsp;','nnn.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':no:','*NO*','no.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':nono:','*NONO*','nono.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':nun:','&nbsp;','nun.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':nunu:','&nbsp;','nunu.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':obm:','&nbsp;','obm.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':ok:','*OK*','ok.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':owl:','&nbsp;','owl.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':pal:','&nbsp;','pal.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':pif:','&nbsp;','pif.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':pirate:','&nbsp;','pirate.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':podz:','&nbsp;','podz.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':ponder:','&nbsp;','ponder.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':privet:','&nbsp;','privet.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':radio1:','&nbsp;','radio1.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':radio2:','&nbsp;','radio2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':rand:','&nbsp;','rand.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':red:',':-[','red.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':rev:','&nbsp;','rev.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':rocket:','&nbsp;','rocket.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':rose:','@}->-','rose.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':rotate:','&nbsp;','rotate.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':row:','&nbsp;','row.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':rupor:','&nbsp;','rupor.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sharp:','&nbsp;','sharp.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':showng:','&nbsp;','showng.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':shuffle:','&nbsp;','shuffle.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':smash:','&nbsp;','smash.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':smil:','&nbsp;','smil.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':smile0:',':)','icon7.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':smile:','&nbsp;','smile.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':smoke:','*WASSUP*','smoke.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sneeze:','&nbsp;','sneeze.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':snegur:','&nbsp;','snegur.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sniper:','&nbsp;','sniper.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':snowfight:','&nbsp;','snowfight.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sorry2:','&nbsp;','sorry2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sorry:','&nbsp;','sorry.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sten:','&nbsp;','sten.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':str:','&nbsp;','str.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':super:','super.gif','super.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':superng:','&nbsp;','superng.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':susel:','&nbsp;','susel.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':sword:','&nbsp;','sword.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':tease:','&nbsp;','tease.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':tongue2:',':-P','tongue2.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':tongue:',':-p','tongue.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':trup:','&nbsp;','trup.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':ura:','&nbsp;','ura.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':vamp:','&nbsp;','vamp.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':victory:','&nbsp;','victory.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':wink:',':;)','wink.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':yar:','&nbsp;','yar.gif');
insert  into `forum_smiles`(`text`,`atext`,`img`) values (':yes:','*YES*','yes.gif');

UNLOCK TABLES;

/*Table structure for table `forum_topic` */

DROP TABLE IF EXISTS `forum_topic`;

CREATE TABLE `forum_topic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `msg` longtext CHARACTER SET cp1251 NOT NULL,
  `topic_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `login` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `orden` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `clan` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `clan_s` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `level` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `forum_topic` */

LOCK TABLES `forum_topic` WRITE;

UNLOCK TABLES;

/*Table structure for table `forum_topics_ru` */

DROP TABLE IF EXISTS `forum_topics_ru`;

CREATE TABLE `forum_topics_ru` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `last_update` bigint(20) NOT NULL DEFAULT '0',
  `fixed` int(1) NOT NULL DEFAULT '0',
  `cat` varchar(15) CHARACTER SET cp1251 NOT NULL DEFAULT 'main',
  `title` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `icon` int(2) NOT NULL DEFAULT '0',
  `text` text CHARACTER SET cp1251 NOT NULL,
  `date` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `poster` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `p_id` bigint(20) NOT NULL DEFAULT '0',
  `p_rank` int(2) NOT NULL DEFAULT '0',
  `p_tribe` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `p_level` int(11) NOT NULL DEFAULT '0',
  `p_rase` int(2) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  KEY `cat` (`cat`)
) ENGINE=MyISAM AUTO_INCREMENT=1176923604 DEFAULT CHARSET=utf8;

/*Data for the table `forum_topics_ru` */

LOCK TABLES `forum_topics_ru` WRITE;

UNLOCK TABLES;

/*Table structure for table `gift` */

DROP TABLE IF EXISTS `gift`;

CREATE TABLE `gift` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `price` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `wish` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mass` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `is_random` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `g_type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `g_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mountown` varchar(10) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gift` */

LOCK TABLES `gift` WRITE;

UNLOCK TABLES;

/*Table structure for table `goers` */

DROP TABLE IF EXISTS `goers`;

CREATE TABLE `goers` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `time` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `destenation` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `dest_game` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `len` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `len_done` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `napr` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `goers` */

LOCK TABLES `goers` WRITE;

UNLOCK TABLES;

/*Table structure for table `history_auth` */

DROP TABLE IF EXISTS `history_auth`;

CREATE TABLE `history_auth` (
  `id` bigint(20) NOT NULL,
  `guid` int(11) NOT NULL,
  `action` tinyint(2) NOT NULL,
  `ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `city` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `comment` varchar(32) CHARACTER SET cp1251 DEFAULT NULL,
  `date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`guid`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `history_auth` */

LOCK TABLES `history_auth` WRITE;

UNLOCK TABLES;

/*Table structure for table `history_bank` */

DROP TABLE IF EXISTS `history_bank`;

CREATE TABLE `history_bank` (
  `id` bigint(20) NOT NULL,
  `credit` int(10) NOT NULL DEFAULT '0',
  `credit2` int(10) NOT NULL DEFAULT '0',
  `cash` double NOT NULL DEFAULT '0',
  `euro` double NOT NULL DEFAULT '0',
  `operation` tinyint(3) NOT NULL DEFAULT '0',
  `date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`credit`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

/*Data for the table `history_bank` */

LOCK TABLES `history_bank` WRITE;

UNLOCK TABLES;

/*Table structure for table `history_items` */

DROP TABLE IF EXISTS `history_items`;

CREATE TABLE `history_items` (
  `id` int(11) NOT NULL,
  `guid` int(11) NOT NULL,
  `receive` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `action` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `item` longtext CHARACTER SET cp1251 NOT NULL,
  `date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=705 DEFAULT CHARSET=utf8;

/*Data for the table `history_items` */

LOCK TABLES `history_items` WRITE;

UNLOCK TABLES;

/*Table structure for table `history_mail` */

DROP TABLE IF EXISTS `history_mail`;

CREATE TABLE `history_mail` (
  `id` int(11) NOT NULL,
  `guid` int(11) NOT NULL,
  `receive` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `action` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `item` longtext CHARACTER SET cp1251 NOT NULL,
  `ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Data for the table `history_mail` */

LOCK TABLES `history_mail` WRITE;

UNLOCK TABLES;

/*Table structure for table `hit_temp` */

DROP TABLE IF EXISTS `hit_temp`;

CREATE TABLE `hit_temp` (
  `attack` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `defend` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `def_hit1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `def_hit2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `def_block1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `def_block2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `hit_temp` */

LOCK TABLES `hit_temp` WRITE;

UNLOCK TABLES;

/*Table structure for table `item_template` */

DROP TABLE IF EXISTS `item_template`;

CREATE TABLE `item_template` (
  `entry` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `section` varchar(11) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(11) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `item_flags` int(11) unsigned NOT NULL DEFAULT '0',
  `mass` double unsigned NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `price_euro` double NOT NULL DEFAULT '0',
  `tear` int(3) unsigned NOT NULL DEFAULT '0',
  `min_level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_str` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_dex` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_con` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_vit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_int` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_wis` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_sword` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_axe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_fail` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_knife` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_staff` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_fire` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_water` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_air` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_earth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_light` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_gray` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_dark` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `min_mp_all` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `add_str` tinyint(3) NOT NULL DEFAULT '0',
  `add_dex` tinyint(3) NOT NULL DEFAULT '0',
  `add_con` tinyint(3) NOT NULL DEFAULT '0',
  `add_int` tinyint(3) NOT NULL DEFAULT '0',
  `add_hp` int(4) NOT NULL DEFAULT '0',
  `add_mp` int(4) NOT NULL DEFAULT '0',
  `hp_regen` int(3) NOT NULL DEFAULT '0',
  `mp_regen` int(3) NOT NULL DEFAULT '0',
  `mp_cons` int(3) NOT NULL DEFAULT '0',
  `def_h` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `def_a` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `def_b` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `def_l` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `attack` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `brick` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `res_magic` int(3) NOT NULL DEFAULT '0',
  `res_fire` int(3) NOT NULL DEFAULT '0',
  `res_water` int(3) NOT NULL DEFAULT '0',
  `res_air` int(3) NOT NULL DEFAULT '0',
  `res_earth` int(3) NOT NULL DEFAULT '0',
  `res_light` int(3) NOT NULL DEFAULT '0',
  `res_gray` int(3) NOT NULL DEFAULT '0',
  `res_dark` int(3) NOT NULL DEFAULT '0',
  `res_dmg` int(3) NOT NULL DEFAULT '0',
  `res_dmg_h` int(3) NOT NULL DEFAULT '0',
  `res_dmg_a` int(3) NOT NULL DEFAULT '0',
  `res_dmg_b` int(3) NOT NULL DEFAULT '0',
  `res_dmg_l` int(3) NOT NULL DEFAULT '0',
  `res_sting` int(3) NOT NULL DEFAULT '0',
  `res_sting_h` int(3) NOT NULL DEFAULT '0',
  `res_sting_a` int(3) NOT NULL DEFAULT '0',
  `res_sting_b` int(3) NOT NULL DEFAULT '0',
  `res_sting_l` int(3) NOT NULL DEFAULT '0',
  `res_slash` int(3) NOT NULL DEFAULT '0',
  `res_slash_h` int(3) NOT NULL DEFAULT '0',
  `res_slash_a` int(3) NOT NULL DEFAULT '0',
  `res_slash_b` int(3) NOT NULL DEFAULT '0',
  `res_slash_l` int(3) NOT NULL DEFAULT '0',
  `res_crush` int(3) NOT NULL DEFAULT '0',
  `res_crush_h` int(3) NOT NULL DEFAULT '0',
  `res_crush_a` int(3) NOT NULL DEFAULT '0',
  `res_crush_b` int(3) NOT NULL DEFAULT '0',
  `res_crush_l` int(3) NOT NULL DEFAULT '0',
  `res_sharp` int(3) NOT NULL DEFAULT '0',
  `res_sharp_h` int(3) NOT NULL DEFAULT '0',
  `res_sharp_a` int(3) NOT NULL DEFAULT '0',
  `res_sharp_b` int(3) NOT NULL DEFAULT '0',
  `res_sharp_l` int(3) NOT NULL DEFAULT '0',
  `mf_dmg` int(3) NOT NULL DEFAULT '0',
  `mf_dmg_h` int(3) NOT NULL DEFAULT '0',
  `mf_sting` int(3) NOT NULL DEFAULT '0',
  `mf_sting_h` int(3) NOT NULL DEFAULT '0',
  `mf_slash` int(3) NOT NULL DEFAULT '0',
  `mf_slash_h` int(3) NOT NULL DEFAULT '0',
  `mf_crush` int(3) NOT NULL DEFAULT '0',
  `mf_crush_h` int(3) NOT NULL DEFAULT '0',
  `mf_sharp` int(3) NOT NULL DEFAULT '0',
  `mf_sharp_h` int(3) NOT NULL DEFAULT '0',
  `mf_magic` int(3) NOT NULL DEFAULT '0',
  `mf_fire` int(3) NOT NULL DEFAULT '0',
  `mf_water` int(3) NOT NULL DEFAULT '0',
  `mf_air` int(3) NOT NULL DEFAULT '0',
  `mf_earth` int(3) NOT NULL DEFAULT '0',
  `mf_light` int(3) NOT NULL DEFAULT '0',
  `mf_gray` int(3) NOT NULL DEFAULT '0',
  `mf_dark` int(3) NOT NULL DEFAULT '0',
  `mf_crit` int(3) NOT NULL DEFAULT '0',
  `mf_crit_h` int(3) NOT NULL DEFAULT '0',
  `mf_critp` int(3) NOT NULL DEFAULT '0',
  `mf_critp_h` int(3) NOT NULL DEFAULT '0',
  `mf_acrit` int(3) NOT NULL DEFAULT '0',
  `mf_dodge` int(3) NOT NULL DEFAULT '0',
  `mf_adodge` int(3) NOT NULL DEFAULT '0',
  `mf_adodge_h` int(3) NOT NULL DEFAULT '0',
  `mf_parmour` int(3) NOT NULL DEFAULT '0',
  `mf_parmour_h` int(3) NOT NULL DEFAULT '0',
  `mf_contr` int(3) NOT NULL DEFAULT '0',
  `mf_parry` int(3) NOT NULL DEFAULT '0',
  `mf_shieldb` int(3) NOT NULL DEFAULT '0',
  `all_magic` int(3) NOT NULL DEFAULT '0',
  `fire` int(3) NOT NULL DEFAULT '0',
  `water` int(3) NOT NULL DEFAULT '0',
  `air` int(3) NOT NULL DEFAULT '0',
  `earth` int(3) NOT NULL DEFAULT '0',
  `light` int(3) NOT NULL DEFAULT '0',
  `gray` int(3) NOT NULL DEFAULT '0',
  `dark` int(3) NOT NULL DEFAULT '0',
  `all_mastery` int(3) NOT NULL DEFAULT '0',
  `sword` int(3) NOT NULL DEFAULT '0',
  `sword_h` int(3) NOT NULL DEFAULT '0',
  `bow` int(3) NOT NULL DEFAULT '0',
  `crossbow` int(3) NOT NULL DEFAULT '0',
  `axe` int(3) NOT NULL DEFAULT '0',
  `axe_h` int(3) NOT NULL DEFAULT '0',
  `fail` int(3) NOT NULL DEFAULT '0',
  `fail_h` int(3) NOT NULL DEFAULT '0',
  `knife` int(3) NOT NULL DEFAULT '0',
  `knife_h` int(3) NOT NULL DEFAULT '0',
  `staff` int(3) NOT NULL DEFAULT '0',
  `add_hit_min` int(2) NOT NULL DEFAULT '0',
  `add_hit_max` int(2) NOT NULL DEFAULT '0',
  `rep_magic` int(3) NOT NULL DEFAULT '0',
  `rep_fire` int(3) NOT NULL DEFAULT '0',
  `rep_water` int(3) NOT NULL DEFAULT '0',
  `rep_air` int(3) NOT NULL DEFAULT '0',
  `rep_earth` int(3) NOT NULL DEFAULT '0',
  `ch_sting` tinyint(3) NOT NULL DEFAULT '0',
  `ch_slash` tinyint(3) NOT NULL DEFAULT '0',
  `ch_crush` tinyint(3) NOT NULL DEFAULT '0',
  `ch_sharp` tinyint(3) NOT NULL DEFAULT '0',
  `ch_fire` tinyint(3) NOT NULL DEFAULT '0',
  `ch_water` tinyint(3) NOT NULL DEFAULT '0',
  `ch_air` tinyint(3) NOT NULL DEFAULT '0',
  `ch_earth` tinyint(3) NOT NULL DEFAULT '0',
  `ch_light` tinyint(3) NOT NULL DEFAULT '0',
  `ch_dark` tinyint(3) NOT NULL DEFAULT '0',
  `inc_count` tinyint(3) NOT NULL DEFAULT '0',
  `personal_owner` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `block` tinyint(3) NOT NULL DEFAULT '0',
  `orden` tinyint(3) NOT NULL DEFAULT '0',
  `sex` tinyint(3) DEFAULT NULL,
  `itemset` varchar(30) CHARACTER SET cp1251 DEFAULT '',
  `hands` tinyint(3) NOT NULL DEFAULT '0',
  `description` longtext CHARACTER SET cp1251,
  `validity` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`entry`),
  KEY `id` (`entry`)
) ENGINE=MyISAM AUTO_INCREMENT=1122 DEFAULT CHARSET=utf8;

/*Data for the table `item_template` */

LOCK TABLES `item_template` WRITE;

UNLOCK TABLES;

/*Table structure for table `lotto` */

DROP TABLE IF EXISTS `lotto`;

CREATE TABLE `lotto` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `number` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Data for the table `lotto` */

LOCK TABLES `lotto` WRITE;

UNLOCK TABLES;

/*Table structure for table `lotto_fond` */

DROP TABLE IF EXISTS `lotto_fond`;

CREATE TABLE `lotto_fond` (
  `fond` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `lotto_fond` */

LOCK TABLES `lotto_fond` WRITE;

UNLOCK TABLES;

/*Table structure for table `medal` */

DROP TABLE IF EXISTS `medal`;

CREATE TABLE `medal` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `msg` varchar(255) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `price` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `disc` longtext CHARACTER SET cp1251 NOT NULL,
  `add_l` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_u` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mass` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `medal` */

LOCK TABLES `medal` WRITE;

UNLOCK TABLES;

/*Table structure for table `miners` */

DROP TABLE IF EXISTS `miners`;

CREATE TABLE `miners` (
  `login` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `time` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `resource` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `cell` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `count` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `miners` */

LOCK TABLES `miners` WRITE;

UNLOCK TABLES;

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(60) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `msg` text CHARACTER SET cp1251 NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

LOCK TABLES `news` WRITE;

insert  into `news`(`id`,`theme`,`msg`,`date`) values (1,'Открытие!','<img src=\'img/site/suven2008_5.gif\' width=\'60\' height=\'60\' hspace=\'5\' vspace=\'5\' align=\'left\'><br>С данного дня 20.06.09, я начинаю потихоньку тестить сайт, что-то корректировать.','1245441600');

UNLOCK TABLES;

/*Table structure for table `online` */

DROP TABLE IF EXISTS `online`;

CREATE TABLE `online` (
  `guid` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `login_display` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `city` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `room` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `sid` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `last_time` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `online` */

LOCK TABLES `online` WRITE;

UNLOCK TABLES;

/*Table structure for table `player_effects` */

DROP TABLE IF EXISTS `player_effects`;

CREATE TABLE `player_effects` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL,
  `add_hp` int(4) NOT NULL DEFAULT '0',
  `add_mp` int(4) NOT NULL DEFAULT '0',
  `mp_regen` int(3) NOT NULL DEFAULT '0',
  `mp_cons` int(3) NOT NULL DEFAULT '0',
  `res_magic` int(3) NOT NULL DEFAULT '0',
  `res_dmg` int(3) NOT NULL DEFAULT '0',
  `mf_magic` int(3) NOT NULL DEFAULT '0',
  `mf_dmg` int(3) NOT NULL DEFAULT '0',
  `add_hit_min` int(2) NOT NULL DEFAULT '0',
  `add_hit_max` int(2) NOT NULL DEFAULT '0',
  `mf_critp` int(3) NOT NULL DEFAULT '0',
  `mf_acrit` int(3) NOT NULL DEFAULT '0',
  `mf_dodge` int(3) NOT NULL DEFAULT '0',
  `mf_adodge` int(3) NOT NULL DEFAULT '0',
  `duration` bigint(20) NOT NULL DEFAULT '0' COMMENT 'sec',
  `set` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `power` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `player_effects` */

LOCK TABLES `player_effects` WRITE;

insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (1,'Выносливость',30,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,0);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (2,'Чудовищная Сила',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,'str',1);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (3,'Чудовищная Сила',0,0,0,0,0,0,0,10,0,0,0,0,0,0,0,'str',2);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (4,'Чудовищная Сила',50,0,0,0,0,0,0,15,0,0,0,0,0,0,0,'str',3);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (5,'Чудовищная Сила',50,0,0,0,0,0,0,15,10,10,0,0,0,0,0,'str',4);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (6,'Чудовищная Сила',50,0,0,0,0,0,0,25,10,10,0,75,0,75,0,'str',5);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (7,'Чудовищная Сила',100,0,0,0,0,0,0,35,10,10,0,75,0,75,0,'str',6);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (8,'Скорость Молнии',0,0,0,0,0,0,0,0,0,0,0,0,0,50,0,'dex',1);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (9,'Скорость Молнии',0,0,0,0,0,0,0,0,0,0,0,0,100,50,0,'dex',2);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (10,'Скорость Молнии',0,0,0,0,0,0,0,0,0,0,0,0,100,150,0,'dex',3);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (11,'Скорость Молнии',0,0,0,0,0,0,0,0,0,0,0,0,100,150,0,'dex',4);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (12,'Скорость Молнии',0,0,0,0,0,0,0,0,0,0,0,0,250,150,0,'dex',5);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (13,'Скорость Молнии',0,0,0,0,0,0,0,10,0,0,0,0,250,200,0,'dex',6);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (14,'Предчувствие',0,0,0,0,0,0,0,0,0,0,10,0,0,0,0,'con',1);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (15,'Предчувствие',0,0,0,0,0,0,0,0,0,0,10,50,0,0,0,'con',2);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (16,'Предчувствие',0,0,0,0,0,0,0,0,0,0,25,50,0,0,0,'con',3);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (17,'Предчувствие',0,0,0,0,0,0,0,0,0,0,25,50,0,0,0,'con',4);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (18,'Предчувствие',0,0,0,0,0,0,0,0,0,0,25,200,0,0,0,'con',5);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (19,'Предчувствие',0,0,0,0,0,0,0,0,0,0,35,300,0,0,0,'con',6);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (20,'Стальное Тело',50,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'vit',1);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (21,'Стальное Тело',150,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'vit',2);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (22,'Стальное Тело',300,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'vit',3);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (23,'Стальное Тело',300,0,0,0,10,10,0,0,0,0,0,0,0,0,0,'vit',4);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (24,'Стальное Тело',500,0,0,0,10,10,0,0,0,0,0,0,0,0,0,'vit',5);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (25,'Стальное Тело',750,0,0,0,10,10,0,0,0,0,0,0,0,0,0,'vit',6);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (26,'Разум',0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,'int',1);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (27,'Разум',0,0,0,0,0,0,10,0,0,0,0,0,0,0,0,'int',2);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (28,'Разум',0,0,0,0,0,0,15,0,0,0,0,0,0,0,0,'int',3);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (29,'Разум',0,0,0,0,0,0,15,0,0,0,0,0,0,0,0,'int',4);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (30,'Разум',0,100,0,0,0,0,20,0,0,0,0,0,0,0,0,'int',5);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (31,'Разум',0,150,0,0,0,0,30,0,0,0,0,0,0,0,0,'int',6);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (32,'Сила Мудрости',0,50,100,0,0,0,0,0,0,0,0,0,0,0,0,'wis',1);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (33,'Сила Мудрости',0,100,200,0,0,0,0,0,0,0,0,0,0,0,0,'wis',2);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (34,'Сила Мудрости',0,200,350,0,0,0,0,0,0,0,0,0,0,0,0,'wis',3);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (35,'Сила Мудрости',0,200,350,5,0,0,0,0,0,0,0,0,0,0,0,'wis',4);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (36,'Сила Мудрости',0,350,500,5,0,0,0,0,0,0,0,0,0,0,0,'wis',5);
insert  into `player_effects`(`id`,`name`,`add_hp`,`add_mp`,`mp_regen`,`mp_cons`,`res_magic`,`res_dmg`,`mf_magic`,`mf_dmg`,`add_hit_min`,`add_hit_max`,`mf_critp`,`mf_acrit`,`mf_dodge`,`mf_adodge`,`duration`,`set`,`power`) values (37,'Сила Мудрости',0,550,600,5,0,0,0,0,0,0,0,0,0,0,0,'wis',6);

UNLOCK TABLES;

/*Table structure for table `player_exp_for_level` */

DROP TABLE IF EXISTS `player_exp_for_level`;

CREATE TABLE `player_exp_for_level` (
  `up` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `ups` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `skills` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '0',
  `vit` int(11) NOT NULL DEFAULT '0',
  `spi` int(11) NOT NULL DEFAULT '0',
  `hp_regen` int(10) NOT NULL DEFAULT '0',
  `add_bars` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`up`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `player_exp_for_level` */

LOCK TABLES `player_exp_for_level` WRITE;

insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (1,0,20,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (2,0,45,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (3,0,75,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (4,1,110,3,1,0,1,0,250,'mod,power,def');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (5,1,160,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (6,1,215,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (7,1,280,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (8,1,350,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (9,2,410,3,1,0,1,0,0,'set');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (10,2,530,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (11,2,670,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (12,2,830,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (13,2,950,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (14,2,1100,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (15,3,1300,3,1,0,1,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (16,3,1450,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (17,3,1650,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (18,3,1850,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (19,3,2050,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (20,3,2200,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (21,4,2500,5,1,0,1,0,0,'btn');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (22,4,2900,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (23,4,3350,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (24,4,3800,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (25,4,4200,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (26,4,4600,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (27,5,5000,3,1,0,1,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (28,5,6000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (29,5,7000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (30,5,8000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (31,5,9000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (32,5,10000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (33,5,11000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (34,5,12000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (35,6,12500,3,1,0,1,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (36,6,14000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (37,6,15500,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (53,8,300000,5,1,500,1,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (52,7,280000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (51,7,260000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (50,7,250000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (49,7,225000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (48,7,200000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (47,7,175000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (46,7,150000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (45,7,75000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (44,7,60000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (43,7,30000,5,1,0,1,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (38,6,17000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (39,6,19000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (40,6,21000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (41,6,23000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (42,6,27000,1,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (54,8,400000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (55,8,500000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (56,8,600000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (57,8,700000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (58,8,800000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (59,8,900000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (60,8,1000000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (61,8,1200000,0,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (62,8,1500000,1,0,500,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (63,8,1750000,1,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (64,8,2000000,1,0,300,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (65,8,2175000,1,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (66,8,2300000,1,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (67,8,2400000,1,0,1,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (68,8,2500000,1,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (69,8,2600000,1,0,100,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (70,8,2800000,1,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (71,9,3000000,7,1,1400,2,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (72,9,6000000,1,0,500,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (73,9,6500000,1,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (74,9,7500000,1,0,1,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (75,9,8500000,1,0,250,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (76,9,9000000,1,0,400,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (77,9,9250000,1,0,50,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (78,9,9500000,1,0,400,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (79,9,9750000,1,0,350,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (80,9,9900000,1,0,500,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (81,10,10000000,9,1,2400,3,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (82,10,13000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (83,10,14000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (84,10,15000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (85,10,16000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (86,10,17000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (87,10,17500000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (88,10,18000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (89,10,19000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (90,10,19500000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (91,10,20000000,2,0,200,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (92,10,30000000,2,0,0,0,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (93,10,32000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (94,10,34000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (95,10,35000000,2,0,0,0,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (96,10,36000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (97,10,38000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (98,10,40000000,2,0,0,0,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (99,10,42000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (100,10,44000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (101,10,45000000,2,0,0,0,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (102,10,46000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (103,10,48000000,2,0,0,0,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (104,10,50000000,2,0,0,0,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (105,11,52000000,10,1,0,5,0,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (106,11,55000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (107,11,60000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (108,11,65000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (109,11,70000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (110,11,80000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (111,11,85000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (112,11,90000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (113,11,95000000,1,0,0,1,1,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (114,11,100000000,5,1,0,5,5,0,'');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`spi`,`hp_regen`,`add_bars`) values (115,12,120000000,0,0,0,20,0,0,'');

UNLOCK TABLES;

/*Table structure for table `player_shapes` */

DROP TABLE IF EXISTS `player_shapes`;

CREATE TABLE `player_shapes` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `sex` varchar(11) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `str` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `dex` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `con` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `int` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `wis` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sword` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `axe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fail` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `knife` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fire` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `water` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `earth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `air` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `light` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `dark` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

/*Data for the table `player_shapes` */

LOCK TABLES `player_shapes` WRITE;

insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (1,'0','1.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (2,'0','2.gif',0,0,0,0,0,0,30,0,0,0,0,3,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (3,'0','3.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (4,'0','4.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (5,'0','5.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (6,'0','6.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (7,'0','7.gif',0,0,0,0,0,0,30,0,0,0,0,0,3,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (8,'0','8.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (9,'0','9.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (10,'0','10.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (11,'0','11.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (12,'0','12.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (13,'0','13.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (14,'0','14.gif',0,0,0,0,0,0,30,0,0,0,0,0,0,3,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (15,'0','15.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (16,'0','16.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (17,'0','17.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (18,'0','18.gif',0,0,0,0,0,0,30,0,0,0,0,0,0,0,3,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (19,'0','19.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (20,'0','20.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (21,'0','21.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (22,'0','22.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (23,'0','23.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (24,'0','24.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (25,'0','25.gif',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (26,'0','26.gif',9,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (27,'0','27.gif',9,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (28,'0','28.gif',9,0,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (29,'0','29.gif',9,0,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (30,'0','30.gif',8,0,0,0,0,35,35,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (31,'0','31.gif',8,35,0,0,35,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (32,'0','32.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,0,4);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (33,'0','33.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,4,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (34,'0','34.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,5,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (35,'0','35.gif',9,0,0,0,0,50,50,0,0,0,0,4,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (36,'0','36.gif',9,0,0,0,0,50,50,0,0,0,0,0,4,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (37,'0','37.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,4,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (38,'0','38.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (39,'0','39.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (40,'0','40.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (41,'0','41.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (42,'0','42.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (43,'0','43.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (44,'0','44.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (45,'0','45.gif',7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (46,'0','46.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (47,'0','47.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (48,'0','48.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (49,'0','49.gif',7,0,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (50,'0','50.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (51,'0','51.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (52,'0','52.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (53,'0','53.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (54,'1','1.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (55,'1','69.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (56,'1','3.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (57,'1','4.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (58,'1','5.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (59,'1','6.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (60,'1','7.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (61,'1','8.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (62,'1','9.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (63,'1','10.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (64,'1','11.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (65,'1','12.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (66,'1','13.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (67,'1','14.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (68,'1','15.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (69,'1','16.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (70,'1','17.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (71,'1','18.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (72,'1','19.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (73,'1','20.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (74,'1','21.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (75,'1','22.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (76,'1','23.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (77,'1','24.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (78,'1','25.gif',0,0,0,0,0,0,0,0,0,0,5,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (79,'1','26.gif',0,0,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (80,'1','27.gif',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (81,'1','28.gif',0,0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (82,'1','29.gif',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (83,'1','30.gif',0,0,0,0,0,0,0,0,0,0,0,5,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (84,'1','31.gif',0,0,0,0,0,0,35,0,0,0,0,0,0,0,0,0,4);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (85,'1','32.gif',0,0,0,0,0,0,0,0,0,5,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (86,'1','33.gif',0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (87,'1','34.gif',0,0,0,0,40,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (88,'1','35.gif',0,0,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (89,'1','36.gif',9,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (90,'1','37.gif',9,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (91,'1','38.gif',9,0,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (92,'1','42.gif',8,0,0,0,0,35,35,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (93,'1','43.gif',8,35,0,0,35,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (94,'1','44.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,4,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (95,'1','45.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,0,4);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (96,'1','46.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,4,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (97,'1','47.gif',9,0,0,0,0,50,50,0,0,0,0,4,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (98,'1','48.gif',9,0,0,0,0,50,50,0,0,0,0,0,4,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (99,'1','49.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,4,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (100,'1','50.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (101,'1','51.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (102,'1','52.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (103,'1','53.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (104,'1','54.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (105,'1','55.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (106,'1','56.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (107,'1','57.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (108,'1','58.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (109,'1','59.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (110,'1','60.gif',7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (111,'1','61.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (112,'1','62.gif',8,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (113,'1','63.gif',8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (114,'1','64.gif',8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (115,'1','65.gif',8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (116,'1','66.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (117,'1','67.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (118,'1','68.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

UNLOCK TABLES;

/*Table structure for table `player_travms` */

DROP TABLE IF EXISTS `player_travms`;

CREATE TABLE `player_travms` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(2) NOT NULL DEFAULT '0',
  `point` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(60) CHARACTER SET cp1251 NOT NULL,
  `dur_min` bigint(20) NOT NULL DEFAULT '0' COMMENT 'sec',
  `dur_max` bigint(20) NOT NULL DEFAULT '0' COMMENT 'sec',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

/*Data for the table `player_travms` */

LOCK TABLES `player_travms` WRITE;

insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (1,0,3,0,'Наркоз',300,900);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (2,1,1,1,'легкий ушиб уха',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (3,1,1,1,'ушиб носа',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (4,1,1,1,'рассеченая бровь',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (5,1,1,1,'разбитая губа',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (6,1,1,2,'поцарапанная грудь',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (7,1,1,2,'вывих плеча',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (8,1,1,2,'вывих ключицы',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (9,1,1,2,'ушиб локтя',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (10,1,1,3,'вывих бедра',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (11,1,1,3,'оцарапнный зад',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (12,1,1,3,'множественные царапины на ягодицах',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (13,1,1,3,'вывих гениталий',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (14,1,1,4,'растяжение сухожилий',3600,28800);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (15,1,2,1,'перелом носа',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (16,1,2,1,'разбитый нос',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (17,1,2,1,'рассеченая бровь',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (18,1,2,1,'выбитый зуб',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (19,1,2,2,'перелом левой руки',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (20,1,2,2,'сломаное ребро',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (21,1,2,2,'отбитые почки',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (22,1,2,2,'перелом левой руки',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (23,1,2,2,'перелом ключицы',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (24,1,2,3,'перелом половых органов',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (25,1,2,3,'треснутое бедро',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (26,1,2,3,'трещина в тазовом суставе',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (27,1,2,3,'сдвиг копчика',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (28,1,2,4,'перелом правой ноги',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (29,1,2,4,'разрыв сухожилий',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (30,1,2,4,'трещина коленной чашечки',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (31,1,2,4,'перелом левой ноги',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (32,1,2,4,'перелом голени',28800,57600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (33,1,3,1,'сотрясение мозга',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (34,1,3,1,'раздробленный нос',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (35,1,3,1,'проломленный череп',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (36,1,3,1,'открытый перелом челюсти',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (37,1,3,1,'выбитый глаз',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (38,1,3,1,'внутренне кровотечение в мозг',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (39,1,3,2,'перелом грудной клетки',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (40,1,3,2,'открытй перелом руки',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (41,1,3,2,'разрыв селезенки',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (42,1,3,2,'разрыв грудных мышц',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (43,1,3,2,'множественные переломы ребер',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (44,1,3,3,'раздробленный тазовый сустав',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (45,1,3,3,'оторванные гениталии',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (46,1,3,3,'открытый перелом копчика',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (47,1,3,3,'раздробленный тазовый сустав',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (48,1,3,4,'открытый перелом левой ноги',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (49,1,3,4,'множественные открытые переломы ноги',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (50,1,3,4,'трещена в берцовой кости',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (51,1,3,4,'открытый перелом стопы',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (52,1,3,4,'раздробленная коленная чашечка',57600,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (53,2,1,0,'',43200,43200);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (54,2,2,0,'',86400,86400);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (55,2,3,0,'',129600,129600);
insert  into `player_travms`(`id`,`type`,`power`,`point`,`name`,`dur_min`,`dur_max`) values (100,0,0,0,'Ослабление после боя',300,300);

UNLOCK TABLES;

/*Table structure for table `podval` */

DROP TABLE IF EXISTS `podval`;

CREATE TABLE `podval` (
  `number` varchar(40) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varbinary(40) NOT NULL DEFAULT '                                        '
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `podval` */

LOCK TABLES `podval` WRITE;

UNLOCK TABLES;

/*Table structure for table `protocol` */

DROP TABLE IF EXISTS `protocol`;

CREATE TABLE `protocol` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `templier` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `reason` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `time` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `protocol` */

LOCK TABLES `protocol` WRITE;

UNLOCK TABLES;

/*Table structure for table `protocol_adm` */

DROP TABLE IF EXISTS `protocol_adm`;

CREATE TABLE `protocol_adm` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `login` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `target` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `msg` longtext CHARACTER SET cp1251,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `protocol_adm` */

LOCK TABLES `protocol_adm` WRITE;

UNLOCK TABLES;

/*Table structure for table `res` */

DROP TABLE IF EXISTS `res`;

CREATE TABLE `res` (
  `locate` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `resource` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `time` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `res` */

LOCK TABLES `res` WRITE;

UNLOCK TABLES;

/*Table structure for table `riba` */

DROP TABLE IF EXISTS `riba`;

CREATE TABLE `riba` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `price` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mass` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mountown` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

/*Data for the table `riba` */

LOCK TABLES `riba` WRITE;

UNLOCK TABLES;

/*Table structure for table `river` */

DROP TABLE IF EXISTS `river`;

CREATE TABLE `river` (
  `login` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `time` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `resource` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `river` */

LOCK TABLES `river` WRITE;

insert  into `river`(`login`,`time`,`resource`) values ('Мироздатель','','riba');

UNLOCK TABLES;

/*Table structure for table `sapojn` */

DROP TABLE IF EXISTS `sapojn`;

CREATE TABLE `sapojn` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `money` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `num` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0',
  `zarplata` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '0.2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `sapojn` */

LOCK TABLES `sapojn` WRITE;

UNLOCK TABLES;

/*Table structure for table `server_cities` */

DROP TABLE IF EXISTS `server_cities`;

CREATE TABLE `server_cities` (
  `city` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `name` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`city`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `server_cities` */

LOCK TABLES `server_cities` WRITE;

insert  into `server_cities`(`city`,`name`,`flag`) values ('cap','Capital city',1);
insert  into `server_cities`(`city`,`name`,`flag`) values ('ang','Angels city',16);
insert  into `server_cities`(`city`,`name`,`flag`) values ('dem','Demons city',32);
insert  into `server_cities`(`city`,`name`,`flag`) values ('dev','Devils city',64);
insert  into `server_cities`(`city`,`name`,`flag`) values ('sun','Suncity',128);
insert  into `server_cities`(`city`,`name`,`flag`) values ('em','Emeralds city',256);
insert  into `server_cities`(`city`,`name`,`flag`) values ('sand','Sandcity',512);
insert  into `server_cities`(`city`,`name`,`flag`) values ('moon','Mooncity',1024);
insert  into `server_cities`(`city`,`name`,`flag`) values ('nc','New Capital city',2048);
insert  into `server_cities`(`city`,`name`,`flag`) values ('ap','Abandoned Plains',4096);
insert  into `server_cities`(`city`,`name`,`flag`) values ('drm','Dreams city',2);
insert  into `server_cities`(`city`,`name`,`flag`) values ('low','Low city',4);
insert  into `server_cities`(`city`,`name`,`flag`) values ('old','Old city',8);

UNLOCK TABLES;

/*Table structure for table `server_commands` */

DROP TABLE IF EXISTS `server_commands`;

CREATE TABLE `server_commands` (
  `name` varchar(32) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `security` int(2) NOT NULL DEFAULT '0',
  `help` longtext CHARACTER SET cp1251 NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `server_commands` */

LOCK TABLES `server_commands` WRITE;

insert  into `server_commands`(`name`,`security`,`help`) values ('/afk',0,'');
insert  into `server_commands`(`name`,`security`,`help`) values ('/dnd',0,'');
insert  into `server_commands`(`name`,`security`,`help`) values ('/e',0,'');

UNLOCK TABLES;

/*Table structure for table `server_errors` */

DROP TABLE IF EXISTS `server_errors`;

CREATE TABLE `server_errors` (
  `id` int(11) unsigned NOT NULL,
  `text` text CHARACTER SET cp1251 NOT NULL,
  `bold` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `hyphen` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `server_errors` */

LOCK TABLES `server_errors` WRITE;

insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (100,'Вы отбываете тюремное заключение! Вы не можете покинуть здание тюрьмы.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (101,'Вы не можете попасть в эту комнату, уровень маловат ;)',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (102,'Вы не можете перемещаться через стены.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (103,'Вы не можете передвигаться! Масса всех вещей [%1$s] превышает допустимую норму [%2$s].',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (104,'Вход разрешен только %1$s',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (105,'Вы не можете пользоваться здесь чем-либо кроме почты.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (106,'Адресат не существует.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (107,'У вас недостаточно средств!',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (108,'Екровые вещи нельзя отправить по почте.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (110,'Вы не можете так быстро бегать по комнатам',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (111,'Вы сможете сменить образ через %1$s',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (112,'Предмет не найден на почте.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (113,'Исчерпан лимит передач.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (114,'Действие не доступно.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (201,'Заклинание удачно использовано.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (202,'У вас не достаточно параметров для использования этого заклинания.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (203,'Персонаж <b>\"%1$s\"</b> не найден',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (204,'Персонаж <b>\"%1$s\"</b> не травмирован.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (205,'Вы не можете использовать это заклинание на себя.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (206,'Персонаж <b>\"%1$s\"</b> сейчас оффлайн.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (207,'Персонаж <b>\"%1$s\"</b> находится в другой комнате.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (208,'Персонаж <b>\"%1$s\"</b> находится в бою.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (209,'Персонаж <b>\"%1$s\"</b> слишком ослаблен.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (210,'Нападение на персонажей 0-го уровня запрещено Мироздателем.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (211,'Использование этого заклинания на персонажа <b>\"%1$s\"</b> запрещено.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (212,'Вам не удалось использовать это заклинание.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (213,'Предмет не найден в вашем рюкзаке.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (214,'Предмет не надет на вас.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (216,'У предмета нет доступных увеличений.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (217,'Предмет требуется снять.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (218,'Зачем вам самому себе что-либо передавать?',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (219,'Неизвестное увеличение.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (220,'Увеличение параметра <b>\"%1$s\"</b> у предмета <b>\"%2$s\"</b> произведено удачно.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (300,'Пароли не совпадают!',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (301,'Вы не ввели пароль.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (302,'Неверный пароль!',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (303,'Счет не существует!',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (304,'У вас нет при себе <b>%1$s кр.</b>',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (305,'У вас нет <b>%1$s кр.</b> на счету',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (306,'Эта услуга доступна только персонажам, достигшим 8-го уровня.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (307,'Нельзя передавать кредиты самому себе.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (308,'Вы обменяли <b>%1$s екр.</b> со счета <b>#%2$s</b>. Вам зачисленно <b>%3$s кр.</b>',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (309,'Нельзя передать сумму менее 1 кр.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (310,'У вас нет <b>%1$s екр.</b> на счету',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (311,'Пароль изменен. На всякий случай, рекомендуем выйти из банка и войти снова для проверки нового пароля. Убедитесь, что функция высылки пароля на email включена ;)',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (312,'Пароль не был изменен.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (313,'Сохранили записную книжку.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (314,'Записная книжка не сохранена.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (315,'Вы не ввели новый пароль.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (316,'Новый пароль нужно ввести дважды.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (317,'Второй раз пароль нужно ввести, чтобы избежать возможных опечаток. Вы ошиблись при повторном вводе нового пароля. Будьте внимательнее!',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (318,'Вы открыли счет <b>#%1$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (319,'Вы положили <b>%1$s кр.</b> на счет <b>#%2$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (320,'Вы сняли <b>%1$s кр.</b> со счета <b>#%2$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (321,'Вы перевели <b>%1$s кр.</b> к <b>%2$s</b> на счет <b>#%3$s</b> со счета <b>#%4$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (322,'Счет пренадлежит не вам.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (323,'Для открытия счета необходимо иметь при себе <b>%1$s кр.</b>',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (324,'Пароль нужно ввести дважды.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (325,'Укажите сумму',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (326,'Укажите сумму и номер счета',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (327,'Укажите обмениваемую сумму',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (400,'Вы купили предмет <b>\"%1$s\"</b>x<b>%3$s</b> за <b>%2$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (401,'Вы купили предмет <b>\"%1$s\"</b>x<b>%3$s</b> за <b>%2$s екр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (403,'Вещь не найдена в магазине',1,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (404,'Вы продали предмет <b>\"%1$s\"</b> за <b>%2$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (115,'У вас травма вы не можете перемещаться.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (406,'Вы отправили предмет <b>\"%1$s\"</b> за <b>%2$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (407,'Вы забрали \"%1$s\"',1,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (408,'Вы отправили обратно \"%1$s\"',1,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (409,'Вы отправили <b>%1$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (410,'Минимальная сумма перевода: %1$s кр.',1,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (500,'\"Новый пароль нужно написать дважды (чтобы избежать возможных опечаток)\"',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (501,'Прежний пароль указан неверно',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (502,'Вы ошиблись при написании пароля. Будьте внимательнее!',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (503,'Длина пароля не может быть меньше 6 символов или более 30 символов',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (504,'Новый пароль записан',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (505,'Должно пройти не менее трех суток между сменой подтверждения, пароля или email',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (506,'Новый пароль должен состоять только из букв русского и английского алфавита, а также из цифр!',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (507,'Укажите пароль к персонажу',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (508,'Укажите прежний email',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (509,'Укажите новый email',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (510,'Неверно указан старый e-mail',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (511,'Неправильный формат e-mail',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (512,'Новый e-mail записан',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (0,'',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (221,'Не найден такой комплект',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (215,'Вы не можете выбрать данный образ.',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (222,'Не удалось запомнить комплект \"%1$s\"',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (200,'&nbsp; &nbsp;Увеличение способностей невозможно',1,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (513,'Укажите секретный вопрос',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (109,'Проход сюда только до <b>%1$s-го</b> уровня.',0,1);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (1,'%1$s',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (514,'Новый секретный вопрос / ответ записан',0,0);
insert  into `server_errors`(`id`,`text`,`bold`,`hyphen`) values (515,'Должно пройти не менее трех суток между сменой подтверждения, пароля или email\r\n',0,0);

UNLOCK TABLES;

/*Table structure for table `server_images` */

DROP TABLE IF EXISTS `server_images`;

CREATE TABLE `server_images` (
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL,
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `default` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `low_level` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `level` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `server_images` */

LOCK TABLES `server_images` WRITE;

insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_amulet',60,20,'wamulet.gif','amulet0001.gif',4);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_earring',60,20,'wearring.gif','clips0001.gif',4);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_armor',60,80,'warmor.gif',NULL,0);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_pants',60,80,'wpants.gif',NULL,0);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_belt',60,40,'wbelt.gif','belt0001.gif',3);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_bracer',60,40,'wbracer.gif','arms0001.gif',2);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_gloves',60,40,'wgloves.gif','hands0001.gif',2);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_boots',60,40,'wboots.gif','boots0001.gif',3);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_ring',20,20,'wring.gif','ring0001.gif',4);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_animal',90,60,NULL,NULL,0);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_hand_r',60,60,'whand_r.gif','weapon0001.gif',1);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_acsess',60,60,NULL,NULL,0);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_hand_l',60,60,'whand_l.gif','shield0001.gif',1);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_hand_l_f',60,60,'whand_l.gif','shield0001.gif',1);
insert  into `server_images`(`name`,`width`,`height`,`default`,`low_level`,`level`) values ('item_helmet',60,60,'whelmet.gif','head0001.gif',3);

UNLOCK TABLES;

/*Table structure for table `server_info` */

DROP TABLE IF EXISTS `server_info`;

CREATE TABLE `server_info` (
  `login` tinyint(3) unsigned NOT NULL,
  `registration` tinyint(3) unsigned NOT NULL,
  `reminder` tinyint(3) unsigned NOT NULL,
  `language` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `last_transfer` bigint(20) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `server_info` */

LOCK TABLES `server_info` WRITE;

insert  into `server_info`(`login`,`registration`,`reminder`,`language`,`last_transfer`) values (1,1,1,'ru',1422044099);

UNLOCK TABLES;

/*Table structure for table `server_language` */

DROP TABLE IF EXISTS `server_language`;

CREATE TABLE `server_language` (
  `key` varchar(32) CHARACTER SET cp1251 NOT NULL,
  `ru` text CHARACTER SET cp1251 NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `server_language` */

LOCK TABLES `server_language` WRITE;

insert  into `server_language`(`key`,`ru`) values ('str','Сила:');
insert  into `server_language`(`key`,`ru`) values ('dex','Ловкость:');
insert  into `server_language`(`key`,`ru`) values ('con','Интуиция:');
insert  into `server_language`(`key`,`ru`) values ('vit','Выносливость:');
insert  into `server_language`(`key`,`ru`) values ('int','Интеллект:');
insert  into `server_language`(`key`,`ru`) values ('wis','Мудрость:');
insert  into `server_language`(`key`,`ru`) values ('spi','Духовность:');
insert  into `server_language`(`key`,`ru`) values ('level','Уровень:');
insert  into `server_language`(`key`,`ru`) values ('mp_all','Мана');
insert  into `server_language`(`key`,`ru`) values ('sex','Пол:');
insert  into `server_language`(`key`,`ru`) values ('sex_0','Мужской');
insert  into `server_language`(`key`,`ru`) values ('sex_1','Женский');
insert  into `server_language`(`key`,`ru`) values ('sword','Мастерство владения мечами:');
insert  into `server_language`(`key`,`ru`) values ('axe','Мастерство владения топорами, секирами:');
insert  into `server_language`(`key`,`ru`) values ('fail','Мастерство владения дубинами, булавами:');
insert  into `server_language`(`key`,`ru`) values ('knife','Мастерство владения ножами, кастетами:');
insert  into `server_language`(`key`,`ru`) values ('staff','Мастерство владения магическими посохами:');
insert  into `server_language`(`key`,`ru`) values ('fire','Мастерство владения стихией Огня:');
insert  into `server_language`(`key`,`ru`) values ('water','Мастерство владения стихией Воды:');
insert  into `server_language`(`key`,`ru`) values ('air','Мастерство владения стихией Воздуха:');
insert  into `server_language`(`key`,`ru`) values ('earth','Мастерство владения стихией Земли:');
insert  into `server_language`(`key`,`ru`) values ('light','Мастерство владения магией Света:');
insert  into `server_language`(`key`,`ru`) values ('gray','Мастерство владения серой магией:');
insert  into `server_language`(`key`,`ru`) values ('dark','Мастерство владения магией Тьмы:');
insert  into `server_language`(`key`,`ru`) values ('mf_critp','Мф. мощности крит. удара (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_acrit','Мф. против критического удара (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_adodge','Мф. против увертывания (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_parmour','Мф. удара сквозь броню (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_crit','Мф. критического удара (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_parry','Мф. парирования (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_shieldb','Мф. блока щитом (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_dodge','Мф. увертывания (%):');
insert  into `server_language`(`key`,`ru`) values ('mf_contr','Мф. контрудара (%):');
insert  into `server_language`(`key`,`ru`) values ('rep_magic','Подавление защиты от магии:');
insert  into `server_language`(`key`,`ru`) values ('rep_fire','Подавление защиты от магии Огня:');
insert  into `server_language`(`key`,`ru`) values ('rep_water','Подавление защиты от магии Воды:');
insert  into `server_language`(`key`,`ru`) values ('rep_air','Подавление защиты от магии Воздуха:');
insert  into `server_language`(`key`,`ru`) values ('rep_earth','Подавление защиты от магии Земли:');
insert  into `server_language`(`key`,`ru`) values ('mf_magic','Мф. мощности магии стихий:');
insert  into `server_language`(`key`,`ru`) values ('mf_fire','Мф. мощности магии Огня:');
insert  into `server_language`(`key`,`ru`) values ('mf_water','Мф. мощности магии Воды:');
insert  into `server_language`(`key`,`ru`) values ('mf_air','Мф. мощности магии Воздуха:');
insert  into `server_language`(`key`,`ru`) values ('mf_earth','Мф. мощности магии Земли:');
insert  into `server_language`(`key`,`ru`) values ('mf_dmg','Мф. мощности урона:');
insert  into `server_language`(`key`,`ru`) values ('mf_sting','Мф. мощности колющего урона:');
insert  into `server_language`(`key`,`ru`) values ('mf_slash','Мф. мощности рубящего урона:');
insert  into `server_language`(`key`,`ru`) values ('mf_crush','Мф. мощности дробящего урона:');
insert  into `server_language`(`key`,`ru`) values ('mf_sharp','Мф. мощности режущего урона:');
insert  into `server_language`(`key`,`ru`) values ('all_magic','Мастерство владения магией стихий:');
insert  into `server_language`(`key`,`ru`) values ('all_mastery','Мастерство владения оружием:');
insert  into `server_language`(`key`,`ru`) values ('res_magic','Защита от магии:');
insert  into `server_language`(`key`,`ru`) values ('res_fire','Защита от магии огня:');
insert  into `server_language`(`key`,`ru`) values ('res_water','Защита от магии воды:');
insert  into `server_language`(`key`,`ru`) values ('res_air','Защита от магии воздуха:');
insert  into `server_language`(`key`,`ru`) values ('res_earth','Защита от магии земли:');
insert  into `server_language`(`key`,`ru`) values ('res_light','Защита от магии Света:');
insert  into `server_language`(`key`,`ru`) values ('res_gray','Защита от серой магии:');
insert  into `server_language`(`key`,`ru`) values ('res_dark','Защита от магии Тьмы:');
insert  into `server_language`(`key`,`ru`) values ('res_dmg','Защита от урона:');
insert  into `server_language`(`key`,`ru`) values ('res_sting','Защита от колющего урона:');
insert  into `server_language`(`key`,`ru`) values ('res_slash','Защита от рубящего урона:');
insert  into `server_language`(`key`,`ru`) values ('res_crush','Защита от дробящего урона:');
insert  into `server_language`(`key`,`ru`) values ('res_sharp','Защита от режущего урона:');
insert  into `server_language`(`key`,`ru`) values ('add_hp','Уровень жизни (HP):');
insert  into `server_language`(`key`,`ru`) values ('add_mp','Уровень маны (MP):');
insert  into `server_language`(`key`,`ru`) values ('mp_cons','Уменьшение расхода маны (%):');
insert  into `server_language`(`key`,`ru`) values ('mp_regen','Восстановление маны (%):');
insert  into `server_language`(`key`,`ru`) values ('hp_regen','Восстановление здоровья (%):');
insert  into `server_language`(`key`,`ru`) values ('add_hit_min','Минимальное наносимое повреждение:');
insert  into `server_language`(`key`,`ru`) values ('add_hit_max','Максимальное наносимое повреждение:');
insert  into `server_language`(`key`,`ru`) values ('ch_sting','Колющие атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_slash','Рубящие атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_crush','Дробящие атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_sharp','Режущие атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_fire','Огненные атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_water','Ледяные атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_air','Электрические атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_earth','Земляные атаки:');
insert  into `server_language`(`key`,`ru`) values ('ch_light','Атаки Светом:');
insert  into `server_language`(`key`,`ru`) values ('ch_dark','Атаки Тьмой:');
insert  into `server_language`(`key`,`ru`) values ('def_h','Броня головы:');
insert  into `server_language`(`key`,`ru`) values ('def_a','Броня корпуса:');
insert  into `server_language`(`key`,`ru`) values ('def_b','Броня пояса:');
insert  into `server_language`(`key`,`ru`) values ('def_l','Броня ног:');
insert  into `server_language`(`key`,`ru`) values ('inc_count','Количество увеличений:');
insert  into `server_language`(`key`,`ru`) values ('features','Особенности:');
insert  into `server_language`(`key`,`ru`) values ('description','Описание:');
insert  into `server_language`(`key`,`ru`) values ('never','Никогда');
insert  into `server_language`(`key`,`ru`) values ('ex_rarely','Ничтожно редки');
insert  into `server_language`(`key`,`ru`) values ('rarely','Редки');
insert  into `server_language`(`key`,`ru`) values ('little','Малы');
insert  into `server_language`(`key`,`ru`) values ('naa','Временами');
insert  into `server_language`(`key`,`ru`) values ('regular','Регулярны');
insert  into `server_language`(`key`,`ru`) values ('often','Часты');
insert  into `server_language`(`key`,`ru`) values ('always','Всегда');
insert  into `server_language`(`key`,`ru`) values ('required','Требуется минимальное:');
insert  into `server_language`(`key`,`ru`) values ('act','Действует на:');
insert  into `server_language`(`key`,`ru`) values ('price','Цена:');
insert  into `server_language`(`key`,`ru`) values ('durability','Долговечность:');
insert  into `server_language`(`key`,`ru`) values ('validity','Срок годности: до %1$s  (осталось %2$s)');
insert  into `server_language`(`key`,`ru`) values ('val_life','Срок жизни:');
insert  into `server_language`(`key`,`ru`) values ('artefact','Артефакт');
insert  into `server_language`(`key`,`ru`) values ('gift','Подарок от');
insert  into `server_language`(`key`,`ru`) values ('mass','Масса:');
insert  into `server_language`(`key`,`ru`) values ('min_bent','Требуемая склонность:');
insert  into `server_language`(`key`,`ru`) values ('blocks','Зоны блокирования:');
insert  into `server_language`(`key`,`ru`) values ('no_repair','Предмет не подлежит ремонту');
insert  into `server_language`(`key`,`ru`) values ('made_in','Сделано в');
insert  into `server_language`(`key`,`ru`) values ('sec_hand','Второе оружие');
insert  into `server_language`(`key`,`ru`) values ('two_hands','Двуручное оружие');
insert  into `server_language`(`key`,`ru`) values ('damage','Удар:');
insert  into `server_language`(`key`,`ru`) values ('behaviour','Свойства предмета:');
insert  into `server_language`(`key`,`ru`) values ('amulet_f','Пустой слот амулет');
insert  into `server_language`(`key`,`ru`) values ('earring_f','Пустой слот серьги');
insert  into `server_language`(`key`,`ru`) values ('helmet_f','Пустой слот шлем');
insert  into `server_language`(`key`,`ru`) values ('armor_f','Пустой слот броня');
insert  into `server_language`(`key`,`ru`) values ('pants_f','Пустой слот поножи');
insert  into `server_language`(`key`,`ru`) values ('belt_f','Пустой слот пояс');
insert  into `server_language`(`key`,`ru`) values ('bracer_f','Пустой слот наручи');
insert  into `server_language`(`key`,`ru`) values ('gloves_f','Пустой слот перчатки');
insert  into `server_language`(`key`,`ru`) values ('boots_f','Пустой слот обувь');
insert  into `server_language`(`key`,`ru`) values ('ring_f','Пустой слот кольцо');
insert  into `server_language`(`key`,`ru`) values ('hand_r_f','Пустой слот правая рука');
insert  into `server_language`(`key`,`ru`) values ('hand_l_f','Левая рука занята');
insert  into `server_language`(`key`,`ru`) values ('hand_l_f_f','Пустой слот щит');
insert  into `server_language`(`key`,`ru`) values ('sting_i','Колющий урон:');
insert  into `server_language`(`key`,`ru`) values ('slash_i','Рубящий урон:');
insert  into `server_language`(`key`,`ru`) values ('crush_i','Дробящий урон:');
insert  into `server_language`(`key`,`ru`) values ('sharp_i','Режущий урон:');
insert  into `server_language`(`key`,`ru`) values ('fire_i','Магия Огня:');
insert  into `server_language`(`key`,`ru`) values ('water_i','Магия Воды:');
insert  into `server_language`(`key`,`ru`) values ('air_i','Магия Воздуха:');
insert  into `server_language`(`key`,`ru`) values ('earth_i','Магия Земли:');
insert  into `server_language`(`key`,`ru`) values ('light_i','Магия Света:');
insert  into `server_language`(`key`,`ru`) values ('gray_i','Серая магия:');
insert  into `server_language`(`key`,`ru`) values ('dark_i','Магия Тьмы:');
insert  into `server_language`(`key`,`ru`) values ('sting_p','Мощность колющего урона повышает ваш урон колющими атаками');
insert  into `server_language`(`key`,`ru`) values ('slash_p','Мощность рубящего урона повышает ваш урон рубящими атаками');
insert  into `server_language`(`key`,`ru`) values ('crush_p','Мощность дробящего урона повышает ваш урон дробящими атаками');
insert  into `server_language`(`key`,`ru`) values ('sharp_p','Мощность режущего урона повышает ваш урон режущими атаками');
insert  into `server_language`(`key`,`ru`) values ('fire_p','Мощность магии Огня повышает ваш урон стихией Огня');
insert  into `server_language`(`key`,`ru`) values ('water_p','Мощность магии Воды повышает ваш урон стихией Воды');
insert  into `server_language`(`key`,`ru`) values ('air_p','Мощность магии Воздуха повышает ваш урон стихией Воздуха');
insert  into `server_language`(`key`,`ru`) values ('earth_p','Мощность магии Земли повышает ваш урон стихией Земли');
insert  into `server_language`(`key`,`ru`) values ('light_p','Мощность магии Света повышает ваш урон магией Света');
insert  into `server_language`(`key`,`ru`) values ('gray_p','Мощность серой магии повышает ваш урон серой магией');
insert  into `server_language`(`key`,`ru`) values ('dark_p','Мощность магии Тьмы повышает ваш урон магией Тьмы');
insert  into `server_language`(`key`,`ru`) values ('bar_power','Мощность:');
insert  into `server_language`(`key`,`ru`) values ('sting_d','Защита от колющего урона снижает урон нанесенный вам колющими атаками');
insert  into `server_language`(`key`,`ru`) values ('slash_d','Защита от рубящего урона снижает урон нанесенный вам рубящими атаками');
insert  into `server_language`(`key`,`ru`) values ('crush_d','Защита от дробящего урона снижает урон нанесенный вам дробящими атаками');
insert  into `server_language`(`key`,`ru`) values ('sharp_d','Защита от режущего урона снижает урон нанесенный вам режущими атаками');
insert  into `server_language`(`key`,`ru`) values ('fire_d','Защита от магии Огня снижает урон нанесенный вам стихией Огня');
insert  into `server_language`(`key`,`ru`) values ('water_d','Защита от магии Воды снижает урон нанесенный вам стихией Воды');
insert  into `server_language`(`key`,`ru`) values ('air_d','Защита от магии Воздуха снижает урон нанесенный вам стихией Воздуха');
insert  into `server_language`(`key`,`ru`) values ('earth_d','Защита от магии Земли снижает урон нанесенный вам стихией Земли');
insert  into `server_language`(`key`,`ru`) values ('light_d','Защита от магии Света снижает урон нанесенный вам магией Света');
insert  into `server_language`(`key`,`ru`) values ('gray_d','Защита от серой магии снижает урон нанесенный вам серой магией');
insert  into `server_language`(`key`,`ru`) values ('dark_d','Защита от магии Тьмы снижает урон нанесенный вам магией Тьмы');
insert  into `server_language`(`key`,`ru`) values ('bar_def','Защита:');
insert  into `server_language`(`key`,`ru`) values ('bar_btn','Кнопки:');
insert  into `server_language`(`key`,`ru`) values ('bar_mod','Модификаторы:');
insert  into `server_language`(`key`,`ru`) values ('mf_crit_i','Мф. крит. удара:');
insert  into `server_language`(`key`,`ru`) values ('mf_critp_i','Мф. мощности крит. удара:');
insert  into `server_language`(`key`,`ru`) values ('mf_acrit_i','Мф. против крит. удара:');
insert  into `server_language`(`key`,`ru`) values ('mf_crit_m','Мф. крит. удара позволяет нанести критический удар, наносящий дополнительные повреждения даже сквозь блок.');
insert  into `server_language`(`key`,`ru`) values ('mf_critp_m','Мф. мощности крит. удара показывает, на сколько % критический удар будет сильнее, чем обычно.');
insert  into `server_language`(`key`,`ru`) values ('mf_acrit_m','Мф. против крит. удара снижает вероятность получения крит. удара');
insert  into `server_language`(`key`,`ru`) values ('mf_dodge_m','Мф. увертывания позволяет вам уклониться от атаки противника, полностью игнорируя ее.');
insert  into `server_language`(`key`,`ru`) values ('mf_adodge_m','Мф. против увертывания снижает шансы противника уклониться от вашей атаки');
insert  into `server_language`(`key`,`ru`) values ('mf_contr_m','Мф. контрудара позволяет нанести дополнительный удар по противнику, после того как вы уклонились от его атаки');
insert  into `server_language`(`key`,`ru`) values ('mf_parry_m','Мф. парирования позволяет \"угадать\" зону удара противника. Итоговый шанс парирования в бою равен разнице вашего мф. парирования и половины мф. парирования противника');
insert  into `server_language`(`key`,`ru`) values ('mf_shieldb_m','Мф. блока щитом позволяет \"угадать\" зону удара противника. Этот модификатор абсолютен.');
insert  into `server_language`(`key`,`ru`) values ('mastery_m','Мастерство владения текущим оружием в момент нанесения удара');
insert  into `server_language`(`key`,`ru`) values ('mastery','Мастерство:');
insert  into `server_language`(`key`,`ru`) values ('mf_dodge_i','Мф. увертывания:');
insert  into `server_language`(`key`,`ru`) values ('mf_adodge_i','Мф. против увертывания:');
insert  into `server_language`(`key`,`ru`) values ('mf_contr_i','Мф. контрудара:');
insert  into `server_language`(`key`,`ru`) values ('mf_parry_i','Мф. парирования:');
insert  into `server_language`(`key`,`ru`) values ('mf_shieldb_i','Мф. блока щитом:');
insert  into `server_language`(`key`,`ru`) values ('bar_stat','Характеристики:');
insert  into `server_language`(`key`,`ru`) values ('ups','Способности');
insert  into `server_language`(`key`,`ru`) values ('skills','Обучение');
insert  into `server_language`(`key`,`ru`) values ('unwear_all','Снять всё');
insert  into `server_language`(`key`,`ru`) values ('min_stat','Мин. характеристики:');
insert  into `server_language`(`key`,`ru`) values ('select_shape','Выбрать этот образ');
insert  into `server_language`(`key`,`ru`) values ('magic','Магия:');
insert  into `server_language`(`key`,`ru`) values ('weapon','Оружие:');
insert  into `server_language`(`key`,`ru`) values ('bar_set','Комплекты:');
insert  into `server_language`(`key`,`ru`) values ('NULL','');
insert  into `server_language`(`key`,`ru`) values ('shop_weapon','Оружие: ');
insert  into `server_language`(`key`,`ru`) values ('shop_dress','Одежда: ');
insert  into `server_language`(`key`,`ru`) values ('shop_jewel','Ювелирные товары: ');
insert  into `server_language`(`key`,`ru`) values ('whitespace','&nbsp;&nbsp;&nbsp;&nbsp;');
insert  into `server_language`(`key`,`ru`) values ('shop_sell','Скупка');
insert  into `server_language`(`key`,`ru`) values ('shop_knife','кастеты,ножи');
insert  into `server_language`(`key`,`ru`) values ('shop_axe','топоры');
insert  into `server_language`(`key`,`ru`) values ('shop_fail','дубины,булавы');
insert  into `server_language`(`key`,`ru`) values ('shop_sword','мечи');
insert  into `server_language`(`key`,`ru`) values ('shop_staff','магические посохи');
insert  into `server_language`(`key`,`ru`) values ('shop_boots','сапоги');
insert  into `server_language`(`key`,`ru`) values ('shop_shirt','рубахи');
insert  into `server_language`(`key`,`ru`) values ('shop_gloves','перчатки');
insert  into `server_language`(`key`,`ru`) values ('shop_light_armor','легкая броня');
insert  into `server_language`(`key`,`ru`) values ('shop_heavy_armor','тяжелая броня');
insert  into `server_language`(`key`,`ru`) values ('shop_helmet','шлемы');
insert  into `server_language`(`key`,`ru`) values ('shop_bracer','наручи');
insert  into `server_language`(`key`,`ru`) values ('shop_belt','пояса');
insert  into `server_language`(`key`,`ru`) values ('shop_pants','поножи');
insert  into `server_language`(`key`,`ru`) values ('shop_shield','Щиты');
insert  into `server_language`(`key`,`ru`) values ('shop_earring','серьги');
insert  into `server_language`(`key`,`ru`) values ('shop_amulet','ожерелья');
insert  into `server_language`(`key`,`ru`) values ('shop_ring','кольца');
insert  into `server_language`(`key`,`ru`) values ('shop_scroll','Заклинания');
insert  into `server_language`(`key`,`ru`) values ('style_warrior','Воин');
insert  into `server_language`(`key`,`ru`) values ('style_mage','Маг');
insert  into `server_language`(`key`,`ru`) values ('style_barbarian','Варвар');
insert  into `server_language`(`key`,`ru`) values ('style_rogue','Разбойник');
insert  into `server_language`(`key`,`ru`) values ('bank_1','Вы открыли счет');
insert  into `server_language`(`key`,`ru`) values ('bank_2','Вы положили на счет <b>%2$s кр.</b>');
insert  into `server_language`(`key`,`ru`) values ('bank_3','Вы сняли со счета <b>%2$s кр.</b>');
insert  into `server_language`(`key`,`ru`) values ('bank_4','Вы перевели со счета <b>%2$s кр.</b> на счет <b>#%1$s</b>');
insert  into `server_language`(`key`,`ru`) values ('bank_5','Вам перевели <b>%2$s кр.</b> со счета <b>#$h_credit2</b>');
insert  into `server_language`(`key`,`ru`) values ('bank_6','Вы обменяли со счета <b>%3$s екр.</b> Вам зачисленно <b>%2$s кр.</b>');
insert  into `server_language`(`key`,`ru`) values ('mail_items',' . Передать предметы ');
insert  into `server_language`(`key`,`ru`) values ('mail_money',' . Кредиты и Телеграф ');
insert  into `server_language`(`key`,`ru`) values ('mail_report',' . Отчет ');
insert  into `server_language`(`key`,`ru`) values ('mail_get_mail',' . Получить вещи ');
insert  into `server_language`(`key`,`ru`) values ('wins','Побед:');
insert  into `server_language`(`key`,`ru`) values ('loses','Поражений:');
insert  into `server_language`(`key`,`ru`) values ('draws','Ничьих:');
insert  into `server_language`(`key`,`ru`) values ('crossbow','Мастерство владения арбалетом:');
insert  into `server_language`(`key`,`ru`) values ('bow','Мастерство владения луком:');
insert  into `server_language`(`key`,`ru`) values ('style','Стиль боя:');
insert  into `server_language`(`key`,`ru`) values ('money','Деньги:');
insert  into `server_language`(`key`,`ru`) values ('exp','Опыт:');
insert  into `server_language`(`key`,`ru`) values ('clan','Клан:');
insert  into `server_language`(`key`,`ru`) values ('status','Статус:');
insert  into `server_language`(`key`,`ru`) values ('games','Бои:');
insert  into `server_language`(`key`,`ru`) values ('bank','Банк:');
insert  into `server_language`(`key`,`ru`) values ('sort_by','Выровнять по');
insert  into `server_language`(`key`,`ru`) values ('sort_name','названию');
insert  into `server_language`(`key`,`ru`) values ('sort_price','цене');
insert  into `server_language`(`key`,`ru`) values ('sort_type','типу');
insert  into `server_language`(`key`,`ru`) values ('drop_trash','Выбросить хлам');
insert  into `server_language`(`key`,`ru`) values ('back_pack','Рюкзак:');
insert  into `server_language`(`key`,`ru`) values ('count_items','предметов:');
insert  into `server_language`(`key`,`ru`) values ('empty','ПУСТО');
insert  into `server_language`(`key`,`ru`) values ('sec_item','Обмундирование');
insert  into `server_language`(`key`,`ru`) values ('sec_thing','Заклятия');
insert  into `server_language`(`key`,`ru`) values ('sec_elix','Эликсиры');
insert  into `server_language`(`key`,`ru`) values ('sec_other','Прочее');
insert  into `server_language`(`key`,`ru`) values ('return','Вернуться');
insert  into `server_language`(`key`,`ru`) values ('hint','Подсказка');
insert  into `server_language`(`key`,`ru`) values ('security','Безопасность');
insert  into `server_language`(`key`,`ru`) values ('form','Анкета');
insert  into `server_language`(`key`,`ru`) values ('abilities','Умения');
insert  into `server_language`(`key`,`ru`) values ('shape','Образ');
insert  into `server_language`(`key`,`ru`) values ('shape_choose','Выбрать образ персонажа');
insert  into `server_language`(`key`,`ru`) values ('change_pass_mail','Сменить пароль/email');
insert  into `server_language`(`key`,`ru`) values ('orden_pal','Паладинский орден');
insert  into `server_language`(`key`,`ru`) values ('orden_dark','Армада');
insert  into `server_language`(`key`,`ru`) values ('credit_exit','Закончить работу со счётом');
insert  into `server_language`(`key`,`ru`) values ('credit_choose','выбрать счёт');
insert  into `server_language`(`key`,`ru`) values ('shut_desc','На персонажа наложено заклятие молчания. Будет молчать еще');
insert  into `server_language`(`key`,`ru`) values ('set_delete','Удалить комплект');
insert  into `server_language`(`key`,`ru`) values ('equip','Надеть');
insert  into `server_language`(`key`,`ru`) values ('shop_empty','Прилавок магазина пустой');
insert  into `server_language`(`key`,`ru`) values ('shop_no','Это место не является магазином');
insert  into `server_language`(`key`,`ru`) values ('mf_dark','Мф. мощности магии Тьмы:');
insert  into `server_language`(`key`,`ru`) values ('mf_light','Мф. мощности магии Света:');
insert  into `server_language`(`key`,`ru`) values ('mf_gray','Мф. мощности серой магии:');
insert  into `server_language`(`key`,`ru`) values ('style_warrior_d','Сила: +10, Выносливость: +10');
insert  into `server_language`(`key`,`ru`) values ('status_private','Рядовой');
insert  into `server_language`(`key`,`ru`) values ('status_corporal','Капрал');
insert  into `server_language`(`key`,`ru`) values ('status_sergeant','Сержант');
insert  into `server_language`(`key`,`ru`) values ('status_m_sergeant','Старший сержант');
insert  into `server_language`(`key`,`ru`) values ('status_s_major','Старшина');
insert  into `server_language`(`key`,`ru`) values ('status_knight','Рыцарь');
insert  into `server_language`(`key`,`ru`) values ('status_k_lieutenant','Рыцарь-лейтенант');
insert  into `server_language`(`key`,`ru`) values ('status_k_captain','Рыцарь-капитан');
insert  into `server_language`(`key`,`ru`) values ('status_k_champion','Рыцарь-защитник');
insert  into `server_language`(`key`,`ru`) values ('status_l_commander','Лейтенант-командор');
insert  into `server_language`(`key`,`ru`) values ('status_commander','Командор');
insert  into `server_language`(`key`,`ru`) values ('status_marshal','Маршал');
insert  into `server_language`(`key`,`ru`) values ('status_f_marshal','Фельдмаршал');
insert  into `server_language`(`key`,`ru`) values ('status_g_marshal','Главнокомандующий');
insert  into `server_language`(`key`,`ru`) values ('status_god','Бог');
insert  into `server_language`(`key`,`ru`) values ('status_admin','Администратор');
insert  into `server_language`(`key`,`ru`) values ('status_novice','Новичок');
insert  into `server_language`(`key`,`ru`) values ('style_mage_d','Интеллект: +10, Мудрость: +10');
insert  into `server_language`(`key`,`ru`) values ('style_rogue_d','Ловкость: +15, Интуиция: +5');
insert  into `server_language`(`key`,`ru`) values ('style_barbarian_d','Интуиция: +15, Выносливость: +5');
insert  into `server_language`(`key`,`ru`) values ('refresh','Обновить');
insert  into `server_language`(`key`,`ru`) values ('forum','Форум');
insert  into `server_language`(`key`,`ru`) values ('return_b','Возврат');
insert  into `server_language`(`key`,`ru`) values ('map','Карта клуба');
insert  into `server_language`(`key`,`ru`) values ('fights','Поединки');
insert  into `server_language`(`key`,`ru`) values ('amulet_l','Слот ожерелья открывается на 4-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('earring_l','Слот серег открывается на 4-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('helmet_l','Слот шлема открывается на 3-ем уровне.');
insert  into `server_language`(`key`,`ru`) values ('belt_l','Слот пояса открывается на 3-ем уровне.');
insert  into `server_language`(`key`,`ru`) values ('bracer_l','Слот наручей открывается на 2-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('gloves_l','Слот перчаток открывается на 2-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('boots_l','Слот обуви открывается на 3-ем уровне.');
insert  into `server_language`(`key`,`ru`) values ('ring_l','Слот кольца открывается на 4-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('hand_r_l','Слот основной руки открывается на 1-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('hand_l_l','Слот второй руки открывается на 1-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('hand_l_f_l','Слот второй руки открывается на 1-ом уровне.');
insert  into `server_language`(`key`,`ru`) values ('travm_p_1','Легкая травма');
insert  into `server_language`(`key`,`ru`) values ('travm_p_2','Средняя травма');
insert  into `server_language`(`key`,`ru`) values ('travm_p_3','Тяжелая травма');

UNLOCK TABLES;

/*Table structure for table `team1` */

DROP TABLE IF EXISTS `team1`;

CREATE TABLE `team1` (
  `player` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hitted` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `over` varchar(5) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `player` (`player`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `team1` */

LOCK TABLES `team1` WRITE;

UNLOCK TABLES;

/*Table structure for table `team1_history` */

DROP TABLE IF EXISTS `team1_history`;

CREATE TABLE `team1_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `player` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `hitted` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`),
  KEY `id_5` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

/*Data for the table `team1_history` */

LOCK TABLES `team1_history` WRITE;

UNLOCK TABLES;

/*Table structure for table `team2` */

DROP TABLE IF EXISTS `team2`;

CREATE TABLE `team2` (
  `player` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hitted` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `over` varchar(5) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `player` (`player`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `team2` */

LOCK TABLES `team2` WRITE;

UNLOCK TABLES;

/*Table structure for table `team2_history` */

DROP TABLE IF EXISTS `team2_history`;

CREATE TABLE `team2_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `player` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `ip` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `hitted` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`),
  KEY `id_5` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

/*Data for the table `team2_history` */

LOCK TABLES `team2_history` WRITE;

UNLOCK TABLES;

/*Table structure for table `thing_book` */

DROP TABLE IF EXISTS `thing_book`;

CREATE TABLE `thing_book` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `img` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `mass` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `price` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `min_intellekt` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `min_vospriyatie` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `min_level` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `add_intellekt` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `add_mana` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `iznos_min` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `iznos_max` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `type` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `mountown` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `orden` varchar(30) CHARACTER SET cp1251 DEFAULT NULL,
  `add_water` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_earth` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_fire` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `add_air` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `pages` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `desc` text CHARACTER SET cp1251 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `thing_book` */

LOCK TABLES `thing_book` WRITE;

UNLOCK TABLES;

/*Table structure for table `thing_scroll` */

DROP TABLE IF EXISTS `thing_scroll`;

CREATE TABLE `thing_scroll` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `img` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `mass` int(4) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `veroyat` char(3) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_vospriyatie` int(2) DEFAULT NULL,
  `min_intellekt` int(2) DEFAULT NULL,
  `min_level` int(2) DEFAULT NULL,
  `iznos_min` int(3) DEFAULT NULL,
  `iznos_max` int(3) DEFAULT NULL,
  `mana` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `file` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `orden` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `mountown` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_sila2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_arm_l` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_arm_m` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_arm_h` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_water` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_air` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_earth` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_cast` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_trade` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_cure` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `add_walk` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_lovkost2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_udacha2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_power2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_intellekt2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_vospriyatie2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `min_level2` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `school` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `thing_scroll` */

LOCK TABLES `thing_scroll` WRITE;

UNLOCK TABLES;

/*Table structure for table `thread` */

DROP TABLE IF EXISTS `thread`;

CREATE TABLE `thread` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `topic` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `thr` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `topic_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `clan` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `clan_s` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `orden` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `level` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `last_post` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `thread` */

LOCK TABLES `thread` WRITE;

UNLOCK TABLES;

/*Table structure for table `timeout` */

DROP TABLE IF EXISTS `timeout`;

CREATE TABLE `timeout` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lasthit` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `creator` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle_id` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

/*Data for the table `timeout` */

LOCK TABLES `timeout` WRITE;

UNLOCK TABLES;

/*Table structure for table `wood` */

DROP TABLE IF EXISTS `wood`;

CREATE TABLE `wood` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `img` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `price` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mass` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `mountown` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `wood` */

LOCK TABLES `wood` WRITE;

UNLOCK TABLES;

/*Table structure for table `zayavka` */

DROP TABLE IF EXISTS `zayavka`;

CREATE TABLE `zayavka` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `date` varchar(5) CHARACTER SET cp1251 DEFAULT NULL,
  `timeout` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `battle` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `creator` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `minlev1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `maxlev1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `minlev2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `maxlev2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `limit1` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `limit2` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `wait` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `all_z` varchar(30) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  `comment` varchar(225) CHARACTER SET cp1251 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `player1` (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=utf8;

/*Data for the table `zayavka` */

LOCK TABLES `zayavka` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
