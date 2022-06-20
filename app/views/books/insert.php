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
       


</head>
<body>



     <?php
    require APPROOT.'/views/includes/navigation.php';
    ?>   


<div class="wrapper-register-book">

                          
        <form action="<?php echo URLROOT; ?>/books/insert" method="POST">
                
                <div class="wrapper-register-book-left">

                        <label for="title" >Título</label>
                        <input type="text" id="title" name="title" ></input>   
                        <span class="invalidFeedback">
                            <?php echo $data['entryErrorTitle'];?>
                        </span>
                        
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn">   
                        <span class="invalidFeedback">
                            <?php echo $data['entryErrorIsbn'];?>
                        </span>


                        <label for="genre">Género</label>
                        <select id="genre" name="genre" >
                                    <option value="Fantasía">Fantasía</option>
                                    <option value="Ciencia ficción">Ciencia ficción</option>
                                    <option value="Novela negra">Novela negra</option>
                                    <option value="Novela histórica">Novela histórica</option>
                                    <option value="Novela histórica">Novela</option>
                                    <option value="Ensayo">Ensayo</option>
                                    <option value="Infantil">Infantil</option>
                                    <option value="Romántica">Romántica</option>
                                    <option value="Poesía">Poesía</option>
                                    </select>
                        
                        <span class="invalidFeedback">
                            <?php echo $data['entryErrorGenre'];?>
                            
                            </span>
                        <label for="editorial">Editorial</label>
                        <input type="text" id="editorial" name="editorial">
                        <span class="invalidFeedback">
                            <?php echo $data['entryErrorEditorial'];?>
                        </span>

                        

                        <label for="author">Autor/es</label>
                        <input type="text" id="author" name="author">
                        <span class="invalidFeedback">
                            <?php echo $data['entryErrorAuthor'];?>
                        </span>

                    

                        <label for="quantity">Nº de libros</label>
                        <input type="text" id="quantity" name="quantity">
                        <span class="invalidFeedback">
                            <?php echo $data['entryErrorQuantity'];?>
                        </span>

                        <label for="resume">Sinopsis</label>
                    <textarea type="text" id="resume" name="resume" cols="10" rows="10"></textarea>
                    <span class="invalidFeedback">
                        <?php echo $data['entryErrorResume'];?>
                    </span>


                </div>
                

                <div class="wrapper-register-book-rigth">
                    
                <button id="submit" type="submit" value="submit">Registrar libro</button>
                <br>
                <br>

                <?php if ($data['confirmation']=="Libro registrado correctamente."){
                ?>
                    <span class="confirmation">
                    <?php echo $data['confirmation'];
                    
                    ?> 
                    <br>
                    
                    <a href="<?php echo URLROOT;?>/books/insert"><div class="button">Insertar nuevo libro</div></a>

                    
                    
                        </span>
                <?php
            }
                ?>

                </div>

               

                
                
                

                
            </form>
    
</div>

<!-- PReviene que se vuelvan a enviar datos al refrescar la página -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
   


<br>