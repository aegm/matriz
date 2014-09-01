/*
Navicat MySQL Data Transfer

Source Server         : matriz
Source Server Version : 50168
Source Host           : mysql500.ixwebhosting.com:3306
Source Database       : C243473_matriz

Target Server Type    : MYSQL
Target Server Version : 50168
File Encoding         : 65001

Date: 2014-09-01 14:21:32
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
-- Table structure for config_matrix
-- ----------------------------
DROP TABLE IF EXISTS `config_matrix`;
CREATE TABLE `config_matrix` (
  `id_matrix` int(11) NOT NULL,
  `valor1` varchar(50) DEFAULT NULL,
  `valor2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_matrix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config_matrix
-- ----------------------------
INSERT INTO `config_matrix` VALUES ('1', '2', '2');

-- ----------------------------
-- Table structure for contratos
-- ----------------------------
DROP TABLE IF EXISTS `contratos`;
CREATE TABLE `contratos` (
  `id_contrato` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_creacion` int(10) NOT NULL,
  `id_afiliador` varchar(50) NOT NULL,
  `id_persona` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of contratos
-- ----------------------------
INSERT INTO `contratos` VALUES ('1', '1408336200', '1', '1');
INSERT INTO `contratos` VALUES ('62', '1408825066', '1', '61');
INSERT INTO `contratos` VALUES ('71', '1409100583', '', '76');
INSERT INTO `contratos` VALUES ('72', '1409150871', '', '77');
INSERT INTO `contratos` VALUES ('73', '1409151282', '', '78');
INSERT INTO `contratos` VALUES ('74', '1409363795', '', '0');

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
  KEY `fk_pais_estados` (`id_pais`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of estado
-- ----------------------------

-- ----------------------------
-- Table structure for linea
-- ----------------------------
DROP TABLE IF EXISTS `linea`;
CREATE TABLE `linea` (
  `id` int(10) NOT NULL,
  `id_usuario` int(10) DEFAULT NULL,
  `tamaño` int(10) DEFAULT NULL,
  `linea` int(10) DEFAULT NULL,
  `position` int(10) DEFAULT NULL,
  `id_matrix` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of linea
-- ----------------------------
INSERT INTO `linea` VALUES ('1', '1', '1', '0', '1', '1');
INSERT INTO `linea` VALUES ('2', '61', '2', '1', '2', '1');

-- ----------------------------
-- Table structure for matrix
-- ----------------------------
DROP TABLE IF EXISTS `matrix`;
CREATE TABLE `matrix` (
  `id` int(10) NOT NULL,
  `id_config_matrix` int(10) DEFAULT NULL,
  `position` int(10) DEFAULT NULL,
  `id_usuario` int(10) DEFAULT NULL,
  `estatus` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matrix
-- ----------------------------
INSERT INTO `matrix` VALUES ('1', '1', '1', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('4', '4', 'menu_profile', '', 'Mi Perfil', 'afiliado/profile.php', '', '1', '0', '1');
INSERT INTO `menu` VALUES ('5', '5', 'menu_network', '', 'Red', 'afiliado/network.php', '', '4', '0', '1');
INSERT INTO `menu` VALUES ('6', '6', 'menu_support', '', 'Apoyo', 'afiliado/support.php', '', '5', '0', '1');

-- ----------------------------
-- Table structure for pais
-- ----------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `PAI_ISONUM` smallint(6) DEFAULT NULL,
  `PAI_ISO2` char(2) DEFAULT NULL,
  `PAI_ISO3` char(3) DEFAULT NULL,
  `PAI_NOMBRE` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pais
-- ----------------------------
INSERT INTO `pais` VALUES ('1', '4', 'AF', 'AFG', 'Afganistán');
INSERT INTO `pais` VALUES ('2', '248', 'AX', 'ALA', 'Islas Gland');
INSERT INTO `pais` VALUES ('3', '8', 'AL', 'ALB', 'Albania');
INSERT INTO `pais` VALUES ('4', '276', 'DE', 'DEU', 'Alemania');
INSERT INTO `pais` VALUES ('5', '20', 'AD', 'AND', 'Andorra');
INSERT INTO `pais` VALUES ('6', '24', 'AO', 'AGO', 'Angola');
INSERT INTO `pais` VALUES ('7', '660', 'AI', 'AIA', 'Anguilla');
INSERT INTO `pais` VALUES ('8', '10', 'AQ', 'ATA', 'Antártida');
INSERT INTO `pais` VALUES ('9', '28', 'AG', 'ATG', 'Antigua y Barbuda');
INSERT INTO `pais` VALUES ('10', '530', 'AN', 'ANT', 'Antillas Holandesas');
INSERT INTO `pais` VALUES ('11', '682', 'SA', 'SAU', 'Arabia Saudí');
INSERT INTO `pais` VALUES ('12', '12', 'DZ', 'DZA', 'Argelia');
INSERT INTO `pais` VALUES ('13', '32', 'AR', 'ARG', 'Argentina');
INSERT INTO `pais` VALUES ('14', '51', 'AM', 'ARM', 'Armenia');
INSERT INTO `pais` VALUES ('15', '533', 'AW', 'ABW', 'Aruba');
INSERT INTO `pais` VALUES ('16', '36', 'AU', 'AUS', 'Australia');
INSERT INTO `pais` VALUES ('17', '40', 'AT', 'AUT', 'Austria');
INSERT INTO `pais` VALUES ('18', '31', 'AZ', 'AZE', 'Azerbaiyán');
INSERT INTO `pais` VALUES ('19', '44', 'BS', 'BHS', 'Bahamas');
INSERT INTO `pais` VALUES ('20', '48', 'BH', 'BHR', 'Bahréin');
INSERT INTO `pais` VALUES ('21', '50', 'BD', 'BGD', 'Bangladesh');
INSERT INTO `pais` VALUES ('22', '52', 'BB', 'BRB', 'Barbados');
INSERT INTO `pais` VALUES ('23', '112', 'BY', 'BLR', 'Bielorrusia');
INSERT INTO `pais` VALUES ('24', '56', 'BE', 'BEL', 'Bélgica');
INSERT INTO `pais` VALUES ('25', '84', 'BZ', 'BLZ', 'Belice');
INSERT INTO `pais` VALUES ('26', '204', 'BJ', 'BEN', 'Benin');
INSERT INTO `pais` VALUES ('27', '60', 'BM', 'BMU', 'Bermudas');
INSERT INTO `pais` VALUES ('28', '64', 'BT', 'BTN', 'Bhután');
INSERT INTO `pais` VALUES ('29', '68', 'BO', 'BOL', 'Bolivia');
INSERT INTO `pais` VALUES ('30', '70', 'BA', 'BIH', 'Bosnia y Herzegovina');
INSERT INTO `pais` VALUES ('31', '72', 'BW', 'BWA', 'Botsuana');
INSERT INTO `pais` VALUES ('32', '74', 'BV', 'BVT', 'Isla Bouvet');
INSERT INTO `pais` VALUES ('33', '76', 'BR', 'BRA', 'Brasil');
INSERT INTO `pais` VALUES ('34', '96', 'BN', 'BRN', 'Brunéi');
INSERT INTO `pais` VALUES ('35', '100', 'BG', 'BGR', 'Bulgaria');
INSERT INTO `pais` VALUES ('36', '854', 'BF', 'BFA', 'Burkina Faso');
INSERT INTO `pais` VALUES ('37', '108', 'BI', 'BDI', 'Burundi');
INSERT INTO `pais` VALUES ('38', '132', 'CV', 'CPV', 'Cabo Verde');
INSERT INTO `pais` VALUES ('39', '136', 'KY', 'CYM', 'Islas Caimán');
INSERT INTO `pais` VALUES ('40', '116', 'KH', 'KHM', 'Camboya');
INSERT INTO `pais` VALUES ('41', '120', 'CM', 'CMR', 'Camerún');
INSERT INTO `pais` VALUES ('42', '124', 'CA', 'CAN', 'Canadá');
INSERT INTO `pais` VALUES ('43', '140', 'CF', 'CAF', 'República Centroafricana');
INSERT INTO `pais` VALUES ('44', '148', 'TD', 'TCD', 'Chad');
INSERT INTO `pais` VALUES ('45', '203', 'CZ', 'CZE', 'República Checa');
INSERT INTO `pais` VALUES ('46', '152', 'CL', 'CHL', 'Chile');
INSERT INTO `pais` VALUES ('47', '156', 'CN', 'CHN', 'China');
INSERT INTO `pais` VALUES ('48', '196', 'CY', 'CYP', 'Chipre');
INSERT INTO `pais` VALUES ('49', '162', 'CX', 'CXR', 'Isla de Navidad');
INSERT INTO `pais` VALUES ('50', '336', 'VA', 'VAT', 'Ciudad del Vaticano');
INSERT INTO `pais` VALUES ('51', '166', 'CC', 'CCK', 'Islas Cocos');
INSERT INTO `pais` VALUES ('52', '170', 'CO', 'COL', 'Colombia');
INSERT INTO `pais` VALUES ('53', '174', 'KM', 'COM', 'Comoras');
INSERT INTO `pais` VALUES ('54', '180', 'CD', 'COD', 'República Democrática del Congo');
INSERT INTO `pais` VALUES ('55', '178', 'CG', 'COG', 'Congo');
INSERT INTO `pais` VALUES ('56', '184', 'CK', 'COK', 'Islas Cook');
INSERT INTO `pais` VALUES ('57', '408', 'KP', 'PRK', 'Corea del Norte');
INSERT INTO `pais` VALUES ('58', '410', 'KR', 'KOR', 'Corea del Sur');
INSERT INTO `pais` VALUES ('59', '384', 'CI', 'CIV', 'Costa de Marfil');
INSERT INTO `pais` VALUES ('60', '188', 'CR', 'CRI', 'Costa Rica');
INSERT INTO `pais` VALUES ('61', '191', 'HR', 'HRV', 'Croacia');
INSERT INTO `pais` VALUES ('62', '192', 'CU', 'CUB', 'Cuba');
INSERT INTO `pais` VALUES ('63', '208', 'DK', 'DNK', 'Dinamarca');
INSERT INTO `pais` VALUES ('64', '212', 'DM', 'DMA', 'Dominica');
INSERT INTO `pais` VALUES ('65', '214', 'DO', 'DOM', 'República Dominicana');
INSERT INTO `pais` VALUES ('66', '218', 'EC', 'ECU', 'Ecuador');
INSERT INTO `pais` VALUES ('67', '818', 'EG', 'EGY', 'Egipto');
INSERT INTO `pais` VALUES ('68', '222', 'SV', 'SLV', 'El Salvador');
INSERT INTO `pais` VALUES ('69', '784', 'AE', 'ARE', 'Emiratos Árabes Unidos');
INSERT INTO `pais` VALUES ('70', '232', 'ER', 'ERI', 'Eritrea');
INSERT INTO `pais` VALUES ('71', '703', 'SK', 'SVK', 'Eslovaquia');
INSERT INTO `pais` VALUES ('72', '705', 'SI', 'SVN', 'Eslovenia');
INSERT INTO `pais` VALUES ('73', '724', 'ES', 'ESP', 'España');
INSERT INTO `pais` VALUES ('74', '581', 'UM', 'UMI', 'Islas ultramarinas de Estados Unidos');
INSERT INTO `pais` VALUES ('75', '840', 'US', 'USA', 'Estados Unidos');
INSERT INTO `pais` VALUES ('76', '233', 'EE', 'EST', 'Estonia');
INSERT INTO `pais` VALUES ('77', '231', 'ET', 'ETH', 'Etiopía');
INSERT INTO `pais` VALUES ('78', '234', 'FO', 'FRO', 'Islas Feroe');
INSERT INTO `pais` VALUES ('79', '608', 'PH', 'PHL', 'Filipinas');
INSERT INTO `pais` VALUES ('80', '246', 'FI', 'FIN', 'Finlandia');
INSERT INTO `pais` VALUES ('81', '242', 'FJ', 'FJI', 'Fiyi');
INSERT INTO `pais` VALUES ('82', '250', 'FR', 'FRA', 'Francia');
INSERT INTO `pais` VALUES ('83', '266', 'GA', 'GAB', 'Gabón');
INSERT INTO `pais` VALUES ('84', '270', 'GM', 'GMB', 'Gambia');
INSERT INTO `pais` VALUES ('85', '268', 'GE', 'GEO', 'Georgia');
INSERT INTO `pais` VALUES ('86', '239', 'GS', 'SGS', 'Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO `pais` VALUES ('87', '288', 'GH', 'GHA', 'Ghana');
INSERT INTO `pais` VALUES ('88', '292', 'GI', 'GIB', 'Gibraltar');
INSERT INTO `pais` VALUES ('89', '308', 'GD', 'GRD', 'Granada');
INSERT INTO `pais` VALUES ('90', '300', 'GR', 'GRC', 'Grecia');
INSERT INTO `pais` VALUES ('91', '304', 'GL', 'GRL', 'Groenlandia');
INSERT INTO `pais` VALUES ('92', '312', 'GP', 'GLP', 'Guadalupe');
INSERT INTO `pais` VALUES ('93', '316', 'GU', 'GUM', 'Guam');
INSERT INTO `pais` VALUES ('94', '320', 'GT', 'GTM', 'Guatemala');
INSERT INTO `pais` VALUES ('95', '254', 'GF', 'GUF', 'Guayana Francesa');
INSERT INTO `pais` VALUES ('96', '324', 'GN', 'GIN', 'Guinea');
INSERT INTO `pais` VALUES ('97', '226', 'GQ', 'GNQ', 'Guinea Ecuatorial');
INSERT INTO `pais` VALUES ('98', '624', 'GW', 'GNB', 'Guinea-Bissau');
INSERT INTO `pais` VALUES ('99', '328', 'GY', 'GUY', 'Guyana');
INSERT INTO `pais` VALUES ('100', '332', 'HT', 'HTI', 'Haití');
INSERT INTO `pais` VALUES ('101', '334', 'HM', 'HMD', 'Islas Heard y McDonald');
INSERT INTO `pais` VALUES ('102', '340', 'HN', 'HND', 'Honduras');
INSERT INTO `pais` VALUES ('103', '344', 'HK', 'HKG', 'Hong Kong');
INSERT INTO `pais` VALUES ('104', '348', 'HU', 'HUN', 'Hungría');
INSERT INTO `pais` VALUES ('105', '356', 'IN', 'IND', 'India');
INSERT INTO `pais` VALUES ('106', '360', 'ID', 'IDN', 'Indonesia');
INSERT INTO `pais` VALUES ('107', '364', 'IR', 'IRN', 'Irán');
INSERT INTO `pais` VALUES ('108', '368', 'IQ', 'IRQ', 'Iraq');
INSERT INTO `pais` VALUES ('109', '372', 'IE', 'IRL', 'Irlanda');
INSERT INTO `pais` VALUES ('110', '352', 'IS', 'ISL', 'Islandia');
INSERT INTO `pais` VALUES ('111', '376', 'IL', 'ISR', 'Israel');
INSERT INTO `pais` VALUES ('112', '380', 'IT', 'ITA', 'Italia');
INSERT INTO `pais` VALUES ('113', '388', 'JM', 'JAM', 'Jamaica');
INSERT INTO `pais` VALUES ('114', '392', 'JP', 'JPN', 'Japón');
INSERT INTO `pais` VALUES ('115', '400', 'JO', 'JOR', 'Jordania');
INSERT INTO `pais` VALUES ('116', '398', 'KZ', 'KAZ', 'Kazajstán');
INSERT INTO `pais` VALUES ('117', '404', 'KE', 'KEN', 'Kenia');
INSERT INTO `pais` VALUES ('118', '417', 'KG', 'KGZ', 'Kirguistán');
INSERT INTO `pais` VALUES ('119', '296', 'KI', 'KIR', 'Kiribati');
INSERT INTO `pais` VALUES ('120', '414', 'KW', 'KWT', 'Kuwait');
INSERT INTO `pais` VALUES ('121', '418', 'LA', 'LAO', 'Laos');
INSERT INTO `pais` VALUES ('122', '426', 'LS', 'LSO', 'Lesotho');
INSERT INTO `pais` VALUES ('123', '428', 'LV', 'LVA', 'Letonia');
INSERT INTO `pais` VALUES ('124', '422', 'LB', 'LBN', 'Líbano');
INSERT INTO `pais` VALUES ('125', '430', 'LR', 'LBR', 'Liberia');
INSERT INTO `pais` VALUES ('126', '434', 'LY', 'LBY', 'Libia');
INSERT INTO `pais` VALUES ('127', '438', 'LI', 'LIE', 'Liechtenstein');
INSERT INTO `pais` VALUES ('128', '440', 'LT', 'LTU', 'Lituania');
INSERT INTO `pais` VALUES ('129', '442', 'LU', 'LUX', 'Luxemburgo');
INSERT INTO `pais` VALUES ('130', '446', 'MO', 'MAC', 'Macao');
INSERT INTO `pais` VALUES ('131', '807', 'MK', 'MKD', 'ARY Macedonia');
INSERT INTO `pais` VALUES ('132', '450', 'MG', 'MDG', 'Madagascar');
INSERT INTO `pais` VALUES ('133', '458', 'MY', 'MYS', 'Malasia');
INSERT INTO `pais` VALUES ('134', '454', 'MW', 'MWI', 'Malawi');
INSERT INTO `pais` VALUES ('135', '462', 'MV', 'MDV', 'Maldivas');
INSERT INTO `pais` VALUES ('136', '466', 'ML', 'MLI', 'Malí');
INSERT INTO `pais` VALUES ('137', '470', 'MT', 'MLT', 'Malta');
INSERT INTO `pais` VALUES ('138', '238', 'FK', 'FLK', 'Islas Malvinas');
INSERT INTO `pais` VALUES ('139', '580', 'MP', 'MNP', 'Islas Marianas del Norte');
INSERT INTO `pais` VALUES ('140', '504', 'MA', 'MAR', 'Marruecos');
INSERT INTO `pais` VALUES ('141', '584', 'MH', 'MHL', 'Islas Marshall');
INSERT INTO `pais` VALUES ('142', '474', 'MQ', 'MTQ', 'Martinica');
INSERT INTO `pais` VALUES ('143', '480', 'MU', 'MUS', 'Mauricio');
INSERT INTO `pais` VALUES ('144', '478', 'MR', 'MRT', 'Mauritania');
INSERT INTO `pais` VALUES ('145', '175', 'YT', 'MYT', 'Mayotte');
INSERT INTO `pais` VALUES ('146', '484', 'MX', 'MEX', 'México');
INSERT INTO `pais` VALUES ('147', '583', 'FM', 'FSM', 'Micronesia');
INSERT INTO `pais` VALUES ('148', '498', 'MD', 'MDA', 'Moldavia');
INSERT INTO `pais` VALUES ('149', '492', 'MC', 'MCO', 'Mónaco');
INSERT INTO `pais` VALUES ('150', '496', 'MN', 'MNG', 'Mongolia');
INSERT INTO `pais` VALUES ('151', '500', 'MS', 'MSR', 'Montserrat');
INSERT INTO `pais` VALUES ('152', '508', 'MZ', 'MOZ', 'Mozambique');
INSERT INTO `pais` VALUES ('153', '104', 'MM', 'MMR', 'Myanmar');
INSERT INTO `pais` VALUES ('154', '516', 'NA', 'NAM', 'Namibia');
INSERT INTO `pais` VALUES ('155', '520', 'NR', 'NRU', 'Nauru');
INSERT INTO `pais` VALUES ('156', '524', 'NP', 'NPL', 'Nepal');
INSERT INTO `pais` VALUES ('157', '558', 'NI', 'NIC', 'Nicaragua');
INSERT INTO `pais` VALUES ('158', '562', 'NE', 'NER', 'Níger');
INSERT INTO `pais` VALUES ('159', '566', 'NG', 'NGA', 'Nigeria');
INSERT INTO `pais` VALUES ('160', '570', 'NU', 'NIU', 'Niue');
INSERT INTO `pais` VALUES ('161', '574', 'NF', 'NFK', 'Isla Norfolk');
INSERT INTO `pais` VALUES ('162', '578', 'NO', 'NOR', 'Noruega');
INSERT INTO `pais` VALUES ('163', '540', 'NC', 'NCL', 'Nueva Caledonia');
INSERT INTO `pais` VALUES ('164', '554', 'NZ', 'NZL', 'Nueva Zelanda');
INSERT INTO `pais` VALUES ('165', '512', 'OM', 'OMN', 'Omán');
INSERT INTO `pais` VALUES ('166', '528', 'NL', 'NLD', 'Países Bajos');
INSERT INTO `pais` VALUES ('167', '586', 'PK', 'PAK', 'Pakistán');
INSERT INTO `pais` VALUES ('168', '585', 'PW', 'PLW', 'Palau');
INSERT INTO `pais` VALUES ('169', '275', 'PS', 'PSE', 'Palestina');
INSERT INTO `pais` VALUES ('170', '591', 'PA', 'PAN', 'Panamá');
INSERT INTO `pais` VALUES ('171', '598', 'PG', 'PNG', 'Papúa Nueva Guinea');
INSERT INTO `pais` VALUES ('172', '600', 'PY', 'PRY', 'Paraguay');
INSERT INTO `pais` VALUES ('173', '604', 'PE', 'PER', 'Perú');
INSERT INTO `pais` VALUES ('174', '612', 'PN', 'PCN', 'Islas Pitcairn');
INSERT INTO `pais` VALUES ('175', '258', 'PF', 'PYF', 'Polinesia Francesa');
INSERT INTO `pais` VALUES ('176', '616', 'PL', 'POL', 'Polonia');
INSERT INTO `pais` VALUES ('177', '620', 'PT', 'PRT', 'Portugal');
INSERT INTO `pais` VALUES ('178', '630', 'PR', 'PRI', 'Puerto Rico');
INSERT INTO `pais` VALUES ('179', '634', 'QA', 'QAT', 'Qatar');
INSERT INTO `pais` VALUES ('180', '826', 'GB', 'GBR', 'Reino Unido');
INSERT INTO `pais` VALUES ('181', '638', 'RE', 'REU', 'Reunión');
INSERT INTO `pais` VALUES ('182', '646', 'RW', 'RWA', 'Ruanda');
INSERT INTO `pais` VALUES ('183', '642', 'RO', 'ROU', 'Rumania');
INSERT INTO `pais` VALUES ('184', '643', 'RU', 'RUS', 'Rusia');
INSERT INTO `pais` VALUES ('185', '732', 'EH', 'ESH', 'Sahara Occidental');
INSERT INTO `pais` VALUES ('186', '90', 'SB', 'SLB', 'Islas Salomón');
INSERT INTO `pais` VALUES ('187', '882', 'WS', 'WSM', 'Samoa');
INSERT INTO `pais` VALUES ('188', '16', 'AS', 'ASM', 'Samoa Americana');
INSERT INTO `pais` VALUES ('189', '659', 'KN', 'KNA', 'San Cristóbal y Nevis');
INSERT INTO `pais` VALUES ('190', '674', 'SM', 'SMR', 'San Marino');
INSERT INTO `pais` VALUES ('191', '666', 'PM', 'SPM', 'San Pedro y Miquelón');
INSERT INTO `pais` VALUES ('192', '670', 'VC', 'VCT', 'San Vicente y las Granadinas');
INSERT INTO `pais` VALUES ('193', '654', 'SH', 'SHN', 'Santa Helena');
INSERT INTO `pais` VALUES ('194', '662', 'LC', 'LCA', 'Santa Lucía');
INSERT INTO `pais` VALUES ('195', '678', 'ST', 'STP', 'Santo Tomé y Príncipe');
INSERT INTO `pais` VALUES ('196', '686', 'SN', 'SEN', 'Senegal');
INSERT INTO `pais` VALUES ('197', '891', 'CS', 'SCG', 'Serbia y Montenegro');
INSERT INTO `pais` VALUES ('198', '690', 'SC', 'SYC', 'Seychelles');
INSERT INTO `pais` VALUES ('199', '694', 'SL', 'SLE', 'Sierra Leona');
INSERT INTO `pais` VALUES ('200', '702', 'SG', 'SGP', 'Singapur');
INSERT INTO `pais` VALUES ('201', '760', 'SY', 'SYR', 'Siria');
INSERT INTO `pais` VALUES ('202', '706', 'SO', 'SOM', 'Somalia');
INSERT INTO `pais` VALUES ('203', '144', 'LK', 'LKA', 'Sri Lanka');
INSERT INTO `pais` VALUES ('204', '748', 'SZ', 'SWZ', 'Suazilandia');
INSERT INTO `pais` VALUES ('205', '710', 'ZA', 'ZAF', 'Sudáfrica');
INSERT INTO `pais` VALUES ('206', '736', 'SD', 'SDN', 'Sudán');
INSERT INTO `pais` VALUES ('207', '752', 'SE', 'SWE', 'Suecia');
INSERT INTO `pais` VALUES ('208', '756', 'CH', 'CHE', 'Suiza');
INSERT INTO `pais` VALUES ('209', '740', 'SR', 'SUR', 'Surinam');
INSERT INTO `pais` VALUES ('210', '744', 'SJ', 'SJM', 'Svalbard y Jan Mayen');
INSERT INTO `pais` VALUES ('211', '764', 'TH', 'THA', 'Tailandia');
INSERT INTO `pais` VALUES ('212', '158', 'TW', 'TWN', 'Taiwán');
INSERT INTO `pais` VALUES ('213', '834', 'TZ', 'TZA', 'Tanzania');
INSERT INTO `pais` VALUES ('214', '762', 'TJ', 'TJK', 'Tayikistán');
INSERT INTO `pais` VALUES ('215', '86', 'IO', 'IOT', 'Territorio Británico del Océano Índico');
INSERT INTO `pais` VALUES ('216', '260', 'TF', 'ATF', 'Territorios Australes Franceses');
INSERT INTO `pais` VALUES ('217', '626', 'TL', 'TLS', 'Timor Oriental');
INSERT INTO `pais` VALUES ('218', '768', 'TG', 'TGO', 'Togo');
INSERT INTO `pais` VALUES ('219', '772', 'TK', 'TKL', 'Tokelau');
INSERT INTO `pais` VALUES ('220', '776', 'TO', 'TON', 'Tonga');
INSERT INTO `pais` VALUES ('221', '780', 'TT', 'TTO', 'Trinidad y Tobago');
INSERT INTO `pais` VALUES ('222', '788', 'TN', 'TUN', 'Túnez');
INSERT INTO `pais` VALUES ('223', '796', 'TC', 'TCA', 'Islas Turcas y Caicos');
INSERT INTO `pais` VALUES ('224', '795', 'TM', 'TKM', 'Turkmenistán');
INSERT INTO `pais` VALUES ('225', '792', 'TR', 'TUR', 'Turquía');
INSERT INTO `pais` VALUES ('226', '798', 'TV', 'TUV', 'Tuvalu');
INSERT INTO `pais` VALUES ('227', '804', 'UA', 'UKR', 'Ucrania');
INSERT INTO `pais` VALUES ('228', '800', 'UG', 'UGA', 'Uganda');
INSERT INTO `pais` VALUES ('229', '858', 'UY', 'URY', 'Uruguay');
INSERT INTO `pais` VALUES ('230', '860', 'UZ', 'UZB', 'Uzbekistán');
INSERT INTO `pais` VALUES ('231', '548', 'VU', 'VUT', 'Vanuatu');
INSERT INTO `pais` VALUES ('232', '862', 'VE', 'VEN', 'Venezuela');
INSERT INTO `pais` VALUES ('233', '704', 'VN', 'VNM', 'Vietnam');
INSERT INTO `pais` VALUES ('234', '92', 'VG', 'VGB', 'Islas Vírgenes Británicas');
INSERT INTO `pais` VALUES ('235', '850', 'VI', 'VIR', 'Islas Vírgenes de los Estados Unidos');
INSERT INTO `pais` VALUES ('236', '876', 'WF', 'WLF', 'Wallis y Futuna');
INSERT INTO `pais` VALUES ('237', '887', 'YE', 'YEM', 'Yemen');
INSERT INTO `pais` VALUES ('238', '262', 'DJ', 'DJI', 'Yibuti');
INSERT INTO `pais` VALUES ('239', '894', 'ZM', 'ZMB', 'Zambia');
INSERT INTO `pais` VALUES ('240', '716', 'ZW', 'ZWE', 'Zimbabue');

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
  `sexo` varchar(5) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `id_ciudad` int(10) unsigned DEFAULT NULL,
  `identificacion` varchar(50) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_creacion` int(12) NOT NULL,
  `fecha_modificacion` int(12) DEFAULT NULL,
  `id_pais` int(10) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `in_identificacion` (`identificacion`) USING BTREE,
  KEY `fk_persona_id_ciudad` (`id_ciudad`) USING BTREE,
  KEY `fk_persona_id_estado` (`id_estado`) USING BTREE,
  KEY `pais_persona` (`id_pais`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', '1', 'Pedro', 'Ramos', null, '', '12345', '2', '16595338', 'angeledugo@gmail.com', '1408336200', '1408336200', '3', null);
INSERT INTO `personas` VALUES ('61', null, 'Angel', 'Gonzalez', '1692041896', 'm', '241-8315703', null, null, 'aegm@gmail.com', '1408825066', null, '17', null);
INSERT INTO `personas` VALUES ('76', null, 'Jonathan', 'Trejo', '1904788800', 'm', '04263419488', null, null, 'jtcpu2@gmail.com', '1409100583', null, '232', 'jonathan');
INSERT INTO `personas` VALUES ('77', null, 'Klever', 'Freire', '0', 'm', '0959672438', null, null, 'kmfponce@gmail.com', '1409150871', null, '66', 'ninguno');
INSERT INTO `personas` VALUES ('78', null, 'Klever', 'Freire Ponce', '0', 'm', '0959672438', null, null, 'klemafre2@hotmail.com', '1409151282', null, '66', 'ninguno');

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `nivel` int(5) DEFAULT NULL,
  `afiliados` int(5) DEFAULT NULL,
  `pago` int(5) DEFAULT NULL,
  `compensacion` int(5) DEFAULT NULL,
  `monto_next_nivel` int(5) DEFAULT NULL,
  `total_liquido` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plan
-- ----------------------------
INSERT INTO `plan` VALUES ('1', 'COBRE', '1', '2', '10', '20', '20', '0');
INSERT INTO `plan` VALUES ('2', 'BRONCE', '2', '4', '20', '80', '40', '40');
INSERT INTO `plan` VALUES ('3', 'PLATA', '3', '8', '40', '320', '80', '280');
INSERT INTO `plan` VALUES ('4', 'ORO', '4', '16', '80', '1280', '160', '1400');
INSERT INTO `plan` VALUES ('5', 'PLATINO', '5', '32', '160', '5120', '320', '6200');
INSERT INTO `plan` VALUES ('6', 'RODIO', '6', '64', '320', '20480', '640', '26040');
INSERT INTO `plan` VALUES ('7', 'PERLA', '7', '128', '640', '81920', '1280', '106680');
INSERT INTO `plan` VALUES ('8', 'JADE', '8', '256', '1280', '327680', '2560', '431800');
INSERT INTO `plan` VALUES ('9', 'ZAFIRO', '9', '512', '2560', '1310720', '5120', '1737400');
INSERT INTO `plan` VALUES ('10', 'ESMERALDA', '10', '1024', '5120', '5242880', '9999', '6970281');
INSERT INTO `plan` VALUES ('11', 'DIAMANTE', '11', '2048', '9999', '20477952', '9999', '27438234');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_grupo` int(10) unsigned NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(32) NOT NULL,
  `fecha_registro` int(12) NOT NULL,
  `ultima_entrada` int(10) DEFAULT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT '1' COMMENT '1:activo, 2:inactivo, 3:contrato_vencido',
  `id_persona` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `in_usuario` (`usuario`) USING BTREE,
  KEY `fk_usuarios_id_grupo` (`id_grupo`) USING BTREE,
  KEY `id_persona` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', '1', 'kmfponce', '81dc9bdb52d04dc20036dbd8313ed055', '1408336200', '1409597441', '1', '1');
INSERT INTO `usuarios` VALUES ('7', '1', 'jona2518', '81dc9bdb52d04dc20036dbd8313ed055', '1409100583', null, '3', '76');
INSERT INTO `usuarios` VALUES ('8', '1', 'KleverF', '81dc9bdb52d04dc20036dbd8313ed055', '1409150871', '1409153093', '1', '77');
INSERT INTO `usuarios` VALUES ('9', '1', 'KleverFreire', '231d175a6f588a685bc28d34133fa5ca', '1409151282', null, '1', '78');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios_accesos
-- ----------------------------
INSERT INTO `usuarios_accesos` VALUES ('4', 'profile', '2222');
INSERT INTO `usuarios_accesos` VALUES ('5', 'network', '2222');
INSERT INTO `usuarios_accesos` VALUES ('6', 'support', '2222');

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
INSERT INTO `usuarios_grupos_permisos` VALUES ('1', '4', '2222');
INSERT INTO `usuarios_grupos_permisos` VALUES ('1', '5', '2222');
INSERT INTO `usuarios_grupos_permisos` VALUES ('1', '6', '2222');

-- ----------------------------
-- View structure for v_usuarios
-- ----------------------------
DROP VIEW IF EXISTS `v_usuarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`C243473_matriz`@`%` SQL SECURITY DEFINER VIEW `v_usuarios` AS select `personas`.`id_persona` AS `id_persona`,`usuarios_grupos`.`id_grupo` AS `id_grupo`,`personas`.`identificacion` AS `identificacion`,`personas`.`nombre` AS `nombre`,`personas`.`apellido` AS `apellido`,`usuarios_grupos`.`nombre` AS `grupo`,`usuarios`.`usuario` AS `usuario`,`usuarios`.`clave` AS `clave`,`usuarios`.`ultima_entrada` AS `ultima_entrada`,`usuarios_config`.`nivel_actual` AS `nivel_actual`,`usuarios_config`.`datos_actualizados` AS `datos_actualizados`,`usuarios`.`estatus` AS `estatus`,`personas`.`correo` AS `correo` from (((`usuarios` join `usuarios_grupos` on((`usuarios`.`id_grupo` = `usuarios_grupos`.`id_grupo`))) join `personas` on((`usuarios`.`id_persona` = `personas`.`id_persona`))) left join `usuarios_config` on((`personas`.`id_persona` = `usuarios_config`.`id_persona`))) ;

-- ----------------------------
-- View structure for vmenu
-- ----------------------------
DROP VIEW IF EXISTS `vmenu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`C243473_matriz`@`%` SQL SECURITY DEFINER VIEW `vmenu` AS select `menu`.`id_menu` AS `id_menu`,`usuarios_grupos`.`id_grupo` AS `id_grupo`,`usuarios_accesos`.`id_acceso` AS `id_acceso`,`usuarios_grupos`.`nombre` AS `grupo`,`usuarios_grupos_permisos`.`seguridad` AS `grupo_seguridad`,`usuarios_accesos`.`nombre` AS `acceso`,`usuarios_accesos`.`seguridad` AS `acceso_seguridad`,`menu`.`id` AS `id`,`menu`.`clase` AS `clase`,`menu`.`nombre` AS `nombre`,`menu`.`url` AS `url`,`menu`.`orden` AS `orden`,`menu`.`tipo` AS `tipo`,`menu`.`session` AS `session`,`menu`.`target` AS `target` from (((`menu` join `usuarios_grupos_permisos` on((`menu`.`id_acceso` = `usuarios_grupos_permisos`.`id_acceso`))) join `usuarios_grupos` on((`usuarios_grupos_permisos`.`id_grupo` = `usuarios_grupos`.`id_grupo`))) join `usuarios_accesos` on((`usuarios_grupos_permisos`.`id_acceso` = `usuarios_accesos`.`id_acceso`))) ;

-- ----------------------------
-- View structure for vpersonas
-- ----------------------------
DROP VIEW IF EXISTS `vpersonas`;
