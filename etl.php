<?php include 'header.php';?>
 
  <div class="card text-center">
   <br>   <br> <br> <br>
  <div class="card-body"> 
   <?php  if (isset($_SESSION['username'])) : ?>
    	<h3>Bienvenido: <strong><?php echo $_SESSION['name']; ?></strong></h3>
    <?php endif ?>

  <br>
    <h5 class="card-title"></h5>
      <br>
    
    <p class="card-text">La etapa de extracción fue exitosa , los registros han sido enviados al Data Warehouse.</p>
    <p class="card-text">En la parte superior se encuentran las capas que muestran los errores encontrados en cada una de ellas.</p>
     <p class="card-text">Tipos de validaciones: </p>
     <div>
     <ul style="text-align: justify;   margin-left: 690px;">
        <li>Números positivos.</li>
        <li>Caracteres permitidos.</li>
        <li>Fecha.</li>
        <li>Hora.</li>
        <li>Palabras recurrentes analizadas previamente.</li>
    </ul>

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