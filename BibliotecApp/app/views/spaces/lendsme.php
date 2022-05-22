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

<div class="header"><h3>CONSULTA TUS PRÉSTAMOS</h3></div>
<div class="containertable" style="width:80%">
    

<input class="form-control" type="text" id="myInput" placeholder="Busca un préstamo" onkeyup="myFunction()">
            
  
<br>
    <div class="row align-middle">

   

        <table class="table table-bordered table-hover " id="myTable">

       
            <thead>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Libro</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Género</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Editorial</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">ISBN</th>
                <th style="color:#116087; cursor:pointer;" onclick="sortTable(0)">Vencimiento</th>
            </thead>
                
                        <?php foreach($data as $prestamo) {?>
                          
                <tr style="<?php 
                          $someDate = new \DateTime($prestamo['date_fin']);
                           $now = new \DateTime(); 
                          if($someDate->diff($now)->days < 5) { echo "background-color:#FF7D75";} else{ echo "background-color:#BBD7E5";} ?>">
                <form action="<?php echo URLROOT; ?>/spaces/return" method="POST" onSubmit="return confirm('¿Quiere confirmar esta devolución?');">
                    
                    <td >   <?php echo $prestamo['title'] ?> </td>
                    <td>    <?php echo $prestamo['genre'] ?> </td>
                    <td>    <?php echo $prestamo['editorial']?> </td>
                    <td>    <?php echo $prestamo['isbn']?> </td>
                    <td>    <?php echo $prestamo['date_fin']?> </td>
                   
                   

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