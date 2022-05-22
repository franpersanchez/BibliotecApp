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
<body style="background-color:#cee6f2">
    <?php 
require APPROOT.'/views/includes/navigation.php';
?>   

<div style="background-color:#cee6f2" >
<div class="containertable"> 


                    
                <br>

            <div class="row align-middle">


                <div class="messagePost">

                <div><h2><b><?php echo $data[0]['titular'];?></b></h2></div>
                <span class="boton-theme"><?php echo $data[0]['theme'];?></span>
                <div style="font-size:12px; margin-bottom:2%">Escrito por: <?php echo $data[0]['username'];?></div>
                <div><?php echo '<h4>'.$data[0]['mensaje_foro'].'</h4>';?></div>
                <br>
               <?php if(isset($_SESSION['username'])){ ?> 
                
                <div><form action="<?php echo URLROOT; ?>/spaces/post" method="POST"><button class="btn btn-info btn-mg" type="submit" name="like" value="<?php echo $_GET['forum_id'] ?>"><span class="glyphicon glyphicon-thumbs-up"></span></button></form></div>
                <br>
                <a style="cursor:pointer; width:80x; display:inline; float:left; margin-left:10px" data-id="" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus" ></span> Responder </a>
                
                
                
                <?php }else{
                 ?><span style="color:blue">Haz <a href="<?php echo URLROOT; ?>/users/login" style="cursor:pointer">log in</a> para responder a este post</span> <?php } ?>
               
            </div>
            
                        
                                <?php foreach($data as $post) {
                                    if(isset($post['post_id'])){ ?>

                                        <div class="message-general-post" >
                                        <div style="font-size:12px">Escrito por: <?php echo $post['username'];?> el <?php echo $post['fecha'];?>  </div>
                                        <div class="message-titular" > <?php echo '<h4>'.$post['mensaje'].'</h4>'; ?></div> 
                                            
                                            
                                           
                                               
                                                <div class="message-details-abajo">
                                                    <ul>
                                                        
                                                        <li style="background-color: orange; border-radius: 10px;"><?php echo $post['theme'];?></li>
            
                                                    </ul>
                                                </div>
                                                </div>
                                        <?php   } 

                                    }?>
                          
                            

              
                
            </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel" style="text-align:center;">Responder al post</h2>
        
      </div>

      <div class="modal-body">
          <div style="">
          <form action="<?php echo URLROOT; ?>/spaces/post" method="POST">
         
         <div class="form-group">
          
           <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
           <input type="hidden" name="forum_id" value="<?php echo $data[0]['forum_id']?>">

           

          <label style="display:block"for="mensaje">Respuesta</label>
          <textarea name="mensaje" id="" cols="30" rows="10"></textarea>

          </div>
        

            
          </div>
         
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" name="responder">Responder</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</body>
         