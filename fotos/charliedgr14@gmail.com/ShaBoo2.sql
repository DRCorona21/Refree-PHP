-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.21-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sharebooks
CREATE DATABASE IF NOT EXISTS `sharebooks` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sharebooks`;

-- Volcando estructura para tabla sharebooks.autor
CREATE TABLE IF NOT EXISTS `autor` (
  `id_autor` int(10) unsigned NOT NULL,
  `autor` varchar(35) NOT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.autor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) unsigned NOT NULL,
  `categoria` varchar(35) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `id_publicacion` (`id_publicacion`),
  CONSTRAINT `FK_categoria_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.categoria: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.chat: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.chmenusu
CREATE TABLE IF NOT EXISTS `chmenusu` (
  `email` varchar(50) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `id_mensaje` int(11) DEFAULT NULL,
  KEY `FK_ChMenUsu_chat` (`id_chat`),
  KEY `FK_ChMenUsu_mensaje` (`id_mensaje`),
  KEY `FK_ChMenUsu_usuario` (`email`),
  CONSTRAINT `FK_ChMenUsu_chat` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_ChMenUsu_mensaje` FOREIGN KEY (`id_mensaje`) REFERENCES `mensaje` (`id_mensaje`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_ChMenUsu_usuario` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.chmenusu: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `chmenusu` DISABLE KEYS */;
/*!40000 ALTER TABLE `chmenusu` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.clave
CREATE TABLE IF NOT EXISTS `clave` (
  `id_clave` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `clave` varchar(6) NOT NULL,
  PRIMARY KEY (`id_clave`),
  KEY `email` (`email`),
  CONSTRAINT `FK_clave_usuario` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.clave: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `clave` DISABLE KEYS */;
INSERT INTO `clave` (`id_clave`, `email`, `clave`) VALUES
	(1, 'charliedgr14@gmail.com', '369211');
/*!40000 ALTER TABLE `clave` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.libro
CREATE TABLE IF NOT EXISTS `libro` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `email` varchar(35) NOT NULL,
  PRIMARY KEY (`id_libro`),
  KEY `FK_Libro_usuario` (`email`),
  CONSTRAINT `FK_Libro_usuario` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.libro: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` (`id_libro`, `titulo`, `URL`, `email`) VALUES
	(5, '123', '123', 'charliedgr14@gmail.com'),
	(6, 'Normalizacion.pdf', 'descargas/charliedgr14@gmail.com/Normalizacion.pdf', 'charliedgr14@gmail.com'),
	(7, 'Normalizacion.pdf', 'descargas/charliedgr14@gmail.com/Normalizacion.pdf', 'charliedgr14@gmail.com');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.mensaje
CREATE TABLE IF NOT EXISTS `mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `mensaje` text NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.mensaje: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.publicacion
CREATE TABLE IF NOT EXISTS `publicacion` (
  `id_publicacion` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `foto` varchar(50) NOT NULL,
  `descripcion` tinytext,
  `fecha` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_categoria` int(11) unsigned NOT NULL,
  `editorial` varchar(25) NOT NULL,
  `edicion` varchar(25) NOT NULL,
  `id_autor` int(11) unsigned NOT NULL,
  `titulo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_publicacion`),
  KEY `FK_publicacion_categoria` (`id_categoria`),
  KEY `FK_publicacion_autor` (`id_autor`),
  KEY `FK_publicacion_usuario` (`email`),
  CONSTRAINT `FK_publicacion_autor` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id_autor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_publicacion_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_publicacion_usuario` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.publicacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacion` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.telefono
CREATE TABLE IF NOT EXISTS `telefono` (
  `id_tel` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` bit(1) NOT NULL DEFAULT b'0',
  `numero` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tel`),
  KEY `FK_telefono_usuario` (`email`),
  CONSTRAINT `FK_telefono_usuario` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.telefono: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
INSERT INTO `telefono` (`id_tel`, `tipo`, `numero`, `email`) VALUES
	(1, b'0', '5553748192', 'charliedgr14@gmail.com'),
	(2, b'0', '5553748192', 'edgr14@gmail.com');
/*!40000 ALTER TABLE `telefono` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(50) NOT NULL,
  `nombre` varchar(26) NOT NULL,
  `apellido` varchar(26) NOT NULL,
  `password` varchar(300) NOT NULL,
  `tipo` bit(1) NOT NULL DEFAULT b'0',
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `Fnacimiento` date NOT NULL,
  `Fcreacion` date NOT NULL,
  `PreguntaS` varchar(1) NOT NULL,
  `Respuesta` varchar(300) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`email`, `nombre`, `apellido`, `password`, `tipo`, `estado`, `Fnacimiento`, `Fcreacion`, `PreguntaS`, `Respuesta`, `domicilio`) VALUES
	('charliedgr14@gmail.com', 'Carlos Daniel', 'Gonzalez Rodriguez', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', b'0', b'0', '2018-05-03', '2018-05-03', '1', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Vista Hermosa'),
	('edgr14@gmail.com', 'Carlos Daniel', '', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', b'0', b'0', '2018-05-03', '2018-05-03', '1', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Vista Hermosa');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sharebooks.vistas
CREATE TABLE IF NOT EXISTS `vistas` (
  `id_vistas` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  PRIMARY KEY (`id_vistas`),
  KEY `FK_vistas_publicacion` (`id_publicacion`),
  KEY `FK_vistas_usuario` (`email`),
  CONSTRAINT `FK_vistas_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_vistas_usuario` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sharebooks.vistas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `vistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `vistas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
