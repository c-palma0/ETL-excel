<?php include 'header.php';?>

	

<?php 
     $results = mysqli_query($db, "SELECT * FROM tbl_glorietas"); 
   $resultado = $results -> num_rows; ?>
<div class="etl2">

<?php if ($resultado):?>
  <br>
	<h3>&nbsp;&nbsp;Glorietas&nbsp;<img data-toggle="modal" data-target="#exampleModalCenter" src="wi2.png"></h3>

	<br>
	<div>
<table  id="table" class="table">
	  <thead class="thead-dark">
		<tr class="contenedor">
			<th scope="col"><input type="checkbox" id="checkAll"></th>
			<th scope="col">Coordenada X</th>
			<th scope="col">Coordenada Y</th>
			<th scope="col">Nombre</th>
			<th scope="col">Monumento</th>
			<th scope="col"><button type="button" class="btn btn-danger" id="delete">Eliminar</button></th>
		</tr>
	</thead>
 <tbody>
	<?php 
	while ($row = mysqli_fetch_array($results)): ?>
		<tr>
		<form method="POST" action="server.php">
			<td title="<?php echo $row['id'] ?>" name="id1[]"><input class="checkbox" type="checkbox" id="<?php echo $row['id'] ?>" name="id1[]"></td>
			<td><?php echo $row['coord_x']; ?><input style="display:none;" type="text" name="coord_x" value="<?php echo $row['coord_x'];?>"></td>
			<td><?php echo $row['coord_y']; ?><input style="display:none;" type="text" name="coord_y" value="<?php echo $row['coord_y'];?>"></td>
			 <?php  $des=$row['nombre']; if (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$des")&&$des!=null):?>
            <td><?php echo $row['nombre'];?><input style="display:none;" type="text" name="nombre" value="<?php echo $row['nombre'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="nombre" pattern="([áéíóúña-z0-9\s]*[/]*[,]*[.]*[(]*[)]*)*"  title="Solo texto" value="<?php echo $row['nombre'];?>" required></td>
            <?php endif  ?>	
       <?php  $des=$row['monumento']; if (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$des")&&$des!=null):?>
            <td><?php echo $row['monumento'];?><input style="display:none;" type="text" name="monumento" value="<?php echo $row['monumento'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="monumento" pattern="([áéíóúña-z0-9\s]*[/]*[,]*[.]*[(]*[)]*)*"  title="Solo texto" value="<?php echo $row['monumento'];?>" required></td>
        <?php endif  ?>	     
			<td  style="display:none;"><input type="text" name="id" value="<?php echo $row['id'];?>"></td>
			<td><button type="submit" name="glorieta" class="btn btn-outline-warning">Actualizar</button>					
			</td>
			</form>
		</tr>
<?php endwhile ?>
 </tbody>
</table>
</div>
	<?php else: ?>
    <br>   <br>   <br>   <br>   <br>   <br>   <br>   <br> 
    	<h2>No se encontraron Errores</h2>
	<?php endif ?> 

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  style="color:red;"class="modal-title" id="exampleModalLongTitle">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		 </div>
      <div class="modal-body">
	
  	-Los campos de texto pueden contener letras, numeros, comas, puntos y simbolos divisores.
        (Las letras solo pueden ser minusculas debido a reglas de datos abiertos).
		<br>
		-El sistema no acepta guardar campos vacíos.
		<br>
        -Si desea hacer un registro sin tener todos los datos, coloque un 0.
        <br>
      </div>
      <div class="modal-footer">
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
  <?php include 'scroll.php';?>
	<script>
  
  $(document).ready(function(){
      $('#checkAll').click(function(){
         if(this.checked){
             $('.checkbox').each(function(){
                this.checked = true;
             });   
         }else{
            $('.checkbox').each(function(){
                this.checked = false;
             });
         } 
      });


    $('#delete').click(function(){
       var dataArr  = new Array();
       if($('input:checkbox:checked').length > 0){
          $('input:checkbox:checked').each(function(){
              dataArr.push($(this).attr('id'));
              $(this).closest('tr').remove();
          });
          sendResponse(dataArr)
       }else{
        // alert('No record selected ');
       }

    });  


    function sendResponse(dataArr){
        $.ajax({
            type    : 'post',
            url     : 'server.php',
            data    : {'datag' : dataArr},
            success : function(response){
                      //  alert(response);
                      },
            error   : function(errResponse){
                      //alert(errResponse);
                      }                     
        });
    }

  });
    $(document).ready(function () {
            $("#table").freezeHeader();
        })
</script>
</body>
	
<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>
</html>