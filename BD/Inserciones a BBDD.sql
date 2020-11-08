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