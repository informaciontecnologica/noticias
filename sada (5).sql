-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2016 a las 22:31:32
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE IF NOT EXISTS `agentes` (
  `idagente` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idpersonas` int(4) NOT NULL,
  `interno` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idagente`),
  UNIQUE KEY `idpersonas` (`idpersonas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`idagente`, `idpersonas`, `interno`) VALUES
(0000000001, 19, '4578'),
(0000000003, 18, '8965');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE IF NOT EXISTS `alquileres` (
  `idalquiler` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `fecha_Activa` date NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin NOT NULL,
  `temporada` varchar(50) COLLATE utf8_bin NOT NULL,
  `estado` char(13) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idalquiler`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`idalquiler`, `monto`, `fecha_Activa`, `descripcion`, `temporada`, `estado`) VALUES
(1, 4500, '2016-05-10', '', 'verano', 'libre'),
(2, 1542, '2016-07-19', 'promocion', '', 'promocion'),
(3, 4825, '2016-05-08', 'Oficinas temporaria', 'Verano', 'alquilado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE IF NOT EXISTS `barrio` (
  `idbarrio` int(11) NOT NULL AUTO_INCREMENT,
  `barrio` varchar(35) COLLATE utf8_bin NOT NULL DEFAULT 'nombre del barrio',
  `idciudad` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`idbarrio`,`idciudad`,`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`),
  KEY `Ref428` (`idmunicipio`,`iddepartamento`,`idciudad`,`idprovincia`,`idpais`),
  KEY `Refciudad28` (`idciudad`,`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`idbarrio`, `barrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`) VALUES
(1, 'San martin', 1, 1, 1, 1, 1),
(2, 'Coluccio', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(35) COLLATE utf8_bin DEFAULT NULL,
  `idmunicipio` int(11) NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`idciudad`,`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`),
  KEY `Ref1916` (`iddepartamento`,`idmunicipio`,`idprovincia`,`idpais`),
  KEY `Refmunicipio16` (`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idciudad`, `ciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`) VALUES
(1, 'Formosa', 1, 1, 1, 1),
(2, 'Mojon de fierro', 2, 1, 1, 1),
(3, 'Tres marias', 1, 1, 1, 1),
(4, 'Villa del Carmen', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE IF NOT EXISTS `contratos` (
  `idcontratos` int(11) NOT NULL AUTO_INCREMENT,
  `contratoscol` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idalquiler` int(11) NOT NULL,
  PRIMARY KEY (`idcontratos`,`idalquiler`),
  KEY `Ref123` (`idalquiler`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `iddepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`iddepartamento`,`idprovincia`,`idpais`),
  KEY `Ref1826` (`idprovincia`,`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `departamento`, `idprovincia`, `idpais`) VALUES
(1, 'Formosa', 1, 1),
(2, 'Pirane', 1, 1),
(3, 'Patiño', 1, 1),
(4, 'Ramon lista', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotopersona`
--

CREATE TABLE IF NOT EXISTS `fotopersona` (
  `idFotoPersona` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idpersonas` int(11) unsigned zerofill NOT NULL,
  `foto` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idFotoPersona`),
  KEY `idFotoPersona` (`idFotoPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `fotopersona`
--

INSERT INTO `fotopersona` (`idFotoPersona`, `idpersonas`, `foto`) VALUES
(00000000006, 00000000019, 'avatar19.jpg'),
(00000000011, 00000000017, 'avatar17.jpg'),
(00000000012, 00000000018, 'avatar18.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotopropiedad`
--

CREATE TABLE IF NOT EXISTS `fotopropiedad` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `idpropiedad` int(11) DEFAULT NULL,
  `foto` char(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `fotopropiedad`
--

INSERT INTO `fotopropiedad` (`idfoto`, `idpropiedad`, `foto`) VALUES
(31, 1, '11.jpg'),
(32, 1, 'images (49).jpg'),
(33, 2, 'images (46).jpg'),
(34, 2, 'images (47).jpg'),
(35, 2, 'images (57).jpg'),
(36, 2, 'images (3).jpg'),
(37, 3, 'images (34).jpg'),
(38, 3, 'images (36).jpg'),
(39, 4, 'images (55).jpg'),
(40, 4, '12.jpg'),
(41, 5, 'images (38).jpg'),
(42, 5, 'images (20).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE IF NOT EXISTS `instituciones` (
  `idinstitucion` int(11) NOT NULL AUTO_INCREMENT,
  `institucion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idinstitucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` int(11) NOT NULL,
  `link` varchar(60) COLLATE utf8_bin NOT NULL,
  `Texto` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `idmunicipio` int(11) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`),
  KEY `Ref2427` (`iddepartamento`,`idprovincia`,`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`idmunicipio`, `municipio`, `iddepartamento`, `idprovincia`, `idpais`) VALUES
(1, 'Formosa', 1, 1, 1),
(2, 'Mojon de Fierro', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idnoticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `encabezado` text COLLATE utf8_spanish_ci NOT NULL,
  `cuerpo` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `lugar` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `confeccion` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idnoticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='noticias de inta con imagenes satelitales' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idpais`, `pais`) VALUES
(1, 'Argentina'),
(2, 'Paraguay'),
(3, 'Brasil'),
(4, 'Uruguay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(35) COLLATE utf8_bin NOT NULL,
  `privilegios` int(11) NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `perfil`, `privilegios`, `nivel`) VALUES
(1, 'Administrador', 1, 1),
(2, 'Gerencia', 1, 2),
(3, 'Analista', 1, 3),
(4, 'Usuario', 1, 2),
(5, 'Propietario', 3, 3),
(6, 'Nulo', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `idpersonas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellido` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `mail` varchar(45) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(12) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `documento` int(11) DEFAULT NULL,
  `idbarrio` int(11) NOT NULL,
  `idciudad` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  `area` polygon NOT NULL,
  PRIMARY KEY (`idpersonas`),
  KEY `Ref331` (`idciudad`,`idprovincia`,`idmunicipio`,`idpais`,`idbarrio`,`iddepartamento`),
  KEY `Refbarrio31` (`idbarrio`,`idciudad`,`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idpersonas`, `nombre`, `apellido`, `nacimiento`, `mail`, `telefono`, `direccion`, `documento`, `idbarrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`, `area`) VALUES
(17, 'Carolina', 'Fernandez', '2016-02-06', 'Carloina@bgf.com', '54307043105', 'Rivadavia 1400', 1116, 1, 1, 1, 1, 1, 1, ''),
(18, 'Luis Fernando ', 'Gomez', '2016-02-09', 'lfgomez@gmail.com', '3704300465', 'Julio a Roca 2500', 1541, 1, 1, 1, 1, 1, 1, ''),
(19, 'Jose Maria', 'rojas', '2016-02-09', 'josemcaballero@gmail.com', '3704300465', 'Av. napoleón Uriburu 455', 25785621, 1, 1, 1, 1, 1, 1, ''),
(20, 'Caco', 'Ruben', '2016-05-05', 'caco@gmail.com', '154215', 'palacete', 1545452, 1, 1, 1, 1, 1, 1, ''),
(21, 'a', 'fer', '2016-06-07', 'jdfdf@sds.com', '12121212', 'ss', 15421315, 1, 1, 1, 1, 1, 1, ''),
(22, 'Cecilia', 'Gimenez', '2016-08-11', 'cg@gmimenes.com', '454545454', 'dedos', 15445454, 2, 1, 1, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas usuario`
--

CREATE TABLE IF NOT EXISTS `personas usuario` (
  `idpersonas` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idpersonas`,`idusuario`),
  KEY `Ref1135` (`idpersonas`),
  KEY `Ref2336` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `personas usuario`
--

INSERT INTO `personas usuario` (`idpersonas`, `idusuario`) VALUES
(17, 55),
(18, 59),
(19, 60),
(20, 61),
(22, 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_alquileres`
--

CREATE TABLE IF NOT EXISTS `personas_alquileres` (
  `idpersona` int(4) unsigned NOT NULL,
  `idpalquileres` int(11) NOT NULL,
  `a` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idpersona`,`idpalquileres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas_alquileres`
--

INSERT INTO `personas_alquileres` (`idpersona`, `idpalquileres`, `a`) VALUES
(17, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE IF NOT EXISTS `propiedades` (
  `idpropiedad` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `FPublicacion` datetime NOT NULL,
  `superficie` int(11) NOT NULL,
  `direccion` varchar(45) COLLATE utf8_bin NOT NULL,
  `valor` decimal(11,0) NOT NULL,
  `Descripcion` text COLLATE utf8_bin NOT NULL,
  `banos` tinyint(4) DEFAULT NULL,
  `habitaciones` tinyint(4) DEFAULT NULL,
  `pileta` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `otros` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `tipopropiedad_id_tipoPropiedad` int(11) NOT NULL,
  `idbarrio` int(11) NOT NULL,
  `idciudad` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  `localizacion` varchar(60) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idpropiedad`),
  KEY `fk_propiedades_tipopropiedad1_idx` (`tipopropiedad_id_tipoPropiedad`),
  KEY `fk_propiedades_tipopropiedad1` (`tipopropiedad_id_tipoPropiedad`),
  KEY `Ref329` (`idmunicipio`,`idpais`,`idbarrio`,`iddepartamento`,`idciudad`,`idprovincia`),
  KEY `Refbarrio29` (`idbarrio`,`idciudad`,`idmunicipio`,`iddepartamento`,`idprovincia`,`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`idpropiedad`, `FPublicacion`, `superficie`, `direccion`, `valor`, `Descripcion`, `banos`, `habitaciones`, `pileta`, `otros`, `tipopropiedad_id_tipoPropiedad`, `idbarrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`, `localizacion`) VALUES
(1, '2015-10-14 11:00:00', 1515, 'Julio a Roca 25', '8500', '2 habitaciones , cocina comedor, 1 baño, servicios', 1, 1, '0', 'sin datos', 2, 1, 1, 1, 1, 1, 1, '-26.178240098493074,-58.17992448806763'),
(2, '2014-02-05 11:00:00', 3500, 'Alem 400', '4500', 'Latex, Armarios, Cocina, Modular de cocina , Servicios', 2, 2, '1', 'Termotanque', 1, 2, 1, 1, 1, 1, 1, '-26.170614206759144,-58.1746244430542'),
(3, '2016-10-14 11:00:00', 2500, 'Av. napoleon Uriburu 455', '3500', 'Pañalero, cochera, Start, Termotanque, Telefono', 2, 3, '1', 's/n', 1, 2, 1, 1, 1, 1, 1, '-26.184594627154706,-58.204214572906494'),
(4, '2016-01-15 11:00:00', 3600, 'Mitre 10', '3800', 'Patio, termotanque', 2, 3, '0', 's/n', 1, 1, 1, 1, 1, 1, 1, '-26.176160359313926,-58.17404508590698'),
(5, '0000-00-00 00:00:00', 4500, 'Rivadavia 800', '7800', 'Termotanque , solarium, Termotanque solar, energía eólica ', 3, 4, '0', 's/n', 1, 1, 1, 1, 1, 1, 1, '-26.147271257094403,-58.15690040588379');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades alquileres`
--

CREATE TABLE IF NOT EXISTS `propiedades alquileres` (
  `idprop_alquiler` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idpropiedad` int(11) NOT NULL,
  `idalquileres` int(11) NOT NULL,
  PRIMARY KEY (`idprop_alquiler`),
  UNIQUE KEY `unico` (`idpropiedad`,`idalquileres`),
  UNIQUE KEY `uni1` (`idpropiedad`),
  UNIQUE KEY `uni2` (`idalquileres`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `propiedades alquileres`
--

INSERT INTO `propiedades alquileres` (`idprop_alquiler`, `idpropiedad`, `idalquileres`) VALUES
(0000000001, 1, 1),
(0000000002, 2, 2),
(0000000008, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_persona`
--

CREATE TABLE IF NOT EXISTS `propiedad_persona` (
  `idpropietario_persona` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `idpersona` int(10) unsigned zerofill NOT NULL,
  `idpropiedad` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`idpropietario_persona`),
  UNIQUE KEY `idpropiedad` (`idpropiedad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `propiedad_persona`
--

INSERT INTO `propiedad_persona` (`idpropietario_persona`, `idpersona`, `idpropiedad`) VALUES
(0000000001, 0000000018, 0000000001),
(0000000002, 0000000019, 0000000002),
(0000000003, 0000000018, 0000000004);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `idprovincia` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`idprovincia`,`idpais`),
  KEY `Ref1714` (`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idprovincia`, `provincia`, `idpais`) VALUES
(1, 'Formosa', 1),
(2, 'Chaco', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE IF NOT EXISTS `sesiones` (
  `id` char(128) COLLATE utf8_bin NOT NULL,
  `horario` char(10) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL,
  `clave_sesion` char(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopropiedad`
--

CREATE TABLE IF NOT EXISTS `tipopropiedad` (
  `idtipoPropiedad` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idtipoPropiedad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipopropiedad`
--

INSERT INTO `tipopropiedad` (`idtipoPropiedad`, `Tipo`) VALUES
(1, 'Casa'),
(2, 'Departamento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `clave` char(36) COLLATE utf8_bin DEFAULT NULL,
  `mail` char(50) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `mail` (`mail`),
  KEY `Ref1040` (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=84 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `clave`, `mail`, `fecha`, `id_perfil`) VALUES
(55, 'dadasd@dsad', '7815696ecbf1c96e6894b779456d330e', 'Carloina@bgf.com', '2015-11-18', 5),
(57, 'Daniel', '848ffd503f98d2368d47abceb4821465', 'jorge.daniel.castro.formosa@gmail.com', '2015-11-19', 1),
(58, 'Pomelo', '848ffd503f98d2368d47abceb4821465', 'jose@diego', '2016-01-06', 1),
(59, 'CArlos', 'dc599a9972fde3045dab59dbd1ae170b', 'jorge@fdfsd.com', '2016-01-07', 5),
(60, 'Fernando', '81dc9bdb52d04dc20036dbd8313ed055', 'jorge@gmail.com', '2016-01-13', 2),
(61, 'caco', '0a72fb3525e0cc69d14c732a2dc39808', 'caco@gmail.com', '2016-05-17', 5),
(63, 'daniel', '2c216b1ba5e33a27eb6d3df7de7f8c36', 'cg@gmimenes.com', '2016-06-13', 5),
(65, 'asa', '7815696ecbf1c96e6894b779456d330e', 'asda', '2016-05-05', 1),
(67, 'asa', '7815696ecbf1c96e6894b779456d330e', 'asdaa', '2016-09-10', 1),
(68, 'a', '4a8a08f09d37b73795649038408b5f33', 'b', '2016-09-10', 1),
(69, 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'q', '2016-09-10', 1),
(70, 'joselo robles', '836b1d4d4c96c2e706b2e12e4770119a', 'joselo@gmail.com', '2016-09-10', 1),
(71, 'joselo robles', '836b1d4d4c96c2e706b2e12e4770119a', 'ajoselo@gmail.com', '2016-09-10', 1),
(72, 'joselo robles', '836b1d4d4c96c2e706b2e12e4770119a', 'aajoselo@gmail.com', '2016-09-10', 1),
(73, 'joselo robles', '836b1d4d4c96c2e706b2e12e4770119a', 'aaajoselo@gmail.com', '2016-09-10', 1),
(74, 'd', '8277e0910d750195b448797616e091ad', 'd', '2016-09-10', 1),
(75, 'dq', '8277e0910d750195b448797616e091ad', 'dq', '2016-09-10', 1),
(76, 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'w', '2016-09-10', 1),
(77, 'r', '4b43b0aee35624cd95b910189b3dc231', 'r', '2016-09-10', 1),
(78, 'r', '4b43b0aee35624cd95b910189b3dc231', 'rr', '2016-09-10', 1),
(79, 'g', 'b2f5ff47436671b6e533d8dc3614845d', 'g', '2016-09-10', 1),
(80, 'as', 'f970e2767d0cfe75876ea857f92e319b', 'as', '2016-09-10', 1),
(81, 'y', '415290769594460e2e485922904f345d', 'y', '2016-09-10', 1),
(82, 'e', 'e1671797c52e15f763380b45e841ec32', 'e', '2016-09-10', 1),
(83, 'u', '7b774effe4a349c6dd82ad4f4f21d34c', 'u', '2016-09-10', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `Refciudad28` FOREIGN KEY (`idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`) REFERENCES `ciudad` (`idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `Refmunicipio16` FOREIGN KEY (`idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`) REFERENCES `municipio` (`idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`);

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `Refalquileres23` FOREIGN KEY (`idalquiler`) REFERENCES `alquiler` (`idAlquileres`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `Refprovincia26` FOREIGN KEY (`idprovincia`, `idpais`) REFERENCES `provincia` (`idprovincia`, `idpais`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `Refdepartamento27` FOREIGN KEY (`iddepartamento`, `idprovincia`, `idpais`) REFERENCES `departamento` (`iddepartamento`, `idprovincia`, `idpais`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `Refbarrio31` FOREIGN KEY (`idbarrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`) REFERENCES `barrio` (`idbarrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`);

--
-- Filtros para la tabla `personas usuario`
--
ALTER TABLE `personas usuario`
  ADD CONSTRAINT `Refpersonas35` FOREIGN KEY (`idpersonas`) REFERENCES `personas` (`idpersonas`),
  ADD CONSTRAINT `Refusuario36` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `fk_propiedades_tipopropiedad1` FOREIGN KEY (`tipopropiedad_id_tipoPropiedad`) REFERENCES `tipopropiedad` (`idtipoPropiedad`),
  ADD CONSTRAINT `Refbarrio29` FOREIGN KEY (`idbarrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`) REFERENCES `barrio` (`idbarrio`, `idciudad`, `idmunicipio`, `iddepartamento`, `idprovincia`, `idpais`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `Refpais14` FOREIGN KEY (`idpais`) REFERENCES `pais` (`idpais`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Refperfil40` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
