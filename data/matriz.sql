/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : matriz

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-08-18 16:05:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ciudades
-- ----------------------------
DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE `ciudades` (
  `id_ciudad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estado` int(10) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ciudad`),
  KEY `fk_ciudad_estado` (`id_estado`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ciudades
-- ----------------------------

-- ----------------------------
-- Table structure for contratos
-- ----------------------------
DROP TABLE IF EXISTS `contratos`;
CREATE TABLE `contratos` (
  `id_contrato` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_creacion` int(10) NOT NULL,
  `fecha_modificacion` int(10) NOT NULL,
  `id_afiliador` varchar(50) NOT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT '1' COMMENT '1-activo, 2-inactivo,3-vencido,0-anulado',
  `modificado_identificacion` varchar(50) NOT NULL,
  `modificado_nombre` varchar(100) NOT NULL,
  `id_persona` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of contratos
-- ----------------------------
INSERT INTO `contratos` VALUES ('1', '1408336200', '1408336200', '1', '1', '1408336200', 'Angel Gonzalez', '1');

-- ----------------------------
-- Table structure for estado
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `id_estado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `id_pais` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_estado`),
  UNIQUE KEY `in_nombre` (`nombre`) USING BTREE,
  KEY `fk_pais_estados` (`id_pais`) USING BTREE,
  CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of estado
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_acceso` int(10) unsigned NOT NULL,
  `id` varchar(20) NOT NULL,
  `clase` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `target` varchar(20) NOT NULL,
  `orden` int(2) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '0.- Menu principal, # de id para sub menu del id.',
  `session` int(1) NOT NULL COMMENT '0: desabilitado, 1: solo no session, 2: session y no session, 3: solo session.',
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `orden` (`orden`,`tipo`) USING BTREE,
  KEY `fk_menu_acceso` (`id_acceso`) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_acceso`) REFERENCES `usuarios_accesos` (`id_acceso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '1', 'menu_afiliar', 'dropdown', 'Afiliar', 'afiliar.php', '', '1', '0', '1');

-- ----------------------------
-- Table structure for pais
-- ----------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `id_pais` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pais`),
  UNIQUE KEY `nombre` (`nombre`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of pais
-- ----------------------------

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id_persona` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estado` int(10) unsigned DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` int(10) DEFAULT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `id_ciudad` int(10) unsigned DEFAULT NULL,
  `identificacion` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `creado` varchar(100) NOT NULL,
  `modificado` varchar(100) NOT NULL,
  `fecha_creacion` int(12) NOT NULL,
  `fecha_modificacion` int(12) NOT NULL,
  `id_pais` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `in_identificacion` (`identificacion`) USING BTREE,
  KEY `fk_persona_id_ciudad` (`id_ciudad`) USING BTREE,
  KEY `fk_persona_id_estado` (`id_estado`) USING BTREE,
  KEY `pais_persona` (`id_pais`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', '1', 'Angel', 'Gonzalez', null, 'prueba', '12345', '2', '16595338', 'angeledugo@gmail.com', '16595338', '16595338', '1408336200', '1408336200', '3');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_persona` int(10) unsigned NOT NULL,
  `id_grupo` int(10) unsigned NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(32) NOT NULL,
  `fecha_registro` int(12) NOT NULL,
  `ultima_entrada` int(10) NOT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT '1' COMMENT '1:activo, 2:inactivo, 3:contrato_vencido',
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `in_usuario` (`usuario`) USING BTREE,
  KEY `fk_usuarios_id_grupo` (`id_grupo`) USING BTREE,
  KEY `id_persona` (`id_persona`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', '1', 'angeledugo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1408336200', '1408372542', '1');

-- ----------------------------
-- Table structure for usuarios_accesos
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_accesos`;
CREATE TABLE `usuarios_accesos` (
  `id_acceso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `seguridad` int(4) NOT NULL,
  PRIMARY KEY (`id_acceso`),
  UNIQUE KEY `in_nombre` (`nombre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios_accesos
-- ----------------------------
INSERT INTO `usuarios_accesos` VALUES ('1', 'afiliar', '2211');

-- ----------------------------
-- Table structure for usuarios_config
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_config`;
CREATE TABLE `usuarios_config` (
  `id_persona` int(10) unsigned NOT NULL,
  `nivel_actual` int(10) NOT NULL,
  `datos_actualizados` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios_config
-- ----------------------------
INSERT INTO `usuarios_config` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for usuarios_grupos
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_grupos`;
CREATE TABLE `usuarios_grupos` (
  `id_grupo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_grupo`),
  UNIQUE KEY `in_nombre` (`nombre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios_grupos
-- ----------------------------
INSERT INTO `usuarios_grupos` VALUES ('1', 'Afiliado');

-- ----------------------------
-- Table structure for usuarios_grupos_permisos
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_grupos_permisos`;
CREATE TABLE `usuarios_grupos_permisos` (
  `id_grupo` int(10) unsigned NOT NULL,
  `id_acceso` int(10) unsigned NOT NULL,
  `seguridad` int(4) NOT NULL,
  PRIMARY KEY (`id_grupo`,`id_acceso`),
  KEY `fk_grupo_permisos-acceso` (`id_acceso`) USING BTREE,
  CONSTRAINT `usuarios_grupos_permisos_ibfk_1` FOREIGN KEY (`id_acceso`) REFERENCES `usuarios_accesos` (`id_acceso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_grupos_permisos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `usuarios_grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios_grupos_permisos
-- ----------------------------
INSERT INTO `usuarios_grupos_permisos` VALUES ('1', '1', '2211');

-- ----------------------------
-- View structure for vmenu
-- ----------------------------
DROP VIEW IF EXISTS `vmenu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `vmenu` AS SELECT
	`menu`.`id_menu` AS `id_menu`,
	`usuarios_grupos`.`id_grupo` AS `id_grupo`,
	`usuarios_accesos`.`id_acceso` AS `id_acceso`,
	`usuarios_grupos`.`nombre` AS `grupo`,
	`usuarios_grupos_permisos`.`seguridad` AS `grupo_seguridad`,
	`usuarios_accesos`.`nombre` AS `acceso`,
	`usuarios_accesos`.`seguridad` AS `acceso_seguridad`,
	`menu`.`id` AS `id`,
	`menu`.`clase` AS `clase`,
	`menu`.`nombre` AS `nombre`,
	`menu`.`url` AS `url`,
	`menu`.`orden` AS `orden`,
	`menu`.`tipo` AS `tipo`,
	`menu`.`session` AS `session`,
	`menu`.`target` AS `target`
FROM
	(
		(
			(
				`menu`
				JOIN `usuarios_grupos_permisos` ON (
					(
						`menu`.`id_acceso` = `usuarios_grupos_permisos`.`id_acceso`
					)
				)
			)
			JOIN `usuarios_grupos` ON (
				(
					`usuarios_grupos_permisos`.`id_grupo` = `usuarios_grupos`.`id_grupo`
				)
			)
		)
		JOIN `usuarios_accesos` ON (
			(
				`usuarios_grupos_permisos`.`id_acceso` = `usuarios_accesos`.`id_acceso`
			)
		)
	) ;

-- ----------------------------
-- View structure for v_usuarios
-- ----------------------------
DROP VIEW IF EXISTS `v_usuarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_usuarios` AS SELECT
	`personas`.`id_persona` AS `id_persona`,
	`usuarios_grupos`.`id_grupo` AS `id_grupo`,
	`personas`.`identificacion` AS `identificacion`,
	`personas`.`nombre` AS `nombre`,
	`personas`.`apellido` AS `apellido`,
	`usuarios_grupos`.`nombre` AS `grupo`,
	`usuarios`.`usuario` AS `usuario`,
	`usuarios`.`clave` AS `clave`,
	`usuarios`.`ultima_entrada` AS `ultima_entrada`,
	`usuarios_config`.`nivel_actual` AS `nivel_actual`,
	`usuarios_config`.`datos_actualizados` AS `datos_actualizados`,
	`usuarios`.`estatus` AS `estatus`,
	`personas`.`correo` AS `correo`
FROM
	(
		(
			(
				`usuarios`
				JOIN `usuarios_grupos` ON (
					(
						`usuarios`.`id_grupo` = `usuarios_grupos`.`id_grupo`
					)
				)
			)
			JOIN `personas` ON (
				(
					`usuarios`.`id_persona` = `personas`.`id_persona`
				)
			)
		)
		LEFT JOIN `usuarios_config` ON (
			(
				`personas`.`id_persona` = `usuarios_config`.`id_persona`
			)
		)
	) ;
