<?php

 $host_db = "localhost";
 $user_db = "root";
 $pass_db = "";
 $db_name = "etl";
 $tbl_name = "user";
 
 

 $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
if (isset($_POST['name'])) {
			$name = $_POST['name'];
 $buscarUsuario = "SELECT * FROM user
 WHERE name = '$name' ";

 $result = $conexion->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
    $existe="<p>EL usuario ya existe</p>";
 }
 else{
    $existe="<p>Registrado</p>";
 }

}
 mysqli_close($conexion);
?>