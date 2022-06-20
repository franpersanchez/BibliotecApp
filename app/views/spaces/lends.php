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

         
<div class="header"><h3>SELECCIONA UN USUARIO</h3></div>
<div class="containertable">
    

<input class="form-control" type="text" id="myInput" placeholder="Busca un usuario" onkeyup="myFunction()">
            
  
<br>
    <div class="row align-middle">

        <table class="table table-bordered table-hover " id="myTable">
                
                        <?php foreach($data as $usuario) {?>
                <tr>
                    
                    <td >   <a href="<?php echo URLROOT;?>/spaces/lendsbook?user_id=<?php echo $usuario['user_id']; ?>"><?php echo $usuario['username'] ?></a> </td>
                    <td >   <?php echo $usuario['name'] ?> </td>
                    <td>    <?php echo $usuario['surname'] ?> </td>
                    <td>    <?php echo $usuario['email'] ?> </td>
                    

                </tr>
                    <?php   } ?>


        </table>
    </div>
</div>

         
<script>
function myFunction() {
    var input = document.getElementById("myInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("myTable");
    var tr = table.getElementsByTagName("tr");
    for (var i = 0; i < tr.length; i++) {
        if (tr[i].textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }      
    }
}
</script>
     