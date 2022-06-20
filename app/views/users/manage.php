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



<div class="container">

<div class="span2 pull-right"><a href="<?php echo URLROOT;?>/users/register" class="btn btn-success">Instar Nuevo Usuario</a> </div>

<input class="form-control" type="text" id="myInput" placeholder="Buscar Usuario" onkeyup="myFunction()" style="margin-top:5%;">

    <div class="row align-middle">

    <table class="table table-hover " id="myTable">
            <thead>
                <th>Role</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Última actividad</th>
                <th></th>
                <th></th>
            </thead>
                    <?php foreach($data as $usuario) {?>
            <tr>
                <td > <?php echo $usuario['type'] ?> </td>
                <td> <?php echo $usuario['username'] ?> </td>
                <td> <?php echo $usuario['name']." ".$usuario['surname'] ?> </td>
                <td> <?php echo $usuario['email'] ?> </td>
                <td> <?php echo $usuario['last_activity'] ?> </td>
                <td>    <a href="<?php echo URLROOT;?>/users/update?user_id=<?php echo $usuario['user_id']; ?>" class="btn btn-info">Editar</a> 
                        <a href="<?php echo URLROOT;?>/users/delete?delete=<?php echo $usuario['user_id']; ?>" class="btn btn-danger">Eliminar</a> 
                    </td>

            </tr>
                 <?php   } ?>


            </table>
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















    
    </body>
