<?php include 'header.php';?>

<?php $results = mysqli_query($db, "SELECT * FROM tbl_cauces_de_agua ");
$resultado = $results -> num_rows;
?>
<div class="etl1">
<?php if  ($resultado):?>
	<h3>Cauces de agua    <img data-toggle="modal" data-target="#exampleModalCenter" src="wi2.png"></h3>
	<br>
	<div>
<table id="table" class="table">
	  <thead class="thead-dark">
		<tr class="contenedor">
			<th scope="col"><input type="checkbox" id="checkAll1"></th>
			<th scope="col">Coordenada X</th>
			<th scope="col">Coordenada Y</th>
			<th scope="col">Nombre</th>
			<th scope="col"><button type="button" class="btn btn-danger" id="delete1">Eliminar</button></th>
		</tr>
	</thead>
 <tbody>
	<?php 
	while ($row = mysqli_fetch_array($results)) { 
		?>
		<tr>
		<form method="POST" action="server.php">
			<td title="<?php echo $row['id'] ?>"><input class="checkbox" type="checkbox" id="<?php echo $row['id'] ?>" name="id[]"></td>
			<td><?php echo $row['coord_x'];?><input style="display:none;" type="text" name="coord_x" value="<?php echo $row['coord_x'];?>"></td>
			<td><?php echo $row['coord_y'];?><input style="display:none;" type="text" name="coord_y" value="<?php echo $row['coord_y'];?>"></td>
			<td><input  style="color:black; background-color:#EE9A9A; text-align:center;" class="form-control" type="text" name="nombre" value="<?php echo $row['nombre'];?>" pattern="([áéíóúña-z0-9\s]*[/]*[,]*[.]*[(]*[)]*)*"  title="Solo texto" required></td>
			<td  style="display:none;"><input type="text" name="id" value="<?php echo $row['id'];?>"></td>
			<td><button type="submit" name="cau" class="btn btn-outline-warning">Actualizar</button>
					
			</td>
			</form>
		</tr>
<?php  } ?>
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
		-Los nombres de los Cauces de agua pueden contener letras, numeros, comas, puntos y simbolos divisores.
        (Las letras solo pueden ser minusculas debido a reglas de datos abiertos).
		<br>
		-El sistema no acepta guardar campos vacíos.
		<br>
		-Si desea hacer un registro sin tener todos los datos, coloque un 0.
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
	<script>
  
  $(document).ready(function(){
      $('#checkAll1').click(function(){
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


    $('#delete1').click(function(){
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
            data    : {'data1' : dataArr},
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