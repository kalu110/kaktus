<?php
  require('admin/konekcija.php');
    if(!$_SESSION['user'])
    {
        header("Location: login.php");
    }
    elseif($_SESSION['user']=='acmilan')
    {
        header('Location: lazna.html');
    }
    else{
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "Zdravo ".$_SESSION["user"]." <br> <button onclick='logoutuser()'>Odjava</button> <a href='userputovanja.php'>Putovanja</a>";
    ?>

    
<script src="js/funckije.js"></script>
<script>
    function  logoutuser(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
   document.querySelector("body").innerHTML =
   this.responseText;
 }
 }
 xhttp.open("GET","admin/destroysesion.php", true);
 xhttp.send();
 }
</script>
</body>
</html>