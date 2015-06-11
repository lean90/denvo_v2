ALTER TABLE `dento`.`t_teeth_grow` CHANGE `delete` `delete` TINYINT(1) DEFAULT 0  NULL;
UPDATE `t_teeth_grow` SET `delete` = 0;