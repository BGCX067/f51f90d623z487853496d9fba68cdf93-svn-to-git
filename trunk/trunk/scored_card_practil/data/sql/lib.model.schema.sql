
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- periodo_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `periodo_sc`;


CREATE TABLE `periodo_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(100)  NOT NULL,
	`flag` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_sc`;


CREATE TABLE `user_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(50),
	`profile` INTEGER,
	`password` VARCHAR(50),
	`created_at` DATETIME,
	`flag` TEXT,
	`token_session` TEXT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tree_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tree_sc`;


CREATE TABLE `tree_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` TEXT,
	`descripcion` TEXT,
	`user_id` INTEGER  NOT NULL,
	`grupo_trabajo_id` INTEGER,
	`periodo_id` INTEGER,
	`responsable_id` INTEGER,
	`email_responsable` VARCHAR(50),
	`valor_minimo` INTEGER,
	`valor_deseado` INTEGER,
	`configure_flag` TEXT,
	`flag` TEXT,
	`create_at` DATETIME,
	`update_at` DATETIME,
	`configure_design` TEXT,
	`produccion` TEXT,
	PRIMARY KEY (`id`),
	INDEX `tree_sc_FI_1` (`user_id`),
	CONSTRAINT `tree_sc_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user_sc` (`id`),
	INDEX `tree_sc_FI_2` (`grupo_trabajo_id`),
	CONSTRAINT `tree_sc_FK_2`
		FOREIGN KEY (`grupo_trabajo_id`)
		REFERENCES `grupo_trabajo_sc` (`id`),
	INDEX `tree_sc_FI_3` (`periodo_id`),
	CONSTRAINT `tree_sc_FK_3`
		FOREIGN KEY (`periodo_id`)
		REFERENCES `periodo_sc` (`id`),
	INDEX `tree_sc_FI_4` (`responsable_id`),
	CONSTRAINT `tree_sc_FK_4`
		FOREIGN KEY (`responsable_id`)
		REFERENCES `user_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tree_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tree_user`;


CREATE TABLE `tree_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`tree_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `tree_user_FI_1` (`user_id`),
	CONSTRAINT `tree_user_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user_sc` (`id`),
	INDEX `tree_user_FI_2` (`tree_id`),
	CONSTRAINT `tree_user_FK_2`
		FOREIGN KEY (`tree_id`)
		REFERENCES `tree_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- indicators_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `indicators_sc`;


CREATE TABLE `indicators_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`titulo` VARCHAR(250)  NOT NULL,
	`descripcion` TEXT,
	`valor_minimo` INTEGER,
	`valor_deseado` INTEGER,
	`valor_optimo` INTEGER,
	`responsable_id` INTEGER,
	`tree_id` INTEGER  NOT NULL,
	`previous_id` INTEGER,
	`parents` TEXT,
	`indicadores_hijos_configure` TEXT,
	`ultimo_nodo` VARCHAR(5),
	`valor_actual_entregado` INTEGER,
	`conectores_configure` TEXT,
	`owner_indicadores` TEXT,
	`email_responsable` VARCHAR(50),
	`flag` TEXT,
	PRIMARY KEY (`id`),
	INDEX `indicators_sc_FI_1` (`responsable_id`),
	CONSTRAINT `indicators_sc_FK_1`
		FOREIGN KEY (`responsable_id`)
		REFERENCES `user_sc` (`id`),
	INDEX `indicators_sc_FI_2` (`tree_id`),
	CONSTRAINT `indicators_sc_FK_2`
		FOREIGN KEY (`tree_id`)
		REFERENCES `tree_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- grupo_trabajo_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo_trabajo_sc`;


CREATE TABLE `grupo_trabajo_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(250)  NOT NULL,
	`owner_id` INTEGER  NOT NULL,
	`flag` TEXT,
	`create_at` DATETIME,
	`update_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `grupo_trabajo_sc_FI_1` (`owner_id`),
	CONSTRAINT `grupo_trabajo_sc_FK_1`
		FOREIGN KEY (`owner_id`)
		REFERENCES `user_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- detalle_grupo_trabajo_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `detalle_grupo_trabajo_sc`;


CREATE TABLE `detalle_grupo_trabajo_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(50)  NOT NULL,
	`user_id` INTEGER,
	`grupo_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `detalle_grupo_trabajo_sc_FI_1` (`user_id`),
	CONSTRAINT `detalle_grupo_trabajo_sc_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user_sc` (`id`),
	INDEX `detalle_grupo_trabajo_sc_FI_2` (`grupo_id`),
	CONSTRAINT `detalle_grupo_trabajo_sc_FK_2`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo_trabajo_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- solicitud_grupo_trabajo_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `solicitud_grupo_trabajo_sc`;


CREATE TABLE `solicitud_grupo_trabajo_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`grupo_id` INTEGER,
	`email` VARCHAR(50)  NOT NULL,
	`create_at` DATETIME,
	`update_at` DATETIME,
	`user_id` INTEGER,
	`token` TEXT,
	`flag` TEXT,
	`respondido` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `solicitud_grupo_trabajo_sc_FI_1` (`grupo_id`),
	CONSTRAINT `solicitud_grupo_trabajo_sc_FK_1`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo_trabajo_sc` (`id`),
	INDEX `solicitud_grupo_trabajo_sc_FI_2` (`user_id`),
	CONSTRAINT `solicitud_grupo_trabajo_sc_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- asignacion_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `asignacion_sc`;


CREATE TABLE `asignacion_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`grupo_id` INTEGER,
	`email` VARCHAR(50)  NOT NULL,
	`tree_id` INTEGER  NOT NULL,
	`indicador_id` INTEGER  NOT NULL,
	`flag` TEXT,
	`user_id` INTEGER,
	`create_at` DATETIME,
	`update_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `asignacion_sc_FI_1` (`grupo_id`),
	CONSTRAINT `asignacion_sc_FK_1`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo_trabajo_sc` (`id`),
	INDEX `asignacion_sc_FI_2` (`tree_id`),
	CONSTRAINT `asignacion_sc_FK_2`
		FOREIGN KEY (`tree_id`)
		REFERENCES `tree_sc` (`id`),
	INDEX `asignacion_sc_FI_3` (`indicador_id`),
	CONSTRAINT `asignacion_sc_FK_3`
		FOREIGN KEY (`indicador_id`)
		REFERENCES `indicators_sc` (`id`),
	INDEX `asignacion_sc_FI_4` (`user_id`),
	CONSTRAINT `asignacion_sc_FK_4`
		FOREIGN KEY (`user_id`)
		REFERENCES `user_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- group_data_indicadores
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `group_data_indicadores`;


CREATE TABLE `group_data_indicadores`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`create_at` DATETIME,
	`periodo_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `group_data_indicadores_FI_1` (`periodo_id`),
	CONSTRAINT `group_data_indicadores_FK_1`
		FOREIGN KEY (`periodo_id`)
		REFERENCES `periodo_sc` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- data_indicadores
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `data_indicadores`;


CREATE TABLE `data_indicadores`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`indicador_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`data` INTEGER  NOT NULL,
	`group_data` INTEGER  NOT NULL,
	`create_at` DATETIME,
	`update_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `data_indicadores_FI_1` (`indicador_id`),
	CONSTRAINT `data_indicadores_FK_1`
		FOREIGN KEY (`indicador_id`)
		REFERENCES `indicators_sc` (`id`),
	INDEX `data_indicadores_FI_2` (`user_id`),
	CONSTRAINT `data_indicadores_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user_sc` (`id`),
	INDEX `data_indicadores_FI_3` (`group_data`),
	CONSTRAINT `data_indicadores_FK_3`
		FOREIGN KEY (`group_data`)
		REFERENCES `group_data_indicadores` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- audit_data_indicadores
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `audit_data_indicadores`;


CREATE TABLE `audit_data_indicadores`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`indicador_id` INTEGER  NOT NULL,
	`data` INTEGER  NOT NULL,
	`create_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `audit_data_indicadores_FI_1` (`indicador_id`),
	CONSTRAINT `audit_data_indicadores_FK_1`
		FOREIGN KEY (`indicador_id`)
		REFERENCES `data_indicadores` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tmp_tree_sc
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tmp_tree_sc`;


CREATE TABLE `tmp_tree_sc`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`valor_minimo` INTEGER,
	`valor_deseado` INTEGER,
	`configure_flag` TEXT,
	`flag` VARCHAR(5),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tmp_data_reports
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tmp_data_reports`;


CREATE TABLE `tmp_data_reports`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`indicador_id` INTEGER,
	`valor_minimo` INTEGER,
	`valor_deseado` INTEGER,
	`valor_optimo` INTEGER,
	`tree_id` INTEGER  NOT NULL,
	`previous_id` INTEGER,
	`parents` TEXT,
	`indicadores_hijos_configure` TEXT,
	`ultimo_nodo` VARCHAR(5),
	`data` INTEGER,
	`conectores_configure` TEXT,
	`update_at` DATETIME,
	`flag` VARCHAR(5),
	PRIMARY KEY (`id`),
	INDEX `tmp_data_reports_FI_1` (`tree_id`),
	CONSTRAINT `tmp_data_reports_FK_1`
		FOREIGN KEY (`tree_id`)
		REFERENCES `tmp_tree_sc` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
