

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO clientes VALUES("1","Seguros Constitucion C.A.","2","401331645","sconstitucion2018@segurosconstitucion.com","02128142125","Edificio torre empresarial, sector bello monte, avenida Miranda, Chacaito, Estado Miranda","2018-06-12 15:41:12");
INSERT INTO clientes VALUES("2","Seguros Universita","2","30305425","universitas12@segurosuniversitas.com","02812745154","Centro empresarial Lecherias, avenida principal, planta baja, lecheria Estado Anzoategui","2018-06-12 15:44:08");





CREATE TABLE `factura` (
  `id_factura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_vehiculo` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned NOT NULL,
  `iva` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `total` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `ordenCompra` text COLLATE utf8_spanish_ci NOT NULL,
  `n_poliza` text COLLATE utf8_spanish_ci NOT NULL,
  `n_siniestro` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fechaPago` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_factura`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO factura VALUES("1","ADF-85J","1","2","10200000.00","95200000.00","AS85545-AS*AS5","2011-02018A","32363-2011A","2018-04-12","2018-06-13","3","2018-06-12 16:03:16");
INSERT INTO factura VALUES("2","ADFSDS5","1","1","14400000.00","134400000.00","as5554","2012aas-2322212","21125-2211","2018-05-12","2018-06-13","3","2018-06-12 17:08:07");
INSERT INTO factura VALUES("3","0","1","2","43800000.00","408800000.00","22555aasaa","2012201","","2018-06-12","2018-06-13","1","2018-06-12 17:23:01");
INSERT INTO factura VALUES("4","ADF25YU","19","1","54000000.00","504000000.00","swasww","wwqw","qwqwq","2018-06-13","2018-06-13","2","2018-06-13 18:41:31");
INSERT INTO factura VALUES("5","adf4488","1","1","4250400.00","39670400.00","asa-1442","sasa-96544","assas322s444","2018-06-13","","1","2018-06-13 21:31:49");





CREATE TABLE `factura_repuesto` (
  `id_fac_repuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_repuesto` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `cantidad` varchar(115) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_fac_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO factura_repuesto VALUES("1","2","1","1","2018-06-12 16:03:17");
INSERT INTO factura_repuesto VALUES("2","3","2","1","2018-06-12 17:08:07");
INSERT INTO factura_repuesto VALUES("3","1","3","1","2018-06-12 17:23:01");
INSERT INTO factura_repuesto VALUES("4","2","3","1","2018-06-12 17:23:01");
INSERT INTO factura_repuesto VALUES("5","4","4","1","2018-06-13 18:41:31");
INSERT INTO factura_repuesto VALUES("6","5","4","1","2018-06-13 18:41:31");
INSERT INTO factura_repuesto VALUES("7","7","5","2","2018-06-13 21:31:49");
INSERT INTO factura_repuesto VALUES("8","8","5","2","2018-06-13 21:31:49");





CREATE TABLE `nota_entrega` (
  `id_nota_entrega` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_nota_entrega` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `id_factura` int(10) unsigned NOT NULL,
  `empresa_envio` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `guia` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `costo_envio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_envio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fechaEntrega` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nota_entrega`),
  KEY `id_factura` (`id_factura`),
  CONSTRAINT `nota_entrega_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO nota_entrega VALUES("1","0001","1","TEALCA","TR-524412","250000","1","2018-06-05","2018-06-14","2018-06-12 16:03:16");
INSERT INTO nota_entrega VALUES("2","002","5","domesa","asa48484--aasaa","2500000","2","","","2018-06-13 21:31:49");





CREATE TABLE `repuesto` (
  `id_repuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `detalle` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `precio_unitario` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `stock` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO repuesto VALUES("1","2","Parachoque trasero","para fortuner 2012-2016","280000000","1","2018-06-12 15:27:15");
INSERT INTO repuesto VALUES("2","2","Faro LH","para chevrolet cruze","85000000","4","2018-06-12 15:27:57");
INSERT INTO repuesto VALUES("3","1","Faro LH","para chevrolet cruze","120000000","3","2018-06-12 15:28:23");
INSERT INTO repuesto VALUES("4","3","Puerta delantera RH","para toyota meru 2002-2006","100000000","4","2018-06-12 15:29:03");
INSERT INTO repuesto VALUES("5","1","Espejo retrovisor","para mack granite o vision","350000000","5","2018-06-12 15:29:59");
INSERT INTO repuesto VALUES("7","3","Parachoque delantero","chevrolet blazer","5210000","4","2018-06-12 17:19:28");
INSERT INTO repuesto VALUES("8","1","Faro","para toyota corolla","12500000","12","2018-06-12 17:20:07");
INSERT INTO repuesto VALUES("9","2","Cocuyo delantero","para ford explorer","1250000","2","2018-06-12 17:20:32");





CREATE TABLE `rol` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO rol VALUES("1","Presidente","2018-06-12 15:17:30");
INSERT INTO rol VALUES("2","Director Administrativo","2018-06-12 15:17:30");
INSERT INTO rol VALUES("3","Vendedor","2018-06-12 15:17:30");
INSERT INTO rol VALUES("4","Administrador del Sistema","2018-06-12 15:17:30");





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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO usuario VALUES("1","llucart","28718610a6a764ade6df171a7f0a5bf2","4","Luis","Lucart","2018-06-12 15:19:36");
INSERT INTO usuario VALUES("2","eramirez","b41cb62ec6767f2e41f9df7a2d161515","1","Edgar","Ramirez","2018-06-12 15:22:50");
INSERT INTO usuario VALUES("3","silva23","025534300f6347096d973e5f8bb175e1","2","Jose","Silva","2018-06-12 15:23:37");
INSERT INTO usuario VALUES("4","jhernandez","83a41092a07ec414b010bd68b2e5cd95","3","Jorge","Hernandez","2018-06-12 15:25:45");
INSERT INTO usuario VALUES("15","jcortez2","25d55ad283aa400af464c76d713c07ad","3","jose","cortez","2018-06-13 11:19:23");
INSERT INTO usuario VALUES("17","lrondon","274377e46cc4be92468beb04f27dfa89","4","luis","rondon","2018-06-13 11:22:39");
INSERT INTO usuario VALUES("18","eramirezz","25d55ad283aa400af464c76d713c07ad","4","Luis","Rondon","2018-06-13 17:39:07");
INSERT INTO usuario VALUES("19","luiser8","25d55ad283aa400af464c76d713c07ad","4","Luis","Rondon","2018-06-13 17:40:19");
INSERT INTO usuario VALUES("20","rramos","bf93814eb3345dd80567cfaf58fa9b16","4","Romer","Ramos","2018-06-13 17:54:42");





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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO vehiculos VALUES("1","N/A","N/A","0","N/A","2018-06-12 15:50:32");
INSERT INTO vehiculos VALUES("2","CHEVROLET","CRUZE","ADF-85J","2012","2018-06-12 16:03:16");
INSERT INTO vehiculos VALUES("4","Dodge","Ram","ADF25YU","2011","2018-06-13 18:41:31");
INSERT INTO vehiculos VALUES("5","toyota","meru","adf4488","2011","2018-06-13 21:31:49");
INSERT INTO vehiculos VALUES("3","CHERY","ORINOCO","ADFSDS5","2014","2018-06-12 17:08:07");



