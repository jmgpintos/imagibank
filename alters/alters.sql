/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  José Manuel García Pintos<jmgpintos at gmail.com>
 * Created: 15-dic-2016
 */

--Creación y poblado de tabla usuario Para pruebas
CREATE TABLE `imagibank`.`usuario` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `username` VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, UNIQUE (`username`)) ENGINE = InnoDB;
INSERT INTO  `imagibank`.`usuario` (`id` ,`username` ,`password`)VALUES (NULL ,  'user1',  'sd646f46sf6'), (NULL ,  'user2',  'hj67hgj');
