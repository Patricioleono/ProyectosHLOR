/*tabla datos de usuario matronas*/

CREATE TABLE public._matronas_user
(
    user_pk bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
    user_nombres character varying(255),
    user_apellido_paterno character varying(50),
    user_apellido_materno character varying(50),
    user_rut_sin_dv integer,
    user_rut_dv character varying(1),
    user_nacionalidad smallint,
    user_direccion character varying(255),
    user_prevision smallint,
    user_telefono integer,
    user_fecha_nacimiento date,
    PRIMARY KEY (user_pk)
);

ALTER TABLE IF EXISTS public._matronas_user
    OWNER to postgres;
	
	
/*tabla motivo pap*/
CREATE TABLE public._matronas_motivo_pap
(
    mat_motivo_pap_pk bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
    mat_motivo_pap character varying(25),
    mat_valor_pap smallint,
    PRIMARY KEY (mat_motivo_pap_pk)
);

ALTER TABLE IF EXISTS public._matronas_motivo_pap
    OWNER to postgres;
	
	
/*tabla nacionalidad*/
CREATE TABLE public._matronas_nacionalidad
(
    mat_nacionalidad_pk smallint NOT NULL GENERATED ALWAYS AS IDENTITY,
    mat_pais_origen character varying(25),
    mat_valor_nacionalidad smallint,
    PRIMARY KEY (mat_nacionalidad_pk)
);

ALTER TABLE IF EXISTS public._matronas_nacionalidad
    OWNER to postgres;
	
	
/*tabla prevision*/
CREATE TABLE public._matronas_prevision
(
    mat_prevision_pk smallint NOT NULL GENERATED ALWAYS AS IDENTITY,
    mat_prevision_nombre character varying(30),
    mat_prevision_valor smallint,
    PRIMARY KEY (mat_prevision_pk)
);

ALTER TABLE IF EXISTS public._matronas_prevision
    OWNER to postgres;
	
/*tabla historial pacientes*/
CREATE TABLE public._matronas_historial
(
    mat_historial_pk bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
    mat_historial_fecha_pap date,
    mat_historial_indicaciones text,
    mat_historial_observaciones text,
    mat_historial_motivo_pap smallint,
    PRIMARY KEY (mat_historial_pk)
);

ALTER TABLE IF EXISTS public._matronas_historial
    OWNER to postgres;



	
	