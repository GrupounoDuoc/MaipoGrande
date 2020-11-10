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
