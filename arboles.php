<?php include 'header.php';?>

	

<?php $results = mysqli_query($db, "SELECT t.coord_x , t.coord_y, t.id, t.especie, t.ancho_m, t.alto_m, t.id_c_fisica, t.numero, t.solicito, t.autoriza, t.fecha_reso, t.reforestacion, c.c_fisica FROM tbl_arboles as t join ct_cond_fisica as c on t.id_c_fisica= c.id"); 
$resultado = $results -> num_rows;
?>
<div class="c">
<br>
<?php if ($resultado):?>

	<h3>&nbsp;&nbsp;&nbsp;Arboles&nbsp;<img data-toggle="modal" data-target="#exampleModalCenter" src="wi2.png"></h3>

	<br>
	<div>
<table  id="table" class="table">
	  <thead class="thead-dark">
		<tr class="contenedor">
			<th scope="col"><input type="checkbox" id="checkAll"></th>
			<th scope="col">Coordenada X</th>
			<th scope="col">Coordenada Y</th>
			<th scope="col">Especie </th>
			<th scope="col">Ancho</th>
            <th scope="col">Alto</th>
            <th scope="col">Condición fisica</th>
            <th scope="col">No.</th>
            <th scope="col">Solicito</th>
            <th scope="col">Autoriza</th>
            <th scope="col">Fecha de resolución</th>
            <th scope="col">Reforestación</th>
			<th scope="col"><button type="button"  class="btn btn-danger" id="delete">Eliminar</button></th>
		</tr>
	</thead>
 <tbody>
	<?php 
	while ($row = mysqli_fetch_array($results)): ?>
		<tr>
		<form method="POST" action="server.php">
            <td style="display:none;"><input type="text" name="id"  value="<?php echo $row['id'];?>"></td>
			<td title="<?php echo $row['id'];?>   "><input class="checkbox" type="checkbox" id="<?php echo $row['id'] ?>" name="id1[]"></td>
			<td><?php echo $row['coord_x']; ?><input style="display:none;" type="text" name="coord_x" value="<?php echo $row['coord_x'];?>"></td>
			<td><?php echo $row['coord_y']; ?><input style="display:none;" type="text" name="coord_y" value="<?php echo $row['coord_y'];?>"></td>
			 <?php  $des=$row['especie']; if (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$des")&&$des!=null):?>
            <td><?php echo $row['especie'];?><input style="display:none;" type="text" name="especie" value="<?php echo $row['especie'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="especie" pattern="([áéíóúña-z0-9\s]*[/]*[,]*[.]*[(]*[)]*)*"  title="Solo texto" value="<?php echo $row['especie'];?>" required></td>
            <?php endif  ?>	
		    <?php $ancho_m=$row['ancho_m']; if (filter_var($ancho_m, FILTER_VALIDATE_FLOAT) && $ancho_m >= 0 || $ancho_m ==0 && $ancho_m != ""):?>
            <td><?php echo $row['ancho_m'];?><input style="display:none;" type="text" name="ancho_m" value="<?php echo $row['ancho_m'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="ancho_m"  pattern="0?\d+(.\d)*?" title="Solo numeros positivos"  value="<?php echo $row['ancho_m'];?>" required></td>
            <?php endif  ?>	
             <?php $alto_m=$row['alto_m']; if ((filter_var($alto_m, FILTER_VALIDATE_FLOAT)) && $alto_m >= 0 || $alto_m==0 && $alto_m != ""):?>
            <td><?php echo $row['alto_m'];?><input style="display:none;" type="text" name="alto_m" value="<?php echo $row['alto_m'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="alto_m"  pattern="0?\d+(.\d)*?" title="Solo numeros positivos"  value="<?php echo $row['alto_m'];?>" required></td>
            <?php endif  ?>	
           	<td><?php echo $row['c_fisica']; ?><input style="display:none;" type="text" name="c_fisica" value="<?php echo $row['c_fisica'];?>"></td>
            <?php $numero=$row['numero']; if(preg_match('/^[0-9]/',"$numero") ):?>
            <td><?php echo $row['numero'];?><input style="display:none;" type="text" name="numero" value="<?php echo $row['numero'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="numero" pattern="[0-9]*?" title="Solo numeros positivos"  value="<?php echo $row['numero'];?>" required></td>
            <?php endif  ?>	
            <?php  $des=$row['solicito']; if (preg_match('/^([áéíóúña-z0-9\s]*[\/]*[,]*[.]*[(]*[)]*)*+$/',"$des")&&$des!=null):?>
            <td><?php echo $row['solicito'];?><input style="display:none;" type="text" name="solicito" value="<?php echo $row['solicito'];?>"></td>	
            <?php else: ?>
                <td><input style="text-align:center; color:black; background-color:#EE9A9A;" class="form-control" type="text" name="solicito" pattern="([áéíóúña-z0-9\s]*[/]*[,]*[.]*[(]*[)]*)*"  title="Solo texto" value="<?php echo $row['solicito'];?>" required></td>
            <?php endif  ?>	  
            <?php  $des=$row['autoriza']; if ($des=="si" || $des =="no"):?>
            <td><?php echo $row['autoriza'];?><input style="display:none;" type="text" name="autoriza" value="<?php echo $row['autoriza'];?>"></td>	
            <?php else: ?>
                <td> <div class="form-group">
                        <label for="sn2"></label>
                        <select class="" name="autoriza">
                            <option>no</option>
                            <option>si</option>
                        </select>
                        <br>
                      </div></td>
            <?php endif  ?>	
              <?php   if (preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$row['fecha_reso'])&&$row['fecha_reso'] != "1970-01-01"): ?>
               <td><?php  echo date("d-m-Y", strtotime($row['fecha_reso']));?><input style="display:none;" type="text" name="fecha_reso" value="<?php $row['fecha_reso']; ?>"></td>
            <?php else: ?>
                <td><input style="text-align:center;"  id="datefield" type="date" name="fecha_reso" required></td>
            <?php endif  ?>	  
			
            <?php  $des=$row['reforestacion']; if ($des=="si" || $des =="no"):?>
            <td><?php echo $row['reforestacion'];?><input style="display:none;" type="text" name="reforestacion" value="<?php echo $row['reforestacion'];?>"></td>	
            <?php else: ?>
                <td> <div class="form-group">
                        <label for="sn2"></label>
                        <select class="" name="reforestacion">
                            <option>no</option>
                            <option>si</option>
                        </select>
                        <br>
                     </div></td>
            <?php endif  ?>	
            <td><button type="submit" name="arboles" class="btn btn-outline-warning">Actualizar</button></td>
			</form>
		</tr>
<?php endwhile ?>
 </tbody>
</table>
</div>
	<?php else: ?>
    <br>   <br>   <br>   <br>   <br>   <br>   <br>   <br> 
    	<div style=" content:center; margin-left:600px;"><h2>No se encontraron Errores</h2></div>
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
		-Solo se aceptan numeros positivos.
		<br>
		-El sistema no acepta guardar campos vacíos.
		<br>
        -Si desea hacer un registro sin tener todos los datos, coloque un 0.
        <br>
        -EL formato de fecha debe ser dd-mm-aaaa.
        <br>
        -Los campos de texto pueden contener letras, numeros, comas, puntos y simbolos divisores.
        (Las letras solo pueden ser minusculas debido a reglas de datos abiertos).
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<a href="#" class="btn1 botonF2"><span>+</span></a>
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
            data    : {'dataar' : dataArr},
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

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datefield").setAttribute("max", today);
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