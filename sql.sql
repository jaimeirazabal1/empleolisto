-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-01-2017 a las 12:58:25
-- Versión del servidor: 5.6.33-cll-lve
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `empleolisto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_user` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `company_user`, `url`, `status`, `created`) VALUES
(1, 10, 'ernest', 'stop', '2017-01-13 15:16:35'),
(2, 13, 'lumen123', 'play', '2017-01-24 15:15:36'),
(3, 14, 'comex123', 'play', '2017-01-24 15:42:19'),
(4, 15, 'prueba', 'play', '2017-01-24 19:38:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_fields`
--

CREATE TABLE IF NOT EXISTS `company_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo_url` varchar(255) DEFAULT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `bg_url` varchar(255) DEFAULT NULL,
  `texto` varchar(550) DEFAULT NULL,
  `agradecimiento` text,
  `aviso_privacidad` text,
  `company_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `company_fields`
--

INSERT INTO `company_fields` (`id`, `logo_url`, `bg_color`, `bg_url`, `texto`, `agradecimiento`, `aviso_privacidad`, `company_id`, `created`) VALUES
(1, 'upload/1484320965_5.jpg', '#8000ff', NULL, '<p>jaime Irazabal 16923509</p>\r\n<p>asdasd</p>\r\n<p>asdasd</p>\r\n<p>asd</p>', '<p><strong>Finalidades del tratamiento de los datos personales</strong></p>\r\n<p>Los datos personales solicitados se requieren para: a) la completa y correcta prestaci&oacute;n de los servicios o venta de los bienes objeto de la relaci&oacute;n comercial que se sostenga con LUMEN b) realizar campa&ntilde;as publicitarias (v&iacute;a telef&oacute;nica y por medios electr&oacute;nicos) para la comercializaci&oacute;n de productos y servicios de Lumen; c) ofrecer informaci&oacute;n sobre nuevos productos y servicios, promociones exclusivas, descuentos, ofertas especiales, regalos y beneficios que Lumen ofrece; d) configurar la base de datos de los clientes de Lumen; e) realizar an&aacute;lisis estad&iacute;sticos y de mercado; f) evaluar la calidad de los productos y servicios de Lumen; g) atender oportunamente las preguntas, sugerencias o quejas que los clientes presentan en relaci&oacute;n con bienes o servicios ofrecidos por Lumen; h) facturar los bienes y servicios ofrecidos por Lumen; i) verificar la identidad del cliente, o bien del contacto que aqu&eacute;l se&ntilde;al&oacute;, al momento de la entrega de la mercanc&iacute;a adquirida; j) generar un expediente crediticio que garantice el cumplimiento de obligaciones de pagos diferidos o en parcialidades, en su caso; k) para fines mercadot&eacute;cnicos, publicitarios o de prospecci&oacute;n comercial ; y l) para la generaci&oacute;n, en su caso, de un registro como usuario o cliente de Lumen con la intenci&oacute;n de facilitar las transacciones comerciales actuales o futuras que el usuario pudiera realizar. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Transferencia de los datos personales</strong></p>\r\n<p>Los datos personales obtenidos a trav&eacute;s de los medios y mecanismos arriba precisados, no ser&aacute;n transferidos a persona o entidad distinta de Lumen. .</p>\r\n<p>&nbsp;</p>\r\n<p>DERECHOS ARCO (Acceso, Rectificaci&oacute;n, Cancelaci&oacute;n y Oposici&oacute;n) y REVOCACI&Oacute;N del consentimiento para el tratamiento de los datos. .</p>\r\n<p>&nbsp;</p>\r\n<p>Para cualquier acceso, rectificaci&oacute;n, cancelaci&oacute;n, oposici&oacute;n o revocaci&oacute;n en el manejo de los datos personales obtenidos a trav&eacute;s de la compra de bienes o servicios por tel&eacute;fono, Lumen pone a su disposici&oacute;n el correo electr&oacute;nico arco@lumen.com.mx y el tel&eacute;fono 54-90-66-93, de los cuales ser&aacute; responsable del resguardo y administraci&oacute;n de la informaci&oacute;n el Comit&eacute; de Derechos Arco, en t&eacute;rminos del Cap&iacute;tulo IV de la Ley Federal de Protecci&oacute;n de Datos Personales en Posesi&oacute;n de los Particulares, art&iacute;culo 21 de su Reglamento, as&iacute; como de las disposiciones contenidas en los Lineamientos del Aviso de Privacidad emitidas por la Secretar&iacute;a de Econom&iacute;a. .</p>\r\n<p>&nbsp;</p>\r\n<p>Para estos efectos, el usuario deber&aacute; enviar a dicha direcci&oacute;n de correo electr&oacute;nico un escrito en el que se&ntilde;ale, de manera clara y expedita, qu&eacute; datos y en qu&eacute; medida desea tener acceso, o bien, rectificar, cancelar, oponerse o revocar su consentimiento al tratamiento de los mismos, adjuntando la documentaci&oacute;n que sustente su petici&oacute;n. .</p>\r\n<p>&nbsp;</p>\r\n<p>Una vez que sea recibida la petici&oacute;n debidamente requisitada en la cuenta de correo electr&oacute;nico ya se&ntilde;alada, Lumen contar&aacute; con un plazo de veinte d&iacute;as (mismos que podr&aacute;n ser ampliados por un periodo igual, dependiendo de las circunstancias del caso) para resolver la petici&oacute;n correspondiente. .</p>\r\n<p>&nbsp;</p>\r\n<p>De resultar procedente la petici&oacute;n del usuario, Lumen deber&aacute; cumplir con la misma en un plazo de quince d&iacute;as contados a partir de la emisi&oacute;n de la resoluci&oacute;n correspondiente. .</p>', '<div class="page-title">\r\n<h1>Aviso de privacidad</h1>\r\n</div>\r\n<p><strong>Responsable</strong></p>\r\n<p>Abastecedora Lumen, S.A. de C.V. (en adelante &ldquo;Lumen&rdquo;), ubicada en Av. Toluca No. 481, Col. Olivar de los Padres, C.P. 01780, Deleg. &Aacute;lvaro Obreg&oacute;n, M&eacute;xico, Distrito Federal, es la responsable del debido tratamiento y resguardo de los datos personales que son recabados de todos aquellos clientes que: a) realizan compras de bienes o servicios por tel&eacute;fono e internet; b) env&iacute;an un correo electr&oacute;nico a Lumen, a efecto de solicitar informaci&oacute;n sobre ciertos bienes o servicios que la empresa ofrece; c) usuarios de los canales de venta Lumen que deseen generar un registro como cliente para la realizaci&oacute;n de operaciones comerciales actuales o futuras; y d) usuarios o clientes que deseen presentar una queja o sugerencia a Lumen. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Datos requeridos</strong></p>\r\n<ul>\r\n<li>Trat&aacute;ndose de compras de bienes o servicios por tel&eacute;fono e internet, los datos que se requieren son los siguientes: i) nombre; ii) direcci&oacute;n de entrega de la mercanc&iacute;a adquirida; iii) tel&eacute;fono; iv) correo electr&oacute;nico; v) de ser requerida una factura, los datos fiscales necesarios para la expedici&oacute;n de la misma, en los t&eacute;rminos de la legislaci&oacute;n fiscal vigente; vi) datos e informaci&oacute;n de la tarjeta y n&uacute;mero de cuenta bancaria con la que se pretende hacer el pago del bien o servicio requerido, cuando dicha operaci&oacute;n sea efectuada directamente con LUMEN; y vii) en su caso, el nombre, tel&eacute;fono y correo electr&oacute;nico del contacto con quien se efectuar&aacute; el cobro de la mercanc&iacute;a adquirida. <br /><br />Es importante se&ntilde;alar que en el caso de que el pago del bien o servicio correspondiente sea gestionado por una entidad distinta a LUMEN, los datos precisados en el inciso vi) anterior ser&aacute;n recabados directamente por dicha entidad sin que LUMEN tenga acceso dicha informaci&oacute;n. Por ello, se reitera que no habr&aacute; transferencia alguna de tales datos en este supuesto.</li>\r\n<li>Trat&aacute;ndose de env&iacute;os de correos electr&oacute;nicos a Lumen, con la finalidad de solicitar informaci&oacute;n sobre ciertos bienes o servicios que la empresa ofrece, o bien para presentar una queja o sugerencia, los datos que se requieren son los siguientes: i) nombre; ii) sexo; iii) correo electr&oacute;nico; iv) tel&eacute;fono; v) entidad federativa donde reside y vi) el comentario que desea ingresar a la p&aacute;gina.</li>\r\n<li>Trat&aacute;ndose del registro como cliente en l&iacute;nea, los datos que se requieren son los siguientes: a) g&eacute;nero; b) nombre completo; c) fecha de nacimiento; d) correo electr&oacute;nico; e) generaci&oacute;n de contrase&ntilde;a .</li>\r\n<li>Para efectos de inscripci&oacute;n al Bolet&iacute;n Mensual de Lumen, los datos que se requieren son los siguientes: i) nombre; ii) correo electr&oacute;nico; iii) fecha de nacimiento; iv) sexo; v) estado civil; vi) si tiene hijos; vii) ocupaci&oacute;n; viii) entidad federativa donde reside; ix) c&oacute;digo postal; x) colonia y xi) sucursal que frecuenta.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Finalidades del tratamiento de los datos personales</strong></p>\r\n<p>Los datos personales solicitados se requieren para: a) la completa y correcta prestaci&oacute;n de los servicios o venta de los bienes objeto de la relaci&oacute;n comercial que se sostenga con LUMEN b) realizar campa&ntilde;as publicitarias (v&iacute;a telef&oacute;nica y por medios electr&oacute;nicos) para la comercializaci&oacute;n de productos y servicios de Lumen; c) ofrecer informaci&oacute;n sobre nuevos productos y servicios, promociones exclusivas, descuentos, ofertas especiales, regalos y beneficios que Lumen ofrece; d) configurar la base de datos de los clientes de Lumen; e) realizar an&aacute;lisis estad&iacute;sticos y de mercado; f) evaluar la calidad de los productos y servicios de Lumen; g) atender oportunamente las preguntas, sugerencias o quejas que los clientes presentan en relaci&oacute;n con bienes o servicios ofrecidos por Lumen; h) facturar los bienes y servicios ofrecidos por Lumen; i) verificar la identidad del cliente, o bien del contacto que aqu&eacute;l se&ntilde;al&oacute;, al momento de la entrega de la mercanc&iacute;a adquirida; j) generar un expediente crediticio que garantice el cumplimiento de obligaciones de pagos diferidos o en parcialidades, en su caso; k) para fines mercadot&eacute;cnicos, publicitarios o de prospecci&oacute;n comercial ; y l) para la generaci&oacute;n, en su caso, de un registro como usuario o cliente de Lumen con la intenci&oacute;n de facilitar las transacciones comerciales actuales o futuras que el usuario pudiera realizar. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Transferencia de los datos personales</strong></p>\r\n<p>Los datos personales obtenidos a trav&eacute;s de los medios y mecanismos arriba precisados, no ser&aacute;n transferidos a persona o entidad distinta de Lumen. .</p>\r\n<p>&nbsp;</p>\r\n<p>DERECHOS ARCO (Acceso, Rectificaci&oacute;n, Cancelaci&oacute;n y Oposici&oacute;n) y REVOCACI&Oacute;N del consentimiento para el tratamiento de los datos. .</p>\r\n<p>&nbsp;</p>\r\n<p>Para cualquier acceso, rectificaci&oacute;n, cancelaci&oacute;n, oposici&oacute;n o revocaci&oacute;n en el manejo de los datos personales obtenidos a trav&eacute;s de la compra de bienes o servicios por tel&eacute;fono, Lumen pone a su disposici&oacute;n el correo electr&oacute;nico arco@lumen.com.mx y el tel&eacute;fono 54-90-66-93, de los cuales ser&aacute; responsable del resguardo y administraci&oacute;n de la informaci&oacute;n el Comit&eacute; de Derechos Arco, en t&eacute;rminos del Cap&iacute;tulo IV de la Ley Federal de Protecci&oacute;n de Datos Personales en Posesi&oacute;n de los Particulares, art&iacute;culo 21 de su Reglamento, as&iacute; como de las disposiciones contenidas en los Lineamientos del Aviso de Privacidad emitidas por la Secretar&iacute;a de Econom&iacute;a. .</p>\r\n<p>&nbsp;</p>\r\n<p>Para estos efectos, el usuario deber&aacute; enviar a dicha direcci&oacute;n de correo electr&oacute;nico un escrito en el que se&ntilde;ale, de manera clara y expedita, qu&eacute; datos y en qu&eacute; medida desea tener acceso, o bien, rectificar, cancelar, oponerse o revocar su consentimiento al tratamiento de los mismos, adjuntando la documentaci&oacute;n que sustente su petici&oacute;n. .</p>\r\n<p>&nbsp;</p>\r\n<p>Una vez que sea recibida la petici&oacute;n debidamente requisitada en la cuenta de correo electr&oacute;nico ya se&ntilde;alada, Lumen contar&aacute; con un plazo de veinte d&iacute;as (mismos que podr&aacute;n ser ampliados por un periodo igual, dependiendo de las circunstancias del caso) para resolver la petici&oacute;n correspondiente. .</p>\r\n<p>&nbsp;</p>\r\n<p>De resultar procedente la petici&oacute;n del usuario, Lumen deber&aacute; cumplir con la misma en un plazo de quince d&iacute;as contados a partir de la emisi&oacute;n de la resoluci&oacute;n correspondiente. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Opciones y medios para limitar el uso o divulgaci&oacute;n de los datos personales</strong></p>\r\n<p>En caso de que el titular decida limitar el uso o divulgaci&oacute;n de los datos personales recabados, Lumen pone a su disposici&oacute;n la direcci&oacute;n de correo electr&oacute;nico arco@lumen.com.mx, para que as&iacute; lo manifieste de manera expresa. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Cambios al aviso de privacidad</strong></p>\r\n<p>En caso de realizar modificaciones a nuestro Aviso de Privacidad, enviaremos un correo electr&oacute;nico a los titulares de los datos personales recabados, para informarles sobre dichos cambios, mismo que incluir&aacute; el v&iacute;nculo para consultarlos. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Consentimiento del usuario</strong></p>\r\n<p>Estoy de acuerdo con los t&eacute;rminos y condiciones de privacidad y protecci&oacute;n de datos establecidas en el presente Aviso de Privacidad, incluidas la finalidad y tratamiento de dichos datos, por lo que manifiesto mi consentimiento expreso e inequ&iacute;voco para tales efectos. .</p>', 1, '2017-01-13 15:16:35'),
(2, 'upload/1485271253_Captura de pantalla 2017-01-19 a la(s) 15.59.04.png', '#05beff', 'upload/1485271253_Captura de pantalla 2017-01-19 a la(s) 15.50.48.png', '<p>Somos una empresa 100% mexicana reconocida por nuestro gran surtido y variedad de productos en las &aacute;reas de papel, arte, computo, fotograf&iacute;a, oficina, escolar, mobiliario, manualidades dibujo, escritura adhesivos, electr&oacute;nica y libros.&nbsp;</p>\r\n<p><strong>&iexcl;Y seguimos creciendo!</strong></p>', '<p>Muchas gracias por subir tus datos</p>', '<div class="page-title">\r\n<h1>Aviso de privacidad</h1>\r\n</div>\r\n<p><strong>Responsable</strong></p>\r\n<p>Abastecedora Lumen, S.A. de C.V. (en adelante &ldquo;Lumen&rdquo;), ubicada en Av. Toluca No. 481, Col. Olivar de los Padres, C.P. 01780, Deleg. &Aacute;lvaro Obreg&oacute;n, M&eacute;xico, Distrito Federal, es la responsable del debido tratamiento y resguardo de los datos personales que son recabados de todos aquellos clientes que: a) realizan compras de bienes o servicios por tel&eacute;fono e internet; b) env&iacute;an un correo electr&oacute;nico a Lumen, a efecto de solicitar informaci&oacute;n sobre ciertos bienes o servicios que la empresa ofrece; c) usuarios de los canales de venta Lumen que deseen generar un registro como cliente para la realizaci&oacute;n de operaciones comerciales actuales o futuras; y d) usuarios o clientes que deseen presentar una queja o sugerencia a Lumen. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Datos requeridos</strong></p>\r\n<ul>\r\n<li>Trat&aacute;ndose de compras de bienes o servicios por tel&eacute;fono e internet, los datos que se requieren son los siguientes: i) nombre; ii) direcci&oacute;n de entrega de la mercanc&iacute;a adquirida; iii) tel&eacute;fono; iv) correo electr&oacute;nico; v) de ser requerida una factura, los datos fiscales necesarios para la expedici&oacute;n de la misma, en los t&eacute;rminos de la legislaci&oacute;n fiscal vigente; vi) datos e informaci&oacute;n de la tarjeta y n&uacute;mero de cuenta bancaria con la que se pretende hacer el pago del bien o servicio requerido, cuando dicha operaci&oacute;n sea efectuada directamente con LUMEN; y vii) en su caso, el nombre, tel&eacute;fono y correo electr&oacute;nico del contacto con quien se efectuar&aacute; el cobro de la mercanc&iacute;a adquirida. <br /><br />Es importante se&ntilde;alar que en el caso de que el pago del bien o servicio correspondiente sea gestionado por una entidad distinta a LUMEN, los datos precisados en el inciso vi) anterior ser&aacute;n recabados directamente por dicha entidad sin que LUMEN tenga acceso dicha informaci&oacute;n. Por ello, se reitera que no habr&aacute; transferencia alguna de tales datos en este supuesto.</li>\r\n<li>Trat&aacute;ndose de env&iacute;os de correos electr&oacute;nicos a Lumen, con la finalidad de solicitar informaci&oacute;n sobre ciertos bienes o servicios que la empresa ofrece, o bien para presentar una queja o sugerencia, los datos que se requieren son los siguientes: i) nombre; ii) sexo; iii) correo electr&oacute;nico; iv) tel&eacute;fono; v) entidad federativa donde reside y vi) el comentario que desea ingresar a la p&aacute;gina.</li>\r\n<li>Trat&aacute;ndose del registro como cliente en l&iacute;nea, los datos que se requieren son los siguientes: a) g&eacute;nero; b) nombre completo; c) fecha de nacimiento; d) correo electr&oacute;nico; e) generaci&oacute;n de contrase&ntilde;a .</li>\r\n<li>Para efectos de inscripci&oacute;n al Bolet&iacute;n Mensual de Lumen, los datos que se requieren son los siguientes: i) nombre; ii) correo electr&oacute;nico; iii) fecha de nacimiento; iv) sexo; v) estado civil; vi) si tiene hijos; vii) ocupaci&oacute;n; viii) entidad federativa donde reside; ix) c&oacute;digo postal; x) colonia y xi) sucursal que frecuenta.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Finalidades del tratamiento de los datos personales</strong></p>\r\n<p>Los datos personales solicitados se requieren para: a) la completa y correcta prestaci&oacute;n de los servicios o venta de los bienes objeto de la relaci&oacute;n comercial que se sostenga con LUMEN b) realizar campa&ntilde;as publicitarias (v&iacute;a telef&oacute;nica y por medios electr&oacute;nicos) para la comercializaci&oacute;n de productos y servicios de Lumen; c) ofrecer informaci&oacute;n sobre nuevos productos y servicios, promociones exclusivas, descuentos, ofertas especiales, regalos y beneficios que Lumen ofrece; d) configurar la base de datos de los clientes de Lumen; e) realizar an&aacute;lisis estad&iacute;sticos y de mercado; f) evaluar la calidad de los productos y servicios de Lumen; g) atender oportunamente las preguntas, sugerencias o quejas que los clientes presentan en relaci&oacute;n con bienes o servicios ofrecidos por Lumen; h) facturar los bienes y servicios ofrecidos por Lumen; i) verificar la identidad del cliente, o bien del contacto que aqu&eacute;l se&ntilde;al&oacute;, al momento de la entrega de la mercanc&iacute;a adquirida; j) generar un expediente crediticio que garantice el cumplimiento de obligaciones de pagos diferidos o en parcialidades, en su caso; k) para fines mercadot&eacute;cnicos, publicitarios o de prospecci&oacute;n comercial ; y l) para la generaci&oacute;n, en su caso, de un registro como usuario o cliente de Lumen con la intenci&oacute;n de facilitar las transacciones comerciales actuales o futuras que el usuario pudiera realizar. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Transferencia de los datos personales</strong></p>\r\n<p>Los datos personales obtenidos a trav&eacute;s de los medios y mecanismos arriba precisados, no ser&aacute;n transferidos a persona o entidad distinta de Lumen. .</p>\r\n<p>&nbsp;</p>\r\n<p>DERECHOS ARCO (Acceso, Rectificaci&oacute;n, Cancelaci&oacute;n y Oposici&oacute;n) y REVOCACI&Oacute;N del consentimiento para el tratamiento de los datos. .</p>\r\n<p>&nbsp;</p>\r\n<p>Para cualquier acceso, rectificaci&oacute;n, cancelaci&oacute;n, oposici&oacute;n o revocaci&oacute;n en el manejo de los datos personales obtenidos a trav&eacute;s de la compra de bienes o servicios por tel&eacute;fono, Lumen pone a su disposici&oacute;n el correo electr&oacute;nico arco@lumen.com.mx y el tel&eacute;fono 54-90-66-93, de los cuales ser&aacute; responsable del resguardo y administraci&oacute;n de la informaci&oacute;n el Comit&eacute; de Derechos Arco, en t&eacute;rminos del Cap&iacute;tulo IV de la Ley Federal de Protecci&oacute;n de Datos Personales en Posesi&oacute;n de los Particulares, art&iacute;culo 21 de su Reglamento, as&iacute; como de las disposiciones contenidas en los Lineamientos del Aviso de Privacidad emitidas por la Secretar&iacute;a de Econom&iacute;a. .</p>\r\n<p>&nbsp;</p>\r\n<p>Para estos efectos, el usuario deber&aacute; enviar a dicha direcci&oacute;n de correo electr&oacute;nico un escrito en el que se&ntilde;ale, de manera clara y expedita, qu&eacute; datos y en qu&eacute; medida desea tener acceso, o bien, rectificar, cancelar, oponerse o revocar su consentimiento al tratamiento de los mismos, adjuntando la documentaci&oacute;n que sustente su petici&oacute;n. .</p>\r\n<p>&nbsp;</p>\r\n<p>Una vez que sea recibida la petici&oacute;n debidamente requisitada en la cuenta de correo electr&oacute;nico ya se&ntilde;alada, Lumen contar&aacute; con un plazo de veinte d&iacute;as (mismos que podr&aacute;n ser ampliados por un periodo igual, dependiendo de las circunstancias del caso) para resolver la petici&oacute;n correspondiente. .</p>\r\n<p>&nbsp;</p>\r\n<p>De resultar procedente la petici&oacute;n del usuario, Lumen deber&aacute; cumplir con la misma en un plazo de quince d&iacute;as contados a partir de la emisi&oacute;n de la resoluci&oacute;n correspondiente. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Opciones y medios para limitar el uso o divulgaci&oacute;n de los datos personales</strong></p>\r\n<p>En caso de que el titular decida limitar el uso o divulgaci&oacute;n de los datos personales recabados, Lumen pone a su disposici&oacute;n la direcci&oacute;n de correo electr&oacute;nico arco@lumen.com.mx, para que as&iacute; lo manifieste de manera expresa. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Cambios al aviso de privacidad</strong></p>\r\n<p>En caso de realizar modificaciones a nuestro Aviso de Privacidad, enviaremos un correo electr&oacute;nico a los titulares de los datos personales recabados, para informarles sobre dichos cambios, mismo que incluir&aacute; el v&iacute;nculo para consultarlos. .</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Consentimiento del usuario</strong></p>\r\n<p>Estoy de acuerdo con los t&eacute;rminos y condiciones de privacidad y protecci&oacute;n de datos establecidas en el presente Aviso de Privacidad, incluidas la finalidad y tratamiento de dichos datos, por lo que manifiesto mi consentimiento expreso e inequ&iacute;voco para tales efectos.</p>', 2, '2017-01-19 20:05:24'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2017-01-24 15:15:36'),
(4, NULL, '#000000', NULL, NULL, NULL, NULL, 3, '2017-01-24 15:42:19'),
(5, NULL, '#000000', NULL, NULL, NULL, NULL, 4, '2017-01-24 19:38:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_perfiles`
--

CREATE TABLE IF NOT EXISTS `company_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `telefono2` varchar(20) DEFAULT NULL,
  `puesto` varchar(35) NOT NULL,
  `experiencia` varchar(220) NOT NULL,
  `educacion` varchar(35) DEFAULT NULL,
  `comentario` text,
  `user_id` int(11) DEFAULT NULL,
  `no_aplica` tinyint(1) DEFAULT NULL,
  `aplico` tinyint(1) DEFAULT NULL,
  `llamar` tinyint(1) DEFAULT NULL,
  `entrevista1` tinyint(1) DEFAULT NULL,
  `entrevista2` tinyint(1) DEFAULT NULL,
  `medico` tinyint(1) DEFAULT NULL,
  `documentos` tinyint(1) DEFAULT NULL,
  `contrato` tinyint(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `company_perfiles`
--

INSERT INTO `company_perfiles` (`id`, `company_id`, `nombre`, `sexo`, `email`, `edad`, `telefono1`, `telefono2`, `puesto`, `experiencia`, `educacion`, `comentario`, `user_id`, `no_aplica`, `aplico`, `llamar`, `entrevista1`, `entrevista2`, `medico`, `documentos`, `contrato`, `created`) VALUES
(1, 1, 'name', 'F', 'name@gmail.com', 18, '123456', NULL, 'Seguridad', 'asdasdsad', NULL, 'Experiencia comprobada, lista para incluirla a la terna final de candidatos.', 1, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, '2017-01-20 13:05:25'),
(2, 1, 'lala', 'F', 'lala@gmail.com', 19, '12345', '65432', 'Ventas', 'experiencia', NULL, 'Comentairos', 1, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, '2017-01-20 15:07:29'),
(3, 2, 'Enrique Arenas', 'M', 'quique@arenas.com', 45, '5566994433', '3344556677', 'Suajador', 'Tengo mucha experiencia =)', NULL, NULL, 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-24 15:34:09'),
(4, 2, 't', 'F', 'dfsd@fs.com', 45, '45', '45', 'Limpieza', 'dfgdfgd', NULL, 'Ya le llamé, excelente candidata', 13, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2017-01-24 15:38:50'),
(5, 2, 'David Centeno', 'M', 'david@centeno.com', 29, '5566778890', '4848484747', 'Albañil', 'jkdsfsjkfnsdjfn kjdsnfjds fnjdks fndjks fnkjds . nfkjdsnfkjdsnfjdsnfkdsnj', NULL, 'Podemos poner muchos comentarios en esta sección podemos segregar lo que tenemos', 13, NULL, NULL, 1, NULL, 1, NULL, 1, 1, '2017-01-24 17:15:46'),
(6, 2, 'luis g', 'M', 'sdfsd@sdfs.com', 45, '5544332211', '3444444444', 'Homenajeador', 'dsdfsfs', NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-24 17:46:40'),
(7, 1, 'pepepe', 'F', 'pepe@maasd.com', 22, '87487', '891984', 'Seguridad', '8a4s98d4as98d4sa98d4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-24 19:46:04'),
(8, 1, 'jaja', 'F', 'asdas@asdasd.com', 21, '78946546', '654847489', 'Ventas', '45698498', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-24 19:47:02'),
(9, 1, 'asdasdas', 'M', 'asdasd@asdasd.com', 21, '5646541651', '56156156', 'Seguridad', '65465a4s65a1sd56a1s6d51as65d1sa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-24 19:50:59'),
(10, 1, 'hola', 'M', 'hola@gmail.com', 20, '546556', '651651', 'Seguridad', 'a5s64da56sd', 'Secundaria / secundaria técnica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-24 19:53:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_plan`
--

CREATE TABLE IF NOT EXISTS `company_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meses` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `company_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `company_plan`
--

INSERT INTO `company_plan` (`id`, `meses`, `activo`, `company_id`, `created`) VALUES
(1, 12, 1, 1, '2017-02-01 15:16:35'),
(2, 12, 1, 2, '2017-01-19 20:05:24'),
(3, 3, 1, 2, '2017-01-24 15:15:36'),
(4, 3, 1, 3, '2017-01-24 15:42:19'),
(5, 3, 1, 4, '2017-01-24 19:38:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_puesto`
--

CREATE TABLE IF NOT EXISTS `company_puesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puesto` varchar(50) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `company_puesto`
--

INSERT INTO `company_puesto` (`id`, `puesto`, `activo`, `company_id`) VALUES
(4, 'Ventas', 1, 1),
(5, 'Seguridad', 1, 1),
(6, 'Seguridad 2', 1, 1),
(8, 'AAA', 1, 1),
(9, 'A', 0, 1),
(11, 'C', 0, 1),
(12, 'D', 0, 1),
(13, 'Hola', 0, 1),
(14, 'Cajero', 1, 2),
(15, 'Limpieza', 1, 2),
(22, 'Cajero', 1, 3),
(23, 'Limpieza', 1, 3),
(24, 'Chofer', 1, 3),
(25, 'Operador De Linea', 1, 3),
(26, 'Suajador', 1, 2),
(27, 'Perforador', 1, 2),
(28, 'Albañil', 1, 2),
(29, 'Comprador', 1, 2),
(30, 'Terminador', 1, 2),
(31, 'Extintor', 1, 2),
(32, 'Homenajeador', 1, 2),
(33, 'Saturador', 1, 2),
(34, 'B', 0, 1),
(35, 'E', 0, 1),
(36, 'Estilista', 0, 2),
(37, 'Bordador', 0, 2),
(38, 'General', 0, 2),
(40, 'Cambiadores De Tipo', 1, 2),
(41, 'Cambiadores De Tipo 1', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_user`
--

CREATE TABLE IF NOT EXISTS `company_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `company_user`
--

INSERT INTO `company_user` (`id`, `username`, `password`, `role`, `created`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'admin', '2017-01-11 19:02:29'),
(10, 'ernesto', '8f91bdb4de0142710ac1718345b96308', NULL, '2017-01-13 15:16:35'),
(11, 'mia', '5102ecd3d47f6561de70979017b87a80', NULL, '2017-01-19 20:05:24'),
(12, 'hey', '6057f13c496ecf7fd777ceb9e79ae285', NULL, '2017-01-19 20:29:51'),
(13, 'lumen123', 'c833406e3338feb04c97a257432fab6b', NULL, '2017-01-24 15:15:36'),
(14, 'comex123', '089673ad9b6f334c46c2053fa6fc644e', NULL, '2017-01-24 15:42:19'),
(15, 'prueba', '3d44e7d47bc896df027df8c3f7629d29', NULL, '2017-01-24 19:38:57');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
