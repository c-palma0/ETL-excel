<?php 
	session_start();
	$db = mysqli_connect("localhost", "root","","etl");
	$db->set_charset("utf8");
	$dw = mysqli_connect("localhost", "root","","catastro_dw");
	$dw->set_charset("utf8");
	// initialize variables
	// $nombre = "";
	// $id_calle = "";
	// $id = 0;
	// $update = false;
	//$_SESSION['message'] = "Address updated!"; 
if (isset($_POST['num'])) {
	 	$id = $_POST['id'];
	 	$id_colonia = $_POST['id_colonia'];
		$num_oficial = $_POST['num_oficial'];
		$coord_x = $_POST['coord_x'];
		$coord_y = $_POST['coord_y'];
		$today = date("Y-m-d");  
		echo $id_colonia;
	 	 mysqli_query($db, "UPDATE tbl_numeros_oficiales SET num_oficial='$num_oficial' WHERE id=$id");
		 mysqli_query($dw, "INSERT INTO tbl_numeros_oficiales VALUES ($id,'$num_oficial',$id_colonia,'$today',$coord_x,$coord_y)");
	     mysqli_query($db, "DELETE FROM tbl_numeros_oficiales WHERE id=$id");
	 	 header('location: numeros.php');
	 }
if (isset($_POST['glorieta'])) {
	 	 	$id = $_POST['id'];
	 	$nombre= $_POST['nombre'];
		$monumento = $_POST['monumento'];
		$coord_x = $_POST['coord_x'];
		$coord_y = $_POST['coord_y'];
		$today = date("Y-m-d");  

	 	 mysqli_query($db, "UPDATE tbl_glorietas SET monumento='$monumento', nombre='$nombre' WHERE id=$id");
		 mysqli_query($dw, "INSERT INTO tbl_glorietas VALUES ($id,'$nombre','$monumento','$today',$coord_x,$coord_y)");
	     mysqli_query($db, "DELETE FROM tbl_glorietas WHERE id=$id");
	 	 header('location: glorietas.php');
	 }

	 if (isset($_POST['vialidad'])) {
	 	$id = $_POST['id'];
	 	$nombre = $_POST['nombrev'];
		$id_material = $_POST['id_material'];
		$coord_x = $_POST['coord_x'];
		$coord_y = $_POST['coord_y'];
		$today = date("Y-m-d");  
		
	 	 mysqli_query($db, "UPDATE tbl_vialidad SET nombre='$nombre' WHERE id=$id");
		 mysqli_query($dw, "INSERT INTO tbl_vialidad VALUES ($id,'$nombre',$id_material,'$today',$coord_x,$coord_y)");
	     mysqli_query($db, "DELETE FROM tbl_vialidad WHERE id=$id");
	 	 header('location: vialidades.php');
	 }
	if (isset($_POST['arboles'])) {
				$id = $_POST['id'];
				$especie = $_POST['especie'];
				$coord_x = $_POST['coord_x'];
				$coord_y = $_POST['coord_y'];
				$ancho_m = $_POST['ancho_m'];
				$alto_m= $_POST["alto_m"];  
				$id_c_fisica = $_POST['c_fisica'];
				$numero = $_POST['numero'];
				$solicito= $_POST["solicito"];
				$autoriza= $_POST['autoriza'];
				$fecha_reso= $_POST['fecha_reso'];
				$reforestacion= $_POST["reforestacion"];  
				$today = date("Y-m-d");  
  
			mysqli_query($db, "UPDATE tbl_arboles SET especie='$especie', ancho_m='$ancho_m', alto_m='$alto_m', numero='$numero', solicito='$solicito',
			autoriza='$autoriza', fecha_reso='$fecha_reso', reforestacion='$reforestacion' WHERE id=$id");
			mysqli_query($dw, "INSERT INTO tbl_arboles VALUES ($id,'$especie','$ancho_m','$alto_m','$id_c_fisica','$numero','$solicito','$autoriza',
			'$fecha_reso','$reforestacion','$today',$coord_x,$coord_y)");
			mysqli_query($db, "DELETE FROM tbl_arboles WHERE id=$id");
		//	$_SESSION['message'] = "actualizado!"; 
				
			header('location:arboles.php');
		}
	   
	if (isset($_POST['area'])) {
			$id = $_POST['id'];
			$area = $_POST['area'];
			$coord_x = $_POST['coord_x'];
			$coord_y = $_POST['coord_y'];
			$id_ca = $_POST['id_ca'];
			$today = date("Y-m-d");  

		
		echo ($today);
		mysqli_query($db, "UPDATE tbl_cuerpos_de_agua SET area='$area' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO  tbl_cuerpos_de_agua VALUES ($id,$area,$id_ca,'$today',$coord_x,$coord_y)");
		mysqli_query($db, "DELETE FROM tbl_cuerpos_de_agua WHERE id=$id");
	//	$_SESSION['message'] = "actualizado!"; 

		header('location:cuerpos_agua.php');
	}

	if (isset($_POST['cau'])) {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$coord_x = $_POST['coord_x'];
			$coord_y = $_POST['coord_y'];
			$today = date("Y-m-d"); 
			echo $id." ".$nombre;
		mysqli_query($db, "UPDATE tbl_cauces_de_agua SET nombre='$nombre' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO  tbl_cauces_de_agua VALUES ($id,'$nombre','$today',$coord_x,$coord_y)");
		mysqli_query($db, "DELETE FROM tbl_cauces_de_agua WHERE id=$id");
	//	$_SESSION['message'] = "actualizado!"; 

		header('location:cauces_agua.php');
	}

if (isset($_POST['camellones'])) {
			$id = $_POST['id'];
			$area = $_POST['camellones'];
			$coord_x = $_POST['coord_x'];
			$coord_y = $_POST['coord_y'];
			$today = date("Y-m-d"); 

		//mysqli_query($db, "UPDATE tbl_vialidad SET nombre='$nombre', id_calle='$id_calle' WHERE id=$id");
		echo ($today);
		mysqli_query($db, "UPDATE tbl_camellones SET area='$area' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO  tbl_camellones VALUES ($id,$area,'$today',$coord_x,$coord_y)");
		mysqli_query($db, "DELETE FROM tbl_camellones WHERE id=$id");
	//	$_SESSION['message'] = "actualizado!"; 

		header('location:camellones.php');
	}
	// if (isset($_GET['del'])) {
	// 	$id = $_GET['del'];
	// 	mysqli_query($db, "DELETE FROM tbl_vialidad WHERE id=$id");
	// //	$_SESSION['message'] = "Eliminado!"; 
	// 	header('location: index2.php');
	// }
if (isset($_POST['descripcion'])) {
			$id = $_POST['id'];
			$fecha_ini = $_POST['fecha_ini'];
			$descripcion = $_POST['descripcion'];
			$coord_x = $_POST['coord_x'];
			$coord_y = $_POST['coord_y'];
			$today = date("Y-m-d"); 
		    $fecha_ini = date("Y-m-d", strtotime($fecha_ini));
			
		//mysqli_query($db, "UPDATE tbl_vialidad SET nombre='$nombre', id_calle='$id_calle' WHERE id=$id");	
		mysqli_query($db, "UPDATE tbl_multas SET fecha_ini='$fecha_ini', descripcion='$descripcion' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO  tbl_multas VALUES ($id,'$descripcion','$fecha_ini','$today',$coord_x,$coord_y)");
		mysqli_query($db, "DELETE FROM tbl_multas WHERE id=$id");
	//	$_SESSION['message'] = "actualizado!"; 

		header('location:multas.php');
	}

	if (isset($_POST['hospitales'])) {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$coord_x = $_POST['coord_x'];
			$coord_y = $_POST['coord_y'];
			$tipo = $_POST['tipo'];
			$dependencia = $_POST['dependencia'];
			$today = date("Y-m-d");  

		//mysqli_query($db, "UPDATE tbl_vialidad SET nombre='$nombre', id_calle='$id_calle' WHERE id=$id");
		echo ($today);
		mysqli_query($db, "UPDATE tbl_hospital SET nombre='$nombre', tipo='$tipo', dependencia='$dependencia' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO tbl_hospital VALUES ($id,'$nombre','$tipo','$dependencia','$today',$coord_x,$coord_y)");
		mysqli_query($db, "DELETE FROM tbl_hospital WHERE id=$id");
	//	$_SESSION['message'] = "actualizado!"; 

		header('location:hospitales.php');
	}
	if(isset($_POST['data'])){
	$dataArr = $_POST['data'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_cuerpos_de_agua where id='$id'");
		}
		header("location:cuerpos_agua.php");
	}

	if(isset($_POST['data1'])){
	$dataArr = $_POST['data1'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_cauces_de_agua where id='$id'");
		}
			header("location:cauces_agua.php");
	}
	if(isset($_POST['data2'])){
	$dataArr = $_POST['data2'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_camellones where id='$id'");
		}
		header('location:camellones.php');
	}
	if(isset($_POST['datam'])){
	$dataArr = $_POST['datam'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_multas where id='$id'");
		}
		header('location:multas.php');
	}

		if(isset($_POST['dataa'])){
		$dataArr = $_POST['dataa'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_accidentes where id='$id'");
		}
		header('location:accidentes.php');
	}

		if(isset($_POST['datah'])){
		$dataArr = $_POST['datah'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_hospital where id='$id'");
		}
		header('location:hospitales.php');
	}

		if(isset($_POST['datas'])){
		$dataArr = $_POST['datas'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_sismo_2003 where id='$id'");
		}
		header('location:sismo.php');
	}
		if(isset($_POST['datav'])){
		$dataArr = $_POST['datav'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_vialidad where id='$id'");
		}
		header('location:vialidades.php');
	}

		if(isset($_POST['datan'])){
		$dataArr = $_POST['datan'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_numeros_oficiales where id='$id'");
		}
		header('location:numeros.php');
	}
		if(isset($_POST['datag'])){
		$dataArr = $_POST['datag'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_glorietas where id='$id'");
		}
		header('location:glorietas.php');
	}

		if(isset($_POST['datar'])){
		$dataArr = $_POST['datar'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_rutas_camion where id='$id'");
		}
		header('location:rutas.php');
	}		

		if(isset($_POST['dataar'])){
		$dataArr = $_POST['dataar'] ; 

		foreach($dataArr as $id){
			mysqli_query($db , "DELETE FROM tbl_arboles where id='$id'");
		}
		header('location:arboles.php');
	}		

	
?>