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
    
    



<div class="title1"><h1><?php echo $data[0]['title'];?></h1>
    <h3 style="font-style: italic;"><?php echo $data[0]['author'];?></h3>
    <br>

    </div>

                
                <div class="detallesLibro">
                    <ul style="list-style-type:none">
                        <li style="float:left; padding:10px;"><?php echo '<b>Isbn: </b>'.$data[0]['isbn'];?></li>
                        <li style="float:left; padding:10px;"><?php echo '<b>Género: </b>'.$data[0]['genre'];?></li>
                        <li style="float:left; padding:10px;"><?php echo '<b>Editorial: </b>'.$data[0]['editorial'];?></li>
                        <li style="float:left; padding:10px;"><?php echo '<b>Disponibles: </b>'?>
                        <?php if($data[0]['quantity']=='0'){echo '<b style="color:red;">'.$data[0]['quantity'].'</b>';
                             } else{echo '<b style="color:green;">'.$data[0]['quantity'].'</b>'; };?></li>
                        
                    </ul>
                </div>
               

                    <div class="resume">
                        <p><?php echo '<p><b>Sinopsis: </b></p>'.$data[0]['resume'];?></p>
                        <b style="color:#2189bd;">  Ver Reviews  </b> <span  type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color:#2189bd;"class="glyphicon glyphicon-plus"></span>
                    </div>

                <div class="reviewsyedit">
                <?php if(isset($_SESSION['username'])){ ?>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Valorar</button>
                   <?php } ?>
                
                <?php if(isset($_SESSION['username'])){
                            if($_SESSION['type']=='admin'){ ?>
                            <a class="btn btn-danger" href="<?php echo URLROOT;?>/books/bookedit?idbook=<?php echo $data[0]['idbook']; ?>">Editar</a>
                            <?php
                        } }?>
                

                </div>
                    <div class="collapse" id="collapseExample">
                        <?php 
                                if(isset($data[0]['review'])){

                                
                                $numeroDeReviews=count($data);

                                foreach(array_slice($data, 0, $numeroDeReviews)as $libro){
                                    

                            ?>
                            <p><b><?php echo $libro['username'];?></b> escribió:</p>
                            
                            <p style="font-style: italic;"><?php echo $libro['review'];?></p>
                            <p>Valoración: <b style="color:#FC7F27;"><?php echo $data[0]['rating'];?></b> <b>/5</b></p>
                            <hr/>
                            
                            
                        <?php }?>
                        
                        <?php

                        } else{
                            ?> <p><b><?php echo "Aun no hay valoraciones sobre este libro."?></b></p> <?php
                        }
                        
                        ?></div>
                        <!-- Modal para enviar formulario con la Review y valoracion -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel" style="text-align:center;">Valora este libro</h2>
        
      </div>

      <div class="modal-body">
        <form action="<?php echo URLROOT; ?>/books/review" method="POST">
          <div class="form-group">
            <label >Puntuación:</label>
            <br>
                        <input type="radio" name="rating" id="rating1" value="1" required>
                        <label for="rating1" class="fa fa-star">1</label>
                        <input type="radio" name="rating" id="rating2" value="2" required>
                        <label for="rating2" class="fa fa-star">2</label>
                        <input type="radio" name="rating" id="rating3" value="3" required>
                        <label for="rating3" class="fa fa-star">3</label>
                        <input type="radio" name="rating" id="rating4" value="4" required>
                        <label for="rating4" class="fa fa-star">4</label>
                        <input type="radio" name="rating" id="rating5" value="5" required>
                        <label for="rating5" class="fa fa-star">5</label>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentario:</label>
            <textarea class="form-control" id="message-text" required name="review"></textarea>
            <input type="hidden" name="idbook" value="<?php echo $data[0]['idbook']?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Registrar valoración</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
                        



            







