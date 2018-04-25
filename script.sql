/*database catastro_dw*/
/*SELECT (id,area,tipo) FROM tbl_cuerpos_de_agua join ct_cuerpos_agua on id_ca=id*/
/*catalogos*/
 CREATE TABLE `ct_cond_fisica` (
        `id` INT NOT NULL,
        `c_fisica` VARCHAR(15)
    );

 CREATE TABLE `ct_cuerpos_agua` (
        `id` INT NOT NULL,
        `tipo` VARCHAR(15)
    );

 CREATE TABLE `ct_tipo_luz` (
        `id` INT NOT NULL,
        `tipo_luz` VARCHAR(15)
    );

  CREATE TABLE `ct_tipo_material` (
        `id` INT NOT NULL,
        `material` VARCHAR(30)
    );

   CREATE TABLE `ct_tipo_estructura` (
        `id` INT NOT NULL ,
        `tipo` VARCHAR(100)
    );

    CREATE TABLE `ct_color` (
        `id` INT NOT NULL,
        `color` VARCHAR(15)
    );

    CREATE TABLE `ct_calle` (
        `id` VARCHAR(20) NOT NULL,
        `calle` VARCHAR(20)
    );

    CREATE TABLE `ct_colonia` (
        `id` INT NOT NULL,
        `colonia` VARCHAR(15)
    );
    CREATE TABLE `ct_tipo_co` (
        `id` INT NOT NULL,
        `tipo` VARCHAR(15)
    );

    /*tablas*/
        CREATE TABLE `tbl_arboles` (
        `id` INT NOT NULL,
        `especie` VARCHAR(50),
        `ancho_m` DECIMAL(10,2),
        `alto_m`  DECIMAL(10,2),
        `id_c_fisica`INT,
        `numero` INT,
        `solicito` VARCHAR(20),
        `autoriza` VARCHAR(2),
        `fecha_reso` DATE,
        `reforestacion` VARCHAR(2),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
/*primera parte*/
     CREATE TABLE `tbl_cuerpos_de_agua` (
        `id` INT NOT NULL,
        `area`  DECIMAL(10,2),
        `id_ca` INT,
        `fecha_act` DATE,
    	`coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   /*  
   CREATE TABLE `tbl_cuerpos_de_agua` (
        `id` INT NOT NULL,
        `area`  VARCHAR(15),
        `id_ca` INT,
        `fecha_act` DATE,
    	`coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
    */
  CREATE TABLE `tbl_cauces_de_agua` (
        `id` INT NOT NULL,
        `nombre`  VARCHAR(25),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

   CREATE TABLE `tbl_hospital` (
        `id` INT NOT NULL,
        `nombre`  VARCHAR(35),
        `tipo`  VARCHAR(100),
        `dependencia`  VARCHAR(100),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

      CREATE TABLE `tbl_atlas_de_riesgo` (
        `id` INT NOT NULL,
        `fenomeno`  VARCHAR(100),
        `detalles`  VARCHAR(200),
        `fuente`  VARCHAR(100),
        `tipo`  VARCHAR(15),
        `fen_clasi`  DECIMAL(10,2),
        `ame_ampl`  VARCHAR(15),
        `periodo_ret`  VARCHAR(50),
        `intensid_uni`  VARCHAR(100),
        `cauce`  VARCHAR(15),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   
    CREATE TABLE `tbl_refugios_temporales` (
        `id` INT NOT NULL,
        `area`  DECIMAL(10,2),
        `nombre`  VARCHAR(100),
        `id_colonia`  INT,
        `propietario`  DECIMAL(10,2),
        `construccion` DECIMAL(10,2),
        `superficie` DECIMAL(10,2),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

     CREATE TABLE `tbl_sismo_2003` (
        `id` INT NOT NULL,
        `area`  DECIMAL(10,2),
        `num_oficial`  VARCHAR(10),
        `clasificacion`  VARCHAR(100),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

     CREATE TABLE `tbl_antenas_telecomunicaciones` (
     	`clave_cata`  INT,
        `id` INT NOT NULL,
        `num_oficial`  VARCHAR(10),
        `obra`  VARCHAR(100),
        `tipo_de_obra`  VARCHAR(100),
        `fecha_ini` DATE,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   
      CREATE TABLE `tbl_camellones` (
        `id` INT NOT NULL,
        `area`  INT,
        `id_calle`  VARCHAR(20),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

      CREATE TABLE `tbl_glorietas` (
        `id` INT NOT NULL,
        `nombre`VARCHAR(100) COLLATE utf8_spanish_ci,
        `monumento` VARCHAR(200) COLLATE utf8_spanish_ci,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   
      CREATE TABLE `tbl_licencias_de_construccion` (
        `id` INT NOT NULL,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

      CREATE TABLE `tbl_numeros_oficiales` (
        `id` INT NOT NULL,
        `num_oficial` VARCHAR(10),
        `id_colonia`  INT,
        `fecha_act`   DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

      /*
      nueva tabla id_colonia= int ->varchar

  CREATE TABLE `tbl_numeros_oficiales` (
        `id` INT NOT NULL,
        `num_oficial` VARCHAR(10),
        `id_colonia`  VARCHAR(15),
        `fecha_act`   DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

      */
   
   CREATE TABLE `tbl_vialidad` (
        `id` INT NOT NULL,
        `nombre`  VARCHAR(100),
        `id_material` INT,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

    CREATE TABLE `tbl_paradas_de_camion` (
        `id` INT NOT NULL,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

    CREATE TABLE `tbl_multas` (
        `id` INT NOT NULL,
        `descripcion`  TEXT,
        `fecha_ini` DATE,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
/*
        CREATE TABLE `tbl_multas` (
        `id` INT NOT NULL,
        `descripcion`  TEXT,
        `fecha_ini` VARCHAR(10),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   */
    CREATE TABLE `tbl_rutas_camion` (
        `id` INT NOT NULL,
        `nombre`  VARCHAR(15),
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   

      CREATE TABLE `tbl_semaforos` (
        `id` INT NOT NULL,
        `tipo_semaforo`  VARCHAR(10),
        `num_cabeza`  INT,
        `id_tipo_material` INT,
        `id_tipo_de_luz` INT,
        `id_tipo_de_co`  INT,
        `id_tipo_estruc` INT,
        `id_color`  INT,
        `id_c_fisica` INT,
        `id_c_fisica_ele` INT,
        `tiempo`  VARCHAR(15),
        `fecha_mant` DATE,
        `fecha_ini` DATE,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL 
    );

   CREATE TABLE `tbl_topes` (
        `id` INT NOT NULL,
        `id_color`  INT,
        `id_c_fisica` INT,
        `id_tipo_material` INT,
        `fecha_mant` DATE,
        `fecha_ini` DATE,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );

   CREATE TABLE `tbl_accidentes` (
        `id` INT NOT NULL,
        `hora`  TIME,
        `fecha` DATE,
        `lesionados` SMALLINT,
        `muertos` SMALLINT,
        `afectados` SMALLINT,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );
   /*
      CREATE TABLE `tbl_accidentes` (
        `id` INT NOT NULL,
        `hora`  VARCHAR(10),
        `fecha` VARCHAR(10),
        `lesionados` SMALLINT,
        `muertos` SMALLINT,
        `afectados` SMALLINT,
        `fecha_act` DATE,
        `coord_x` DOUBLE NOT NULL,
        `coord_y` DOUBLE NOT NULL
    );*/
   

/*detalles*/
  CREATE TABLE `dtl_calle_refugios` (
        `id` INT NOT NULL,
        `id_calle`  VARCHAR(20)
    );

  CREATE TABLE `dt_calle_glorieta` (
        `id` INT NOT NULL,
        `id_calle`  VARCHAR(20)
    );


/* multas , rutas camion