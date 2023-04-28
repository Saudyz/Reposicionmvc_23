CREATE TABLE `nw202301`.`Carros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bin` VARCHAR(45),
  `placaCarro` VARCHAR(45) NULL,
  `modeloCarro` VARCHAR(45) NULL,
  `anoCarro` int Default NULL,
  PRIMARY KEY (`id`));
