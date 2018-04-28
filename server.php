<?php 
	session_start();
	$db = mysqli_connect("localhost", "root","","etl");
	$db->set_charset("utf8");
	$dw = mysqli_connect("localhost", "root","","catastro_dw");

	// initialize variables
	// $nombre = "";
	// $id_calle = "";
	// $id = 0;
	// $update = false;



	// if (isset($_POST['update'])) {
	// 	$id = $_POST['id'];
	// 	$nombre = $_POST['nombre'];
	// 	$id_calle = $_POST['id_calle'];

	// 	mysqli_query($db, "UPDATE tbl_vialidad SET nombre='$nombre', id_calle='$id_calle' WHERE id=$id");
	// 	//$_SESSION['message'] = "Address updated!"; 
	// 	header('location: index2.php');
	// }

	   
	if (isset($_POST['area'])) {
			$id = $_POST['id'];
			$area = $_POST['area'];
			$coord_x = $_POST['coord_x'];
			$coord_y = $_POST['coord_y'];
			$id_ca = $_POST['id_ca'];
			$today = date("d-m-Y");  

		//mysqli_query($db, "UPDATE tbl_vialidad SET nombre='$nombre', id_calle='$id_calle' WHERE id=$id");
		echo ($today);
		mysqli_query($db, "UPDATE tbl_cuerpos_de_agua SET area='$area' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO  tbl_cuerpos_de_agua VALUES ($id,$area,$id_ca,'$today',$coord_x,$coord_y)");
		mysqli_query($db, "DELETE FROM tbl_cuerpos_de_agua WHERE id=$id");
	//	$_SESSION['message'] = "actualizado!"; 

		header('location:cuerpos_agua.php');
	}

	if (isset($_POST['nombre'])) {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$today = date("d-m-Y"); 
		mysqli_query($db, "UPDATE tbl_cauces_de_agua SET nombre='$nombre' WHERE id=$id");
		mysqli_query($dw, "INSERT INTO  tbl_cauces_de_agua VALUES ($id,$area,'$today',$coord_x,$coord_y)");
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
?>