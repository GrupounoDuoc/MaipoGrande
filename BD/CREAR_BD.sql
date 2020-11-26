###################################
#CREACION DE BD
DROP SCHEMA  IF EXISTS MAIPO_GRANDE;
CREATE DATABASE MAIPO_GRANDE;
USE MAIPO_GRANDE;
#CREACION DE TABLAS
CREATE TABLE PAIS (ID_PAIS VARCHAR(2)  PRIMARY KEY NOT NULL, NOMBRE VARCHAR(100) NOT NULL);
CREATE TABLE CIUDAD (ID_CIUDAD INT PRIMARY KEY NOT NULL, ID_PAIS VARCHAR(2) NOT NULL, NOMBRE VARCHAR(100) NOT NULL);
CREATE TABLE COMUNA (ID_COMUNA INT PRIMARY KEY NOT NULL, ID_CIUDAD INT NOT NULL, NOMBRE VARCHAR(100) NOT NULL);
CREATE TABLE TIPO_PERSONA_LEGAL (ID_TIPO_PERSONA_LEGAL INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL, DESCRIPCION VARCHAR(150));
CREATE TABLE ESTADOS (ID_ESTADO INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(20) NOT NULL, DESCRIPCION VARCHAR(150));
CREATE TABLE TIPO_TRANSPORTE (ID_TIPO_TRANSPORTE INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL, VIA_TRANSPORTE VARCHAR(15) NOT NULL,
	REFRIGERADO BOOLEAN NOT NULL, TON_MAX FLOAT(6,3) NOT NULL, DESCRIPCION VARCHAR(150));
CREATE TABLE TIPO_FRUTA (ID_TIPO_FRUTA INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL UNIQUE, DESCRIPCION VARCHAR(150), FOTO BLOB);
CREATE TABLE CALIDAD (ID_CALIDAD INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL UNIQUE,DESCRIPCION VARCHAR(150));
CREATE TABLE TIPO_POSTULACION (ID_TIPO_POSTULACION INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL, DESCRIPCION VARCHAR(150) NOT NULL);
CREATE TABLE TIPO_PEDIDO (ID_TIPO_PEDIDO INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL, DESCRIPCION VARCHAR(150));
CREATE TABLE PERFIL (ID_PERFIL INT PRIMARY KEY AUTO_INCREMENT, NOMBRE VARCHAR(100) NOT NULL, DESCRIPCION VARCHAR(150));
CREATE TABLE USUARIO (ID_USUARIO INT PRIMARY KEY AUTO_INCREMENT, CORREO VARCHAR(100) NOT NULL UNIQUE, CONTRASENA VARCHAR(250) NOT NULL, ID_PERFIL INT NOT NULL);
CREATE TABLE PERSONA (ID_USUARIO INT, RUT VARCHAR(8) PRIMARY KEY, DIGITO_VERIFICADOR VARCHAR(1) NOT NULL, NOMBRE VARCHAR(100) NOT NULL, 
	APELLIDO VARCHAR(100), NOMBRE_FANTASIA VARCHAR(100), CODIGO_POSTAL INT, ID_COMUNA INT NOT NULL, TELEFONO INT, ID_TIPO_PERSONA_LEGAL INT NOT NULL);
CREATE TABLE CONTRATO (ID_CONTRATO INT PRIMARY KEY AUTO_INCREMENT, ID_USUARIO INT NOT NULL, CONTRATO BLOB, FECHA_FIRMA DATE NOT NULL, FECHA_VENCIMIENTO DATE NOT NULL);
CREATE TABLE PEDIDO (ID_PEDIDO INT PRIMARY KEY AUTO_INCREMENT, ID_COMPRADOR INT NOT NULL, ID_TIPO_PEDIDO INT NOT NULL, ID_ESTADO_PEDIDO INT NOT NULL,
	FECHA_CREACION DATETIME NOT NULL, FECHA_LIMITE_O_RETIRO DATE, FECHA_PAGO DATETIME);
CREATE TABLE DETALLE_PEDIDO (ID_PEDIDO INT , ID_TIPO_FRUTA INT, ID_CALIDAD INT, CANT_KG FLOAT(6,3), PRECIO_KG FLOAT(9,2), COD_MONEDA VARCHAR(3),
	PRIMARY KEY(ID_PEDIDO,ID_TIPO_FRUTA,ID_CALIDAD));
CREATE TABLE HISTORICO_STOCK (ID_STOCK INT PRIMARY KEY AUTO_INCREMENT, ID_PROVEEDOR INT NOT NULL, ID_TIPO_FRUTA INT NOT NULL, ID_CALIDAD INT NOT NULL, 
	FECHA_REGISTRO DATETIME NOT NULL, CANT_KG FLOAT(6,3) NOT NULL, PRECIO_X_KG FLOAT(9,3) NOT NULL);
CREATE TABLE POSTULACION (ID_POSTULACION INT PRIMARY KEY AUTO_INCREMENT, ID_PEDIDO INT NOT NULL, ID_TIPO_POSTULACION INT NOT NULL, ID_USUARIO INT NOT NULL, 
	ID_ESTADO INT NOT NULL, KG_APORTADOS FLOAT(6,3) NOT NULL);
CREATE TABLE DESPACHO (ID_DESPACHO INT PRIMARY KEY AUTO_INCREMENT, ID_PEDIDO INT NOT NULL, ID_TRANSPORTISTA INT NOT NULL, ID_TIPO_TRANSPORTE INT NOT NULL,
	ID_ESTADO_DESPACHO INT NOT NULL, FECHA_DESPACHO DATETIME, FECHA_RECIBIDO DATETIME);
CREATE TABLE DESTALLE_DESPACHO (ID_DESPACHO INT, FECHA_ACTUALIZACION DATETIME, ID_TIPO_ACTUALIZACION INT NOT NULL, DESCRIPCION VARCHAR(150),
	PRIMARY KEY(ID_DESPACHO,FECHA_ACTUALIZACION));
#ALTERS CON LLAVES FORANEAS
ALTER TABLE CIUDAD
ADD FOREIGN KEY (ID_PAIS) REFERENCES PAIS(ID_PAIS);
ALTER TABLE COMUNA
ADD FOREIGN KEY (ID_CIUDAD) REFERENCES CIUDAD(ID_CIUDAD);
ALTER TABLE USUARIO
ADD FOREIGN KEY (ID_PERFIL) REFERENCES PERFIL(ID_PERFIL);
ALTER TABLE PERSONA
ADD FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID_USUARIO);
ALTER TABLE PERSONA
ADD FOREIGN KEY (ID_TIPO_PERSONA_LEGAL) REFERENCES TIPO_PERSONA_LEGAL(ID_TIPO_PERSONA_LEGAL);
ALTER TABLE PERSONA
ADD FOREIGN KEY (ID_COMUNA) REFERENCES COMUNA(ID_COMUNA);
ALTER TABLE CONTRATO
ADD FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID_USUARIO);
ALTER TABLE PEDIDO
ADD FOREIGN KEY (ID_COMPRADOR) REFERENCES USUARIO(ID_USUARIO);
ALTER TABLE PEDIDO
ADD FOREIGN KEY (ID_TIPO_PEDIDO) REFERENCES TIPO_PEDIDO(ID_TIPO_PEDIDO);
ALTER TABLE PEDIDO
ADD FOREIGN KEY (ID_ESTADO_PEDIDO) REFERENCES ESTADOS(ID_ESTADO);
ALTER TABLE DETALLE_PEDIDO
ADD FOREIGN KEY (ID_PEDIDO) REFERENCES PEDIDO(ID_PEDIDO);
ALTER TABLE DETALLE_PEDIDO
ADD FOREIGN KEY (ID_TIPO_FRUTA) REFERENCES TIPO_FRUTA(ID_TIPO_FRUTA);
ALTER TABLE DETALLE_PEDIDO
ADD FOREIGN KEY (ID_CALIDAD) REFERENCES CALIDAD(ID_CALIDAD);
ALTER TABLE HISTORICO_STOCK
ADD FOREIGN KEY (ID_PROVEEDOR) REFERENCES USUARIO(ID_USUARIO);
ALTER TABLE HISTORICO_STOCK
ADD FOREIGN KEY (ID_TIPO_FRUTA) REFERENCES TIPO_FRUTA(ID_TIPO_FRUTA);
ALTER TABLE HISTORICO_STOCK
ADD FOREIGN KEY (ID_CALIDAD) REFERENCES CALIDAD(ID_CALIDAD);
ALTER TABLE POSTULACION
ADD FOREIGN KEY (ID_PEDIDO) REFERENCES PEDIDO(ID_PEDIDO);
ALTER TABLE POSTULACION
ADD FOREIGN KEY (ID_TIPO_POSTULACION) REFERENCES TIPO_POSTULACION(ID_TIPO_POSTULACION);
ALTER TABLE POSTULACION
ADD FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID_USUARIO);
ALTER TABLE POSTULACION
ADD FOREIGN KEY (ID_ESTADO) REFERENCES ESTADOS(ID_ESTADO);
ALTER TABLE DESPACHO
ADD FOREIGN KEY (ID_PEDIDO) REFERENCES PEDIDO(ID_PEDIDO);
ALTER TABLE DESPACHO
ADD FOREIGN KEY (ID_TRANSPORTISTA) REFERENCES USUARIO(ID_USUARIO);
ALTER TABLE DESPACHO
ADD FOREIGN KEY (ID_TIPO_TRANSPORTE) REFERENCES TIPO_TRANSPORTE(ID_TIPO_TRANSPORTE);
ALTER TABLE DESPACHO
ADD FOREIGN KEY (ID_ESTADO_DESPACHO) REFERENCES ESTADOS(ID_ESTADO);
ALTER TABLE DESTALLE_DESPACHO
ADD FOREIGN KEY (ID_DESPACHO) REFERENCES DESPACHO(ID_DESPACHO);
ALTER TABLE DESTALLE_DESPACHO
ADD FOREIGN KEY (ID_TIPO_ACTUALIZACION) REFERENCES ESTADOS(ID_ESTADO);