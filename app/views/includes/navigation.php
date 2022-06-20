<div class="navbar">
    
    <div id="left">
        
                    
        <?php
                    if(!isset($_SESSION['user_id'])) : ?>
                
               
                    <a href="<?php echo URLROOT;?>/users/login">Log In</a> 
                    
                    <?php elseif(isset($_SESSION['user_id'])) : ?>

                    <a href="<?php echo URLROOT;?>/users/logout">Log Out</a>
                            
                    <?php endif; ?>
                    
                    <?php
                    if(isset($_SESSION['user_id'])) { 
                                
                        if($_SESSION['type']=='usuario') {  ?>       

           <a href="<?php echo URLROOT;?>/spaces/user_space/">Mi espacio</a>

                        <?php } elseif ($_SESSION['type']=='admin') { ?>
                                    
            <a href="<?php echo URLROOT;?>/spaces/admin_space/"> Gestión</a>
                           <?php } ?>

                                    <?php 
                                     }
                                    else   
                                    {  ?>

                <a href="<?php echo URLROOT;?>/users/login/">Mi espacio</a> <?php } ?> 
                <a href="<?php echo URLROOT;?>/spaces/foro">Foro</a>
                <a href="<?php echo URLROOT;?>/books/catalogo">Catálogo</a>
                <a href="<?php echo URLROOT;?>/pages/index">Inicio</a>
                   
              
</div>
</div>

 
    
    

