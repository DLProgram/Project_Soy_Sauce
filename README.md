# 211 Scouting System
## Code name Soy Sauce

### Dependencies
1. Apache, PHP, MySQL Stack
   * [WAMP for Windows users](www.wampserver.com)
   * [MAMP for Mac users](www.mamp.info)
2. Zurb Foundation Web Framework

###MySQL User
Login credentials are stored in **connect.php**.

Create a user named **scouter** with password **password** and grant all privileges to the **scouting_system** database.

### MySQL Tables
1.user
```sql
CREATE TABLE `scouting_system`.`user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);
```
2.match_data
```sql
CREATE TABLE `scouting_system`.`match_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `match_num` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `match_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `blue1` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `blue2` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `red1` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `red2` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);
```
3.submitted_result
```sql
CREATE TABLE `scouting_system`.`submitted_result` (
  `id` int(10) NOT NULL AUTO_INCREMENT ,
  `match_num` int(5) NOT NULL,
  `color` varchar(5) NOT NULL,
  `auto_star_enable1` tinyint(1) NOT NULL,
  `auto_star_range1` tinyint(1) NOT NULL,
  `auto_cube_enable1` tinyint(1) NOT NULL,
  `auto_cube_range1` tinyint(1) NOT NULL,
  `auto_lift1` tinyint(1) NOT NULL,
  `auto_star_enable2` tinyint(1) NOT NULL,
  `auto_star_range2` tinyint(1) NOT NULL,
  `auto_cube_enable2` tinyint(1) NOT NULL,
  `auto_cube_range2` tinyint(1) NOT NULL,
  `auto_lift2` tinyint(1) NOT NULL,
  `auto` int(5) NOT NULL,
  `drive_star_enable1` tinyint(1) NOT NULL,
  `drive_star_range1` tinyint(1) NOT NULL,
  `drive_cube_enable1` tinyint(1) NOT NULL,
  `drive_cube_range1` tinyint(1) NOT NULL,
  `drive_lift1` tinyint(1) NOT NULL,
  `drive_star_enable2` tinyint(1) NOT NULL,
  `drive_star_range2` tinyint(1) NOT NULL,
  `drive_cube_enable2` tinyint(1) NOT NULL,
  `drive_cube_range2` tinyint(1) NOT NULL,
  `drive_lift2` tinyint(1) NOT NULL,
  `drive` int(5) NOT NULL,
  PRIMARY KEY (`id`)
);
```
4.checked_result
```sql
CREATE TABLE `scouting_system`.`checked_result` (
  `id` int(10) NOT NULL AUTO_INCREMENT ,
  `team_name` varchar(10) NOT NULL,
  `auto_star_enable` tinyint(1) NOT NULL,
  `auto_star_range` tinyint(1) NOT NULL,
  `auto_cube_enable` tinyint(1) NOT NULL,
  `auto_cube_range` tinyint(1) NOT NULL,
  `auto_lift1` inyint(1) NOT NULL,
  `auto` int(5) NOT NULL,
  `drive_star_enable` tinyint(1) NOT NULL,
  `drive_star_range` tinyint(1) NOT NULL,
  `drive_cube_enable` tinyint(1) NOT NULL,
  `drive_cube_range` tinyint(1) NOT NULL,
  `drive_lift` tinyint(1) NOT NULL,
  `drive` int(5) NOT NULL,
  PRIMARY KEY (`id`)
);
```
