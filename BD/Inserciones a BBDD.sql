USE MAIPO_GRANDE;
##Usuario
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Administrador','Administrador del sistema');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Vendedor','Vendedor del sistema, puede realizar ventas internas y externas');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Comprador Interno','Comprador interno, puede realizar compras nacionales a traves de la vista del catalogo');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Comprador externo','Comprador externo, realiza compras a través de solicitudes para procesos de compra externa');
INSERT INTO `perfil`( `NOMBRE`, `DESCRIPCION`) VALUES ('Transportista','Transportista de la aplicación, realiza transportes de ambos tipos de venta');

##tipo_persona_legal
INSERT INTO `tipo_persona_legal`( `NOMBRE`, `DESCRIPCION`) VALUES ('Persona Natural','Tipo de persona natural');
INSERT INTO `tipo_persona_legal`( `NOMBRE`, `DESCRIPCION`) VALUES ('Empresa','Empresa');

##ESTADOS
DELETE FROM `maipo_grande`.`estados` WHERE ID_ESTADO!=-1;
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'POR APROBAR','OFERTA DE CLIENTE EXTERNO, EN ESPERA DE APROBACION DE ADMINISTRADOR');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(2,'PUBLICADO','OFERTA PUBLICADA');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(3,'EN LOGISTICA','OFERTA A LA ESPERA DE RECIBIR OFERTA DE PROVEEDOR LOGISTICO, O DE TENER FECHA DE RETIRO RETIRADA');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(4,'DESPACHO','OFERTA SE ENCUENTRA EN DESPACHO/DISPONIBLE PARA RETIRO');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(5,'RECIBIDA','OFERTA FUE RECIBIDA POR COMPRADOR');
INSERT INTO `maipo_grande`.`estados`(`ID_ESTADO`,`NOMBRE`,`DESCRIPCION`)VALUES(6,'RECHAZADA','OFERTA FUE RECHAZADA POR COMPRADOR');

#TIPO PEDIDO
DELETE FROM `maipo_grande`.`tipo_pedido` WHERE ID_TIPO_PEDIDO>0;
INSERT INTO `maipo_grande`.`tipo_pedido`(`ID_TIPO_PEDIDO`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'INTERNO','PEDIDO NACIONAL, PARA CLIENTES DE CHILE');
INSERT INTO `maipo_grande`.`tipo_pedido`(`ID_TIPO_PEDIDO`,`NOMBRE`,`DESCRIPCION`)VALUES(2,'EXTERNO','PEDIDO INTERNACIONAL, PARA CLIENTES DEL EXTRANJERO');

#CALIDAD
INSERT INTO `maipo_grande`.`calidad`(`ID_CALIDAD`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'Calidad A','Calidad premuim');

#TIPO_FRUTA
INSERT INTO `maipo_grande`.`tipo_fruta`(`ID_TIPO_FRUTA`,`NOMBRE`,`DESCRIPCION`)VALUES(1,'Platano','BANANA');

#PAIS
INSERT INTO PAIS VALUES('CL','Chile');
#CIUDAD
INSERT INTO CIUDAD VALUES(1,'CL','Santiago');
#COMUNA
INSERT INTO COMUNA VALUES(1,1,'Maipu');

#USUARIS DE PRUEBA
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(1,'admin@mail.cl','42069',1);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(2,'vendedor@mail.cl','42069',2);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(3,'compradorinterno@mail.cl','42069',3);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(4,'compradorexterno@mail.cl','42069',4);
INSERT INTO `maipo_grande`.`usuario`(`ID_USUARIO`,`CORREO`,`CONTRASENA`,`ID_PERFIL`)VALUES(5,'transportista@mail.cl','42069',2);

#PERSONA
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(2,1,9,'vendedor','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(3,2,9,'comprador interno','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(4,3,9,'comprador externo','maipo grande',null,null,1,null,1);
INSERT INTO `maipo_grande`.`persona`(`ID_USUARIO`,`RUT`,`DIGITO_VERIFICADOR`,`NOMBRE`,`APELLIDO`,`NOMBRE_FANTASIA`,`CODIGO_POSTAL`,`ID_COMUNA`,`TELEFONO`,`ID_TIPO_PERSONA_LEGAL`)VALUES(5,4,9,'transportista','maipo grande',null,null,1,null,1);

#PEDIDO
INSERT INTO `maipo_grande`.`pedido`(`ID_PEDIDO`,`ID_COMPRADOR`,`ID_TIPO_PEDIDO`,`ID_ESTADO_PEDIDO`,`FECHA_CREACION`,`FECHA_LIMITE_O_RETIRO`,`FECHA_PAGO`)VALUES(3,4,2,2,'2020-11-11 15:35:25','2020-11-15',null);

#DETALLE_PEDIDO
INSERT INTO `maipo_grande`.`detalle_pedido`(`ID_PEDIDO`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`CANT_KG`,`PRECIO_KG`,`COD_MONEDA`)VALUES(3,1,1,228.2,1500,'CLP');
