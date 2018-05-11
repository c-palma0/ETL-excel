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
 
$ct_ca = odbc_exec($conexion,"SELECT * FROM [ct_colonia$]");
    while($row = odbc_fetch_array($ct_ca)) {
            $id = $row['id'];
            $colonia = strtolower($row['colonia']);
             $colonia=utf8_encode($colonia);
           // $colonia = utf8_encode($row["colonia"]);
           
          //preg_replace('/[^(áéíóúña-z0-9\s!|"#$,.-_{}%&\/*+-`~,:;><)]*/','', utf8_decode(strtolower($row['colonia'])));
         echo $colonia;
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

   