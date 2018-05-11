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

$glorieta = odbc_exec($conexion,"SELECT * FROM [tbl_glorietas$]");
    while($row = odbc_fetch_array($glorieta)) {
            $id = $row['id'];
            $nombre =  utf8_encode(strtolower($row['nombre']));
            $coord_x = $row['coord_x'];
            $coord_y = $row['coord_y'];
            $monumento =  utf8_encode(strtolower($row['monumento']));
          
           
        if ((preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$nombre") && $nombre!=null) 

           && (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$monumento") && $monumento!=null)){

          mysqli_query($dw, "INSERT INTO tbl_glorietas VALUES ($id,'$nombre','$monumento','$today',$coord_x,$coord_y)");
        }else{
           mysqli_query($db, "INSERT INTO tbl_glorietas VALUES ($id,'$nombre','$monumento','$today',$coord_x,$coord_y)");
        }      
            
    }

$camellones= odbc_exec($conexion,"SELECT * FROM [tbl_camellones$]");

	while($row = odbc_fetch_array($camellones)) {
        $id = $row['id'];
        $area = $row['area'];
        $coord_x = $row['coord_x'];
        $coord_y = $row['coord_y'];
       //  echo "INSERT INTO  tbl_camellones VALUES ($id,'$area','$today',$coord_x,$coord_y)";
       
        if (filter_var($area, FILTER_VALIDATE_FLOAT) && $area >= 0 && $area !=''|| $area=='0') {
            
            mysqli_query($dw, "INSERT INTO  tbl_camellones VALUES ($id,$area,'$today',$coord_x,$coord_y)");    
            
        }else{
          
         
          mysqli_query($db, "INSERT INTO  tbl_camellones VALUES ($id,'$area','$today',$coord_x,$coord_y)");
        }    
         
    }

$lc = odbc_exec($conexion,"SELECT * FROM [tbl_licencias_de_construccion$]");
    while($row = odbc_fetch_array($lc)) {
            $id = $row['id'];
            $coord_x = $row['coord_x'];
            $coord_y = $row['coord_y'];
          
           
            mysqli_query($dw, "INSERT INTO tbl_licencias_de_construccion VALUES ($id,'$today',$coord_x,$coord_y)");
            
    }


?>

    