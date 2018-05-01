
<?php include 'serveru.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" media="screen" title="no title">
<link rel="stylesheet" href="css/estilos.css">
<style>
body, html {
    height: 100%;
    color: white;
    overflow-x: hidden;
 
}

.bg { 
    background-image: url("fondo.jpg");
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    
}

</style>
</head>
<body>
<div class="bg"></div>
<span style="background-color:red;">
<center class="div-rl">
<div class="div-lr">
  <div class="container " >
      <div class="row" >
          <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-success" >
                  <div class="panel-heading">
                      <h4 class="panel-title">Iniciar sesión</h4>
                      <br>
                  </div>
                  <div class="panel-body">
                      <form role="form" method="post" action="login.php">
                       	<?php include('errors.php'); ?>
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Nombre" name="name" id="name" type="text"  required>
                              </div>
                        
                              <div class="form-group">
                                  <input class="form-control" placeholder="Password" name="password" id="password" type="password" required>
                              </div>
                              <button class="btn btn-lg btn-light btn-block" type="submit" name="login_user">Ingresar</button>
                          </fieldset>
                      </form>
                      <center><a style="color: black" href="register.php"><h5>Registrar</h5></a></center>
                  </div>
              </div>
          </div>
      </div>
  </div>

</date>


</center>


</span>




  </body>
</html>
