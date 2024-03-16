CREATE TABLE productos
(
	id				INT IDENTITY (1,1) PRIMARY KEY,
	descripcion		VARCHAR(40)			NOT NULL,
	precio			DECIMAL(7,2)		NOT NULL,
	fecharegistro	DATETIME NOT NULL DEFAULT GETDATE()
);
GO

INSERT INTO productos (descripcion, precio) VALUES
	('Teclado Micronics', 75),
	('Monitor Samsung 24', 500);
GO

SELECT * FROM productos;
GO

-- --------------------------------------------------------------------------------------------
-- --------------------------------------------------------------------------------------------

CREATE TABLE vendedores
(
	id				INT IDENTITY (1,1) PRIMARY KEY,
	apellidos		VARCHAR(50)		NOT NULL,
	nombres			VARCHAR(50)		NOT NULL,
	dni				CHAR(8)			NOT NULL UNIQUE,
	telefono		CHAR(9)			NULL,
	correo			VARCHAR(100)	NULL,
	fecharegistro	DATETIME		NOT NULL DEFAULT GETDATE(),
	contrato		BIT				NOT NULL DEFAULT('1')
);
GO

INSERT INTO vendedores(apellidos, nombres, dni, telefono, correo) VALUES
	('Almeyda Sanchez', 'Carolina', '78909182', '909818273', 'carolina@gmail.com'),
	('Guevara Riola', 'Esthefany', '89182733', '990102939', 'esthefany@gmail.com'),
	('Cáceres Anchante', 'Mirtha', '78181881', '920901929', 'mirtha@gmail.com'),
	('Lovato Espino', 'Celeste', '78110101', '912312091', 'celeste@gmail.com'),
	('Castillo Quiroga', 'Damaris', '81818190', '992910291', 'damaris@gmail.com');
GO

SELECT * FROM vendedores;

UPDATE vendedores SET contrato = 0 WHERE id = 1;

-- Listar vendedores con excepciones
CREATE PROCEDURE listar_contratos
AS
BEGIN
	SELECT id, apellidos, nombres, telefono
	FROM vendedores
	WHERE contrato = 1;
END;
GO

-- Listando todos los vendedores
CREATE PROCEDURE vendedores_todos
AS
BEGIN
	SELECT
		*
		FROM vendedores
		WHERE contrato = 1
END;
GO

-- Registrar vendedores
CREATE PROCEDURE vendedor_registrar
	@apellidos			VARCHAR(50),
	@nombres			VARCHAR(50),
	@dni				CHAR(8),
	@telefono			CHAR(9),
	@correo				VARCHAR(100)
AS
BEGIN

	INSERT INTO vendedores (apellidos, nombres, dni, telefono, correo) 
	VALUES (@apellidos,
			@nombres, 
			@dni, 
			NULLIF(@telefono, ''),
			NULLIF(@correo, ''))
END
GO

-- Ejecuciones
EXEC listar_contratos;
EXEC vendedores_todos;
EXEC spu_vendedores_registrar 'Durand', 'Buenamarca', 78920192, 990910290, 'adriana@gmail.com'