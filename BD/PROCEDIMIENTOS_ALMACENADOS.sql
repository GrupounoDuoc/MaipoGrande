#USAR LA BD PARA LA CREACION
USE MAIPO_GRANDE;
#ELIMINAR PROCEDIMIENTOS EXISTENTES

#CREACION DE PROCEDIMIENTOS

#PROCEDIMIENTO DE CREACION DE USUARIOS
DROP PROCEDURE IF EXISTS SP_CREATE_USUARIO;
DELIMITER //
CREATE PROCEDURE SP_CREATE_USUARIO(
IN $NOMBRE VARCHAR(100),
IN $APELLIDO VARCHAR(100),
IN $RUT INT(8),
IN $DV CHAR(1),
IN $COMUNA INT,
IN $CODIGO_POSTAL INT,
IN $CORREO VARCHAR(100),
IN $CONTRASENA VARCHAR(250),
IN $TELEFONO INT(11),
IN $ID_TIPO_PERSONA INT(11),
IN $NOMBRE_FANTASIA VARCHAR(100),
IN $ID_PERFIL INT(11))
BEGIN
	DECLARE $ID_USUARIO INT;
	#SE CREA NUEVO USUARIO
    INSERT INTO `maipo_grande`.`usuario`
	(`CORREO`,
	`CONTRASENA`,
	`ID_PERFIL`)
	VALUES
	($CORREO,
	$CONTRASENA,
	$ID_PERFIL); 
	#SE OBTIENE ID DE USUARIO CREADO
    SELECT MAX(ID_USUARIO) INTO $ID_USUARIO FROM `maipo_grande`.`usuario`;
    #SE INSERTAN DATOS DE PERSONA, CON EL ID DE USUARIO OBTENIDO
    INSERT INTO `maipo_grande`.`persona`
	(`ID_USUARIO`,
	`RUT`,
	`DIGITO_VERIFICADOR`,
	`NOMBRE`,
	`APELLIDO`,
	`NOMBRE_FANTASIA`,
	`CODIGO_POSTAL`,
	`ID_COMUNA`,
	`TELEFONO`,
	`ID_TIPO_PERSONA_LEGAL`)
	VALUES
	($ID_USUARIO,
	$RUT,
	$DV,
	$NOMBRE,
	$APELLIDO,
	$NOMBRE_FANTASIA,
	$CODIGO_POSTAL,
	$COMUNA,
	$TELEFONO,
	$ID_TIPO_PERSONA);
	IF ($ID_PERFIL = 2 || $ID_PERFIL = 5) THEN  
		INSERT INTO `maipo_grande`.`contrato`
		(`ID_USUARIO`,
		`CONTRATO`,
		`FECHA_FIRMA`,
		`FECHA_VENCIMIENTO`)
		VALUES
		($ID_USUARIO,
		NULL,
		SYSDATE(),
		SYSDATE() + INTERVAL 1 YEAR);
	END IF;
END //
DELIMITER ;

#PROCEDIMIENTO PARA TRAER COMUNAS
DROP PROCEDURE IF EXISTS SP_GET_COMUNAS;
DELIMITER //
CREATE PROCEDURE SP_GET_COMUNAS()
BEGIN
SELECT ID_COMUNA ID, ID_CIUDAD CIUDAD, NOMBRE NOMBRECOMUNA FROM COMUNA;
END //
DELIMITER ;

#PROCEDIMIENTO PARA INSERTAR COMPRA DESDE CARRO DE COMPRAS
DROP PROCEDURE IF EXISTS SP_CREATE_PEDIDO_NACIONAL;
DELIMITER //
CREATE PROCEDURE SP_CREATE_PEDIDO_NACIONAL(
	IN $CORREO VARCHAR(100),
    IN $JSON VARCHAR(65535),
    OUT $RESULTADO INT
)
BEGIN
	DECLARE $ID_USUARIO INT;
	DECLARE $ID_PEDIDO INT;
	DECLARE $ID_TIPO_FRUTA INT;
	DECLARE $ID_CALIDAD INT;
	DECLARE $COUNTER INT;
	DECLARE $PRECIO FLOAT(9,2);
	DECLARE $CANTIDAD FLOAT(9,2); 
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
    BEGIN
		SET $RESULTADO = NULL;
		ROLLBACK;
    END;
    START TRANSACTION;
		#SE OBTIENE EL ID DEL USUARIO
        SELECT ID_USUARIO INTO $ID_USUARIO FROM USUARIO WHERE CORREO = $CORREO;
		#SE CREA EL NUEVO PEDIDO NACIONAL
		INSERT INTO `maipo_grande`.`pedido`(`ID_COMPRADOR`,`ID_TIPO_PEDIDO`,`ID_ESTADO_PEDIDO`,`FECHA_CREACION`,`FECHA_LIMITE_O_RETIRO`,`FECHA_PAGO`)VALUES($ID_USUARIO,1,3,SYSDATE(),null,null);
		#SE OBTIENE ID DEL PEDIDO CREADO
		SELECT MAX(ID_PEDIDO) INTO $ID_PEDIDO FROM `maipo_grande`.`pedido`;
		#SE INSERTAN PEDIDOS DEL CARRO
		SET $COUNTER = 1;
		insertDetalle: LOOP
			IF $COUNTER > JSON_LENGTH($JSON) THEN 
				LEAVE insertDetalle;
			END IF;
			select HS.ID_TIPO_FRUTA,HS.ID_CALIDAD,replace(JSON_EXTRACT($JSON, CONCAT('$.',$counter,'.cantidad')),'"',''),HS.PRECIO_X_KG  
				INTO $ID_TIPO_FRUTA,$ID_CALIDAD,$CANTIDAD,$PRECIO
				FROM HISTORICO_STOCK HS
				WHERE HS.ID_STOCK =(replace(JSON_EXTRACT($JSON, CONCAT('$.',$counter,'.id')),'"',''));
			INSERT INTO `maipo_grande`.`detalle_pedido`(`ID_PEDIDO`,`ID_TIPO_FRUTA`,`ID_CALIDAD`,`CANT_KG`,`PRECIO_KG`,`COD_MONEDA`)VALUES($ID_PEDIDO,$ID_TIPO_FRUTA,$ID_CALIDAD,$CANTIDAD,$PRECIO,'CLP');
			SET $COUNTER = $COUNTER+1;
		END LOOP insertDetalle;
        SET $RESULTADO = $ID_PEDIDO;
        COMMIT;
END //
DELIMITER ;

#PROCEDIMIENTO PARA INSERTAR UNA NUEVA POSTULACION A VENTA EXTRANJERA
DROP PROCEDURE IF EXISTS SP_CREATE_POSTULACION;
DELIMITER //
CREATE PROCEDURE SP_CREATE_POSTULACION(
	IN $ID_PEDIDO INT,
	IN $CORREO_PROVEEDOR VARCHAR(100),
	IN $TIPO_FRUTA VARCHAR(100),
    IN $CALIDAD VARCHAR(100),
    IN $CANTIDAD FLOAT(6,3),
    IN $PRECIO FLOAT(9,2),
    OUT $RESULTADO INT
)
BEGIN
	DECLARE $ID_USUARIO INT;
    DECLARE $PERFIL VARCHAR(100);
	DECLARE $ID_TIPO_FRUTA INT;
	DECLARE $ID_CALIDAD INT;
    DECLARE $TIPO_POSTULACION INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
    BEGIN
		SET $RESULTADO = NULL;
		ROLLBACK;
    END;
    START TRANSACTION;
		#SE OBTIENE EL ID DEL USUARIO
        SELECT ID_USUARIO,P.NOMBRE INTO $ID_USUARIO,$PERFIL FROM USUARIO U JOIN PERFIL P ON P.ID_PERFIL = U.ID_PERFIL WHERE CORREO = $CORREO_PROVEEDOR;
        #SE OBTIENE ID DE TIPO DE FRUTA
        SELECT ID_TIPO_FRUTA INTO $ID_TIPO_FRUTA FROM `maipo_grande`.`tipo_fruta` WHERE NOMBRE = $TIPO_FRUTA;
        #SE OBTIENE ID DE CALIDAD
        SELECT ID_CALIDAD INTO $CALIDAD FROM `maipo_grande`.`calidad` WHERE NOMBRE = $CALIDAD;
        #SE SELECCIONA EL TIPO DE POSTULACION SEGUN EL TIPO DE PERFIL
        IF($PERFIL = 'Vendedor') THEN
			SET $TIPO_POSTULACION = 1;
        ELSEIF($PERFIL = 'Transportista') THEN
			SET $TIPO_POSTULACION = 2;
		END IF;
        #SE INSERTA EL NUEVO PEDIDO CON ESTADO INICIAL
		INSERT INTO `maipo_grande`.`postulacion` (ID_PEDIDO,ID_TIPO_POSTULACION,ID_USUARIO,ID_ESTADO,KG_APORTADOS,PRECIO)
        VALUES
        ($ID_PEDIDO,$TIPO_POSTULACION,$ID_USUARIO,7,$CANTIDAD,$PRECIO);
        #OBTENER ID DE POSTULACION GENERADOS
        SELECT MAX(ID_POSTULACION) INTO $RESULTADO FROM `maipo_grande`.`postulacion`;
        COMMIT;
END //
DELIMITER ;

#PROCEDIMIENTO CON OFERTAS PARA CATALOGO, SEGUN ROL
DROP PROCEDURE IF EXISTS SP_GET_CATALOGO;
DELIMITER //
CREATE PROCEDURE SP_GET_CATALOGO()
BEGIN
	SELECT 
	CONCAT(PU.NOMBRE,' ',PU.APELLIDO) NOMBRE_VENDEDOR,
	TF.NOMBRE TIPO_FRUTA,
	C.NOMBRE CALIDAD,
	DP.CANT_KG,
	P.FECHA_CREACION ,
    TF.FOTO FOTO,
    DP.PRECIO_KG PRECIO,
    DP.COD_MONEDA MONEDA,
    P.ID_PEDIDO ID
	FROM PEDIDO P
	JOIN PERSONA PU ON PU.ID_USUARIO=P.ID_COMPRADOR
	JOIN DETALLE_PEDIDO DP ON P.ID_PEDIDO=DP.ID_PEDIDO
	JOIN CALIDAD C ON C.ID_CALIDAD=DP.ID_CALIDAD
	JOIN TIPO_FRUTA TF ON TF.ID_TIPO_FRUTA=DP.ID_TIPO_FRUTA
	WHERE ID_ESTADO_PEDIDO IN (2);
END //
DELIMITER ;

#PROCEDIMIENTO CON TIPOS DE FRUTA
DROP PROCEDURE IF EXISTS SP_GET_TIPO_FRUTA;
DELIMITER //
CREATE PROCEDURE SP_GET_TIPO_FRUTA()
BEGIN
	SELECT 
    ID_TIPO_FRUTA, NOMBRE TIPO_FRUTA, DESCRIPCION
	FROM TIPO_FRUTA TF;
END //
DELIMITER ;

#PROCEDIMIENTO CON TIPOS DE CALIDAD
DROP PROCEDURE IF EXISTS SP_GET_CALIDAD;
DELIMITER //
CREATE PROCEDURE SP_GET_CALIDAD()
BEGIN
	SELECT 
    ID_CALIDAD, NOMBRE CALIDAD
	FROM calidad TF;
END //
DELIMITER ;


#PROCEDIMIENTO PARA ELIMINAR USUARIO
DROP PROCEDURE IF EXISTS SP_DELETE_USUARIO;
DELIMITER //
CREATE PROCEDURE SP_DELETE_USUARIO($RUT VARCHAR(8))
BEGIN
	DECLARE $ID_USUARIO INT;
    DECLARE $ID_PEDIDO INT;
	#SE RECUPERA ID DEL USUARIO
    SELECT 
    ID_USUARIO INTO $ID_USUARIO
	FROM PERSONA
    WHERE RUT = $RUT;
    #SE ELMINA DATOS DE PERSONA DEL USUARIO
    #SE RECUPERA EL ID DE LOS PEDIDOS ASOCIADOS AL USUARIO
	SELECT
    ID_PEDIDO INTO $ID_PEDIDO
    FROM PEDIDO
    WHERE ID_COMPRADOR = $ID_USUARIO;
    #SE ELIMINAN LOS PEDIDOS ASOCIADOS AL USUARIO
    DELETE
    FROM DETALLE_PEDIDO
    WHERE ID_PEDIDO = $ID_PEDIDO;
    DELETE
    FROM PEDIDO
    WHERE ID_COMPRADOR = $ID_USUARIO;
	#SE ELIMINAN LOS DESPACHOS ASOCIADOS AL USUARIO, SI ES TRANSPORTISTA
	DELETE
    FROM DESPACHO
    WHERE ID_TRANSPORTISTA = $ID_USUARIO;
    DELETE
    #SE ELIMINA LA PERSONA ASOCIADA AL USUARIO
    FROM PERSONA
    WHERE ID_USUARIO = $ID_USUARIO;
    #SE ELIMINA USUARIO
	DELETE
    FROM USUARIO
    WHERE ID_USUARIO = $ID_USUARIO;
	#SE ELIMINA CONTRATO DE USUARIO
    DELETE
    FROM CONTRATO
    WHERE ID_USUARIO = $ID_USUARIO;
END
DELIMITER ;


#PROCEDIMIENTO PARA MODIFICAR USUARIO
DROP PROCEDURE IF EXISTS SP_UPDATE_USUARIO;
DELIMITER //
CREATE PROCEDURE SP_UPDATE_USUARIO(
$NOMBRE VARCHAR(100),
$APELLIDO VARCHAR(100),
$RUT INT(8),
$TIPO_PERFIL INT,
$TIPO_PERSONA INT,
$NOMBRE_FANTASIA VARCHAR(100),
$COMUNA INT,
$CODIGO_POSTAL INT,
$TELEFONO INT,
$CORREO VARCHAR(100),
$CONTRASENA VARCHAR(255)
)
BEGIN
	DECLARE $ID_USUARIO INT;
    #OBTENER ID DE USUARIO
    SELECT
    ID_USUARIO INTO $ID_USUARIO
    FROM PERSONA
    WHERE RUT=$RUT;
    #ACTUALIZAR DATOS PERSONA
    UPDATE PERSONA SET
    RUT = $RUT,
    NOMBRE = $NOMBRE,
    APELLIDO = $APELLIDO,
    NOMBRE_FANTASIA = NOMBRE_FANTASIA,
    CODIGO_POSTAL = $CODIGO_POSTAL,
    ID_COMUNA = $COMUNA,
    TELEFONO = $TELEFONO,
    ID_TIPO_PERSONA_LEGAL = $TIPO_PERSONA;
    #ACTUALIZAR DATOS USUARIO
    UPDATE USUARIO SET
    CORREO = $CORREO,
    CONTRASENA = $CONTRASENA,
    ID_PERFIL = $TIPO_PERFIL;
END
DELIMITER ;

##CREAR PRODUCTO TIPO FRUTA
DROP PROCEDURE IF EXISTS SP_CREATE_TIPO_FRUTA;
DELIMITER //
CREATE PROCEDURE `SP_CREATE_TIPO_FRUTA`(
IN $NOMBRE VARCHAR(100),
IN $DESCRIPCION VARCHAR(150),
IN $FOTO BLOB)
BEGIN
INSERT INTO `maipo_grande`.`tipo_fruta`
	(`NOMBRE`,
	`DESCRIPCION`,
	`FOTO`)
    VALUES
    ($NOMBRE,
    $DESCRIPCION,
    $FOTO);
END
DELIMITER ;

##ELIMINAR PRODUCTO TIPO FRUTA
DROP PROCEDURE IF EXISTS SP_DELETE_TIPO_FRUTA;
DELIMITER //
CREATE PROCEDURE `SP_DELETE_TIPO_FRUTA`($ID_TIPO_FRUTA INT)
BEGIN
DELETE FROM TIPO_FRUTA WHERE ID_TIPO_FRUTA = $ID_TIPO_FRUTA;
END
DELIMITER ;

##ACTUALIZAR PRODUCTO TIPO FRUTA
DROP PROCEDURE IF EXISTS SP_UPDATE_TIPO_FRUTA;
DELIMITER //
CREATE PROCEDURE `SP_UPDATE_TIPO_FRUTA`(
$ID_TIPO_FRUTA INT,
$NOMBRE VARCHAR(100),
$DESCRIPCION VARCHAR(150),
$FOTO BLOB)
BEGIN

    UPDATE TIPO_FRUTA 
    SET
    NOMBRE = $NOMBRE,
    DESCRIPCION = $DESCRIPCION,
    FOTO = $FOTO
    WHERE ID_TIPO_FRUTA = $ID_TIPO_FRUTA;
END
DELIMITER ;

##LISTAR USUARIOS
DROP PROCEDURE IF EXISTS SP_GET_USUARIO;
DELIMITER //
CREATE PROCEDURE `SP_GET_USUARIO`()
BEGIN
SELECT U.ID_USUARIO ID_USUARIO,P.RUT,P.DIGITO_VERIFICADOR,P.NOMBRE,P.APELLIDO,P.TELEFONO,P.ID_TIPO_PERSONA_LEGAL,P.NOMBRE_FANTASIA,
P.CODIGO_POSTAL,P.ID_COMUNA,U.CORREO,U.ID_PERFIL FROM PERSONA P 
JOIN USUARIO U on U.ID_USUARIO = P.ID_USUARIO
ORDER BY U.ID_USUARIO ;
END
DELIMITER ;


#CREAR VENTA INTERNA
DROP PROCEDURE IF EXISTS SP_CREAR_VENTA_INTERNA;
DELIMITER //
CREATE PROCEDURE `SP_CREAR_VENTA_INTERNA`(
IN $ID_PROVEEDOR INT,
IN $ID_TIPO_FRUTA INT,
IN $ID_CALIDAD INT,
IN $CANT_KG float(6,3),
IN $PRECIO_X_KG float(9,3))
BEGIN
INSERT INTO HISTORICO_STOCK(ID_PROVEEDOR,ID_TIPO_FRUTA,ID_CALIDAD,FECHA_REGISTRO,CANT_KG,PRECIO_X_KG)
VALUES($ID_PROVEEDOR, 
$ID_TIPO_FRUTA, 
$ID_CALIDAD, 
SYSDATE(), 
$CANT_KG, 
$PRECIO_X_KG);
END
DELIMITER ;


#TRAER USUARIOS CON CONTRATO
DROP PROCEDURE IF EXISTS SP_GET_USUARIOS_CON_CONTRATO;
DELIMITER //
CREATE PROCEDURE `SP_GET_USUARIOS_CON_CONTRATO` ()
BEGIN
SELECT ID_USUARIO, CORREO, ID_PERFIL FROM USUARIO WHERE ID_PERFIL = 2 OR ID_PERFIL = 5;
END
DELIMITER ;

#MODIFICAR CONTRATO
DROP PROCEDURE IF EXISTS SP_UPDATE_CONTRATO;
DELIMITER //
CREATE PROCEDURE `SP_UPDATE_CONTRATO`(
$ID_USUARIO INT,
$CONTRATO BLOB,
$FECHA_VENCIMIENTO DATE)
BEGIN
UPDATE CONTRATO
SET
FECHA_VENCIMIENTO = $FECHA_VENCIMIENTO,
CONTRATO = $CONTRATO 
WHERE ID_USUARIO = $ID_USUARIO;
END
