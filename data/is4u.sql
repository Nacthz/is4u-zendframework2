-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2016 a las 01:24:53
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `is4u`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `ctgId` int(11) NOT NULL AUTO_INCREMENT,
  `ctgNmb` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ctgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ctgId`, `ctgNmb`) VALUES
(1, 'Televisores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `cmtId` int(11) NOT NULL AUTO_INCREMENT,
  `usrId` int(11) NOT NULL,
  `cmt` varchar(200) COLLATE utf8_bin NOT NULL,
  `cmtDate` datetime NOT NULL,
  PRIMARY KEY (`cmtId`),
  KEY `usrId` (`usrId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE IF NOT EXISTS `direcciones` (
  `vntId` int(11) NOT NULL,
  `drcId` int(11) NOT NULL AUTO_INCREMENT,
  `drc` varchar(200) COLLATE utf8_bin NOT NULL,
  `drcBrr` varchar(70) COLLATE utf8_bin NOT NULL,
  `drcDpt` varchar(70) COLLATE utf8_bin NOT NULL,
  `drcCda` varchar(70) COLLATE utf8_bin NOT NULL,
  `drcTel` varchar(20) COLLATE utf8_bin NOT NULL,
  `drcCel` varchar(70) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`drcId`),
  KEY `vntId` (`vntId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `fvrId` int(11) NOT NULL AUTO_INCREMENT,
  `prdId` int(11) NOT NULL,
  `usrId` int(11) NOT NULL,
  PRIMARY KEY (`fvrId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `photo` varchar(150) COLLATE utf8_bin NOT NULL,
  `detail` varchar(6000) COLLATE utf8_bin NOT NULL,
  `price` int(9) NOT NULL,
  `price_sale` int(9) NOT NULL,
  `quantity` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `photo`, `detail`, `price`, `price_sale`, `quantity`) VALUES
(18, 'TV 32” 80 cm SAMSUNG 32J4300 HD Internet', 'tv_samsung_32j4300.jpg', 'Pulgadas: 32Medida Diagonal: 80 cmSintonizador Digital DVB-T2Resolución: HDContraste: MEGAEntradas: HDMI (2) USB (1) COMPONENTE (1)Velocidad Respuesta: 120 CMROtros: SMART TV – MODO FUTBOL – DISEÑO DELGADO', 949000, 949000, 11),
(19, 'iPhone 6s Plus 64Gb Rosado 4G', 'Iphone_6_rosado.jpg', 'Resolución:  1334 x 750 pixeles a 326 ppi\r\nTamaño de pantalla:  4.7"\r\nCámara primaria:  12 Mpx\r\nCámara secundaria:  5 Mpx\r\nSMS:  Si\r\nGPS:  GPS asistido\r\nBluetooth:  V4.2\r\nWi-fi:  true\r\nCámara Incoporada:  Si\r\nProcesador:  Chip A9 con arquitectura de 64 bits,coprocesador de movimiento M9 integrado\r\nSensores:  Sensor para identificar huellas digitales integrado en el botón de inicio,barómetro, giroscopio de tres ejes, acelerómetro, sensor de proximidad, sensor de luz ambiental\r\nMemoria interna:  16 GB\r\nSistema operativo:  iOS\r\nDuración batería StandBy:  Hasta 10 días\r\nTipo batería:  Batería de iones de litio recargable integrada\r\nCargador:  Adaptador de corriente o del puerto USB de la computadora\r\nSIM:  Nano sim\r\n', 3210375, 3210375, 4),
(20, 'iPhone 5S 32 GB gris espacial', 'Iphone_5_gris.jpg', 'Resolución:  1.136 por 640 píxeles a 326 p/p\r\nTamaño de pantalla:  4.0"\r\nPantalla táctil:  Si\r\nColores de pantalla:  16 M\r\nTipo de pantalla:  Pantalla Multi-Touch panorámica, Pantalla Retina\r\nDiseño del teléfono:  Bar\r\nCámara primaria:  8 Mpx\r\nCámara secundaria:  1.2 Mpx\r\nVideos:  720p\r\nAlert Types:  Si\r\nEntrada de audio:  3.5 mm\r\nAltavoz:  Si\r\nRedes Sociales:  Si\r\nJava:  No\r\nFlash:  No\r\nSMS:  Si\r\nMMS:  Si\r\nMoviltalk:  No\r\nGPS:  A-GPS, GeoTagging y GLONASS\r\nBandas:  4G\r\nBluetooth:  V4.0\r\nInternet / WAP:  Si\r\nWi-fi:  802.11 a/b/g/n\r\nAgenda:  Si\r\nCorreo Electrónico:  Si\r\nBrowser:  Safari\r\nCámara Incoporada:  Si\r\nRadio FM/ AM:  No\r\nMarcación por voz:  Si\r\nRed:  Always On\r\nTeclado:  Touch\r\nProcesador:  Chip A7\r\nSensores:  Giroscopio de tres ejes, Acelerómetro, Sensor de proximidad, Sensor de luz ambiental\r\nMemoria interna:  32 GB\r\nDuración batería uso:  Hasta 250 horas\r\nCargador:  Conector Lightning\r\nSIM:  Nano sim\r\nNFC:  No\r\nCampo adicional:  4 – AWS\r\nIphone_5_gris\r\n', 886900, 886900, 23),
(21, 'Alcatel Idol 2 Mini S', 'One_Touch_Mini.jpg', 'Resolución:  540 x 960 px\r\nTamaño de pantalla:  4.5"\r\nPantalla táctil:  Capacitiva\r\nColores de pantalla:  16 M\r\nTipo de pantalla:  TFT\r\nCámara primaria:  8 Mpx\r\nCámara secundaria:  2 Mpx\r\nVideos:  3GP\r\nAlert Types:  Si\r\nAudio:  MP3\r\nAltavoz:  Si\r\nRedes Sociales:  Si\r\nSMS:  Si\r\nMMS:  Si\r\nMoviltalk:  No\r\nGPS:  Si\r\nBandas:  4G\r\nBluetooth:  v 4.0\r\nInternet / WAP:  Si\r\nWi-fi:  Si\r\nCorreo Electrónico:  Si\r\nBrowser:  Si\r\nCámara Incoporada:  Si\r\nRadio FM/ AM:  FM\r\nMarcación por voz:  Si\r\nRed:  On demand\r\nTeclado:  Touch\r\nProcesador:  Quad Core 1.2GHz Qualcomm\r\nMemoria interna:  4GB (2G disponibles para el usuario)\r\nMemoria externa:  Hasta 32 GB\r\nSistema operativo:  Android\r\nDuración batería uso:  9h(2G) / 13h (3G)\r\nTipo batería:  Li-ion 2000 mAh\r\nSIM:  Micro sim\r\n', 320900, 320900, 12),
(22, 'Alcatel POP 2 (4.5) LTE', 'alcatel_pop_2.jpg', 'Resolución:  480x854 Tamaño de pantalla:  4.5" Pantalla táctil:  Capacitiva Colores de pantalla:  16M Tipo de pantalla:  TFT Diseño del teléfono:  Bar Cámara primaria:  5 Mpx Cámara secundaria:  VGA SMS:  Si MMS:  Si GPS:  Si Bandas:  4G Bluetooth:  4 Internet / WAP:  Si Wi-fi:  Hot Spot Agenda:  Ilimitada Correo Electrónico:  si Browser:  Si Cámara Incoporada:  Si Radio FM/ AM:  Si Teclado:  Táctil Procesador:  Quad core 1.2GHz Memoria interna:  ROM 8GB. Disponible 5GB a usuario final Memoria externa:  Soporta hasta 32GB Sistema operativo:  Android Duración batería uso:  12 horas Duración batería StandBy:  300 horas Tipo batería:  Li-Ion 2000mAh Cargador:  TBC Micro USB SIM:  Micro sim', 199900, 199900, 3),
(23, 'BlackBerry Curve 9320', 'B_B_curve.jpg', 'Cámara primaria:  3 Mpx Videos:  MP4/WMV/H.263/H.264 Alert Types:  Si Audio:  MP3/eAAC+/WMA/WAV/FLAC Entrada de audio:  3.5 mm Altavoz:  Si Redes Sociales:  Si Java:  No Flash:  No Conectividad:  Wi-Fi, GPS, Bluetooth, Wi-Fi Direct SMS:  Si MMS:  Si Moviltalk:  No GPS:  GPS integrado con A-GPS Bandas:  3G Bluetooth:  Bluetooth 2.1 Internet / WAP:  Si Wi-fi:  Si Agenda:  Agenda telefónica Correo Electrónico:  Si Visualizador de documentos:  Word, Excel, PowerPoint, PDF Browser:  BlackBerry Cámara Incoporada:  Si Radio FM/ AM:  Si Marcación por voz:  Si Red:  Always On Teclado:  QWERTY Procesador:  806MHz Sensores:  Acelerómetro, sensor de proximidad, Brújula / Magnetómetro Memoria interna:  512MB Memoria externa:  Hasta 32 GB Sistema operativo:  Otros Duración batería uso:  7 horas Duración batería StandBy:  18 días Duración batería con música:  30 horas Cargador:  Micro USB SIM:  Sim normal NFC:  No', 340000, 340000, 9),
(24, 'Huawei Mate S', 'Huawei_Mate_S.jpg', 'Cámara primaria:  13 Mpx Cámara secundaria:  8 Mpx Videos:  *.3gp, *.mp4, *.wmv, *.rm, *.rmvb, *.as Audio:  *.mp3, *.mp4, *.3gp, *wma, *.ogg, *.amr, *.aac, *.flac, *.wav, *.midi, *.ra Redes Sociales:  No Flash:  Si SMS:  Si MMS:  Si GPS:  Si Bandas:  4G Bluetooth:  v 4.1 Internet / WAP:  No Wi-fi:  Si, Direct y Hot Spot Agenda:  Depende de la memoria restante Correo Electrónico:  Gmail Browser:  Android Nativo Cámara Incoporada:  Si Radio FM/ AM:  FM Procesador:  Octa-Core Hisilicon 2.0GHz Memoria interna:  ROM: 32GB, Disponible para el usuario: 24GB Memoria externa:  128GB Sistema operativo:  Android Duración batería uso:  2G: 21h, 3G: 14h Duración batería StandBy:  2G: 452h, 3G: 483h, 4G: 440h Tipo batería:  Li-Poly 2700mAh Cargador:  Micro USB SIM:  Nano sim NFC:  Si', 2064900, 2064900, 12),
(25, 'Huawei Y3 Dual Sim Blanco', 'Huawei_Y3.jpg', 'cámara primaria:  5 Mpx Cámara secundaria:  2 Mpx Videos:  *.3gp, *.mp4 Audio:  *.mp3, *.mid, *.amr, *.wav,*.ogg Redes Sociales:  Si Flash:  Si SMS:  Si MMS:  SI GPS:  Si Bandas:  3G Bluetooth:  4 Wi-fi:  WiFi/USB tethering Agenda:  Depende de la memoria restante Correo Electrónico:  Si Visualizador de documentos:  SI (Aplicación descargable) Browser:  Android Nativo Cámara Incoporada:  Si Radio FM/ AM:  FM Marcación por voz:  No Procesador:  Mediatek Quad-Core 1.3GHz Memoria interna:  ROM: 4GB Memoria externa:  32GB Sistema operativo:  Android Duración batería uso:  2G:600min, 3G: 540min Duración batería StandBy:  2G: 280H, 3G: 220H Tipo batería:  Li-ion 1730mAh Cargador:  Micro USB SIM:  Micro sim NFC:  No', 199900, 199000, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `prdId` int(11) NOT NULL AUTO_INCREMENT,
  `ctgId` int(11) NOT NULL,
  `prdNmb` varchar(100) COLLATE utf8_bin NOT NULL,
  `prdDsc` varchar(600) COLLATE utf8_bin NOT NULL,
  `prdSrc` varchar(200) COLLATE utf8_bin NOT NULL,
  `prdPrc` double NOT NULL,
  `prdPrcDsc` double NOT NULL,
  `prdCnt` int(11) NOT NULL,
  PRIMARY KEY (`prdId`),
  KEY `ctgId` (`ctgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`prdId`, `ctgId`, `prdNmb`, `prdDsc`, `prdSrc`, `prdPrc`, `prdPrcDsc`, `prdCnt`) VALUES
(1, 1, 'TV 32” 80 cm SAMSUNG 32J4300 HD Internet', 'Pulgadas: 32\nMedida Diagonal: 80 cm\nSintonizador Digital DVB-T2\nResolución: HD\nContraste: MEGA\nEntradas: HDMI (2) USB (1) COMPONENTE (1)\nVelocidad Respuesta: 120 CMR\nOtros: SMART TV – MODO FUTBOL – DISEÑO DELGADO\n', 'images/samsung1.jpg', 949000, 759200, 3),
(2, 1, 'TV 48” 121 cm SAMSUNG 48J5300 Full HD Internet', 'Pulgadas: 48\nMedida Diagonal: 121 cm\nSintonizador Digital DVB-T2\nResolución: Full HD\nContraste: MEGA\nEntradas: HDMI (2) USB (1) COMPONENTE (1)\nVelocidad Respuesta: 120 CMR\nOtros: SMART TV – MODO FUTBOL – WIFI\n', 'images/samsung1.jpg', 1899000, 1519200, 3),
(3, 1, 'TV 32” 80 cm SAMSUNG 32J54000 HD ', 'Pulgadas: 32\nMedida Diagonal: 80 cm\nSintonizador Digital DVB-T2\nResolución: HD\nContraste: MEGA CONTRASTE\nEntradas: HDMI (2) USB (1) COMPONENTE (1)\nVelocidad Respuesta: 120 CMR\nOtros: MODO FUTBOL – DISEÑO DELGADO\n', 'images/sansung', 739000, 591200, 3),
(4, 1, 'TV 55” 138 cm SAMSUNG 55J6300 Full HD ', 'Pulgadas: 55	\nMedida Diagonal: 138 cm\nSintonizador Digital DVB-T2\nResolución: Full HD\nContraste: MEGA \nEntradas: HDMI (4) USB (3) COMPONENTE (1)\nVelocidad Respuesta: 240 CMR\nOtros: SMART TV (TIZEN) – QUAD CORE - WIFI\n', 'images/sansung1', 1399000, 1119200, 3),
(5, 1, 'TV 40” 101 cm SAMSUNG 40J5200 Full HD Internet', 'Pulgadas: 40\nMedida Diagonal: 101 cm\nSintonizador Digital DVB-T2\nResolución: Full HD\nContraste: MEGA \nEntradas: HDMI (2) USB (1) COMPONENTE (1)\nVelocidad Respuesta: 120 CMR\nOtros: SMART TV – MODO FUTBOL', 'images/sansung', 739000, 591200, 3),
(6, 1, 'TV 24” 60 cm Kalley LED24HDK', 'Pulgadas: 24\nMedida Diagonal: 61 cm\nResolución: HD\nContraste: 3000:1\nEntradas: HDMI (2) USB (1) VGA (1)\nVelocidad Respuesta: 60 HZ\n', 'images/sansung1', 399000, 319200, 3),
(7, 1, 'TV 40” 101 cm LED Kalley K-LED 40FHDZ T2', 'Pulgadas: 40\r\nMedida Diagonal: 101.6 cm\r\nSintonizador Digital: DVB-T2\r\nResolución: Full HD\r\nContraste: 5000:1\r\nEntradas: HDMI (3) USB (1) VGA (1) YPbPr (1)\r\nVelocidad Respuesta: 60 HZ\r\nTV Multimedia PVR Grabador Dígital\r\n', 'images/sansung1', 1049000, 839200, 3),
(8, 1, 'TV 32” 80 cm Kalley  32HD X T2', 'Pulgadas: 32\r\nMedida Diagonal: 80 cm\r\nResolución: HD\r\nContraste: 3000:1\r\nEntradas: HDMI (2) USB (1) YPbPr (1) VGA (1)\r\nVelocidad Respuesta: 60 HZ\r\nOtros: Grabador digital (PVR)\r\n', 'images/sansung1', 599000, 479200, 3),
(9, 1, 'TV 43” 109 cm LED LG 43LF590 Full HD Internet', 'Pulgadas: 43\r\nMedida Diagonal: 109 cm\r\nSincronizador Digital: DVB-T2\r\nResolución: 1920x1080 FHD\r\nContraste: TBD\r\nEntradas: HDMI (2) USB (2) \r\nVelocidad Respuesta: 60 HZ\r\n', 'images/sansung1', 1403220, 1122576, 3),
(10, 1, 'TV 49” 124.4 cm LED LG 49LF510 Full HD ', 'Pulgadas: 49\r\nMedida Diagonal: 124.4 cm\r\nSincronizador Digital: DVB-T2\r\nResolución: 1920x1080 FHD\r\nContraste: TBD\r\nEntradas: HDMI (1) USB (1) \r\nVelocidad Respuesta: 60 HZ\r\n', 'images/sansung1', 1595240, 1276192, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosventas`
--

CREATE TABLE IF NOT EXISTS `productosventas` (
  `vntId` int(11) NOT NULL,
  `prdId` int(11) NOT NULL,
  `prdCnt` int(11) NOT NULL,
  KEY `vntId` (`vntId`),
  KEY `prdId` (`prdId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE IF NOT EXISTS `puntajes` (
  `prdId` int(11) NOT NULL AUTO_INCREMENT,
  `usrId` int(11) NOT NULL,
  `pnt` int(11) NOT NULL,
  PRIMARY KEY (`prdId`),
  KEY `usrId` (`usrId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `usr_password` varchar(100) COLLATE utf8_bin NOT NULL,
  `usr_email` varchar(60) COLLATE utf8_bin NOT NULL,
  `usrl_id` int(11) DEFAULT NULL,
  `lng_id` int(11) DEFAULT NULL,
  `usr_active` tinyint(4) NOT NULL,
  `usr_question` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `usr_answer` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `usr_picture` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `usr_password_salt` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `usr_registration_date` datetime DEFAULT NULL,
  `usr_registration_token` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `usr_email_confirmed` tinyint(4) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_password`, `usr_email`, `usrl_id`, `lng_id`, `usr_active`, `usr_question`, `usr_answer`, `usr_picture`, `usr_password_salt`, `usr_registration_date`, `usr_registration_token`, `usr_email_confirmed`) VALUES
(1, 'Julianita', '60bb2fe3b0bc95073f915673fa459bed', 'julianarojas03@yopmail.com', 2, 1, 1, NULL, NULL, NULL, '9!=7biN~pQgvmLzy3?HV(@~g''3$|8-D25rCr&Zp}E)0!:R/u?[', '2016-04-26 02:27:10', '9481ab7d62077165ac493ef970cf7c7e', 1),
(2, 'karen20', '699fffcb92f84d5b69972cf449139cd9', 'karensita@yopmail.com', 2, 1, 1, NULL, NULL, NULL, '{BEoeV0r>-$Z0.7v:2O*)C!$Y9O%9}3~%+m4IgVTCN1@@HrI<-', '2016-04-26 15:49:22', '9ddd2eaeddbd9d0e608ac63be6a2b7d6', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usrId` int(11) NOT NULL AUTO_INCREMENT,
  `usrNmb` varchar(10) COLLATE utf8_bin NOT NULL,
  `usrApl` varchar(10) COLLATE utf8_bin NOT NULL,
  `usrEml` varchar(30) COLLATE utf8_bin NOT NULL,
  `usrPsw` varchar(10) COLLATE utf8_bin NOT NULL,
  `usrNac` date NOT NULL,
  `usrGnr` int(11) NOT NULL,
  `usrRol` int(11) NOT NULL,
  PRIMARY KEY (`usrId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `vntId` int(11) NOT NULL AUTO_INCREMENT,
  `usrId` int(11) NOT NULL,
  `vntVlr` double NOT NULL,
  `vntVlrEnv` double NOT NULL,
  `vntTot` double NOT NULL,
  `cntEst` int(11) NOT NULL,
  PRIMARY KEY (`vntId`),
  KEY `usrId` (`usrId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`cmtId`) REFERENCES `usuarios` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usrId`) REFERENCES `usuarios` (`usrId`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`vntId`) REFERENCES `ventas` (`vntId`);

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`fvrId`) REFERENCES `productos` (`prdId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ctgId`) REFERENCES `categorias` (`ctgId`);

--
-- Filtros para la tabla `productosventas`
--
ALTER TABLE `productosventas`
  ADD CONSTRAINT `productosventas_ibfk_1` FOREIGN KEY (`vntId`) REFERENCES `ventas` (`vntId`),
  ADD CONSTRAINT `productosventas_ibfk_2` FOREIGN KEY (`prdId`) REFERENCES `productos` (`prdId`);

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `puntajes_ibfk_1` FOREIGN KEY (`prdId`) REFERENCES `productos` (`prdId`),
  ADD CONSTRAINT `puntajes_ibfk_2` FOREIGN KEY (`prdId`) REFERENCES `productos` (`prdId`),
  ADD CONSTRAINT `puntajes_ibfk_3` FOREIGN KEY (`usrId`) REFERENCES `usuarios` (`usrId`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`usrId`) REFERENCES `puntajes` (`prdId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`usrId`) REFERENCES `usuarios` (`usrId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
