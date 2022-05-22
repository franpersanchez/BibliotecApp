<?php
require APPROOT . '/views/includes/head.php';
?>
 <?php
    
require APPROOT.'/views/includes/navigation.php';
?>   

<div class="container-login">
<h2>Inicia sesión</h2>
    <div class="wrapper-login">
       

        <form action="<?php echo URLROOT; ?>/users/login" method="POST">

        <label for="username">Nombre de usuario</label><br>
        <input type="text" id="username" name="username">   
        <span class="invalidFeedback">
            <?php echo $data['usernameError'];?>
        </span>
        

        <label for="password1">Contraseña</label><br>
        <input type="password" id="password1" name="password1">
        <span class="invalidFeedback">
            <?php echo $data['passwordError'];?>
        </span>
        

        <button id="submit" type="submit" value="submit">Acceder</button>
    
        <p class="options">¿Aun no estás registrado? <a href="<?php echo URLROOT;?>/users/register"> Regístrate aquí </a></p>
    
    </form>
    </div>

</div>