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




<div class="header"><h3>ASIGNA UN LIBRO</h3></div>

<div class="containertable"> 

    
    <input class="form-control" type="text" id="myInput" placeholder="Busca por libro / autor / editorial..." onkeyup="myFunction()">
            
 

<br>


    <div class="row align-middle">

        <table class="table table-bordered table-hover " id="myTable">
                
                        <?php foreach($data as $libro) {?>

                <tr style="<?php if ($libro['quantity']==0){ echo "background-color:#FF7D75";} else{ echo "";} ?>">
                            
                    <td >   <?php if ($libro['quantity']==0){ echo $libro['title']; } else { ?><a href="<?php echo URLROOT;?>/spaces/lendsfinal?idbook=<?php echo $libro['idbook']; ?>&user_id=<?php echo $_GET['user_id']; ?>"><?php echo $libro['title'] ?></a><?php } ?></td>
                    <td >   <?php echo $libro['author'] ?> </td>
                    <td>    <?php echo $libro['genre'] ?> </td>
                    <td>    <?php echo $libro['editorial'] ?> </td>
                    <td>    <?php echo $libro['isbn'] ?> </td>
                    <td>    <?php  echo $libro['quantity']?> </td>
                    
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



function showDiv() {
   document.getElementById('okDiv').style.display = "block";
}


</script>