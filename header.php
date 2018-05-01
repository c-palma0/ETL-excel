<?php 
// include('server.php');
	session_start();
	$db = mysqli_connect("localhost", "root","","etl");
  $db->set_charset("utf8");
?>
<!DOCTYPE html>

<html lang="es">
<meta charset="UTF-8">
<head>
  
	<title>Transformacion</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" media="screen" title="no title">
	<link rel="stylesheet" href="css/estilos.css" media="screen" title="no title">
	<link rel="stylesheet" href="table.css" media="screen" title="no title">
	<style>
  .navbar-nav.navbar-center {
    position: absolute;
    left: 38%;  
}
.myicon {
    width: 50px;
    height: 50px;
}
.etl2{
  content:center; 
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 1000px;
  height: 120px;
  margin-left: -500px;
  margin-top: -300px;
}
.etl3{
  content:center; 
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 1000px;
  height: 120px;
  margin-left: -550px;
  margin-top: -300px;
}
.etl_t{
  content:center; 
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 1000px;
  height: 120px;
  margin-left: -480px;
  margin-top: -300px;
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #343a40;
   color: white;
   text-align: center;
}
</style>
</head>

<body style="margin:0;">
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

    <nav style="background-color: black;" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">ETL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav navbar-center">
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img title="Salud" class="myicon" src="img/hospital.png">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="hospitales.php">Hospitales</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img title="Ecología" class="myicon" src="img/tree.png">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="cauces_agua.php">Cauces de agua</a>
          <a class="dropdown-item" href="arboles.php">Árboles</a>
          <a class="dropdown-item" href="cuerpos_agua.php">Cuerpos de agua</a>
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img title="Protección civil" class="myicon" src="img/shield.png">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="sismos.php">Sismos</a>
          <a class="dropdown-item" href="atlas.php">Atlas de riesgo</a>
          <a class="dropdown-item" href="refugios.php">Refugios temporales</a>
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img title="Urbano" class="myicon" src="img/house.png">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="dropdown-item" href="vialidades.php">Vialidades</a>
         <a class="dropdown-item" href="numeros.php">Números Oficiales</a>
         <a class="dropdown-item" href="glorietas.php">Glorietas</a>
         <a class="dropdown-item" href="camellones.php">Camellones</a>
         <a class="dropdown-item" href="licencias.php">Licencias de construcción</a>
         <a class="dropdown-item" href="antenas.php">Antenas de telecomunicacón</a>
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img title="Vialidad" class="myicon" src="img/car.png">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="dropdown-item" href="paradas.php">Paradas de camión</a>
         <a class="dropdown-item" href="multas.php">Multas</a>
         <a class="dropdown-item" href="rutas.php">Rutas de camión</a>
         <a class="dropdown-item" href="semaforos.php">Semáforos</a>
         <a class="dropdown-item" href="topes.php">Topes</a>
         <a class="dropdown-item" href="accidentes.php">Accidentes</a>
        </div>
      </li>
    </ul>

    
      <a style="position: absolute; right: 0;" class="btn btn-outline-info my-2 my-sm-0" href="dw.php" >Salir</a>

  </div>
</nav>