
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

</head>
<body id="body-l" style="margin:0;" class="loading">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
<div class="collapse navbar-collapse " id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
    <a class="nav-link" >
     <?php  if (isset($_SESSION['name'])) : ?>
    	<p>Usuario:<strong><?php echo $_SESSION['name']; ?></strong></p>

    <?php endif ?>
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" >
      <?php  if (isset($_SESSION['email'])) : ?>
    	<p>Correo <strong><?php echo $_SESSION['email']; ?></strong></p>
    
    <?php endif ?>
    </a>
    </li>
  </ul> 

  <a class="btn btn-outline-secondary" href="logout" >Salir</a>
 
</div>
</nav>
 
  
<center> 
<br><br><br><br><br><br>
<h4>Para iniciar el proceso de ETL seleccione el botón <h4>
<div class="etl">
<a class="btn btn-outline-info btn-lg" id="go"  href="#"> &nbsp;&nbsp;ETL&nbsp;&nbsp;  </a>
</div>
</center>




</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="../js/jquery-3.3.1.js"></script>
  <script src="../js/waitMe/waitMe.js"></script>
  <script src="../js/go.js"></script>
 <script src="../js/sp.js"></script>
 <script src="../js/sqload/jquery-loader.js"></script>
</html>

