<?php
require('admin/konekcija.php');
if($_SESSION['user']=='acmilan')
{

}
elseif($_SESSION['user'])
{
  header("Location:indexuser.php");
}
else{
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <span class="navbar-text ml-auto">
            <a href="admin/destroysesion.php" style="color:black;" type="button" class="btn btn-light">Odjava</a>
          </span>
        </div>
      </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 dashnav">
                <div class="col-12 active">
                  <div style="text-align:center;" onmouseover="showhome()" onmouseleave="hidehome()">
                    <label class="labeldash"   for=""><a id="ahome" href="lazna.html"><img id="homeimg" src="images/home.png" alt=""></a></label> 
                  </div>
                </div>
                <hr>
                <div class="col-12">
                  <div style="text-align:center;" onmouseover="showdestination()" onmouseleave="hidedestination()">
                    <label class="labeldash" for=""><a  id="adestination" href="admindestination.php"><img src="images/destination.png" alt=""></a></label>
                  </div>
                </div>
                <hr>
                <div class="col-12">
                  <div style="text-align:center;" onmouseover="showgalery()" onmouseleave="hidegalery()">
                    <label class="labeldash" for=""><a  id="agalery" href="admingalery.php"><img src="images/galery.png" alt=""></a></label>
                  </div>
                </div>
                <hr>
                <div class="col-12">
                  <div style="text-align:center;" onmouseover="showuser()" onmouseleave="hideuser()">
                    <label class="labeldash" for=""><a id="auser" href="adminuser.php"><img src="images/user.png" alt=""></a></label>
                  </div>
                </div>
                <hr>
                <div class="col-12">
                  <div style="text-align:center;" onmouseover="showorders()" onmouseleave="hideorders()">
                    <label class="labeldash" for=""><a id="aorders" href="adminorders.php"><img src="images/orders.png" alt=""></a></label>
                  </div>
                </div>
                <hr>
                <div class="col-12">
                  <div style="text-align:center;" onmouseover="showaccount()" onmouseleave="hideaccount()">
                    <label class="labeldash" for=""><a id="aaccount" href="adminaccount.php"><img src="images/account.png" alt=""></a></label>
                  </div>
                </div>
                <hr>
            </div>
        <div class="col-md-10 homeca">
            <hr>
            <div class="col-md-4"><img src="images/destination.png" alt=""> Destination </div> <hr>
            <div class="col-md-4"><img src="images/user.png" alt=""> Users </div> <hr>
            <div class="col-md-4"><img src="images/orders.png" alt=""> Orders </div> <hr>
        </div>
        </div>
    </div>

    <script src="js/funckije.js"></script>
    <script>
        function showhome(){
  document.querySelector('#ahome').innerHTML="POČETNA";
  }
  function hidehome(){
  document.querySelector('#ahome').innerHTML = '<img src="images/home.png" alt="">'
 }


  function showdestination(){
  document.querySelector('#adestination').innerHTML="DESTINACIJE";
  }
  function hidedestination(){
  document.querySelector('#adestination').innerHTML = '<img src="images/destination.png" alt="">'
  }


  function showuser(){
  document.querySelector('#auser').innerHTML="KORISNICI";
  }
  function hideuser(){
  document.querySelector('#auser').innerHTML = '<img src="images/user.png" alt="">'
  }


  function showorders(){
  document.querySelector('#aorders').innerHTML="REZERVACIJE";
  }
  function hideorders(){
  document.querySelector('#aorders').innerHTML = '<img src="images/orders.png" alt="">'
  }

    function showaccount(){
  document.querySelector('#aaccount').innerHTML="PROFIL";
  }
  function hideaccount(){
  document.querySelector('#aaccount').innerHTML = '<img src="images/account.png" alt="">'
  }

  function showgalery(){
  document.querySelector('#agalery').innerHTML="GALERIJA";
  }
  function hidegalery(){
  document.querySelector('#agalery').innerHTML = '<img src="images/galery.png" alt="">'
  }
    </script>
</body>
</html>