CREATE TABLE `user_farmacos` (
	`IdUsuario` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	`Login_Usuario` VARCHAR(50) NULL DEFAULT '0',
	`Password_Usuario` VARCHAR(41) NULL DEFAULT '0',
	`Nivel` TINYINT(1) UNSIGNED NULL DEFAULT '1',
	`Mail_usuario` VARCHAR(25) NULL DEFAULT NULL,
	`Nombre_completo` VARCHAR(100) NULL DEFAULT NULL,
	`Empresa` VARCHAR(100) NULL DEFAULT NULL,
	`Fecha_alta` DATE NULL DEFAULT NULL,
	`Fecha_ultimo_login` DATE NULL DEFAULT NULL,
	`Activo` TINYINT(1) UNSIGNED NULL DEFAULT '0',
	PRIMARY KEY (`IdUsuario`)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=9;
