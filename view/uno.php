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
      
        if ((filter_var($area, FILTER_VALIDATE_FLOAT)) && $area >= 0 || $area=='0' && $area != "") {
          mysqli_query($dw, "INSERT INTO  tbl_cuerpos_de_agua VALUES ($id,$area,$id_ca,'$today',$coord_x,$coord_y)");    
        }else{
          mysqli_query($db, "INSERT INTO  tbl_cuerpos_de_agua VALUES ($id,'$area',$id_ca,'$today',$coord_x,$coord_y)");
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




    




?>

    