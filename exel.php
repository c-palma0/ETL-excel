<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
header('Content-Type: text/html; charset=UTF-8');

mb_internal_encoding('UTF-8'); 
mb_http_output('UTF-8'); 
mb_http_input('UTF-8'); 
mb_regex_encoding('UTF-8'); 

 
$conexion = odbc_connect('cone','','') or die ('No se pudo establecer una conexion');

$db = mysqli_connect("localhost", "root","","etl");
$db->set_charset("utf8");
$dw = mysqli_connect("localhost", "root","","catastro_dw");
$dw->set_charset("utf8");
    
$today = date("Y-m-d");  
$error="1970-01-01";

$ct_ca = odbc_exec($conexion,"SELECT * FROM [ct_cond_fisica$]");
    while($row = odbc_fetch_array($ct_ca)) {
            $id = $row['id'];
            $c_fisica = strtolower($row['c_fisica']);
          
            mysqli_query($db, "INSERT INTO ct_cond_fisica VALUES ($id,'$c_fisica')");
            mysqli_query($dw, "INSERT INTO ct_cond_fisica VALUES ($id,'$c_fisica')");
            
    }

 $arbol= odbc_exec($conexion,"SELECT * FROM [tbl_arboles$]");

	while($row = odbc_fetch_array($arbol)) {
        $id = $row['id'];
        $especie =  strtolower($row['especie']);
        $especie =utf8_encode($especie);
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
        $ancho_m = $row['ancho_m'];
        $altura_m = $row['altura_m'];
        $c_fisica = $row['c_fisica'];
        $numero = $row['numero'];
        $solicito =  strtolower($row['solicito']);
        $solicito =utf8_encode($solicito);
        $autoriza = strtolower($row['autoriza']);
        $fecha_reso = $row['fecha_reso'];
        $reforestacion = strtolower($row['reforestacion']);

        $fecha_reso= str_replace('/', '-', $fecha_reso);
        $fecha_reso=date('Y-m-d', strtotime($fecha_reso));
        //echo $fecha_reso;
        $año=date("Y", strtotime($fecha_reso));
        $mes=date("m", strtotime($fecha_reso));
        $dia=date("d", strtotime($fecha_reso));

        //$fecha = $dia."-".$mes."-".$año;
       


        if ((preg_match('/^([áéíóúñ a-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$especie") && $especie!=null) 
        && (preg_match('/^([áéíóúñ a-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$solicito") &&  $solicito!=null)
        && ($fecha_reso != $error) 
        && ($reforestacion=="si" || $reforestacion=="no")
        && ($autoriza=="si" || $autoriza=="no")
        && (filter_var($ancho_m, FILTER_VALIDATE_FLOAT) && $ancho_m>= 0 || $ancho_m ==0 && $ancho_m != "")
        && ((filter_var($altura_m, FILTER_VALIDATE_FLOAT)) && $altura_m>= 0 || $altura_m==0 && $altura_m != "")
        && (filter_var($numero,FILTER_VALIDATE_INT) && $numero >= '0' || $numero =='0' && $numero != ""  )){
     
         mysqli_query($dw, "INSERT INTO tbl_arboles VALUES ($id,'$especie',$ancho_m,$altura_m,$c_fisica,'$numero','$solicito','$autoriza','$fecha_reso','$reforestacion','$today',$coord_x,$coord_y)");    
        }else{
         mysqli_query($db, "INSERT INTO tbl_arboles VALUES ($id,'$especie',$ancho_m,$altura_m,$c_fisica,'$numero','$solicito','$autoriza','$fecha_reso','$reforestacion','$today',$coord_x,$coord_y)");  
        
        }        
    }

    $ct_ca = odbc_exec($conexion,"SELECT * FROM [ct_cuerpos_agua$]");
    while($row = odbc_fetch_array($ct_ca)) {
            $id = $row['id'];
            $tipo = strtolower($row['tipo']);
          
            mysqli_query($db, "INSERT INTO ct_cuerpos_agua VALUES ($id,'$tipo')");
            mysqli_query($dw, "INSERT INTO ct_cuerpos_agua VALUES ($id,'$tipo')");
            
    }
$cuerpoAgua = odbc_exec($conexion,"SELECT * FROM [tbl_cuerpos_de_agua$]");
	while($row = odbc_fetch_array($cuerpoAgua)) {
        $id = $row['id'];
        $area = $row['area'];
        $id_ca = $row['id_ca'];
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
      
        if ((filter_var($area, FILTER_VALIDATE_FLOAT)) && $area>= 0 || $area==0 && $area != "") {
          mysqli_query($dw, "INSERT INTO  tbl_cuerpos_de_agua VALUES ($id,$area,$id_ca,'$today',$coord_x,$coord_y)");    
        }else{
          mysqli_query($db, "INSERT INTO  tbl_cuerpos_de_agua VALUES ($id,$area,$id_ca,'$today',$coord_x,$coord_y)");
        }        
    }
    
$hotel = odbc_exec($conexion,"SELECT * FROM [tbl_hospital$]");
	while($row = odbc_fetch_array($hotel)) {
        $id = $row['id'];
        $nombre = strtolower($row['nombre']);
        $nombre =utf8_encode($nombre);
        $tipo = strtolower($row['tipo']);
        $tipo =utf8_encode($tipo);
        $dependencia= strtolower($row['dependencia']);
        $dependencia =utf8_encode($dependencia);
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
     
        if ((preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$nombre") && $nombre!=null) 
           && (preg_match('/^([áéíóúñaa-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$tipo") && $tipo!=null) 
           && (preg_match('/^([a-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$dependencia") && $dependencia!=null)){
           mysqli_query($dw, "INSERT INTO tbl_hospital VALUES ($id,'$nombre','$tipo','$dependencia','$today',$coord_x,$coord_y)");
        }else{
           mysqli_query($db, "INSERT INTO tbl_hospital VALUES ($id,'$nombre','$tipo','$dependencia','$today',$coord_x,$coord_y)");
        }
    }

$cauceAgua = odbc_exec($conexion,"SELECT * FROM [tbl_causes_de_agua$]");

	while($row = odbc_fetch_array($cauceAgua)) {
        $id = $row['id'];
        $nombre = strtolower($row['nombre']);
        $nombre =utf8_encode($nombre);
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
      //  echo $nombre;
      
        if (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$nombre") && $nombre!=null) {
         mysqli_query($dw, "INSERT INTO tbl_cauces_de_agua VALUES ($id,'$nombre','$today',$coord_x,$coord_y)");    
        }else{
         mysqli_query($db, "INSERT INTO tbl_cauces_de_agua VALUES ($id,'$nombre','$today',$coord_x,$coord_y)");
        }        
    }

$vial = odbc_exec($conexion,"SELECT * FROM [tbl_vialidad$]");

	while($row = odbc_fetch_array($vial)) {
        $id = $row['id'];
        $nombre = strtolower($row['nombre']);
        $nombre =utf8_encode($nombre);
        $id_material = $row['id_material']; 
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
      
        if (preg_match('/^([áéíóúñ a-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$nombre") && $nombre!=null && $nombre!='s/n' && $nombre!='sn')  {
         mysqli_query($dw, "INSERT INTO tbl_vialidad VALUES ($id,'$nombre','$id_material','$today',$coord_x,$coord_y)");
        }else{
         mysqli_query($db, "INSERT INTO tbl_vialidad VALUES ($id,'$nombre','$id_material','$today',$coord_x,$coord_y)");
        }       
    }

$ct_ca = odbc_exec($conexion,"SELECT * FROM [ct_tipo_material$]");
    while($row = odbc_fetch_array($ct_ca)) {
            $id = $row['id'];
            $material = strtolower($row['material']);
          
            mysqli_query($db, "INSERT INTO ct_tipo_material VALUES ($id,'$material')");
            mysqli_query($dw, "INSERT INTO ct_tipo_material VALUES ($id,'$material')");
            
    }

$ct_ca = odbc_exec($conexion,"SELECT * FROM [ct_colonia$]");
    while($row = odbc_fetch_array($ct_ca)) {
            $id = $row['id'];
            $colonia=strtolower($row['colonia']);
            $colonia=utf8_encode($colonia);
            //echo $colonia;
            mysqli_query($db, "INSERT INTO ct_colonia VALUES ($id,'$colonia')");
            mysqli_query($dw, "INSERT INTO ct_colonia VALUES ($id,'$colonia')");
            
    }

$numero = odbc_exec($conexion,"SELECT * FROM [tbl_numeros_oficiales$]");
	while($row = odbc_fetch_array($numero)) {
        $id = $row['id'];
        $id_colonia = $row['id_colonia'];
        $num_oficial = utf8_encode(strtolower($row['numero']));
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
       
       
        if (filter_var($num_oficial,FILTER_VALIDATE_INT) && $num_oficial>= '0' || $num_oficial=='0' && $num_oficial != ""  ) {
         mysqli_query($dw, "INSERT INTO tbl_numeros_oficiales VALUES ($id,'$num_oficial','$id_colonia','$today',$coord_x,$coord_y)");
       
        }else{
         mysqli_query($db, "INSERT INTO tbl_numeros_oficiales VALUES ($id,'$num_oficial','$id_colonia','$today',$coord_x,$coord_y)");
        }       
    }


    




?>

    