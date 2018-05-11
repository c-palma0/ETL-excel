<?php include 'header.php';?>
 
  <div class="card text-center">
      
  <div class="card-body"> 
   <?php  if (isset($_SESSION['username'])) : ?>
    	<h3>Bienvenido: <strong><?php echo $_SESSION['name']; ?></strong></h3>
    <?php endif ?>

  <br>
    <h5 class="card-title"></h5>
  
    
    <p class="card-text">La etapa de extracción fue exitosa , los registros han sido enviados al Data Warehouse.</p>
    <p class="card-text">En la parte superior se encuentran las capas que muestran los errores encontrados en cada una de ellas.</p>
     <p class="card-text">Tipos de validaciones: </p>
     <div class="col-md-12 center-block">
     <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <ul style="text-align: justify;">
        <li>Números positivos.</li>
        <li>Caracteres permitidos.</li>
        <li>Fecha.</li>
        <li>Hora.</li>
        <li>Palabras recurrentes analizadas previamente.</li>
         </ul>
        </div>
        <div class="col-md-4"></div>
       </div>
      </div>
     
  </div>
  <br>

  <div class="container">
      <div class="row">
        <div class="col-md-4">
        <ul style="color:red; text-align: justify; ">
            <p>Hospitales: <?php $results = mysqli_query($db, "SELECT * FROM tbl_hospital");
              $h = $results -> num_rows;
              echo $h;?></p>
            <p>Cauces de agua: <?php $results = mysqli_query($db, "SELECT * FROM tbl_cauces_de_agua");
              $c = $results -> num_rows;
              echo $c;?></p>
            <p>Árboles: <?php $results = mysqli_query($db, "SELECT * FROM tbl_arboles");
              $a = $results -> num_rows;
              echo $a;?></p>
            <p>Cuerpos de agua: <?php $results = mysqli_query($db, "SELECT * FROM tbl_cuerpos_de_agua");
              $ca = $results -> num_rows;
              echo $ca;?></p>
            <p>Vialidades: <?php $results = mysqli_query($db, "SELECT * FROM tbl_vialidad");
              $v = $results -> num_rows;
              echo $v;?></p>
            <p>Numeros oficiales: <?php $results = mysqli_query($db, "SELECT * FROM tbl_numeros_oficiales");
              $n = $results -> num_rows;
              echo $n;?></p>
        </ul>
    </div style="color:red; text-align: justify; ">
        <div class="col-md-4 ">
         <ul style="color:red; text-align: justify; ">
            <p>Glorietas: <?php $results = mysqli_query($db, "SELECT * FROM tbl_glorietas");
              $glo = $results -> num_rows;
              echo $glo;?></p>
            <p>Camellones: <?php $results = mysqli_query($db, "SELECT * FROM tbl_camellones");
              $c = $results -> num_rows;
              echo $c;?></p>
            <p>Licencias de construcción: <?php $results = mysqli_query($db, "SELECT * FROM tbl_licencias_de_construccion");
              $a = $results -> num_rows;
              echo $a;?></p>
            <p>Antenas de telecomunicacíon: <?php $results = mysqli_query($db, "SELECT * FROM tbl_antenas_telecomunicacion");
              $ca = $results -> num_rows;
              echo $ca;?></p>
            <p>Paradas de camión: <?php $results = mysqli_query($db, "SELECT * FROM tbl_paradas_de_camion");
              $v = $results -> num_rows;
              echo $v;?></p>
            <p>Multas: <?php $results = mysqli_query($db, "SELECT * FROM tbl_multas");
              $n = $results -> num_rows;
              echo $n;?></p>
        </ul>
        </div>
        <div class="col-md-4"> <ul style="color:red; text-align: justify; ">
            <p>Rutas de camión: <?php $results = mysqli_query($db, "SELECT * FROM tbl_rutas_camion");
              $h = $results -> num_rows;
              echo $h;?></p>
            <p>Semáforos: <?php $results = mysqli_query($db, "SELECT * FROM tbl_semaforos");
              $c = $results -> num_rows;
              echo $c;?></p>
            <p>Topes: <?php $results = mysqli_query($db, "SELECT * FROM tbl_topes");
              $a = $results -> num_rows;
              echo $a;?></p>
            <p>Accidentes: <?php $results = mysqli_query($db, "SELECT * FROM tbl_accidentes");
              $ca = $results -> num_rows;
              echo $ca;?></p>
            <p>Sismos: <?php $results = mysqli_query($db, "SELECT * FROM tbl_sismo_2003");
              $v = $results -> num_rows;
              echo $v;?></p>
            <p>Atlas de riesgo: <?php $results = mysqli_query($db, "SELECT * FROM tbl_atlas_de_riesgo");
              $n = $results -> num_rows;
              echo $n;?></p>
        </ul></div>
      </div>
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