-- FUNCION LISTADO DE PACIENTES
CREATE OR REPLACE FUNCTION fn_pacientList(_type BOOLEAN)
RETURNS TABLE(
	ID_PACIENTE		INT,
	NOMBRE 			VARCHAR(100),
	APELLIDOS 		VARCHAR(255),
	RUT 			INT,
	DV 				VARCHAR(1),
	ULTIMO_CONTROL 	DATE,
	ESTADO_PAP 		VARCHAR(50)
) 
LANGUAGE PLPGSQL
AS $$
	DECLARE
	OUTPUT_CURSOR RECORD;
		BEGIN
			FOR OUTPUT_CURSOR IN(
				SELECT 	PACIENTE_ID AS ID_PACIENTE,
					PACIENTE_NOMBRE AS NOMBRE,
					CONCAT(PACIENTE_APELLIDO_PATERNO, ' ', PACIENTE_APELLIDO_MATERNO) AS APELLIDOS,
					PACIENTE_RUT_SIN_DV AS RUT,
					PACIENTE_DV AS DV,
					PACIENTE_FECHA AS ULTIMO_CONTROL,
					CASE 
						WHEN PACIENTE_ESTADO_PAP != true THEN 'NO REALIZADO' 
						ELSE 'REALIZADO'
					END AS ESTADO_PAP
				FROM _MATRONAS
				WHERE PACIENTE_ESTADO IS NOT NULL
				AND PACIENTE_ESTADO = _type

			) LOOP 	ID_PACIENTE	:= OUTPUT_CURSOR.ID_PACIENTE;
				NOMBRE 			:= UPPER(OUTPUT_CURSOR.NOMBRE);
				APELLIDOS 		:= UPPER(OUTPUT_CURSOR.APELLIDOS);
				RUT 			:= OUTPUT_CURSOR.RUT;
				DV 				:= OUTPUT_CURSOR.DV;
				ULTIMO_CONTROL 	:= OUTPUT_CURSOR.ULTIMO_CONTROL;
				ESTADO_PAP 		:= OUTPUT_CURSOR.ESTADO_PAP;
			RETURN NEXT;
		END LOOP;
END; $$


-- FUNCION UPDATE UN PACIENTE
CREATE OR REPLACE FUNCTION fn_pacientalta(_ID INT) 
RETURNS VOID AS $$
	BEGIN
		UPDATE _MATRONAS
		SET PACIENTE_ESTADO = false
		WHERE PACIENTE_ID = _ID;
	END; 
$$ LANGUAGE PLPGSQL;


