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

/*Table structure for table `admin_item_create` */

DROP TABLE IF EXISTS `admin_item_create`;

CREATE TABLE `admin_item_create` (
  `name` varchar(30) NOT NULL default '',
  `img` varchar(30) NOT NULL default '',
  `section` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default '',
  `item_flags` varchar(30) NOT NULL default '0',
  `mass` varchar(30) NOT NULL default '0',
  `price` varchar(30) NOT NULL default '0',
  `price_euro` varchar(30) NOT NULL default '0',
  `tear` varchar(30) NOT NULL default '0',
  `min_dex` varchar(30) NOT NULL default '0',
  `min_con` varchar(30) NOT NULL default '0',
  `min_level` varchar(30) NOT NULL default '0',
  `min_str` varchar(30) NOT NULL default '0',
  `min_vit` varchar(30) NOT NULL default '0',
  `min_int` varchar(30) NOT NULL default '0',
  `min_wis` varchar(30) NOT NULL default '0',
  `min_sword` varchar(30) NOT NULL default '0',
  `min_axe` varchar(30) NOT NULL default '0',
  `min_fail` varchar(30) NOT NULL default '0',
  `min_knife` varchar(30) NOT NULL default '0',
  `min_staff` varchar(30) NOT NULL default '0',
  `min_shot` varchar(30) NOT NULL default '0',
  `min_fire` varchar(30) NOT NULL default '0',
  `min_water` varchar(30) NOT NULL default '0',
  `min_air` varchar(30) NOT NULL default '0',
  `min_earth` varchar(30) NOT NULL default '0',
  `min_light` varchar(30) NOT NULL default '0',
  `min_gray` varchar(30) NOT NULL default '0',
  `min_dark` varchar(30) NOT NULL default '0',
  `min_mp_all` varchar(30) NOT NULL default '0',
  `add_str` varchar(30) NOT NULL default '0',
  `add_dex` varchar(30) NOT NULL default '0',
  `add_con` varchar(30) NOT NULL default '0',
  `add_int` varchar(30) NOT NULL default '0',
  `add_hp` varchar(30) NOT NULL default '0',
  `add_mp` varchar(30) NOT NULL default '0',
  `mpcons` varchar(30) NOT NULL default '0',
  `hpreco` varchar(30) NOT NULL default '0',
  `mpreco` varchar(30) NOT NULL default '0',
  `def_h_min` varchar(30) NOT NULL default '0',
  `def_h_max` varchar(30) NOT NULL default '0',
  `def_a_min` varchar(30) NOT NULL default '0',
  `def_a_max` varchar(30) NOT NULL default '0',
  `def_b_min` varchar(30) NOT NULL default '0',
  `def_b_max` varchar(30) NOT NULL default '0',
  `def_l_min` varchar(30) NOT NULL default '0',
  `def_l_max` varchar(30) NOT NULL default '0',
  `resist_all_magic` varchar(30) NOT NULL default '0',
  `resist_fire` varchar(30) NOT NULL default '0',
  `resist_water` varchar(30) NOT NULL default '0',
  `resist_air` varchar(30) NOT NULL default '0',
  `resist_earth` varchar(30) NOT NULL default '0',
  `resist_light` varchar(30) NOT NULL default '0',
  `resist_gray` varchar(30) NOT NULL default '0',
  `resist_dark` varchar(30) NOT NULL default '0',
  `resist_all_damage` varchar(30) NOT NULL default '0',
  `resist_all_damage_h` varchar(30) NOT NULL default '0',
  `resist_all_damage_a` varchar(30) NOT NULL default '0',
  `resist_all_damage_b` varchar(30) NOT NULL default '0',
  `resist_all_damage_l` varchar(30) NOT NULL default '0',
  `resist_sting` varchar(30) NOT NULL default '0',
  `resist_sting_h` varchar(30) NOT NULL default '0',
  `resist_sting_a` varchar(30) NOT NULL default '0',
  `resist_sting_b` varchar(30) NOT NULL default '0',
  `resist_sting_l` varchar(30) NOT NULL default '0',
  `resist_slash` varchar(30) NOT NULL default '0',
  `resist_slash_h` varchar(30) NOT NULL default '0',
  `resist_slash_a` varchar(30) NOT NULL default '0',
  `resist_slash_b` varchar(30) NOT NULL default '0',
  `resist_slash_l` varchar(30) NOT NULL default '0',
  `resist_crush` varchar(30) NOT NULL default '0',
  `resist_crush_h` varchar(30) NOT NULL default '0',
  `resist_crush_a` varchar(30) NOT NULL default '0',
  `resist_crush_b` varchar(30) NOT NULL default '0',
  `resist_crush_l` varchar(30) NOT NULL default '0',
  `resist_sharp` varchar(30) NOT NULL default '0',
  `resist_sharp_h` varchar(30) NOT NULL default '0',
  `resist_sharp_a` varchar(30) NOT NULL default '0',
  `resist_sharp_b` varchar(30) NOT NULL default '0',
  `resist_sharp_l` varchar(30) NOT NULL default '0',
  `mf_all_damage` varchar(30) NOT NULL default '0',
  `mf_all_damage_h` varchar(30) NOT NULL default '0',
  `mf_sting` varchar(30) NOT NULL default '0',
  `mf_sting_h` varchar(30) NOT NULL default '0',
  `mf_slash` varchar(30) NOT NULL default '0',
  `mf_slash_h` varchar(30) NOT NULL default '0',
  `mf_crush` varchar(30) NOT NULL default '0',
  `mf_crush_h` varchar(30) NOT NULL default '0',
  `mf_sharp` varchar(30) NOT NULL default '0',
  `mf_sharp_h` varchar(30) NOT NULL default '0',
  `mf_all_magic` varchar(30) NOT NULL default '0',
  `mf_fire` varchar(30) NOT NULL default '0',
  `mf_water` varchar(30) NOT NULL default '0',
  `mf_air` varchar(30) NOT NULL default '0',
  `mf_earth` varchar(30) NOT NULL default '0',
  `mf_light` varchar(30) NOT NULL default '0',
  `mf_gray` varchar(30) NOT NULL default '0',
  `mf_dark` varchar(30) NOT NULL default '0',
  `mf_anticrit` varchar(30) NOT NULL default '0',
  `mf_antiuvorot` varchar(30) NOT NULL default '0',
  `mf_antiuvorot_h` varchar(30) NOT NULL default '0',
  `mf_parry` varchar(30) NOT NULL default '0',
  `mf_uvorot` varchar(30) NOT NULL default '0',
  `mf_contr` varchar(30) NOT NULL default '0',
  `mf_crit` varchar(30) NOT NULL default '0',
  `mf_crit_h` varchar(30) NOT NULL default '0',
  `mf_critpower` varchar(30) NOT NULL default '0',
  `mf_critpower_h` varchar(30) NOT NULL default '0',
  `mf_piercearmor` varchar(30) NOT NULL default '0',
  `mf_piercearmor_h` varchar(30) NOT NULL default '0',
  `mf_blockshield` varchar(30) NOT NULL default '0',
  `all_magic` varchar(30) NOT NULL default '0',
  `fire` varchar(30) NOT NULL default '0',
  `water` varchar(30) NOT NULL default '0',
  `air` varchar(30) NOT NULL default '0',
  `earth` varchar(30) NOT NULL default '0',
  `light` varchar(30) NOT NULL default '0',
  `gray` varchar(30) NOT NULL default '0',
  `dark` varchar(30) NOT NULL default '0',
  `all_mastery` varchar(30) NOT NULL default '0',
  `sword` varchar(30) NOT NULL default '0',
  `sword_h` varchar(30) NOT NULL default '0',
  `axe` varchar(30) NOT NULL default '0',
  `axe_h` varchar(30) NOT NULL default '0',
  `fail` varchar(30) NOT NULL default '0',
  `fail_h` varchar(30) NOT NULL default '0',
  `knife` varchar(30) NOT NULL default '0',
  `knife_h` varchar(30) NOT NULL default '0',
  `staff` varchar(30) NOT NULL default '0',
  `shot` varchar(30) NOT NULL default '0',
  `min_attack` varchar(30) NOT NULL default '0',
  `max_attack` varchar(30) NOT NULL default '0',
  `add_attack_min` varchar(30) NOT NULL default '0',
  `add_attack_max` varchar(30) NOT NULL default '0',
  `repres_all_magic` varchar(30) NOT NULL default '0',
  `repres_fire` varchar(30) NOT NULL default '0',
  `repres_water` varchar(30) NOT NULL default '0',
  `repres_air` varchar(30) NOT NULL default '0',
  `repres_earth` varchar(30) NOT NULL default '0',
  `chance_sting` varchar(30) NOT NULL default '0',
  `chance_slash` varchar(30) NOT NULL default '0',
  `chance_crush` varchar(30) NOT NULL default '0',
  `chance_sharp` varchar(30) NOT NULL default '0',
  `chance_fire` varchar(30) NOT NULL default '0',
  `chance_water` varchar(30) NOT NULL default '0',
  `chance_air` varchar(30) NOT NULL default '0',
  `chance_earth` varchar(30) NOT NULL default '0',
  `chance_light` varchar(30) NOT NULL default '0',
  `chance_dark` varchar(30) NOT NULL default '0',
  `inc_count` varchar(30) NOT NULL default '0',
  `personal_owner` varchar(30) default NULL,
  `block` varchar(30) NOT NULL default '0',
  `orden` varchar(30) NOT NULL default '0',
  `sex` varchar(30) default NULL,
  `itemset` varchar(30) NOT NULL default '0',
  `hands` varchar(30) NOT NULL default '0',
  `description` varchar(30) default NULL,
  `validity` varchar(30) NOT NULL default '0',
  `add_speed` varchar(30) NOT NULL default '',
  `add_cast` varchar(30) NOT NULL default '',
  `add_trade` varchar(30) NOT NULL default '',
  `add_walk` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `admin_item_create` */

insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','amulet','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','sword','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','axe','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','fail','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','knife','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','staff','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','armor','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','1','1','0','0','0','0','1','1','1','1','1','1','1','1','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','belt','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','1','0','0','1','1','1','1','1','1','1','1','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','0','1','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','helmet','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','gloves','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','shield','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','1','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','boots','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','0','0','1','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('1','1','item','ring','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','0','0','0','1','0','1','0','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','0','1','1','1','1','0','1','0','1','0','1','1','1','1','1','1','1','1','1','1','1','0','1','0','1','0','1','0','1','0','0','0','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','0','0','1','1','0','1','1','1','0','1','1','0','0','0','0');
insert  into `admin_item_create`(`name`,`img`,`section`,`type`,`item_flags`,`mass`,`price`,`price_euro`,`tear`,`min_dex`,`min_con`,`min_level`,`min_str`,`min_vit`,`min_int`,`min_wis`,`min_sword`,`min_axe`,`min_fail`,`min_knife`,`min_staff`,`min_shot`,`min_fire`,`min_water`,`min_air`,`min_earth`,`min_light`,`min_gray`,`min_dark`,`min_mp_all`,`add_str`,`add_dex`,`add_con`,`add_int`,`add_hp`,`add_mp`,`mpcons`,`hpreco`,`mpreco`,`def_h_min`,`def_h_max`,`def_a_min`,`def_a_max`,`def_b_min`,`def_b_max`,`def_l_min`,`def_l_max`,`resist_all_magic`,`resist_fire`,`resist_water`,`resist_air`,`resist_earth`,`resist_light`,`resist_gray`,`resist_dark`,`resist_all_damage`,`resist_all_damage_h`,`resist_all_damage_a`,`resist_all_damage_b`,`resist_all_damage_l`,`resist_sting`,`resist_sting_h`,`resist_sting_a`,`resist_sting_b`,`resist_sting_l`,`resist_slash`,`resist_slash_h`,`resist_slash_a`,`resist_slash_b`,`resist_slash_l`,`resist_crush`,`resist_crush_h`,`resist_crush_a`,`resist_crush_b`,`resist_crush_l`,`resist_sharp`,`resist_sharp_h`,`resist_sharp_a`,`resist_sharp_b`,`resist_sharp_l`,`mf_all_damage`,`mf_all_damage_h`,`mf_sting`,`mf_sting_h`,`mf_slash`,`mf_slash_h`,`mf_crush`,`mf_crush_h`,`mf_sharp`,`mf_sharp_h`,`mf_all_magic`,`mf_fire`,`mf_water`,`mf_air`,`mf_earth`,`mf_light`,`mf_gray`,`mf_dark`,`mf_anticrit`,`mf_antiuvorot`,`mf_antiuvorot_h`,`mf_parry`,`mf_uvorot`,`mf_contr`,`mf_crit`,`mf_crit_h`,`mf_critpower`,`mf_critpower_h`,`mf_piercearmor`,`mf_piercearmor_h`,`mf_blockshield`,`all_magic`,`fire`,`water`,`air`,`earth`,`light`,`gray`,`dark`,`all_mastery`,`sword`,`sword_h`,`axe`,`axe_h`,`fail`,`fail_h`,`knife`,`knife_h`,`staff`,`shot`,`min_attack`,`max_attack`,`add_attack_min`,`add_attack_max`,`repres_all_magic`,`repres_fire`,`repres_water`,`repres_air`,`repres_earth`,`chance_sting`,`chance_slash`,`chance_crush`,`chance_sharp`,`chance_fire`,`chance_water`,`chance_air`,`chance_earth`,`chance_light`,`chance_dark`,`inc_count`,`personal_owner`,`block`,`orden`,`sex`,`itemset`,`hands`,`description`,`validity`,`add_speed`,`add_cast`,`add_trade`,`add_walk`) values ('Название','Изображение','item','lang','Флаги','Масса','Цена','Цена (екр)','Долговечность','Ловкость','Интуиция','Уровень','Сила','Выносливость','Интеллект','Мудрость','Меч','Топор','Дубина','Нож','Посох','0','Огонь','Вода','Воздух','Земля','Свет','Серая','Тьма','Мана','+ Сила','+ Ловкость','+ Интуиция','+ Интеллект','+ HP','+ MP','Mpcons','Восстановление HP','Восстановление MP','Голова мин','Голова мах','Армор мин','Армор мах','Пояс мин','Пояс мах','Ноги мин','Ноги мах','Защита от магии','Огонь защ','Вода защ','Воздух защ','Земля защ','Свет защ','Серая защ','Тьма защ','Защита от урона','Все голова защ','Все армор защ','Все пояс защ','Все ноги защ','Колющ защ','Колющ голова защ','Колющ армор защ','Колющ пояс защ','Колющ ноги защ','Рубящ защ','Рубящ голова защ','Рубящ армор защ','Рубящ пояс защ','Рубящ ноги защ','Дробящ защ','Дробящ голова защ','Дробящ армор защ','Дробящ пояс защ','Дробящ ноги защ','Режущ защ','Режущ голова защ','Режущ армор защ','Режущ пояс защ','Режущ ноги защ','Мф удара','Мф удара рука','Мф колющ','Мф колющ рука','Мф рубящ','Мф рубящ рука','Мф дробящ','Мф дробящ рука','Мф режущ','Мф режущ рука','Мф магии','Мф огонь','Мф вода','Мф воздух','Мф земля','Мф свет','Мф серая','Мф тьма','Мф против крит','Мф против уверт','Мф против уверт рука','Мф парирования','Мф уворота','Мф контрудар','Мф крит','Мф крит рука','Мф критсила','Мф критсила рука','Мф пронзающ','Мф пронзающ рука','Мф блокщит','Магия','Огонь','Вода','Воздух','Земля','Свет','Серая','Тьма','Оружие','Меч','Меч рука','Топор','Топор рука','Дубина','Дубина рука','Нож','Нож рука','Посох','0','Атака мин','Атака мах','+ Атака мин','+ Атака мах','Подавл магич защ','Подавл огнен защ','Подавл водян защ','Подавл воздуш защ','Подавл землян защ','Шанс колющ','Шанс рубящ','Шанс дробящ','Шанс режущ','Шанс огонь','Шанс вода','Шанс воздух','Шанс земля','Шанс свет','Шанс тьма','Кол-во добавлен','Персон','Блоки','Орден','Пол','Сет','Руки','Описание','Жизнь','0','0','0','0');

/*Table structure for table `admin_menu` */

DROP TABLE IF EXISTS `admin_menu`;

CREATE TABLE `admin_menu` (
  `id` int(4) NOT NULL default '0',
  `href` varchar(30) character set cp1251 default NULL,
  `name` varchar(40) character set cp1251 NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `admin_menu` */

insert  into `admin_menu`(`id`,`href`,`name`) values (1,'none','Интро');
insert  into `admin_menu`(`id`,`href`,`name`) values (2,'phpinfo','Phpinfo');
insert  into `admin_menu`(`id`,`href`,`name`) values (3,'doc','Документация');
insert  into `admin_menu`(`id`,`href`,`name`) values (4,'admin_bd','Мини-Редактор БД');
insert  into `admin_menu`(`id`,`href`,`name`) values (5,'upload','Загрузщик Файлов');
insert  into `admin_menu`(`id`,`href`,`name`) values (6,'coder','Кодер - Декодер');
insert  into `admin_menu`(`id`,`href`,`name`) values (7,'online','Онлайн Игроки');
insert  into `admin_menu`(`id`,`href`,`name`) values (8,'room_all','Переброска игроков среди комнат');
insert  into `admin_menu`(`id`,`href`,`name`) values (9,'room','Переброска одного игрока среди комнат');
insert  into `admin_menu`(`id`,`href`,`name`) values (10,'kick_all','Вытащить всех из боя');
insert  into `admin_menu`(`id`,`href`,`name`) values (11,'kick','Вытащить одного игрока из боя');
insert  into `admin_menu`(`id`,`href`,`name`) values (12,'unwear_all','Раздеть всех персонажей');
insert  into `admin_menu`(`id`,`href`,`name`) values (13,'unwear','Раздеть персонажа');
insert  into `admin_menu`(`id`,`href`,`name`) values (14,'travm_all','Вылечить у всех персонажей травмы');
insert  into `admin_menu`(`id`,`href`,`name`) values (15,'travm','Вылечить у персонажа травму');
insert  into `admin_menu`(`id`,`href`,`name`) values (16,'hpmp','Вылечить персонажа (HP, MP)');
insert  into `admin_menu`(`id`,`href`,`name`) values (17,'add','Добавление вещей');
insert  into `admin_menu`(`id`,`href`,`name`) values (18,'mer','Меню Свадьбы');
insert  into `admin_menu`(`id`,`href`,`name`) values (19,'metka','Проверка Персонажа');
insert  into `admin_menu`(`id`,`href`,`name`) values (20,'new','Переброска вещей между персонажими');
insert  into `admin_menu`(`id`,`href`,`name`) values (21,'stat_admin','Подданство и Статус');
insert  into `admin_menu`(`id`,`href`,`name`) values (22,'team1','ID бой');
insert  into `admin_menu`(`id`,`href`,`name`) values (23,'team2','ID бой часть II');

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
  `hand_l_type` varchar(30) NOT NULL default 'none',
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
) ENGINE=MyISAM AUTO_INCREMENT=444 DEFAULT CHARSET=utf8;

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
  `hp` int(10) NOT NULL default '48',
  `hp_cure` bigint(20) default '0',
  `hp_all` int(10) NOT NULL default '48',
  `hp_regen` int(10) NOT NULL default '100' COMMENT '%',
  `mp` int(10) NOT NULL default '0',
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
  `speed` int(10) NOT NULL default '0',
  `cast` int(10) NOT NULL default '0',
  `walk` int(10) NOT NULL default '0',
  `cost` int(10) NOT NULL default '0',
  `mass` double NOT NULL default '0',
  `maxmass` double NOT NULL default '43',
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
  `hand_r_staff` int(10) NOT NULL default '0',
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
  `mf_critpower` int(10) NOT NULL default '0',
  `hand_r_critpower` int(10) NOT NULL default '0',
  `hand_l_critpower` int(10) NOT NULL default '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;

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
  `win` int(10) NOT NULL default '0',
  `lose` int(10) NOT NULL default '0',
  `draw` int(10) NOT NULL default '0',
  `glava` varchar(30) character set cp1251 default NULL,
  `chin` varchar(30) character set cp1251 default NULL,
  `passport` varchar(30) character set cp1251 default NULL,
  `status` varchar(30) character set cp1251 default 'Рекрут',
  `shut` bigint(20) NOT NULL default '0',
  `prision` bigint(20) NOT NULL default '0',
  `prision_reason` varchar(255) character set cp1251 default NULL,
  `block` tinyint(3) NOT NULL default '0',
  `block_reason` varchar(255) character set cp1251 default NULL,
  `travm` bigint(20) NOT NULL default '0',
  `travm_stat` varchar(30) character set cp1251 default NULL,
  `travm_var` varchar(30) character set cp1251 default NULL,
  `travm_old_stat` varchar(30) character set cp1251 default NULL,
  `battle` varchar(30) character set cp1251 default '0',
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
  `checkup` bigint(20) NOT NULL default '0',
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
  `chat_filter` tinyint(3) NOT NULL default '0',
  `chat_sys` tinyint(3) NOT NULL default '1',
  `chat_update` tinyint(3) unsigned NOT NULL default '10',
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
) ENGINE=MyISAM AUTO_INCREMENT=1184 DEFAULT CHARSET=utf8;

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
  `shop_section` varchar(32) default NULL,
  PRIMARY KEY  (`room`,`city`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `city_rooms` */

insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('castle','dem','Бойцовский Клуб','km_1,km_2,km_3,km_4,castle2,centplosh',15,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('km_1','dem','Зал воинов','castle',5,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('km_2','dem','Зал воинов 2','castle',5,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('km_3','dem','Зал воинов 3','castle',5,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('km_4','dem','Будуар','castle',5,0,0,'female',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('castle2','dem','Этаж 2','castle,km_6,km_7',10,2,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('km_6','dem','Рыцарский Зал','castle2',5,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('km_7','dem','Торговый Зал','castle2',5,4,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('centplosh','dem','Центральная Площадь','castle,shop,prision,cityhall,stella,comok,mail,fairstreet',15,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('fairstreet','dem','Страшилкина улица','centplosh,bank',15,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('bank','dem','Банк','fairstreet',15,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('shop','dem','Магазин','centplosh',15,0,0,'',NULL,1,'knife');
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('cityhall','dem','Академия','centplosh',5,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('stella','dem','Стела Выбора','centplosh',15,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('comok','dem','Комиссионка','centplosh',5,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('mail','dem','Почтовое отделение','centplosh',15,0,0,'',NULL,0,NULL);
insert  into `city_rooms`(`room`,`city`,`name`,`from`,`time_to_go`,`min_level`,`need_orden`,`sex`,`description`,`shop`,`shop_section`) values ('prision','dem','Тюрьма','centplosh',5,0,0,'',NULL,0,NULL);

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

/*Data for the table `city_stella_main` */

insert  into `city_stella_main`(`id`,`question`,`min_level`,`open`,`city`,`date`) values (1,'Нужна ли эта комната?',4,1,'dem','2007-04-18');

/*Table structure for table `city_stella_question` */

DROP TABLE IF EXISTS `city_stella_question`;

CREATE TABLE `city_stella_question` (
  `id` int(4) NOT NULL auto_increment,
  `question` int(4) NOT NULL default '0',
  `answer` varchar(250) NOT NULL default '',
  `count` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`,`question`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

/*Data for the table `city_stella_question` */

insert  into `city_stella_question`(`id`,`question`,`answer`,`count`) values (1,1,'Не знаю',11);
insert  into `city_stella_question`(`id`,`question`,`answer`,`count`) values (2,1,'Да',5);
insert  into `city_stella_question`(`id`,`question`,`answer`,`count`) values (3,1,'Нет',6);
insert  into `city_stella_question`(`id`,`question`,`answer`,`count`) values (4,1,'А мне не интересно',5);

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

/*Data for the table `forums` */

insert  into `forums`(`id`,`name`,`title`) values (1,'Общий','Общий');
insert  into `forums`(`id`,`name`,`title`) values (2,'Творчество','Творчество');
insert  into `forums`(`id`,`name`,`title`) values (3,'Предложения','Предложения');
insert  into `forums`(`id`,`name`,`title`) values (4,'Баги','Баги');
insert  into `forums`(`id`,`name`,`title`) values (5,'Конкурсы','Конкурсы');
insert  into `forums`(`id`,`name`,`title`) values (6,'Кланы','Кланы');
insert  into `forums`(`id`,`name`,`title`) values (7,'Инквизиция','Инквизиция');

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
) ENGINE=MyISAM AUTO_INCREMENT=370 DEFAULT CHARSET=cp1251;

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
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=cp1251;

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
) ENGINE=MyISAM AUTO_INCREMENT=569 DEFAULT CHARSET=cp1251;

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
  `dem-shop` smallint(11) unsigned NOT NULL default '1000',
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
  `add_hp` int(4) NOT NULL default '0',
  `add_mp` int(4) NOT NULL default '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=1085 DEFAULT CHARSET=cp1251;

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

insert  into `lotto_fond`(`fond`) values ('42');

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

/*Data for the table `news` */

insert  into `news`(`id`,`theme`,`msg`,`date`) values (1,'Открытие!','<img src=\'img/site/suven2008_5.gif\' width=\'60\' height=\'60\' hspace=\'5\' vspace=\'5\' align=\'left\'><br>С данного дня 20.06.09, я начинаю потихоньку тестить сайт, что-то корректировать.','20/06/09 01:44');

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

/*Data for the table `player_exp_for_level` */

insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (1,0,20,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (2,0,45,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (3,0,75,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (4,1,110,3,1,0,1,'','Рекрут');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (5,1,160,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (6,1,215,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (7,1,280,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (8,1,350,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (9,2,410,3,1,0,1,'power,def,set','Оруженосец');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (10,2,530,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (11,2,670,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (12,2,830,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (13,2,950,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (14,2,1100,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (15,3,1300,3,1,0,1,'','Воин');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (16,3,1450,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (17,3,1650,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (18,3,1850,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (19,3,2050,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (20,3,2200,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (21,4,2500,5,1,0,1,'btn','Воин');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (22,4,2900,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (23,4,3350,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (24,4,3800,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (25,4,4200,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (26,4,4600,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (27,5,5000,3,1,0,1,'','Воин');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (28,5,6000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (29,5,7000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (30,5,8000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (31,5,9000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (32,5,10000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (33,5,11000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (34,5,12000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (35,6,12500,3,1,0,1,'','Рыцарь');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (36,6,14000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (37,6,15500,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (53,8,300000,5,1,0,1,'','Рыцарь');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (52,7,280000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (51,7,260000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (50,7,250000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (49,7,225000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (48,7,200000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (47,7,175000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (46,7,150000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (45,7,75000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (44,7,60000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (43,7,30000,5,1,0,1,'','Рыцарь');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (38,6,17000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (39,6,19000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (40,6,21000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (41,6,23000,1,0,0,0,'','');
insert  into `player_exp_for_level`(`up`,`level`,`exp`,`ups`,`skills`,`money`,`vit`,`add_bars`,`status`) values (42,6,27000,1,0,0,0,'','');

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

/*Data for the table `player_shapes` */

insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (1,'m','1.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (2,'m','2.gif',0,0,0,0,0,0,30,0,0,0,0,3,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (3,'m','3.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (4,'m','4.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (5,'m','5.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (6,'m','6.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (7,'m','7.gif',0,0,0,0,0,0,30,0,0,0,0,0,3,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (8,'m','8.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (9,'m','9.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (10,'m','10.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (11,'m','11.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (12,'m','12.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (13,'m','13.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (14,'m','14.gif',0,0,0,0,0,0,30,0,0,0,0,0,0,3,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (15,'m','15.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (16,'m','16.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (17,'m','17.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (18,'m','18.gif',0,0,0,0,0,0,30,0,0,0,0,0,0,0,3,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (19,'m','19.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (20,'m','20.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (21,'m','21.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (22,'m','22.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (23,'m','23.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (24,'m','24.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (25,'m','25.gif',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (26,'m','26.gif',9,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (27,'m','27.gif',9,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (28,'m','28.gif',9,0,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (29,'m','29.gif',9,0,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (30,'m','30.gif',8,0,0,0,0,35,35,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (31,'m','31.gif',8,35,0,0,35,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (32,'m','32.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,0,4);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (33,'m','33.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,4,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (34,'m','34.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,5,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (35,'m','35.gif',9,0,0,0,0,50,50,0,0,0,0,4,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (36,'m','36.gif',9,0,0,0,0,50,50,0,0,0,0,0,4,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (37,'m','37.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,4,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (38,'m','38.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (39,'m','39.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (40,'m','40.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (41,'m','41.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (42,'m','42.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (43,'m','43.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (44,'m','44.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (45,'m','45.gif',7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (46,'m','46.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (47,'m','47.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (48,'m','48.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (49,'m','49.gif',7,0,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (50,'m','50.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (51,'m','51.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (52,'m','52.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (53,'m','53.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (54,'f','1.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (55,'f','69.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (56,'f','3.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (57,'f','4.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (58,'f','5.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (59,'f','6.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (60,'f','7.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (61,'f','8.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (62,'f','9.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (63,'f','10.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (64,'f','11.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (65,'f','12.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (66,'f','13.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (67,'f','14.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (68,'f','15.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (69,'f','16.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (70,'f','17.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (71,'f','18.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (72,'f','19.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (73,'f','20.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (74,'f','21.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (75,'f','22.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (76,'f','23.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (77,'f','24.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (78,'f','25.gif',0,0,0,0,0,0,0,0,0,0,5,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (79,'f','26.gif',0,0,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (80,'f','27.gif',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (81,'f','28.gif',0,0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (82,'f','29.gif',0,0,0,0,0,0,0,5,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (83,'f','30.gif',0,0,0,0,0,0,0,0,0,0,0,5,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (84,'f','31.gif',0,0,0,0,0,0,35,0,0,0,0,0,0,0,0,0,4);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (85,'f','32.gif',0,0,0,0,0,0,0,0,0,5,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (86,'f','33.gif',0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (87,'f','34.gif',0,0,0,0,40,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (88,'f','35.gif',0,0,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (89,'f','36.gif',9,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (90,'f','37.gif',9,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (91,'f','38.gif',9,0,0,0,50,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (92,'f','42.gif',8,0,0,0,0,35,35,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (93,'f','43.gif',8,35,0,0,35,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (94,'f','44.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,4,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (95,'f','45.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,0,0,4);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (96,'f','46.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,4,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (97,'f','47.gif',9,0,0,0,0,50,50,0,0,0,0,4,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (98,'f','48.gif',9,0,0,0,0,50,50,0,0,0,0,0,4,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (99,'f','49.gif',9,0,0,0,0,50,50,0,0,0,0,0,0,0,4,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (100,'f','50.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (101,'f','51.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (102,'f','52.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (103,'f','53.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (104,'f','54.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (105,'f','55.gif',7,40,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (106,'f','56.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (107,'f','57.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (108,'f','58.gif',4,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (109,'f','59.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (110,'f','60.gif',7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (111,'f','61.gif',9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (112,'f','62.gif',8,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (113,'f','63.gif',8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (114,'f','64.gif',8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (115,'f','65.gif',8,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (116,'f','66.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (117,'f','67.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
insert  into `player_shapes`(`id`,`sex`,`img`,`level`,`str`,`dex`,`con`,`vit`,`int`,`wis`,`sword`,`axe`,`fail`,`knife`,`fire`,`water`,`earth`,`air`,`light`,`dark`) values (118,'f','68.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `podval` */

DROP TABLE IF EXISTS `podval`;

CREATE TABLE `podval` (
  `number` varchar(40) NOT NULL default '',
  `type` varbinary(40) NOT NULL default '                                        '
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `podval` */

insert  into `podval`(`number`,`type`) values ('100','1                                       ');
insert  into `podval`(`number`,`type`) values ('100','2                                       ');
insert  into `podval`(`number`,`type`) values ('100','3                                       ');
insert  into `podval`(`number`,`type`) values ('100','4                                       ');
insert  into `podval`(`number`,`type`) values ('136','5                                       ');
insert  into `podval`(`number`,`type`) values ('100','6                                       ');
insert  into `podval`(`number`,`type`) values ('100','7                                       ');
insert  into `podval`(`number`,`type`) values ('99','8                                       ');
insert  into `podval`(`number`,`type`) values ('100','9                                       ');
insert  into `podval`(`number`,`type`) values ('100','10                                      ');
insert  into `podval`(`number`,`type`) values ('0','11                                      ');

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

/*Data for the table `posts` */

insert  into `posts`(`id`,`top_id`,`text`,`date`,`poster`,`p_id`,`p_rank`,`p_tribe`,`p_level`,`p_rase`) values (1176923676,1176923603,'dasd','','',0,0,'',0,0);

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

/*Data for the table `protocol` */

insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (1,'hacik','Delux','clan_reg','sss','','2007-04-06 20:16:16');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (2,'delux','Мироздатель','shut','','  15 минут','2007-04-09 12:11:36');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (3,'Papazogla','Delux','prision','munic','сутки','2007-04-10 15:22:42');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (4,'Papazogla','Delux','unprision','','','2007-04-10 15:22:59');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (5,'Delux','Мироздатель','prision','dsds','3 месяца','2007-04-13 16:26:20');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (6,'Delux','Мироздатель','unprision','','','2007-04-13 16:27:09');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (7,'Delux','Мироздатель','kill','ss','','2007-04-13 16:27:44');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (8,'Delux','Мироздатель','unkill','','','2007-04-13 16:28:43');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (9,'Delux','Мироздатель','shut','','1 часов','2007-04-19 13:23:22');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (10,'Delux','Мироздатель','unshut','','','2007-04-19 13:30:01');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (11,'Delux','Мироздатель','shut','','  15 минут','2007-04-19 13:30:14');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (12,'Delux','Мироздатель','unshut','','','2007-04-19 13:30:34');
insert  into `protocol`(`id`,`login`,`templier`,`type`,`reason`,`time`,`date`) values (13,'Delux','Мироздатель','shut','','  15 минут','2007-04-19 13:30:42');

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

/*Data for the table `protocol_adm` */

insert  into `protocol_adm`(`id`,`date_time`,`login`,`target`,`msg`) values (1,'22.06.07 19:09:20','Смотритель','Смотритель','Сила изменена с <b>4</b> на <b>5</b>.<br>Деньги изменены с <b>0</b> на <b>1000</b>.<br>');

/*Table structure for table `res` */

DROP TABLE IF EXISTS `res`;

CREATE TABLE `res` (
  `locate` varchar(30) NOT NULL default '',
  `resource` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `type` varchar(30) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Table structure for table `river` */

DROP TABLE IF EXISTS `river`;

CREATE TABLE `river` (
  `login` varchar(30) NOT NULL default '',
  `time` varchar(30) NOT NULL default '',
  `resource` varchar(30) NOT NULL default '',
  KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `river` */

insert  into `river`(`login`,`time`,`resource`) values ('Мироздатель','','riba');

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

/*Data for the table `sapojn` */

insert  into `sapojn`(`id`,`login`,`money`,`num`,`zarplata`) values (3,'Мироздатель','0','970','0.2');

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

/*Data for the table `scroll` */

insert  into `scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (2,'?????????','icon/magic/attack.gif',1,9,'70',0,7,4,0,5,'','attack.php','','9973','','','','','','','1','','','','','','','','','','','');
insert  into `scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (1,'??????? ?????','icon/magic/lech.gif',1,15,'50',0,8,4,0,5,'','lech.php','','9995','','','','','','','','','','','','','','','','','','');
insert  into `scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (3,'HP 10','icon/magic/10.gif',1,15,'100',0,2,0,0,5,'','cure_hp10.php','','9994','','','','','','','','','','','','','','','','','','air');
insert  into `scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (4,'HP 25','icon/magic/25.gif',1,15,'100',0,2,0,0,5,'','cure_hp25.php','','9996','','','','','','','','','','','','','','','','','','air');

/*Table structure for table `server_cities` */

DROP TABLE IF EXISTS `server_cities`;

CREATE TABLE `server_cities` (
  `city` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY  (`city`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `server_cities` */

insert  into `server_cities`(`city`,`name`) values ('cap','Capital city');
insert  into `server_cities`(`city`,`name`) values ('ang','Angels city');
insert  into `server_cities`(`city`,`name`) values ('dem','Demons city');
insert  into `server_cities`(`city`,`name`) values ('dev','Devils city');
insert  into `server_cities`(`city`,`name`) values ('sun','Suncity');
insert  into `server_cities`(`city`,`name`) values ('em','Emeralds city');
insert  into `server_cities`(`city`,`name`) values ('sand','Sandcity');
insert  into `server_cities`(`city`,`name`) values ('moon','Mooncity');
insert  into `server_cities`(`city`,`name`) values ('nc','New Capital city');
insert  into `server_cities`(`city`,`name`) values ('ap','Abandoned Plains');
insert  into `server_cities`(`city`,`name`) values ('drm','Dreams city');
insert  into `server_cities`(`city`,`name`) values ('low','Low city');
insert  into `server_cities`(`city`,`name`) values ('old','Old city');

/*Table structure for table `server_commands` */

DROP TABLE IF EXISTS `server_commands`;

CREATE TABLE `server_commands` (
  `name` varchar(32) NOT NULL default '',
  `security` int(2) NOT NULL default '0',
  `help` longtext NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `server_commands` */

insert  into `server_commands`(`name`,`security`,`help`) values ('/afk',0,'');
insert  into `server_commands`(`name`,`security`,`help`) values ('/dnd',0,'');
insert  into `server_commands`(`name`,`security`,`help`) values ('/e',0,'');

/*Table structure for table `server_errors` */

DROP TABLE IF EXISTS `server_errors`;

CREATE TABLE `server_errors` (
  `id` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  `warning` tinyint(3) unsigned NOT NULL default '1',
  `hyphen` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `server_errors` */

insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (100,'Вы отбываете тюремное заключение! Вы не можете покинуть здание тюрьмы.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (101,'Проход сюда только после <b>%1$s-го</b> уровня.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (102,'Вы не можете перемещаться через стены.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (103,'Вы не можете передвигаться! Масса всех вещей [%1$s] превышает допустимую норму [%2$s].',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (104,'Вход разрешен только %1$s',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (105,'Вы не можете пользоваться здесь чем-либо кроме почты.',1,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (106,'Адресат не существует.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (107,'У вас недостаточно средств!',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (108,'Екровые вещи нельзя отправить по почте.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (110,'Вы не можете так быстро бегать по комнатам',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (111,'Вы сможете сменить образ через %1$s',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (112,'Предмет не найден на почте.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (113,'Исчерпан лимит передач.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (114,'Действие не доступно.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (201,'Заклинание удачно использовано.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (202,'У вас не достаточно параметров для использования этого заклинания.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (203,'Персонаж <b>\"%1$s\"</b> не найден',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (204,'Персонаж <b>\"%1$s\"</b> не травмирован.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (205,'Вы не можете использовать это заклинание на себя.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (206,'Персонаж <b>\"%1$s\"</b> сейчас оффлайн.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (207,'Персонаж <b>\"%1$s\"</b> находится в другой комнате.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (208,'Персонаж <b>\"%1$s\"</b> находится в бою.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (209,'Персонаж <b>\"%1$s\"</b> слишком ослаблен.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (210,'Нападение на персонажей 0-го уровня запрещено Мироздателем.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (211,'Использование этого заклинания на персонажа <b>\"%1$s\"</b> запрещено.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (212,'Вам не удалось использовать это заклинание.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (213,'Предмет не найден в вашем рюкзаке.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (214,'Предмет не надет на вас.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (216,'У предмета нет доступных увеличений.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (217,'Предмет требуется снять.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (218,'Зачем вам самому себе что-либо передавать?',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (219,'Неизвестное увеличение.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (220,'Увеличение параметра <b>\"%1$s\"</b> у предмета <b>\"%2$s\"</b> произведено удачно.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (300,'Пароли не совпадают!',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (301,'Вы не ввели пароль.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (302,'Неверный пароль!',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (303,'Счет не существует!',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (304,'У вас нет при себе <b>%1$s кр.</b>',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (305,'У вас нет <b>%1$s кр.</b> на счету',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (306,'Эта услуга доступна только персонажам, достигшим 8-го уровня.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (307,'Нельзя передавать кредиты самому себе.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (308,'Вы обменяли <b>%1$s екр.</b> со счета <b>#%2$s</b>. Вам зачисленно <b>%3$s кр.</b>',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (309,'Нельзя передать сумму менее 1 кр.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (310,'У вас нет <b>%1$s екр.</b> на счету',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (311,'Пароль изменен. На всякий случай, рекомендуем выйти из банка и войти снова для проверки нового пароля. Убедитесь, что функция высылки пароля на email включена ;)',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (312,'Пароль не был изменен.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (313,'Сохранили записную книжку.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (314,'Записная книжка не сохранена.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (315,'Вы не ввели новый пароль.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (316,'Новый пароль нужно ввести дважды.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (317,'Второй раз пароль нужно ввести, чтобы избежать возможных опечаток. Вы ошиблись при повторном вводе нового пароля. Будьте внимательнее!',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (318,'Вы открыли счет <b>#%1$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (319,'Вы положили <b>%1$s кр.</b> на счет <b>#%2$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (320,'Вы сняли <b>%1$s кр.</b> со счета <b>#%2$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (321,'Вы перевели <b>%1$s кр.</b> к <b>%2$s</b> на счет <b>#%3$s</b> со счета <b>#%4$s</b>.',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (322,'Счет пренадлежит не вам.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (323,'Для открытия счета необходимо иметь при себе <b>%1$s кр.</b>',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (324,'Пароль нужно ввести дважды.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (325,'Укажите сумму',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (326,'Укажите сумму и номер счета',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (327,'Укажите обмениваемую сумму',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (400,'Вы купили предмет <b>\"%1$s\"</b>x<b>%3$s</b> за <b>%2$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (401,'Вы купили предмет <b>\"%1$s\"</b>x<b>%3$s</b> за <b>%2$s екр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (403,'Вещь не найдена в магазине',1,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (404,'Вы продали предмет <b>\"%1$s\"</b> за <b>%2$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (405,'Вы продали предмет <b>\"%1$s\"</b> за <b>%2$s екр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (406,'Вы отправили предмет <b>\"%1$s\"</b> за <b>%2$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (407,'Вы забрали \"%1$s\"',1,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (408,'Вы отправили обратно \"%1$s\"',1,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (409,'Вы отправили <b>%1$s кр.</b>',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (410,'Минимальная сумма перевода: %1$s кр.',1,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (500,'\"Новый пароль нужно написать дважды (чтобы избежать возможных опечаток)\"',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (501,'Прежний пароль указан неверно',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (502,'Вы ошиблись при написании пароля. Будьте внимательнее!',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (503,'Длина пароля не может быть меньше 6 символов или более 30 символов',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (504,'Новый пароль записан',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (505,'Должно пройти не менее трех суток между сменой подтверждения, пароля или email',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (506,'Новый пароль должен состоять только из букв русского и английского алфавита, а также из цифр!',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (507,'Укажите пароль к персонажу',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (508,'Укажите прежний email',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (509,'Укажите новый email',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (510,'Неверно указан старый e-mail',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (511,'Неправильный формат e-mail',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (512,'Новый e-mail записан',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (0,'',0,0);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (221,'Не найден такой комплект',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (215,'Вы не можете выбрать данный образ.',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (222,'Не удалось запомнить комплект \"%1$s\"',1,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (200,'&nbsp; &nbsp;Увеличение способности \"<b>%1$s</b>\" произведено удачно',0,1);
insert  into `server_errors`(`id`,`text`,`warning`,`hyphen`) values (199,'&nbsp; &nbsp;Увеличение способности \"%1$s\" невозможно',1,1);

/*Table structure for table `server_images` */

DROP TABLE IF EXISTS `server_images`;

CREATE TABLE `server_images` (
  `name` varchar(30) NOT NULL,
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `default` varchar(30) default NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `server_images` */

insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_amulet',60,20,'wamulet.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_earring',60,20,'wearring.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_armor',60,80,'warmor.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_pants',60,80,'wpants.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_belt',60,40,'wbelt.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_bracer',60,40,'wbracer.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_gloves',60,40,'wgloves.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_boots',60,40,'wboots.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_ring',20,20,'wring.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_animal',90,60,NULL);
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_hand_r',60,60,'whand_r.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_acsess',60,60,NULL);
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_hand_l',60,60,'whand_l.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_hand_l_f',60,60,'whand_l.gif');
insert  into `server_images`(`name`,`width`,`height`,`default`) values ('item_helmet',60,60,'whelmet.gif');

/*Table structure for table `server_info` */

DROP TABLE IF EXISTS `server_info`;

CREATE TABLE `server_info` (
  `login` tinyint(3) unsigned NOT NULL,
  `registration` tinyint(3) unsigned NOT NULL,
  `password` tinyint(3) unsigned NOT NULL,
  `last_transfer` bigint(20) NOT NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `server_info` */

insert  into `server_info`(`login`,`registration`,`password`,`last_transfer`) values (1,1,1,1295825292);

/*Table structure for table `server_language` */

DROP TABLE IF EXISTS `server_language`;

CREATE TABLE `server_language` (
  `key` varchar(32) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

/*Data for the table `server_language` */

insert  into `server_language`(`key`,`text`) values ('str','Сила:');
insert  into `server_language`(`key`,`text`) values ('dex','Ловкость:');
insert  into `server_language`(`key`,`text`) values ('con','Интуиция:');
insert  into `server_language`(`key`,`text`) values ('vit','Выносливость:');
insert  into `server_language`(`key`,`text`) values ('int','Интеллект:');
insert  into `server_language`(`key`,`text`) values ('wis','Мудрость:');
insert  into `server_language`(`key`,`text`) values ('spi','Духовность:');
insert  into `server_language`(`key`,`text`) values ('level','Уровень:');
insert  into `server_language`(`key`,`text`) values ('mp_all','Мана');
insert  into `server_language`(`key`,`text`) values ('sex','Пол:');
insert  into `server_language`(`key`,`text`) values ('male','Мужской');
insert  into `server_language`(`key`,`text`) values ('female','Женский');
insert  into `server_language`(`key`,`text`) values ('sword','Мастерство владения мечами:');
insert  into `server_language`(`key`,`text`) values ('axe','Мастерство владения топорами, секирами:');
insert  into `server_language`(`key`,`text`) values ('fail','Мастерство владения дубинами, булавами:');
insert  into `server_language`(`key`,`text`) values ('knife','Мастерство владения ножами, кастетами:');
insert  into `server_language`(`key`,`text`) values ('staff','Мастерство владения магическими посохами:');
insert  into `server_language`(`key`,`text`) values ('fire','Мастерство владения стихией Огня:');
insert  into `server_language`(`key`,`text`) values ('water','Мастерство владения стихией Воды:');
insert  into `server_language`(`key`,`text`) values ('air','Мастерство владения стихией Воздуха:');
insert  into `server_language`(`key`,`text`) values ('earth','Мастерство владения стихией Земли:');
insert  into `server_language`(`key`,`text`) values ('light','Мастерство владения магией Света:');
insert  into `server_language`(`key`,`text`) values ('gray','Мастерство владения серой магией:');
insert  into `server_language`(`key`,`text`) values ('dark','Мастерство владения магией Тьмы:');
insert  into `server_language`(`key`,`text`) values ('mf_critpower','Мф. мощности крит. удара (%):');
insert  into `server_language`(`key`,`text`) values ('mf_anticrit','Мф. против критического удара (%):');
insert  into `server_language`(`key`,`text`) values ('mf_antiuvorot','Мф. против увертывания (%):');
insert  into `server_language`(`key`,`text`) values ('mf_piercearmor','Мф. удара сквозь броню (%):');
insert  into `server_language`(`key`,`text`) values ('mf_crit','Мф. критического удара (%):');
insert  into `server_language`(`key`,`text`) values ('mf_parry','Мф. парирования (%):');
insert  into `server_language`(`key`,`text`) values ('mf_blockshield','Мф. блока щитом (%):');
insert  into `server_language`(`key`,`text`) values ('mf_uvorot','Мф. увертывания (%):');
insert  into `server_language`(`key`,`text`) values ('mf_contr','Мф. контрудара (%):');
insert  into `server_language`(`key`,`text`) values ('repres_all_magic','Подавление защиты от магии:');
insert  into `server_language`(`key`,`text`) values ('repres_fire','Подавление защиты от магии Огня:');
insert  into `server_language`(`key`,`text`) values ('repres_water','Подавление защиты от магии Воды:');
insert  into `server_language`(`key`,`text`) values ('repres_air','Подавление защиты от магии Воздуха:');
insert  into `server_language`(`key`,`text`) values ('repres_earth','Подавление защиты от магии Земли:');
insert  into `server_language`(`key`,`text`) values ('mf_all_magic','Мф. мощности магии стихий:');
insert  into `server_language`(`key`,`text`) values ('mf_fire','Мф. мощности магии Огня:');
insert  into `server_language`(`key`,`text`) values ('mf_water','Мф. мощности магии Воды:');
insert  into `server_language`(`key`,`text`) values ('mf_air','Мф. мощности магии Воздуха:');
insert  into `server_language`(`key`,`text`) values ('mf_earth','Мф. мощности магии Земли:');
insert  into `server_language`(`key`,`text`) values ('mf_all_damage','Мф. мощности урона:');
insert  into `server_language`(`key`,`text`) values ('mf_sting','Мф. мощности колющего урона:');
insert  into `server_language`(`key`,`text`) values ('mf_slash','Мф. мощности рубящего урона:');
insert  into `server_language`(`key`,`text`) values ('mf_crush','Мф. мощности дробящего урона:');
insert  into `server_language`(`key`,`text`) values ('mf_sharp','Мф. мощности режущего урона:');
insert  into `server_language`(`key`,`text`) values ('all_magic','Мастерство владения магией стихий:');
insert  into `server_language`(`key`,`text`) values ('all_mastery','Мастерство владения оружием:');
insert  into `server_language`(`key`,`text`) values ('resist_all_magic','Защита от магии:');
insert  into `server_language`(`key`,`text`) values ('resist_fire','Защита от магии огня:');
insert  into `server_language`(`key`,`text`) values ('resist_water','Защита от магии воды:');
insert  into `server_language`(`key`,`text`) values ('resist_air','Защита от магии воздуха:');
insert  into `server_language`(`key`,`text`) values ('resist_earth','Защита от магии земли:');
insert  into `server_language`(`key`,`text`) values ('resist_light','Защита от магии Света:');
insert  into `server_language`(`key`,`text`) values ('resist_gray','Защита от серой магии:');
insert  into `server_language`(`key`,`text`) values ('resist_dark','Защита от магии Тьмы:');
insert  into `server_language`(`key`,`text`) values ('resist_all_damage','Защита от урона:');
insert  into `server_language`(`key`,`text`) values ('resist_sting','Защита от колющего урона:');
insert  into `server_language`(`key`,`text`) values ('resist_slash','Защита от рубящего урона:');
insert  into `server_language`(`key`,`text`) values ('resist_crush','Защита от дробящего урона:');
insert  into `server_language`(`key`,`text`) values ('resist_sharp','Защита от режущего урона:');
insert  into `server_language`(`key`,`text`) values ('add_hp','Уровень жизни (HP):');
insert  into `server_language`(`key`,`text`) values ('add_mp','Уровень маны (MP):');
insert  into `server_language`(`key`,`text`) values ('mpcons','Уменьшение расхода маны (%):');
insert  into `server_language`(`key`,`text`) values ('mpreco','Восстановление маны (%):');
insert  into `server_language`(`key`,`text`) values ('hpreco','Восстановление здоровья (%):');
insert  into `server_language`(`key`,`text`) values ('add_attack_min','Минимальное наносимое повреждение:');
insert  into `server_language`(`key`,`text`) values ('add_attack_max','Максимальное наносимое повреждение:');
insert  into `server_language`(`key`,`text`) values ('chance_sting','Колющие атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_slash','Рубящие атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_crush','Дробящие атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_sharp','Режущие атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_fire','Огненные атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_water','Ледяные атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_air','Электрические атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_earth','Земляные атаки:');
insert  into `server_language`(`key`,`text`) values ('chance_light','Атаки Светом:');
insert  into `server_language`(`key`,`text`) values ('chance_dark','Атаки Тьмой:');
insert  into `server_language`(`key`,`text`) values ('def_h','Броня головы:');
insert  into `server_language`(`key`,`text`) values ('def_a','Броня корпуса:');
insert  into `server_language`(`key`,`text`) values ('def_b','Броня пояса:');
insert  into `server_language`(`key`,`text`) values ('def_l','Броня ног:');
insert  into `server_language`(`key`,`text`) values ('inc_count','Количество увеличений:');
insert  into `server_language`(`key`,`text`) values ('features','Особенности:');
insert  into `server_language`(`key`,`text`) values ('description','Описание:');
insert  into `server_language`(`key`,`text`) values ('never','Никогда');
insert  into `server_language`(`key`,`text`) values ('ex_rarely','Ничтожно редки');
insert  into `server_language`(`key`,`text`) values ('rarely','Редки');
insert  into `server_language`(`key`,`text`) values ('little','Малы');
insert  into `server_language`(`key`,`text`) values ('naa','Временами');
insert  into `server_language`(`key`,`text`) values ('regular','Регулярны');
insert  into `server_language`(`key`,`text`) values ('often','Часты');
insert  into `server_language`(`key`,`text`) values ('always','Всегда');
insert  into `server_language`(`key`,`text`) values ('required','Требуется минимальное:');
insert  into `server_language`(`key`,`text`) values ('act','Действует на:');
insert  into `server_language`(`key`,`text`) values ('price','Цена:');
insert  into `server_language`(`key`,`text`) values ('durability','Долговечность:');
insert  into `server_language`(`key`,`text`) values ('validity','Срок годности: до %1$s  (осталось %2$s)');
insert  into `server_language`(`key`,`text`) values ('val_life','Срок жизни:');
insert  into `server_language`(`key`,`text`) values ('artefact','Артефакт');
insert  into `server_language`(`key`,`text`) values ('gift','Подарок от');
insert  into `server_language`(`key`,`text`) values ('mass','Масса:');
insert  into `server_language`(`key`,`text`) values ('min_bent','Требуемая склонность:');
insert  into `server_language`(`key`,`text`) values ('blocks','Зоны блокирования:');
insert  into `server_language`(`key`,`text`) values ('no_repair','Предмет не подлежит ремонту');
insert  into `server_language`(`key`,`text`) values ('made_in','Сделано в');
insert  into `server_language`(`key`,`text`) values ('sec_hand','Второе оружие');
insert  into `server_language`(`key`,`text`) values ('two_hands','Двуручное оружие');
insert  into `server_language`(`key`,`text`) values ('damage','Урон:');
insert  into `server_language`(`key`,`text`) values ('behaviour','Свойства предмета:');
insert  into `server_language`(`key`,`text`) values ('amulet_f','Пустой слот амулет');
insert  into `server_language`(`key`,`text`) values ('earring_f','Пустой слот серьги');
insert  into `server_language`(`key`,`text`) values ('helmet_f','Пустой слот шлем');
insert  into `server_language`(`key`,`text`) values ('armor_f','Пустой слот броня');
insert  into `server_language`(`key`,`text`) values ('pants_f','Пустой слот штаны');
insert  into `server_language`(`key`,`text`) values ('belt_f','Пустой слот пояс');
insert  into `server_language`(`key`,`text`) values ('bracer_f','Пустой слот наручи');
insert  into `server_language`(`key`,`text`) values ('gloves_f','Пустой слот перчатки');
insert  into `server_language`(`key`,`text`) values ('boots_f','Пустой слот обувь');
insert  into `server_language`(`key`,`text`) values ('ring_f','Пустой слот кольцо');
insert  into `server_language`(`key`,`text`) values ('hand_r_f','Пустой слот правая рука');
insert  into `server_language`(`key`,`text`) values ('hand_l_f','Левая рука занята');
insert  into `server_language`(`key`,`text`) values ('hand_l_f_f','Пустой слот щит');
insert  into `server_language`(`key`,`text`) values ('sting_i','Колющий урон:');
insert  into `server_language`(`key`,`text`) values ('slash_i','Рубящий урон:');
insert  into `server_language`(`key`,`text`) values ('crush_i','Дробящий урон:');
insert  into `server_language`(`key`,`text`) values ('sharp_i','Режущий урон:');
insert  into `server_language`(`key`,`text`) values ('fire_i','Магия Огня:');
insert  into `server_language`(`key`,`text`) values ('water_i','Магия Воды:');
insert  into `server_language`(`key`,`text`) values ('air_i','Магия Воздуха:');
insert  into `server_language`(`key`,`text`) values ('earth_i','Магия Земли:');
insert  into `server_language`(`key`,`text`) values ('light_i','Магия Света:');
insert  into `server_language`(`key`,`text`) values ('gray_i','Серая магия:');
insert  into `server_language`(`key`,`text`) values ('dark_i','Магия Тьмы:');
insert  into `server_language`(`key`,`text`) values ('sting_p','Мощность колющего урона повышает ваш урон колющими атаками');
insert  into `server_language`(`key`,`text`) values ('slash_p','Мощность рубящего урона повышает ваш урон рубящими атаками');
insert  into `server_language`(`key`,`text`) values ('crush_p','Мощность дробящего урона повышает ваш урон дробящими атаками');
insert  into `server_language`(`key`,`text`) values ('sharp_p','Мощность режущего урона повышает ваш урон режущими атаками');
insert  into `server_language`(`key`,`text`) values ('fire_p','Мощность магии Огня повышает ваш урон стихией Огня');
insert  into `server_language`(`key`,`text`) values ('water_p','Мощность магии Воды повышает ваш урон стихией Воды');
insert  into `server_language`(`key`,`text`) values ('air_p','Мощность магии Воздуха повышает ваш урон стихией Воздуха');
insert  into `server_language`(`key`,`text`) values ('earth_p','Мощность магии Земли повышает ваш урон стихией Земли');
insert  into `server_language`(`key`,`text`) values ('light_p','Мощность магии Света повышает ваш урон магией Света');
insert  into `server_language`(`key`,`text`) values ('gray_p','Мощность серой магии повышает ваш урон серой магией');
insert  into `server_language`(`key`,`text`) values ('dark_p','Мощность магии Тьмы повышает ваш урон магией Тьмы');
insert  into `server_language`(`key`,`text`) values ('bar_power','Мощность:');
insert  into `server_language`(`key`,`text`) values ('sting_d','Защита от колющего урона снижает урон нанесенный вам колющими атаками');
insert  into `server_language`(`key`,`text`) values ('slash_d','Защита от рубящего урона снижает урон нанесенный вам рубящими атаками');
insert  into `server_language`(`key`,`text`) values ('crush_d','Защита от дробящего урона снижает урон нанесенный вам дробящими атаками');
insert  into `server_language`(`key`,`text`) values ('sharp_d','Защита от режущего урона снижает урон нанесенный вам режущими атаками');
insert  into `server_language`(`key`,`text`) values ('fire_d','Защита от магии Огня снижает урон нанесенный вам стихией Огня');
insert  into `server_language`(`key`,`text`) values ('water_d','Защита от магии Воды снижает урон нанесенный вам стихией Воды');
insert  into `server_language`(`key`,`text`) values ('air_d','Защита от магии Воздуха снижает урон нанесенный вам стихией Воздуха');
insert  into `server_language`(`key`,`text`) values ('earth_d','Защита от магии Земли снижает урон нанесенный вам стихией Земли');
insert  into `server_language`(`key`,`text`) values ('light_d','Защита от магии Света снижает урон нанесенный вам магией Света');
insert  into `server_language`(`key`,`text`) values ('gray_d','Защита от серой магии снижает урон нанесенный вам серой магией');
insert  into `server_language`(`key`,`text`) values ('dark_d','Защита от магии Тьмы снижает урон нанесенный вам магией Тьмы');
insert  into `server_language`(`key`,`text`) values ('bar_def','Защита:');
insert  into `server_language`(`key`,`text`) values ('bar_btn','Кнопки:');
insert  into `server_language`(`key`,`text`) values ('bar_mod','Модификаторы:');
insert  into `server_language`(`key`,`text`) values ('mf_crit_i','Мф. крит. удара:');
insert  into `server_language`(`key`,`text`) values ('mf_critpower_i','Мф. мощности крит. удара:');
insert  into `server_language`(`key`,`text`) values ('mf_anticrit_i','Мф. против крит. удара:');
insert  into `server_language`(`key`,`text`) values ('mf_crit_m','Мф. крит. удара позволяет нанести критический удар, наносящий дополнительные повреждения даже сквозь блок.');
insert  into `server_language`(`key`,`text`) values ('mf_critpower_m','Мф. мощности крит. удара показывает, на сколько % критический удар будет сильнее, чем обычно.');
insert  into `server_language`(`key`,`text`) values ('mf_anticrit_m','Мф. против крит. удара снижает вероятность получения крит. удара');
insert  into `server_language`(`key`,`text`) values ('mf_uvorot_m','Мф. увертывания позволяет вам уклониться от атаки противника, полностью игнорируя ее.');
insert  into `server_language`(`key`,`text`) values ('mf_antiuvorot_m','Мф. против увертывания снижает шансы противника уклониться от вашей атаки');
insert  into `server_language`(`key`,`text`) values ('mf_contr_m','Мф. контрудара позволяет нанести дополнительный удар по противнику, после того как вы уклонились от его атаки');
insert  into `server_language`(`key`,`text`) values ('mf_parry_m','Мф. парирования позволяет \"угадать\" зону удара противника. Итоговый шанс парирования в бою равен разнице вашего мф. парирования и половины мф. парирования противника');
insert  into `server_language`(`key`,`text`) values ('mf_blockshield_m','Мф. блока щитом позволяет \"угадать\" зону удара противника. Этот модификатор абсолютен.');
insert  into `server_language`(`key`,`text`) values ('mastery_m','Мастерство владения текущим оружием в момент нанесения удара');
insert  into `server_language`(`key`,`text`) values ('mastery','Мастерство:');
insert  into `server_language`(`key`,`text`) values ('mf_uvorot_i','Мф. увертывания:');
insert  into `server_language`(`key`,`text`) values ('mf_antiuvorot_i','Мф. против увертывания:');
insert  into `server_language`(`key`,`text`) values ('mf_contr_i','Мф. контрудара:');
insert  into `server_language`(`key`,`text`) values ('mf_parry_i','Мф. парирования:');
insert  into `server_language`(`key`,`text`) values ('mf_blockshield_i','Мф. блока щитом:');
insert  into `server_language`(`key`,`text`) values ('bar_stat','Характеристики:');
insert  into `server_language`(`key`,`text`) values ('ups','Способности');
insert  into `server_language`(`key`,`text`) values ('skills','Обучение');
insert  into `server_language`(`key`,`text`) values ('unwear_all','Снять всё');
insert  into `server_language`(`key`,`text`) values ('min_stat','Мин. характеристики:');
insert  into `server_language`(`key`,`text`) values ('select_shape','Выбрать этот образ');
insert  into `server_language`(`key`,`text`) values ('magic','Магия:');
insert  into `server_language`(`key`,`text`) values ('weapon','Оружие:');
insert  into `server_language`(`key`,`text`) values ('bar_set','Комплекты:');
insert  into `server_language`(`key`,`text`) values ('NULL','');
insert  into `server_language`(`key`,`text`) values ('shop_weapon','Оружие: ');
insert  into `server_language`(`key`,`text`) values ('shop_dress','Одежда: ');
insert  into `server_language`(`key`,`text`) values ('shop_jewel','Ювелирные товары: ');
insert  into `server_language`(`key`,`text`) values ('whitespace','&nbsp;&nbsp;&nbsp;&nbsp;');
insert  into `server_language`(`key`,`text`) values ('shop_sell','Скупка');
insert  into `server_language`(`key`,`text`) values ('shop_knife','кастеты,ножи');
insert  into `server_language`(`key`,`text`) values ('shop_axe','топоры');
insert  into `server_language`(`key`,`text`) values ('shop_fail','дубины,булавы');
insert  into `server_language`(`key`,`text`) values ('shop_sword','мечи');
insert  into `server_language`(`key`,`text`) values ('shop_staff','магические посохи');
insert  into `server_language`(`key`,`text`) values ('shop_boots','сапоги');
insert  into `server_language`(`key`,`text`) values ('shop_shirt','рубахи');
insert  into `server_language`(`key`,`text`) values ('shop_gloves','перчатки');
insert  into `server_language`(`key`,`text`) values ('shop_light_armor','легкая броня');
insert  into `server_language`(`key`,`text`) values ('shop_heavy_armor','тяжелая броня');
insert  into `server_language`(`key`,`text`) values ('shop_helmet','шлемы');
insert  into `server_language`(`key`,`text`) values ('shop_bracer','наручи');
insert  into `server_language`(`key`,`text`) values ('shop_belt','пояса');
insert  into `server_language`(`key`,`text`) values ('shop_pants','поножи');
insert  into `server_language`(`key`,`text`) values ('shop_shield','Щиты');
insert  into `server_language`(`key`,`text`) values ('shop_earring','серьги');
insert  into `server_language`(`key`,`text`) values ('shop_amulet','ожерелья');
insert  into `server_language`(`key`,`text`) values ('shop_ring','кольца');
insert  into `server_language`(`key`,`text`) values ('shop_scroll','Заклинания');
insert  into `server_language`(`key`,`text`) values ('prof_knight','Рыцарь');
insert  into `server_language`(`key`,`text`) values ('prof_mage','Маг');
insert  into `server_language`(`key`,`text`) values ('prof_trade','Торговец');
insert  into `server_language`(`key`,`text`) values ('prof_monk','Варвар');
insert  into `server_language`(`key`,`text`) values ('prof_elf','Эльф');
insert  into `server_language`(`key`,`text`) values ('bank_1','Вы открыли счет');
insert  into `server_language`(`key`,`text`) values ('bank_2','Вы положили на счет <b>%2$s кр.</b>');
insert  into `server_language`(`key`,`text`) values ('bank_3','Вы сняли со счета <b>%2$s кр.</b>');
insert  into `server_language`(`key`,`text`) values ('bank_4','Вы перевели со счета <b>%2$s кр.</b> на счет <b>#%1$s</b>');
insert  into `server_language`(`key`,`text`) values ('bank_5','Вам перевели <b>%2$s кр.</b> со счета <b>#$h_credit2</b>');
insert  into `server_language`(`key`,`text`) values ('bank_6','Вы обменяли со счета <b>%3$s екр.</b> Вам зачисленно <b>%2$s кр.</b>');
insert  into `server_language`(`key`,`text`) values ('mail_items',' . Передать предметы ');
insert  into `server_language`(`key`,`text`) values ('mail_money',' . Кредиты и Телеграф ');
insert  into `server_language`(`key`,`text`) values ('mail_report',' . Отчет ');
insert  into `server_language`(`key`,`text`) values ('mail_get_mail',' . Получить вещи ');
insert  into `server_language`(`key`,`text`) values ('wins','Побед:');
insert  into `server_language`(`key`,`text`) values ('loses','Поражений:');
insert  into `server_language`(`key`,`text`) values ('draws','Ничьих:');
insert  into `server_language`(`key`,`text`) values ('prof','Профессия:');
insert  into `server_language`(`key`,`text`) values ('money','Деньги:');
insert  into `server_language`(`key`,`text`) values ('exp','Опыт:');
insert  into `server_language`(`key`,`text`) values ('clan','Клан:');
insert  into `server_language`(`key`,`text`) values ('status','Статус:');
insert  into `server_language`(`key`,`text`) values ('fights','Бои:');
insert  into `server_language`(`key`,`text`) values ('bank','Банк:');
insert  into `server_language`(`key`,`text`) values ('sort_by','Выровнять по');
insert  into `server_language`(`key`,`text`) values ('sort_name','названию');
insert  into `server_language`(`key`,`text`) values ('sort_price','цене');
insert  into `server_language`(`key`,`text`) values ('sort_type','типу');
insert  into `server_language`(`key`,`text`) values ('drop_trash','Выбросить хлам');
insert  into `server_language`(`key`,`text`) values ('back_pack','Рюкзак:');
insert  into `server_language`(`key`,`text`) values ('count_items','предметов:');
insert  into `server_language`(`key`,`text`) values ('empty','ПУСТО');
insert  into `server_language`(`key`,`text`) values ('sec_item','Обмундирование');
insert  into `server_language`(`key`,`text`) values ('sec_thing','Заклятия');
insert  into `server_language`(`key`,`text`) values ('sec_elix','Эликсиры');
insert  into `server_language`(`key`,`text`) values ('sec_other','Прочее');
insert  into `server_language`(`key`,`text`) values ('return','Вернуться');
insert  into `server_language`(`key`,`text`) values ('hint','Подсказка');
insert  into `server_language`(`key`,`text`) values ('security','Безопасность');
insert  into `server_language`(`key`,`text`) values ('form','Анкета');
insert  into `server_language`(`key`,`text`) values ('abilities','Умения');
insert  into `server_language`(`key`,`text`) values ('shape','Образ');
insert  into `server_language`(`key`,`text`) values ('shape_choose','Выбрать образ персонажа');
insert  into `server_language`(`key`,`text`) values ('change_pass_mail','Сменить пароль/email');
insert  into `server_language`(`key`,`text`) values ('orden_pal','Паладинский орден');
insert  into `server_language`(`key`,`text`) values ('orden_dark','Армада');
insert  into `server_language`(`key`,`text`) values ('credit_exit','Закончить работу со счётом');
insert  into `server_language`(`key`,`text`) values ('credit_choose','выбрать счёт');
insert  into `server_language`(`key`,`text`) values ('shut_desc','На персонажа наложено заклятие молчания. Будет молчать еще');
insert  into `server_language`(`key`,`text`) values ('set_delete','Удалить комплект');
insert  into `server_language`(`key`,`text`) values ('equip','Надеть');
insert  into `server_language`(`key`,`text`) values ('shop_empty','Прилавок магазина пустой');
insert  into `server_language`(`key`,`text`) values ('shop_no','Это место не является магазином');
insert  into `server_language`(`key`,`text`) values ('mf_dark','Мф. мощности магии Тьмы:');
insert  into `server_language`(`key`,`text`) values ('mf_light','Мф. мощности магии Света:');
insert  into `server_language`(`key`,`text`) values ('mf_gray','Мф. мощности серой магии:');

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

/*Data for the table `thing_book` */

insert  into `thing_book`(`id`,`name`,`img`,`mass`,`price`,`min_intellekt`,`min_vospriyatie`,`min_level`,`add_intellekt`,`add_mana`,`iznos_min`,`iznos_max`,`type`,`mountown`,`orden`,`add_water`,`add_earth`,`add_fire`,`add_air`,`pages`,`desc`) values (1,'Book','helmet/helmet27.gif','11','10','10','10','1','10','10','0','20',NULL,NULL,NULL,'1','1','1','1','1','Nanana');

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

/*Data for the table `thing_scroll` */

insert  into `thing_scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (2,'?????????','icon/magic/attack.gif',1,9,'70',0,7,4,0,5,'','attack.php','','9973','','','','','','','1','','','','','','','','','','','');
insert  into `thing_scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (1,'??????? ?????','icon/magic/lech.gif',1,15,'50',0,8,4,0,5,'','lech.php','','9995','','','','','','','','','','','','','','','','','','');
insert  into `thing_scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (3,'HP 10','icon/magic/10.gif',1,15,'100',0,2,0,0,5,'','cure_hp10.php','','9995','','','','','','','','','','','','','','','','','','air');
insert  into `thing_scroll`(`id`,`name`,`img`,`mass`,`price`,`veroyat`,`min_vospriyatie`,`min_intellekt`,`min_level`,`iznos_min`,`iznos_max`,`mana`,`file`,`orden`,`mountown`,`min_sila2`,`add_arm_l`,`add_arm_m`,`add_arm_h`,`add_water`,`add_air`,`add_earth`,`add_cast`,`add_trade`,`add_cure`,`add_walk`,`min_lovkost2`,`min_udacha2`,`min_power2`,`min_intellekt2`,`min_vospriyatie2`,`min_level2`,`school`) values (4,'HP 25','icon/magic/25.gif',1,15,'100',0,2,0,0,5,'','cure_hp25.php','','9996','','','','','','','','','','','','','','','','','','air');

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

/*Data for the table `thread` */

insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (4,'dsadsa','news','','2007-04-18 21:17:56','hacik','','','0','3','18.04.2007-19:17:56');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (5,'dasd','news','','2007-04-18 21:20:14','Мироздатель','sss','sssss','4','1','18.04.2007-19:20:14');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (6,'dasdsa','relax','','2007-04-18 21:20:39','Мироздатель','sss','sssss','4','1','18.04.2007-19:20:39');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (7,'выфвыф','news','','2007-04-18 21:23:57','Мироздатель','sss','sssss','4','1','18.04.2007-21:23:57');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (8,'dasd','news','','2007-04-18 21:26:32','Мироздатель','sss','sssss','4','1','18.04.2007-21:26:32');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (9,'sa','news','9','2007-04-18 21:40:10','Мироздатель','sss','sssss','4','1','9');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (10,'sas','clan','10','2007-04-18 21:40:43','Мироздатель','sss','sssss','4','1','10');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (11,'sas','clan','11','2007-04-18 21:41:39','Мироздатель','sss','sssss','4','1','11');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (12,'sas','clan','12','2007-04-18 21:41:44','Мироздатель','sss','sssss','4','1','12');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (13,'sas','clan','13','2007-04-18 21:41:51','Мироздатель','sss','sssss','4','1','13');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (14,'sas','clan','14','2007-04-18 21:41:56','Мироздатель','sss','sssss','4','1','14');
insert  into `thread`(`id`,`topic`,`thr`,`topic_id`,`date`,`creator`,`clan`,`clan_s`,`orden`,`level`,`last_post`) values (15,'sas','clan','15','2007-04-18 21:42:12','Мироздатель','sss','sssss','4','1','15');

/*Table structure for table `timeout` */

DROP TABLE IF EXISTS `timeout`;

CREATE TABLE `timeout` (
  `id` int(10) NOT NULL auto_increment,
  `lasthit` varchar(30) NOT NULL default '',
  `creator` varchar(30) NOT NULL default '',
  `battle_id` varchar(30) NOT NULL default '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=cp1251;

/*Data for the table `timeout` */

insert  into `timeout`(`id`,`lasthit`,`creator`,`battle_id`) values (130,'1176904035','','120');

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

/*Data for the table `topics` */

insert  into `topics`(`id`,`last_update`,`fixed`,`cat`,`title`,`icon`,`text`,`date`,`poster`,`p_id`,`p_rank`,`p_tribe`,`p_level`,`p_rase`) values (1175708956,1175708956,0,'Инквизиция','зделанно',0,'1)износ вешей','04.04.07 20:49','hacik',38,100,'test',30,3);
insert  into `topics`(`id`,`last_update`,`fixed`,`cat`,`title`,`icon`,`text`,`date`,`poster`,`p_id`,`p_rank`,`p_tribe`,`p_level`,`p_rase`) values (1176923603,1176923676,0,'main','dsada',0,'dsaddsada','','',0,0,'',0,0);

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

/*Data for the table `zayavka` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
