<?php

require('admin/konekcija.php');
if($_SESSION['user']=='acmilan')
{
$data = array();
$q = "SELECT * FROM users";
$r = @mysqli_query($dbc, $q); //Izvrsavanje upita
// Brojanje prikazanih redova:
$num = mysqli_num_rows($r);

if ($num > 0) { // Ako je rezultat upita broj redova  veci od nula
  // Štampaj Broj destinacija:
 
   /* echo "<div class='container'>";
    echo "<div class='row'>";
*/
  // Prolazak kroz redove zapisa rezultata upita:
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      $data[]=$row;
    /*    echo '<div class="card" style="width: 16rem;">
        
         <div id="'.$row['id'].'" class="card-body">
          <h5 class="card-title">'.$row['country'].'<br>'.$row['city'].' - '.$row['price'].'€</h5>
          <p class="card-text">'.$row['description'].'</p>
          <p>'.$row['date'].'</p>
          <button name="btnobrisi" onclick="obrisi('.$row['id'].')">Obrisi</button>
          </div>
      </div>';*/
  }
  mysqli_free_result ($r); // Oslobadjanje resursa zauzetih od strane upita.
}
} 
elseif($_SESSION['user'])
{
  header("Location:indexuser.php");
}
else { // Ako nema zapisa za prikaz.

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
<style>
    #br{
      padding:5px 10px 5px 5px;
      background-color: black;
      color:white;
      font-weight:bolder;
      font-size:22px;
      border-radius:10px;
    }
  </style>
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
                <div class="col-12">
                  <div style="text-align:center;" onmouseover="showhome()" onmouseleave="hidehome()">
                    <label class="labeldash"   for=""><a id="ahome" href="lazna.php"><img id="homeimg" src="images/home.png" alt=""></a></label> 
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
                <div class="col-12 active">
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
        <div class="col-md-10">
            <?php
             echo "<img style='width:30px; height:30px; margin:20px;' src='images/user.png'><span id='br'> $num </span> <hr>\n";
            ?>
            <input type="text" id="myInput" onkeyup="searchusers(this.value)" placeholder="Search for names..">

           <div class="row homeca">
          <form style="width:100%;" action="admin/adminuserdelete.php" method="POST">
           <table class="table">
  <thead class="thead-dark">
    <tr>
    <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col"></th>
    </tr>
    <tbody>
    </tbody>
  </thead>
  
<table>
           </div>
        </div>
        </div>
    </div>

    <script src="js/funckije.js"></script>
    <script>
  spisakzaposlenih=[];
  let destination = <?php echo json_encode($data) ?>;
  let html = document.querySelector('tbody');
  for(let i of destination)
  {
    spisakzaposlenih.push(i);
  }
  for(let i=0;i<spisakzaposlenih.length;i++)
  {
    html.innerHTML+=`
    
 
    <tr>
      <th scope="row">${i+1}</th>
      <td>${spisakzaposlenih[i]['name']}</td>
      <td>${spisakzaposlenih[i]['email']}</td>
      <td>${spisakzaposlenih[i]['phone']}</td>
      <td> <input name="delete" type="submit"  class="btn btn-primary" value="Obrisi"></td>
    </tr>
    <input type="hidden" name="id_to_delete" value="${spisakzaposlenih[i]['id']}">
   </form>
    `
    
   
  }
  
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
<script src="../js/funckije.js" ></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
