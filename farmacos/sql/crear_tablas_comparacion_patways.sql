
CREATE TABLE `f_fda_temp` (
	`IdUsuario` SMALLINT(6) NOT NULL,
	`id_farmaco` MEDIUMINT(9) NOT NULL,
	`id_pathway` MEDIUMINT(11) NOT NULL,
	`pw_activo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`IdUsuario`, `id_farmaco`, `id_pathway`)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM;
CREATE TABLE `f_inv_temp` (
	`IdUsuario` SMALLINT(6) NOT NULL,
	`id_farmaco` MEDIUMINT(9) NOT NULL,
	`id_pathway` MEDIUMINT(11) NOT NULL,
	`pw_activo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`IdUsuario`, `id_farmaco`, `id_pathway`)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM;
