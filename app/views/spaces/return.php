<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo SITENAME; ?></title>
        <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
       


</head>
<body>
    

<?php
    require APPROOT.'/views/includes/navigation.php';
?>   

<div class="header"><h3>SELECCIONA UN PRÉSTAMO</h3></div>
<div class="containertable" style="width:80%">
    

<input class="form-control" type="text" id="myInput" placeholder="Busca un préstamo" onkeyup="myFunction()">
            
  
<br>
    <div class="row align-middle">

   

        <table class="table table-bordered table-hover " id="myTable">

       
            <thead>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Libro</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Usuario</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Nombre</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Contacto</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Vencimiento</th>
            </thead>
                
                        <?php foreach($data as $prestamo) { ?>

                          
                <tr style="<?php 
                          $someDate = new \DateTime($prestamo['date_fin']);
                           $now = new \DateTime(); 
                          if($someDate->diff($now)->days < 5) { echo "background-color:#FF7D75";} else{ echo "";} ?>">
                <form action="<?php echo URLROOT; ?>/spaces/return" method="POST" onSubmit="return confirm('¿Quiere confirmar esta devolución?');">
                    
                    <td >   <?php echo $prestamo['title'] ?> </td>
                    <td>    <?php echo $prestamo['username'] ?> </td>
                    <td>    <?php echo $prestamo['name'].' '.$prestamo['surname'] ?> </td>
                    <td>    <?php echo $prestamo['email'].' // '.$prestamo['telephone'] ?> </td>
                    <td>    <?php echo $prestamo['date_fin']?> </td>
                   
                    <td>    <input type="hidden" name="idprestamo" value="<?php echo $prestamo['idprestamo']?>"><input type="hidden" name="idbook" value="<?php echo $prestamo['idbook']?>"><input type="submit" class="btn btn-success" value="Devolver"></td>
                    <td>     <a  class="btn btn-info" data-id="<?php echo $prestamo['date_fin']?>" data-toggle="modal" data-target="#exampleModal">Ampliar</a> </td>

                    

                </tr>
                </form>
                    <?php   } ?>


        </table>
         
            
        </form>

    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel" style="text-align:center;">Ampliación de préstamo</h2>
        
      </div>

      <div class="modal-body">
        <form action="<?php echo URLROOT; ?>/books/ampliar" method="POST">
         
          <div class="form-group">
           
            <input type="hidden" name="idbook" value="<?php echo $data[0]['idbook']?>">
            <label for="date_fin">Elegir nueva fecha de devolución</label>
            <input type="date" name="date_fin" value="<?php echo $data[0]['date_fin']?>" >

            
          </div>
         
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Ampliar préstamo</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>



         
<script>
function myFunction() {
    var input = document.getElementById("myInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("myTable");
    var tr = table.getElementsByTagName("tr");
    for (var i = 0; i < tr.length; i++) {
        if (tr[i].textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }      
    }
}
</script>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

