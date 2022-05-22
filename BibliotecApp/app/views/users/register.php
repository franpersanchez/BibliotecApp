<?php
require APPROOT . '/views/includes/head.php';
?>


     <?php
    require APPROOT.'/views/includes/navigation.php';
    ?>   


<div class="container-register">
<h2>Regístrate</h2>
    <div class="wrapper-login">
       

        <form action="<?php echo URLROOT; ?>/users/register" method="POST">

        <label for="username">Nombre de usuario</label>
        <input type="text" id="username" name="username">   
        <span class="invalidFeedback">
            <?php echo $data['usernameError'];?>
        </span>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email">   
        <span class="invalidFeedback">
            <?php echo $data['emailError'];?>
        </span>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password1">
        <span class="invalidFeedback">
            <?php echo $data['passwordError'];?>
        </span>

        <label for="password2">Confirme la contraseña</label>
        <input type="password" id="password2" name="password2">
        <span class="invalidFeedback">
            <?php echo $data['confirmPasswordError'];?>
        </span>

        <label for="name">Nombre</label>
        <input type="text" id="name" name="name">   
        

        <label for="surname">Apellidos</label>
        <input type="text" id="surname" name="surname">   
       

        <label for="residence">Domicilio</label>
        <input type="text" id="residence" name="residence">   
       

        <label for="telephone">Teléfono</label>
        <input type="text" id="telephone" name="telephone">   
        

        <label for="date">Fecha de nacimiento</label><br>
        <input type="date" name="date" >
        
        <button id="submit" type="submit" value="submit">Registrar</button>
    
        <p class="options">¿Ya estás registrado? <a href="<?php echo URLROOT;?>/users/login"> Entra aquí </a></p>
        <br>
        <br>
    
    </form>
    </div>

</div>