
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
<script type="text/javascript">
  function uno(){
        $archivo='uno.php';

         document.getElementById('go_api').style.display='none'; 
         document.getElementById('prueba').style.display='block';

         $("body").waitMe({
                        effect: 'timer',
                        text: 'Procesando información.',
                        bg: 'rgba(64,64,64,0.9)',
                        color: '#fff',
                        maxSize: '',
                        source: '../js/waitMe/img.svg',
                        textPos: 'vertical',
                        fontSize: '25px',
                        onClose: function() {}
                    }); setTimeout(function(){
                        $("body").waitMe('hide');
                    },40000);
         
    $("#go_api").load($archivo, function(){
    
       //  $("body").waitMe('hide');  
         
         
        })
     // alert("uno");
      }
  
  function tres(){
        $archivo='tres.php';

         document.getElementById('go_api').style.display='none'; 
         document.getElementById('prueba').style.display='block';

         $("body").waitMe({
                        effect: 'timer',
                        text: 'Procesando información.',
                        bg: 'rgba(64,64,64,0.9)',
                        color: '#fff',
                        maxSize: '',
                        source: '../js/waitMe/img.svg',
                        textPos: 'vertical',
                        fontSize: '25px',
                        onClose: function() {}
                    });setTimeout(function(){
                        $("body").waitMe('hide');
                    },40000);
         
    $("#go_api").load($archivo, function(){
    
         //$("body").waitMe('hide');  
         
         
        })
     //alert("tres");
      }

       function cuatro(){
        $archivo='cuatro.php';

         document.getElementById('go_api').style.display='none'; 
         document.getElementById('prueba').style.display='block';

         $("body").waitMe({
                        effect: 'timer',
                        text: 'Procesando información.',
                        bg: 'rgba(64,64,64,0.9)',
                        color: '#fff',
                        maxSize: '',
                        source: '../js/waitMe/img.svg',
                        textPos: 'vertical',
                        fontSize: '25px',
                        onClose: function() {}
                    });setTimeout(function(){
                        $("body").waitMe('hide');
                    },40000);
         
    $("#go_api").load($archivo, function(){
    
      //   $("body").waitMe('hide');  
         
         
        })
   //  alert("cuatro");
      }

      function cinco(){
        $archivo='cinco.php';

         document.getElementById('go_api').style.display='none'; 
         document.getElementById('prueba').style.display='block';

         $("body").waitMe({
                        effect: 'timer',
                        text: 'Procesando información.',
                        bg: 'rgba(64,64,64,0.9)',
                        color: '#fff',
                        maxSize: '',
                        source: '../js/waitMe/img.svg',
                        textPos: 'vertical',
                        fontSize: '25px',
                        onClose: function() {}
                    });setTimeout(function(){
                        $("body").waitMe('hide');
                    },40000);
         
    $("#go_api").load($archivo, function(){
    
       //  $("body").waitMe('hide');  
         
         
        })
    // alert("cinco");
      }
  
</script>
<script>

    function dos(){
      
        $archivo='dos.php';
             
       
         document.getElementById('go_api').style.display='none'; 
         document.getElementById('prueba').style.display='block';
       
         $("body").waitMe({
                        effect: 'timer',
                        text: 'Procesando información.',
                        bg: 'rgba(64,64,64,0.9)',
                        color: '#fff',
                        maxSize: '',
                        source: '../js/waitMe/img.svg',
                        textPos: 'vertical',
                        fontSize: '25px',
                        onClose: function() {}
                    });setTimeout(function(){
                        $("body").waitMe('hide');
                    },40000);
         
    $("#go_api").load($archivo, function(){ 
        // $("body").waitMe('hide');  
         
        })
     // alert("dos");
      }
  
</script>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
</head>
<body id="body-l" style="margin:0;" class="loading">
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

  <a class="btn btn-outline-secondary" href="../logout.php" >Salir</a>

</div>
</nav>
 
  
<center> 
<br><br><br><br><br><br>
<h4>Para iniciar el proceso de ETL seleccione el botón <h4>
  <div style="display:none;" id="prueba">
  
      <a class="btn btn-outline-info btn-lg" href="http://localhost:8080/etl/etl.php" > &nbsp;&nbsp;Continuar&nbsp;&nbsp;  </a>
   
    
  </div>
<div class="etl">
<a class="btn btn-outline-info btn-lg" id="go_api"  onclick="uno(); dos(); tres(); cuatro(); cinco();" > &nbsp;&nbsp;ETL&nbsp;&nbsp;  </a>
</div>

</center>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="../js/jquery-3.3.1.js"></script>
  <script src="../js/waitMe/waitMe.js"></script>
 <script src="../js/sqload/jquery-loader.js"></script>


</body>

</html>

