<?php

require('admin/konekcija.php');
if($_SESSION['user']=='acmilan')
{

$data = array();
$q = "SELECT * FROM images";
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
  echo '<p class="error">U sistemu nema podataka za prikaz</p>';
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
    <link rel="stylesheet" href="style/lightbox.min.css">
    <title>Document</title>
</head>
<body>
    <style>
        #formphoto{
    width:80%;
    margin-left:auto;
   }

    #br{
      padding:5px 10px 5px 5px;
      background-color: black;
      color:white;
      font-weight:bolder;
      font-size:22px;
      border-radius:10px;
    }
    .modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

/* Hide the slides by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Caption text */
.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

img.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
                <div class="col-12 active">
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
        <div class="col-md-10">
            <?php
             echo "<img style='width:30px; height:30px; margin:20px;' src='images/galery.png'><span id='br'> $num </span>  <hr>\n";
            ?>
            <input type="text" id="myInput" onkeyup="searchimages(this.value)" class="fa fa-search" placeholder="Search for names..">
            <form id="formphoto"   name="myFormImage"  action="admin/upload.php" enctype="multipart/form-data"  onsubmit="return validacijaslika(spisakzaposlenih)"  method="POST">
 Izaberite fotografije:
  <input type="file" name="files[]" id="fileToUpload" multiple>
  <input class="btn btn-primary" type="submit"  name="submit" value="Dodaj Fotografiju">
</form>
<hr>
            <div class="row homeca">
            
           </div>
        </div>
        </div>
    </div>

    <div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext"></div>
      <img src="img1_wide.jpg" style="width:100%">
    </div>
  </div>

    <script src="js/funckije.js"></script>
    <script>
  spisakzaposlenih=[];
   
  let destination = <?php echo json_encode($data) ?>;
  let html = document.querySelector('.homeca');
  for(let i of destination)
  {
    spisakzaposlenih.push(i);
  }
  for(let i of spisakzaposlenih)
  {

    
    html.innerHTML+=`
    <div class="col-md-3 mt-4">
    <div class="card"">
    <a class="example-image-link" href="uploads/${i['file_name']}" data-lightbox="example-2" data-title="Optional caption."><img style="width:100%; height:150px;" class="example-image" src="uploads/${i['file_name']}" alt="image-${i}"></a>
  <p class="text-center">${i['file_name']}</p>
  </div>
  </div>
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

  // Open the Modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

 
console.log(spisakzaposlenih);
</script>
<script src="js/lightbox-plus-jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
