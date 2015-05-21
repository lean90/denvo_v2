ALTER TABLE `t_questions`   
  ADD COLUMN `attached_img_1` INT NULL AFTER `question_type`,
  ADD COLUMN `attached_img_2` INT NULL AFTER `attached_img_1`,
  ADD COLUMN `attached_img_3` INT NULL AFTER `attached_img_2`,
  ADD COLUMN `q_status` INT NULL  COMMENT '0:pendding,1:show,-1:reject' AFTER `attached_img_3`,
  ADD FOREIGN KEY (`attached_img_1`) REFERENCES `t_file`(`id`),
  ADD FOREIGN KEY (`attached_img_2`) REFERENCES `t_file`(`id`),
  ADD FOREIGN KEY (`attached_img_3`) REFERENCES `t_file`(`id`);
  
ALTER TABLE `t_questions`   
  DROP INDEX `attached_img_1`,
  DROP INDEX `attached_img_2`,
  DROP INDEX `attached_img_3`,
  DROP FOREIGN KEY `t_questions_ibfk_1`,
  DROP FOREIGN KEY `t_questions_ibfk_2`,
  DROP FOREIGN KEY `t_questions_ibfk_3`;

ALTER TABLE `t_questions`   
  CHANGE `attached_img_1` `attached_img_1` TEXT NULL,
  CHANGE `attached_img_2` `attached_img_2` TEXT NULL,
  CHANGE `attached_img_3` `attached_img_3` TEXT NULL;

CREATE TABLE `t_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_category` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_link` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `delete` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category_id` (`fk_category`),
  CONSTRAINT `t_position_ibfk_1` FOREIGN KEY (`fk_category`) REFERENCES `t_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `t_category`   
  CHANGE `part_url` `part_url` TEXT NOT NULL  COMMENT 'chứa đường dẫn khi query'
  DROP INDEX `part_url`;
  
ALTER `t_position`   
  ADD COLUMN `postion_type` VARCHAR(127) NULL  COMMENT 'PHONG-KHAM' AFTER `id`;

ALTER TABLE `t_position`
  CHANGE `postion_type` `position_type` VARCHAR(127) CHARSET utf8 COLLATE utf8_unicode_ci NULL  COMMENT 'PHONG-KHAM';
ALTER TABLE `t_position`   
  ADD COLUMN `img1` TEXT NULL AFTER `website_link`,
  ADD COLUMN `img2` TEXT NULL AFTER `img1`,
  ADD COLUMN `img3` TEXT NULL AFTER `img2`,
  ADD COLUMN `img4` TEXT NULL AFTER `img3`;
ALTER TABLE `t_position`   
  ADD COLUMN `sort_description` TEXT NULL AFTER `name`;
ALTER TABLE `t_position`   
  ADD COLUMN `detail_address` TEXT NULL AFTER `name`;
ALTER TABLE `t_position`   
  ADD COLUMN `hotline` VARBINARY(255) NULL AFTER `website_link`;
ALTER TABLE `t_position`   
  ADD COLUMN `logo` TEXT NULL AFTER `hotline`;
ALTER TABLE `t_position`   
  ADD COLUMN `like_number` INT(11) DEFAULT 0  NULL AFTER `img4`;
ALTER TABLE `t_position`   
  ADD COLUMN `email` VARCHAR(255) NULL AFTER `hotline`;
ALTER TABLE `t_position`   
  CHANGE `position_type` `position_type` VARCHAR(127) CHARSET utf8 COLLATE utf8_unicode_ci NULL  COMMENT '\'PHONG-KHAM\',\'CO-SO-VLNK\',\'LABO\'';
ALTER TABLE `t_position`   
  ADD COLUMN `working_time` VARBINARY(255) NULL AFTER `like_number`;

insert into `t_category` (`id`,`category_id`,`part_url`,`name`,`visible`,`part_tree`,`order`,`category_type`,`created_at`,`deleted_at`,`delete`) 
values
(46,NULL,'/phong-kham','Phòng khám',1,'46',0,'STATIC','2014-07-21 20:06:35',NULL,0),
(154,46,'/phong-kham/Ha-Noi','Hà Nội',1,'46,154',1,'POST','2015-05-07 17:17:52',NULL,0);










