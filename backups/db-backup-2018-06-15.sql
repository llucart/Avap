

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO clientes VALUES("1","Seguros Constitucion C.A.","2","404174742","sconstitucion2018@segurosconstitucion.com","02128142145","Edificio torre empresarial, sector bello monte, avenida Miranda, Chacaito, Estado Miranda","2018-06-12 15:41:12");
INSERT INTO clientes VALUES("2","Seguros Universita","2","30305425","universitas12@segurosuniversitas.com","02812745154","Centro empresarial Lecherias, avenida principal, planta baja, lecheria Estado Anzoategui","2018-06-12 15:44:08");
INSERT INTO clientes VALUES("3","milagros lucart","1","19978024","mlucart@gmail.com","04148141201","urbanizacion boyaca IV vereda 11 casa numero 04, barcelona estado anzoategui","2018-06-14 13:55:45");
INSERT INTO clientes VALUES("4","SUPER REPUESTOS 1","4","45874974","super1@gmail.com","04263025124","barcelona estado anzoategui","2018-06-14 20:12:24");
INSERT INTO clientes VALUES("5","seguros baneco","2","458044848","segurosbanesco@gmail.com","021452145","avenida caracas","2018-06-14 22:30:24");





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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO factura VALUES("1","ADF-85J","1","4","10200000.00","95200000.00","sisi96-sa","AS8-AS","1255-as55","2018-04-12","2018-06-14","1","2018-06-12 16:03:16");
INSERT INTO factura VALUES("2","ADFSDS5","1","2","14400000.00","134400000.00","as5554","2012aas-2322212","21125-2211","2018-04-12","2018-06-14","1","2018-06-12 17:08:07");
INSERT INTO factura VALUES("3","0","1","2","43800000.00","408800000.00","22555aasaa","2012201","","2018-06-12","2018-06-13","1","2018-06-12 17:23:01");
INSERT INTO factura VALUES("4","ADF25YU","19","1","54000000.00","504000000.00","swasww","wwqw","qwqwq","2018-06-13","2018-06-13","3","2018-06-13 18:41:31");
INSERT INTO factura VALUES("5","adf4488","1","1","4250400.00","39670400.00","asa-1442","sasa-96544","assas322s444","2018-06-13","2018-05-29","1","2018-06-13 21:31:49");
INSERT INTO factura VALUES("6","adf985a","4","1","70800000.00","660800000.00","asa-32321","hdnns-255","95447--s","2018-06-13","2018-06-14","1","2018-06-13 23:49:44");
INSERT INTO factura VALUES("7","AA695SS","4","2","90150000.00","841400000.00","asa9985","aaaas-9985","asaa885-a","2018-06-13","","2","2018-06-13 23:51:32");
INSERT INTO factura VALUES("8","ADF98DR","3","3","75600000.00","705600000.00","21-554asa-a","215445-58","5845-218","2018-06-14","","2","2018-06-14 22:11:16");
INSERT INTO factura VALUES("9","0","3","1","85500000.00","798000000.00","","","","2018-06-14","","1","2018-06-14 22:12:36");
INSERT INTO factura VALUES("10","0","3","3","181250400.00","1691670400.0","","","","2018-06-14","","1","2018-06-14 22:14:00");
INSERT INTO factura VALUES("11","0","3","1","3625200.00","33835200.00","","","","2018-06-14","","1","2018-06-14 22:15:44");
INSERT INTO factura VALUES("12","0","3","2","1500000.00","14000000.00","","","","2018-05-14","","2","2018-06-14 22:17:25");
INSERT INTO factura VALUES("13","0","3","2","183000000.00","1708000000.0","","","","2018-04-14","","2","2018-06-14 22:20:22");





CREATE TABLE `factura_repuesto` (
  `id_fac_repuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_repuesto` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `cantidad` varchar(115) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_fac_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO factura_repuesto VALUES("1","2","1","1","2018-06-12 16:03:17");
INSERT INTO factura_repuesto VALUES("2","3","2","1","2018-06-12 17:08:07");
INSERT INTO factura_repuesto VALUES("3","1","3","1","2018-06-12 17:23:01");
INSERT INTO factura_repuesto VALUES("4","2","3","1","2018-06-12 17:23:01");
INSERT INTO factura_repuesto VALUES("5","4","4","1","2018-06-13 18:41:31");
INSERT INTO factura_repuesto VALUES("6","5","4","1","2018-06-13 18:41:31");
INSERT INTO factura_repuesto VALUES("7","7","5","2","2018-06-13 21:31:49");
INSERT INTO factura_repuesto VALUES("8","8","5","2","2018-06-13 21:31:49");
INSERT INTO factura_repuesto VALUES("9","2","6","2","2018-06-13 23:49:44");
INSERT INTO factura_repuesto VALUES("10","3","6","1","2018-06-13 23:49:44");
INSERT INTO factura_repuesto VALUES("11","4","6","3","2018-06-13 23:49:44");
INSERT INTO factura_repuesto VALUES("12","5","7","2","2018-06-13 23:51:32");
INSERT INTO factura_repuesto VALUES("13","8","7","4","2018-06-13 23:51:32");
INSERT INTO factura_repuesto VALUES("14","9","7","1","2018-06-13 23:51:32");
INSERT INTO factura_repuesto VALUES("15","2","8","2","2018-06-14 22:11:16");
INSERT INTO factura_repuesto VALUES("16","3","8","3","2018-06-14 22:11:16");
INSERT INTO factura_repuesto VALUES("17","4","8","1","2018-06-14 22:11:16");
INSERT INTO factura_repuesto VALUES("18","5","9","2","2018-06-14 22:12:36");
INSERT INTO factura_repuesto VALUES("19","8","9","1","2018-06-14 22:12:36");
INSERT INTO factura_repuesto VALUES("20","7","10","2","2018-06-14 22:14:00");
INSERT INTO factura_repuesto VALUES("21","10","10","1","2018-06-14 22:14:00");
INSERT INTO factura_repuesto VALUES("22","8","11","2","2018-06-14 22:15:44");
INSERT INTO factura_repuesto VALUES("23","7","11","1","2018-06-14 22:15:44");
INSERT INTO factura_repuesto VALUES("24","8","12","1","2018-06-14 22:17:25");
INSERT INTO factura_repuesto VALUES("25","8","13","2","2018-06-14 22:20:22");
INSERT INTO factura_repuesto VALUES("26","10","13","1","2018-06-14 22:20:22");





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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO nota_entrega VALUES("1","0001","1","TEALCA","TR-524412","2500","2","2018-04-05","2018-06-14","2018-06-12 16:03:16");
INSERT INTO nota_entrega VALUES("2","002","5","domesa","asa4411","2500000","2","2018-04-29","2018-06-14","2018-06-13 21:31:49");
INSERT INTO nota_entrega VALUES("3","0012","6","tealca","asa-8844","1250000","1","2018-05-13","2018-06-14","2018-06-13 23:49:44");
INSERT INTO nota_entrega VALUES("4","0021","8","TEALCA","ASA-ASDAASD88/A","2011500","1","2018-06-14","","2018-06-14 22:11:16");





CREATE TABLE `repuesto` (
  `id_repuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `detalle` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `precio_unitario` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `stock` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_repuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO repuesto VALUES("1","2","Parachoque trasero","para fortuner 2012-2016","280000004","2","2018-06-12 15:27:15");
INSERT INTO repuesto VALUES("2","2","Faro LH","para chevrolet cruze","85000000","4","2018-06-12 15:27:57");
INSERT INTO repuesto VALUES("3","1","Faro LH","para chevrolet cruze","120000000","2","2018-06-12 15:28:23");
INSERT INTO repuesto VALUES("4","3","Puerta delantera RH","para toyota meru 2002-2006","100000000","3","2018-06-12 15:29:03");
INSERT INTO repuesto VALUES("5","1","Espejo retrovisor","para mack granite o vision","350000000","1","2018-06-12 15:29:59");
INSERT INTO repuesto VALUES("7","3","Parachoque delantero","chevrolet blazer","5210000","1","2018-06-12 17:19:28");
INSERT INTO repuesto VALUES("8","1","Faro","para toyota corolla","12500000","2","2018-06-12 17:20:07");
INSERT INTO repuesto VALUES("9","2","Cocuyo delantero","para ford explorer","1250000","1","2018-06-12 17:20:32");
INSERT INTO repuesto VALUES("10","1","motor 8 cilindros","para ford f350 5.7ltrs","1500000000","0","2018-06-14 14:21:30");
INSERT INTO repuesto VALUES("11","2","PARACHOQUE DELANTERO","PARA TOYOTA 2011","2510000","3","2018-06-14 23:08:43");
INSERT INTO repuesto VALUES("12","3","motor v8","triton 5.7","520000000","3","2018-06-14 23:13:31");





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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO usuario VALUES("1","llucart","d73fc1c6d4d52573d4c6b6b467a02d1d","4","Luis","Lucart","2018-06-12 15:19:36");
INSERT INTO usuario VALUES("3","silva23","827ccb0eea8a706c4c34a16891f84e7b","2","Jose","Silva","2018-06-12 15:23:37");
INSERT INTO usuario VALUES("4","jhernandez","827ccb0eea8a706c4c34a16891f84e7b","3","Jorge","Hernandez","2018-06-12 15:25:45");
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO vehiculos VALUES("1","N/A","N/A","0","N/A","2018-06-12 15:50:32");
INSERT INTO vehiculos VALUES("7","mazda","clio","AA695SS","2015","2018-06-13 23:51:32");
INSERT INTO vehiculos VALUES("2","CHEVROLET","CRUZE","ADF-85J","2012","2018-06-12 16:03:16");
INSERT INTO vehiculos VALUES("4","Dodge","Ram","ADF25YU","2011","2018-06-13 18:41:31");
INSERT INTO vehiculos VALUES("5","toyota","meru","adf4488","2011","2018-06-13 21:31:49");
INSERT INTO vehiculos VALUES("6","dongfeng","ss","adf985a","2012","2018-06-13 23:49:44");
INSERT INTO vehiculos VALUES("8","mitsubishi","signo","ADF98DR","2018","2018-06-14 22:11:16");
INSERT INTO vehiculos VALUES("3","CHERY","ORINOCO","ADFSDS5","2014","2018-06-12 17:08:07");



