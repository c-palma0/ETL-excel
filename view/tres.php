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
        && (filter_var($ancho_m, FILTER_VALIDATE_FLOAT) && $ancho_m>= 0 || $ancho_m == '0' && $ancho_m != '')
        && ((filter_var($altura_m, FILTER_VALIDATE_FLOAT)) && $altura_m>= 0 || $altura_m==0 && $altura_m != '')
        && (filter_var($numero,FILTER_VALIDATE_INT) && $numero >= 0 || $numero =='0' && $numero != ''  )){
     
         mysqli_query($dw, "INSERT INTO tbl_arboles VALUES ($id,'$especie',$ancho_m,$altura_m,$c_fisica,'$numero','$solicito','$autoriza','$fecha_reso','$reforestacion','$today',$coord_x,$coord_y)");    
        }else{
         mysqli_query($db, "INSERT INTO tbl_arboles VALUES ($id,'$especie','$ancho_m','$altura_m',$c_fisica,'$numero','$solicito','$autoriza','$fecha_reso','$reforestacion','$today',$coord_x,$coord_y)");  
        
        }        
    }


    




?>

    