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




<div id="okDiv"  style="display:none;" class="alert alert-danger fade in" role="alert"> ok </div>

<div class="header"><h3>CONFIRMA EL PRÉSTAMO</h3></div>
<div class="containertable"> 

    
    <div class="row align-middle">

        <table class="table  " id="myTable">

        <form action="<?php echo URLROOT; ?>/spaces/lendsfinal" method="POST">

            <thead>
                <th>Titulo</th>
                <th>ISBN</th>
                <th>Autor</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellidos</th>
            </thead>
                
                        <?php foreach($data as $prestamo) {?>

                <tr>
                            
                    <td >       <?php echo $prestamo['title'] ?> </td>
                    <td >       <?php echo $prestamo['isbn'] ?> </td>
                    <td >       <?php echo $prestamo['author'] ?> </td>
                    <td >       <?php echo $prestamo['username'] ?> </td>
                    <td >       <?php echo $prestamo['name'] ?> </td>
                    <td >       <?php  echo $prestamo['surname']?> </td>
                    </tr>
                    <?php   } ?>
                    <tr>
                        <td><b>Numero de ejemplares</b></td>
                        <td><input type="number" name="quantity" value="1" min="1" max="<?php echo $prestamo['quantity'] ?>"></td>
                        <td><b>Fecha Préstamo</b></td>
                        <td><input type="date" name="date_ini" value="<?php echo date('Y-m-d'); ?>" required></td>
                        <td><b>Fecha devolución</b></td>
                        <td><input type="date" name="date_fin" value="<?php echo date('Y-m-d',strtotime('+30 days')); ?>" required></td>
                        
                    </tr>
         </table>

                <div class="container-btn">
                    
                    <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>"><input name="idbook" type="hidden" value="<?php echo $_GET['idbook'] ?>">
                    <input type="submit" value="CONFIRMAR" class="btn btn-success" onclick="bootstrapAlert()">

                    </form>
                    <button class="btn btn-danger"  id="cancel">CANCELAR</button></td>

                </div>

        
        
    </div>
    </div>
</div>

<script type="text/javascript">

    document.getElementById("cancel").onclick = function () {
        location.href = "<?php echo URLROOT; ?>/spaces/admin_space";
    };
</script>