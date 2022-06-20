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
<?php
if(isset($_SESSION['username'])){ ?>
    <a  class="btn btn-info btn-lg" data-id="" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus"></span> Nuevo post   </a>
    <?php } ?>
    
    <div class="containertable"> 
    <h1> <b>Foro de la Biblioteca: Noticias, Avisos, Debates...</b> </h1>
    <h3> <b>Haz log in para comentar</b> </h3>
    




  

                    
                <br>

            <div class="row align-middle">

                <table class="table table-hover" id="myTable">

            
                        
                                <?php foreach($data as $post) {?>
                                    
                            <div class="message-general" onclick="window.location='<?php echo URLROOT; ?>/spaces/post?forum_id=<?php echo $post['forum_id']; ?>'">
                                <div class="message-titular" > <?php echo '<h4><b>'.$post['titular'].'</b></h4>'; ?></div> 
                                <div style="font-size:12px">Creado el: <?php echo $post['date_written'];?> por: <?php echo $post['username'];?></div>
                               
                                    <div class="message-texto">
                                            <i><?php $string2 = substr($post['mensaje_foro'], 0, 100); echo $string2.'...'; ?></i>
                                    </div>
                                    <div class="message-details-abajo">
                                        <ul>
                                            
                                        <li style="background-color: #33ccff; border-radius: 10px;"> <?php echo $post['likes'].''?> Likes</li>    
                                        <li style="background-color: orange; border-radius: 10px;"> <?php echo $post['theme'];?></li>
                                            
                                        </ul>
                                    </div>
                                    
                               
                                 
                            

                             
                        

                            </div>
                            <?php   } ?>
                            

                </table>
                
            </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel" style="text-align:center;">Crear un nuevo post</h2>
        
      </div>

      <div class="modal-body">
          <div style="">
          <form action="<?php echo URLROOT; ?>/spaces/foro" method="POST">
         
         <div class="form-group">
          
           <input type="hidden" name="date_written" value="<?php $date=date('m/d/Y'); echo $date;?>">

           <label for="titular">Título del post</label>
           <input style="width:100%" type="text" name="titular" >
           
           <label for="theme">Describe el tema</label>
            <input type="text" name="theme">

          <label style="display:block"for="mensaje_foro">Contenido del post</label>
          <textarea name="mensaje_foro" id="mensaje_foro" cols="30" rows="10"></textarea>

          </div>
        

            
          </div>
         
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Publicar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</body>



         