<?php include 'header.php';?>

	

<?php 
     $results = mysqli_query($db, "SELECT * FROM tbl_sismo_2003"); 
    ?>
<div class="etl2">

<?php if ($results!=null):?>

	<h3>&nbsp;&nbsp;Sismos&nbsp;<img data-toggle="modal" data-target="#exampleModalCenter" src="wi2.png"></h3>


	<br>
	<div>
<table  id="table" class="table">
	  <thead class="thead-dark">
		<tr class="contenedor">
			<th scope="col"><input type="checkbox" id="checkAll"></th>
			<th scope="col">Coordenada X</th>
			<th scope="col">Coordenada Y</th>
			<th scope="col">Num. Oficial</th>
			<th scope="col">Clasificación</th>
			<th scope="col"><button type="button" class="btn btn-danger" id="delete">Eliminar</button></th>
		</tr>
	</thead>
 <tbody>
	<?php 
	while ($row = mysqli_fetch_array($results)): ?>
		<tr>
		<form method="POST" action="server.php">
			<td><input class="checkbox" type="checkbox" id="<?php echo $row['id'] ?>" name="id1[]"></td>
			<td><?php echo $row['coord_x']; ?><input style="display:none;" type="text" name="coord_x" value="<?php echo $row['coord_x'];?>"></td>
			<td><?php echo $row['coord_y']; ?><input style="display:none;" type="text" name="coord_y" value="<?php echo $row['coord_y'];?>"></td>
			<td><?php echo $row['num_oficial'];?><input style="display:none;" type="text" name="num_oficial" value="<?php echo $row['num_oficial'];?>"></td>	
            <td><?php echo $row['clasificacion'];?><input style="display:none;" type="text" name="sismo" value="<?php echo $row['clasificacion'];?>"></td>	
			<td  style="display:none;"><input type="text" name="id" value="<?php echo $row['id'];?>"></td>
			<td><button type="submit" class="btn btn-outline-warning">Actualizar</button>					
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
		-Solo se aceptan numeros positivos.
		<br>
		-El sistema no acepta guardar campos vacíos.
		<br>
        -Si desea hacer un registro sin tener todos los datos, coloque un 0.
        <br>
        -EL formato de fecha debe ser dd-mm-aaaa.
        <br>
        -El formato de hora deve ser hh:mm. (ejemplo: 20:08)
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
            data    : {'datas' : dataArr},
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
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();   
    });
    </script>
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