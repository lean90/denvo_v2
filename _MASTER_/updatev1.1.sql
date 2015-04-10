ALTER TABLE `dento`.`t_questions`   
  ADD COLUMN `attached_img_1` INT NULL AFTER `question_type`,
  ADD COLUMN `attached_img_2` INT NULL AFTER `attached_img_1`,
  ADD COLUMN `attached_img_3` INT NULL AFTER `attached_img_2`,
  ADD COLUMN `q_status` INT NULL  COMMENT '0:pendding,1:show,-1:reject' AFTER `attached_img_3`,
  ADD FOREIGN KEY (`attached_img_1`) REFERENCES `dento`.`t_file`(`id`),
  ADD FOREIGN KEY (`attached_img_2`) REFERENCES `dento`.`t_file`(`id`),
  ADD FOREIGN KEY (`attached_img_3`) REFERENCES `dento`.`t_file`(`id`);
  
ALTER TABLE `dento`.`t_questions`   
  DROP INDEX `attached_img_1`,
  DROP INDEX `attached_img_2`,
  DROP INDEX `attached_img_3`,
  DROP FOREIGN KEY `t_questions_ibfk_1`,
  DROP FOREIGN KEY `t_questions_ibfk_2`,
  DROP FOREIGN KEY `t_questions_ibfk_3`;

ALTER TABLE `dento`.`t_questions`   
  CHANGE `attached_img_1` `attached_img_1` TEXT NULL,
  CHANGE `attached_img_2` `attached_img_2` TEXT NULL,
  CHANGE `attached_img_3` `attached_img_3` TEXT NULL;