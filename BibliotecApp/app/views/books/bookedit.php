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




    <form action="<?php echo URLROOT; ?>/books/bookedit" method="POST">

            <div class="wrapper-update-user-left">

                <input type="hidden" name="idbook" value="<?php echo $data[0]['idbook'] ?>">

                <label for="title">Título</label>
                <input type="text"  name="title" value="<?php echo $data[0]['title'] ?>">   
                        
                <label for="author">Autor</label>
                <input type="text"  name="author" value="<?php echo $data[0]['author'] ?>">   
                
                
                <label for="genre">Género</label>
                <input type="text"  name="genre" value="<?php echo $data[0]['genre'] ?>">   
                

                <label for="isbn">Isbn</label>
                <input type="text"  name="isbn" value="<?php echo $data[0]['isbn'] ?>">   
            

                <label for="editorial">Editorial</label>
                <input type="text" name="editorial" value="<?php echo $data[0]['editorial'] ?>">   
            

                <label for="quantity">Cantidad</label>
                <input type="text"  name="quantity" value="<?php echo $data[0]['quantity'] ?>">   
                

                <label for="resume">Sinopsis</label><br>
                
                <textarea type="text" name="resume" rows="7" cols="50" ><?php echo $data[0]['resume'] ?></textarea>
                
             
            </div>
                
                
   
                <div class="wrapper-register-book-rigth">

                    <button id="submit" type="submit" value="update">Actualizar libro</button>
                </div>
                
    
     </form>
<br>