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


         

    <form action="<?php echo URLROOT; ?>/users/update" method="POST">

                <div class="wrapper-update-user-left">

                <input type="hidden" name="user_id" value="<?php echo $data['user_id'] ?>">

                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" value="<?php echo $data['username'] ?>">   
                        
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $data['email'] ?>">   
                
                
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="<?php echo $data['name'] ?>">   
                

                <label for="surname">Apellidos</label>
                <input type="text" id="surname" name="surname" value="<?php echo $data['surname'] ?>">   
            

                <label for="residence">Domicilio</label>
                <input type="text" id="residence" name="residence" value="<?php echo $data['residence'] ?>">   
            

                <label for="telephone">Teléfono</label>
                <input type="text" id="telephone" name="telephone" value="<?php echo $data['telephone'] ?>">   
                

                <label for="date">Fecha de nacimiento</label><br>
                
                <input type="text" name="date" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" value="<?php echo $data['date'] ?>">
                
                <!-- Como sería mejor poder asignar ROL?
                <label for="type">Rol</label>
                <select id="type" name="type">
                    <option value="admin">Admin</option>
                    <option value="usuario">Usuario</option>
                </select>
                -->
                </div>
                
                
   
                <div class="wrapper-register-book-rigth">

                    <button id="submit" type="submit" value="update">Actualizar datos</button>
                </div>
                
    
     </form>



    