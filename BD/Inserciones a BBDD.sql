USE MAIPO_GRANDE;
##Usuario
DELETE FROM `maipo_grande`.`perfil` WHERE ID_PERFIL>0;
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Administrador','Administrador del sistema');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Vendedor','Vendedor del sistema, puede realizar ventas internas y externas');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Comprador Interno','Comprador interno, puede realizar compras nacionales a traves de la vista del catalogo');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Comprador externo','Comprador externo, realiza compras a través de solicitudes para procesos de compra externa');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Transportista','Transportista de la aplicación, realiza transportes de ambos tipos de venta');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Consultor','Usuario consultor encargado de generar reportería de sistema');

##tipo_persona_legal
DELETE FROM `maipo_grande`.`tipo_persona_legal` WHERE ID_TIPO_PERSONA_LEGAL>0;
INSERT INTO `tipo_persona_legal`( `NOMBRE`, `DESCRIPCION`) VALUES ('Persona Natural','Tipo de persona natural');
INSERT INTO `tipo_persona_legal`( `NOMBRE`, `DESCRIPCION`) VALUES ('Empresa','Empresa');

##tipo_postulacion
DELETE FROM `maipo_grande`.`tipo_postulacion` WHERE ID_TIPO_POSTULACION>0;
INSERT INTO `maipo_grande`.`tipo_postulacion`(`ID_TIPO_POSTULACION`,`NOMBRE`, `DESCRIPCION`) VALUES (1,'Frutas','Proveedor de frutas postula con kilos');
INSERT INTO `maipo_grande`.`tipo_postulacion`(`ID_TIPO_POSTULACION`,`NOMBRE`, `DESCRIPCION`) VALUES (2,'Transporte','Proveedor de transporte logistico postula al despacho');

##ESTADOS
DELETE FROM `maipo_grande`.`estados` WHERE ID_ESTADO!=-1;
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'POR APROBAR','PEDIDO DE CLIENTE EXTERNO, EN ESPERA DE APROBACION DE ADMINISTRADOR');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(2,'PUBLICADO','PEDIDO PUBLICADA');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(3,'EN LOGISTICA','PEDIDO A LA ESPERA DE RECIBIR OFERTA DE PROVEEDOR LOGISTICO, O DE TENER FECHA DE RETIRO RETIRADA');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(4,'DESPACHO','PEDIDO SE ENCUENTRA EN DESPACHO/DISPONIBLE PARA RETIRO');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(5,'ENTREGADO','PEDIDO FUE ENTREGADO AL COMPRADOR');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(6,'RECHAZADO','PEDIDO FUE RECHAZADA POR COMPRADOR');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(7,'PAGADO','SE RECIBIO Y PAGO EL PEDIDO');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(8,'POSTULADO','SE POSTULO A LA PEDIDO');


#CALIDAD
DELETE FROM `maipo_grande`.`calidad` WHERE ID_CALIDAD>0;
INSERT INTO `maipo_grande`.`calidad`(`ID_CALIDAD`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'Calidad A','Calidad premuim');
INSERT INTO `maipo_grande`.`calidad`(`ID_CALIDAD`,`NOMBRE`,`DESCRIPCION`)VALUES(2,'Calidad B','Calidad superior');

#TIPO_FRUTA
DELETE FROM `maipo_grande`.`tipo_fruta` WHERE ID_TIPO_FRUTA>0;
INSERT INTO `maipo_grande`.`tipo_fruta`(`ID_TIPO_FRUTA`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'Platano','BANANA');
INSERT INTO `maipo_grande`.`tipo_fruta`(`ID_TIPO_FRUTA`,`NOMBRE`,`DESCRIPCION`)VALUES(2,'Naranja','ORANGE');

#TIPO_PEDIDO
DELETE FROM `maipo_grande`.`tipo_pedido` WHERE ID_TIPO_PEDIDO>0;
INSERT INTO `maipo_grande`.`tipo_pedido`(`NOMBRE`,`DESCRIPCION`)VALUES('Nacional','Pedido generado por cliente nacional');
INSERT INTO `maipo_grande`.`tipo_pedido`(`NOMBRE`,`DESCRIPCION`)VALUES('Internacional','Pedido generado por cliente internacional');


#PAIS
DELETE FROM `maipo_grande`.`pais` WHERE ID_PAIS='CL';
INSERT INTO PAIS VALUES('CL','Chile');
#CIUDAD
DELETE FROM `maipo_grande`.`ciudad` WHERE ID_CIUDAD>0;
INSERT INTO CIUDAD VALUES(1,'CL','Santiago');
#COMUNA
DELETE FROM `maipo_grande`.`comuna` WHERE ID_COMUNA>0;
INSERT INTO COMUNA VALUES(1,1,'Maipu');

#USUARIS DE PRUEBA
DELETE FROM `maipo_grande`.`usuario` WHERE ID_USUARIO>0;
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(1,'admin@mail.cl','5f4dcc3b5aa765d61d8327deb882cf99',1);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(2,'vendedor@mail.cl','5f4dcc3b5aa765d61d8327deb882cf99',2);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(3,'compradorinterno@mail.cl','5f4dcc3b5aa765d61d8327deb882cf99',3);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(4,'compradorexterno@mail.cl','5f4dcc3b5aa765d61d8327deb882cf99',4);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(5,'transportista@mail.cl','5f4dcc3b5aa765d61d8327deb882cf99',2);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(6,'vendedor2@mail.cl','5f4dcc3b5aa765d61d8327deb882cf99',2);

#PERSONA
DELETE FROM `maipo_grande`.`persona` WHERE ID_USUARIO>0;
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(2,1,9,'vendedor','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(3,2,9,'comprador interno','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(4,3,9,'comprador externo','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(5,4,9,'transportista','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(6,5,9,'vendedor2','maipo grande',null,null,1,null,1);

#PEDIDO
DELETE FROM `maipo_grande`.`pedido` WHERE ID_PEDIDO>0;
INSERT INTO `maipo_grande`.`pedido`(`ID_PEDIDO`,`ID_VENDEDOR`,`ID_COMPRADOR`,`ID_TIPO_PEDIDO`,`ID_ESTADO_PEDIDO`,`FECHA_CREACION`,`FECHA_LIMITE_O_RETIRO`,`FECHA_PAGO`)VALUES(3,2,4,2,2,'2020-11-11 15:35:25','2020-11-15',null);

#DETALLE_PEDIDO
DELETE FROM `maipo_grande`.`detalle_pedido` WHERE ID_PEDIDO>0;
INSERT INTO `maipo_grande`.`detalle_pedido`(`ID_PEDIDO`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`CANT_KG`,`PRECIO_KG`,`COD_MONEDA`)VALUES(3,1,1,228.2,1500,'CLP');
INSERT INTO `maipo_grande`.`detalle_pedido`(`ID_PEDIDO`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`CANT_KG`,`PRECIO_KG`,`COD_MONEDA`)VALUES(3,2,1,228.2,1500,'CLP');

#HISTORICO STOCK
DELETE FROM `maipo_grande`.`historico_stock` WHERE ID_PROVEEDOR>0;
INSERT INTO `maipo_grande`.`historico_stock`(`ID_PROVEEDOR`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`FECHA_REGISTRO`,`CANT_KG`,`PRECIO_X_KG`) VALUES (2,1,1,sysdate(),180.56,2500);
INSERT INTO `maipo_grande`.`historico_stock`(`ID_PROVEEDOR`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`FECHA_REGISTRO`,`CANT_KG`,`PRECIO_X_KG`) VALUES (2,2,1,sysdate(),121,1400);
INSERT INTO `maipo_grande`.`historico_stock`(`ID_PROVEEDOR`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`FECHA_REGISTRO`,`CANT_KG`,`PRECIO_X_KG`) VALUES (6,2,2,sysdate(),181.56,2500);



