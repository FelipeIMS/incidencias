/*
Created: 07-02-2022
Modified: 08-02-2022
Model: MySQL 8.0
Database: MySQL 8.0
*/

-- Create tables section -------------------------------------------------

-- Table incidencias

CREATE TABLE `incidencias`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `observacion` Char(150) NOT NULL,
  `fechaInicio` Datetime NOT NULL,
  `fechaFin` Datetime NOT NULL,
  `id_servicio_1` Int NOT NULL,
  `id_area_1` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table servicios

CREATE TABLE `servicios`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `nombres` Char(50) NOT NULL,
  `id_tipoServicio_1` Int NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table tipo_servicio

CREATE TABLE `tipo_servicio`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `nombrets` Char(60) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Table area

CREATE TABLE `area`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `nombreArea` Char(25) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE `servicios` ADD CONSTRAINT `servicio-tipoServicio` FOREIGN KEY (`id_tipoServicio_1`) REFERENCES `tipo_servicio` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `incidencias` ADD CONSTRAINT `incidencias_servicios` FOREIGN KEY (`id_servicio_1`) REFERENCES `servicios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `incidencias` ADD CONSTRAINT `incidencia-area` FOREIGN KEY (`id_area_1`) REFERENCES `area` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

