<?php

require('admin/konekcija.php');
$data = array();
$q = "SELECT *
FROM orders
INNER JOIN destination ON orders.iddestination = destination.id;";
$r = @mysqli_query($dbc, $q); //Izvrsavanje upita
// Brojanje prikazanih redova:
$num = mysqli_num_rows($r);

if ($num > 0) { // Ako je rezultat upita broj redova  veci od nula

  // Štampaj Broj destinacija:
  echo "<p>Broj destinacija: $num </p>\n";

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


 
} else { // Ako nema zapisa za prikaz.
  echo '<p class="error">U sistemu nema podataka za prikaz</p>';
}


?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
  span img{
    width:15px;
    height:15px;
  }
</style>
<body> 
  <div class="container">
    <div id="prikaz" class="row">
</div>
  </div>
  <script>
  spisakzaposlenih=[];
  let destination = <?php echo json_encode($data) ?>;
  let html = document.querySelector('#prikaz');
  for(let i of destination)
  {
    spisakzaposlenih.push(i);
  }
  for(let i of spisakzaposlenih)
  {
    html.innerHTML+=`
    
    <div class="card" style="width: 14rem;">
  <img src="../uploads/${i['city']}.jpg" class="card-img-top" alt="...">
  <div class="card-body">
  <form action="snimi.php" method="POST">
    <h5 class="card-title">${i['country']}</h5>
    <h4 class="card-title">${i['city']} - ${i['price']}€</h5>
    <p class="card-text">${i['description']}</p>
    
   
    <button class="btn btn-primary" onclick="izmeni(${i['id']},this)">Izmeni</button>
    <input name="delete" type="submit"  class="btn btn-primary" value="Obrisi">
    <p style="font-size:12px;">${i['date']}</p>
    <input type="hidden" name="id_to_delete" value="${i['id']}">
      </form>
      <form action="../prikaz.php" method="POST">
      <input type="hidden" name="id" value="${i['id']}">
      <input name="btn2" type="submit"  class="btn btn-primary" value="Prikazi2">
      </form>
     
      <button id="myBtn">Prikazi vise</button>
      </div>
  </div>
      <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="card" style="width: 100%;">
  

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../uploads/${i['city']}slider1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../uploads/${i['city']}slider2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../uploads/${i['city']}slider3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


  <div class="card-body">
  <div class="row">
  <div class="col-md-4">
    <h5 class="card-title">${i['country']}</h5>
    <h4 class="card-title">${i['city']} - ${i['price']}</h5>
    <p class="card-text">${i['description']}</p>
    </div>
    <div class="col-md-4">
    <span> 
    
                <label for="">Prevoz </label> ${i['transport']}  <br>
                <label for="">Osiguranje</label>  <img src="../images/${i['insurance']}.png">
                <label for="">Transport(Aerodrom)</label>  <img src="../images/${i['airporttransport']}.png"> <br>
                <label for="">Smestaj</label>  - ${i['apartmans']} <br>
                <label for="">Ime smestaja:</label>  ${i['nameapartamns']} <br>
                <label for="">Hrana</label>  ${i['food']} <br>
    </span>
    </div>
    <div class="col-md-4">
    <span>
                <label for="">Restoran</label> <img src="../images/${i['restaurant']}.png"> <br>
                <label for="">Wifi</label> <img src="../images/${i['wifi']}.png"> <br>
                <label for="">Parking</label>  <img src="../images/${i['parking']}.png"> <br>
                <label for="">Pogled na plazu</label> <img src="../images/${i['view']}.png"> <br>    
    </span>
                </div>
                </div>
               
   
   
    <p style="font-size:12px;">${i['date']}</p>
    
      
      
      
  </div>
  </div>

</div>
    `
    
   
  }
  console.log(spisakzaposlenih)

  var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



</script>
<script src="../js/funckije.js" ></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
