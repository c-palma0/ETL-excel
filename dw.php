
<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "Debes de iniciar sesión";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: login.php");
  }
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <title>ETL</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" media="screen" title="no title">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../js/waitMe/waitMe.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salir</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
<div class="collapse navbar-collapse " id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
    <a class="nav-link" >
     <?php  if (isset($_SESSION['name'])) : ?>
    	<p>Usuario: <strong><?php echo $_SESSION['name']; ?></strong></p>

    <?php endif ?>
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" >
      <?php  if (isset($_SESSION['email'])) : ?>
    	<p>Correo: <strong><?php echo $_SESSION['email']; ?></strong></p>
    
    <?php endif ?>
    </a>
    </li>
     <li class="nav-item">
    <a class="nav-link" >
      <?php  if (isset($_SESSION['puesto'])) : ?>
    	<p>Puesto: <strong><?php echo $_SESSION['puesto']; ?></strong></p>
    
    <?php endif ?>
    </a>
    </li>
  </ul> 

</div>
</nav>
 <div class="card text-center">
   <br>   <br> <br> <br>
  <div class="card-body"> 
    <h5 class="card-title"></h5>
    <h3>ETL</h3>
    <p class="card-text">Intenta salir de la sesión, pude continuar la trasformación de los datos después o generar el Data Warehouse.</p>
    <p class="card-text">Debe tener en cuenta que una vez generado el Data Warehouse se eliminarán todos los datos de las tablas de transformación.</p>

      <br> <br> 
     &nbsp;&nbsp; &nbsp;&nbsp; <a style="position: relative; center: 50%;" class="btn btn-outline-success my-2 my-sm-0" href="logout.php" >Salir</a>
      &nbsp;&nbsp;<a style="position: relative;  center: 50%;;" class="btn btn-outline-primary my-2 my-sm-0" href="http://localhost:8080/etl/excel.php" >Data Warehouse</a>
      <br> <br> <br>

  </div>
  </div>
</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="table.js"></script>
</body>
</html>