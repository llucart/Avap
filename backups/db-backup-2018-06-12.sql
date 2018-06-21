

CREATE TABLE `clientes` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_rif` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `rif` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO clientes VALUES("1","Seguros Constitucion CA","3","412569877","segurosuniversitasprincipal@segurosuniversitas.com","021225896444","Centro empresarial el recreo, avenida miranda cruce con calle providencia, Chacao Estado miranda","2018-06-12 12:10:36");





CREATE TABLE `factura` (
  `id_factura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_vehiculo` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned NOT NULL,
  `iva` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `total` varchar(115) COLLATE utf8_spanish_ci NOT NULL,
  `ordenCompra` text COLLATE utf8_spanish_ci NOT NULL,
  `n_poliza` text COLLATE utf8_spanish_ci NOT NULL,
  `n_siniestro` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_factura`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO factura VALUES("1","ADF15D","1","1","16200000.00","151200000.00","aads85241","SC-201333-31","214-2013333-31","2018-06-12","3","2018-06-12 13:18:09");
INSERT INTO factura VALUES("2","AAE-965","1","1","22200000.00","207200000.00","aa58544qq","ASA25211","251-251","2018-06-12","1","2018-06-12 13:31:42");
INSERT INTO factura VALUES("3","0","1","1","6000000.00","56000000.00","96588--asa","251-3622","aaas---55","2018-06-12","2","2018-06-12 13:37:38");





CREATE TABLE `factura_repuesto` (
  `id_fac_repuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_repuesto` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `cantidad` varchar(115) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_fac_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO factura_repuesto VALUES("1","1","1","1","2018-06-12 13:18:09");
INSERT INTO factura_repuesto VALUES("2","2","2","1","2018-06-12 13:31:43");
INSERT INTO factura_repuesto VALUES("3","1","2","1","2018-06-12 13:31:43");
INSERT INTO factura_repuesto VALUES("4","2","3","1","2018-06-12 13:37:38");





CREATE TABLE `nota_entrega` (
  `id_nota_entrega` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_nota_entrega` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `id_factura` int(10) unsigned NOT NULL,
  `empresa_envio` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `guia` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `costo_envio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_envio` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nota_entrega`),
  KEY `id_factura` (`id_factura`),
  CONSTRAINT `nota_entrega_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO nota_entrega VALUES("1","0001","1","TEALCA","FAC-0120","1500000","2","2018-06-12","2018-06-12 13:18:09");
INSERT INTO nota_entrega VALUES("2","0002","2","ZOOM","251412AASA","1306054.50","2","","2018-06-12 13:31:42");





CREATE TABLE `repuesto` (
  `id_repuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `detalle` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `precio_unitario` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `stock` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO repuesto VALUES("1","3","Parachoque Delantero","jbjbjj","135000000","1","2018-06-12 10:12:17");
INSERT INTO repuesto VALUES("2","2","Rin 16plg","Para ford f-350 2002-2012","50000000","1","2018-06-12 10:14:26");





CREATE TABLE `rol` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO rol VALUES("1","Presidente","2018-06-12 09:47:28");
INSERT INTO rol VALUES("2","Director de Finanzas","2018-06-12 09:47:28");
INSERT INTO rol VALUES("3","Vendedor","2018-06-12 09:48:00");
INSERT INTO rol VALUES("4","Administrador del sistema","2018-06-12 09:48:00");





CREATE TABLE `usuario` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cuenta` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  `nombre` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cuenta` (`cuenta`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO usuario VALUES("1","llucart","827ccb0eea8a706c4c34a16891f84e7b","4","Luis","Lucart","2018-06-12 09:50:14");
INSERT INTO usuario VALUES("3","Elucart","827ccb0eea8a706c4c34a16891f84e7b","1","Edgar","Lucart","2018-06-12 10:54:51");
INSERT INTO usuario VALUES("4","jlucart","502e4a16930e414107ee22b6198c578f","3","jose","lucart","2018-06-12 11:03:16");





CREATE TABLE `vehiculos` (
  `id_vehiculo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `placa` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `anio` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`placa`),
  UNIQUE KEY `placa` (`placa`),
  KEY `id_vehiculo` (`id_vehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO vehiculos VALUES("0","N/A","N/A","0","N/A","2018-06-12 13:22:02");
INSERT INTO vehiculos VALUES("3","CHEVROLET","CORSA","AAE-965","2001","2018-06-12 13:31:42");
INSERT INTO vehiculos VALUES("1","FORD","FIESTA","ADF15D","2011","2018-06-12 13:18:09");



