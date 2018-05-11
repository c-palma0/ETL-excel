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
           && (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$dependencia") && $dependencia!=null)){
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





    




?>

    