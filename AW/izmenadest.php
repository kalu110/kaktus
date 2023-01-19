<?php

$dodatno = array();
$dodatno = ["Parking","Wifi","Restoran","Osiguranje","Transfer","Pogled","Akcija"];
require('admin/konekcija.php');
if($_SESSION['user']=='acmilan'){
  $data = array();
   
  $idizmena =$_COOKIE['idizmena'];
  $sql = "SELECT * FROM destination WHERE destination.id = $idizmena";
  $sql2 = "SELECT * FROM images";
  $r = @mysqli_query($dbc, $sql); //Izvrsavanje upita
  $r2 = @mysqli_query($dbc, $sql2);
 

// Brojanje prikazanih redova:
while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
$data[]=$row;
}
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
$data2[]=$row;
$adds = explode("|",$row['add']);
echo '

<form id="formacpanel" name="myForm" action="admin/izmenasend.php" enctype="multipart/form-data" onsubmit="return validacija()" method="POST">
<hr>  
<div class="row">
 <div class="col-md-9">
 <div class="row">
   <div class="col-md-6">
 <input class="form-control" name="country"   value='.$row['country'].' type="text">  <br>
  <input type="date" name="datestart" value='.$row['datestart'].' id=""> - 
 <input type="date" name="dateend" value='.$row['dateend'].' id="">  
  <hr>
 <span>Izaberite nacin prevoza:</span>
 <hr>
 <input  type="radio" onclick="showtransport(1)"'; 
        if($row['transport']=='da')
        {
        echo 'checked';
         } 
 echo   '    style="width:20px;" class="ml-2"  id="transportda" name="transport" value="da">
        <label class="labeladmina"   for="da">Da</label> 
        <input   style="width:20px;" onclick="showtransport(0)"';
        if($row['transport']=='ne')
        {
        echo 'checked';
         } 
        echo' class="ml-2" type="radio" id="transportne" name="transport" value="ne">
        <label class="labeladmina"  for="ne">Ne</label> <br>
        <span id="spantransport"'; 
        if($row['transport']=='da')
        {
          echo ' style="margin: 0; padding:0; display:block"';
        } 
      else
      {
      echo' style="margin: 0; padding:0;"';
      }
      echo  '>
       <select name="transportway" id="sel" class="form-select" aria-label="Default select example">
       <option value="'.$row['transportway'].'">'.$row['transportway'].'</option>
       <option value="Avion">Avion</option>
       <option value="Autobus">Autobus</option>
       </select>
</span>
<br>
       
 </div>
 <div class="col-md-6">
 <input class="form-control" name="city" value='.$row['city'].' type="text"> <br>

              <span>Dodatno:</span>
              <hr>
             
              <div class="row">
              <div class="col-md-5">';     
                   
              for($i=0; $i<count($dodatno);$i++)
              {$bool = true;
              
              foreach($adds as $add){
               if($add == $dodatno[$i])
              {
                if($i==3)
                {
                  echo '</div><div col-md-5>';
                  echo ' <input type="checkbox" checked  name="dodatno[]" value="'.$dodatno[$i].'"> 
                  <label class="labeladmina"  for='.$dodatno[$i].'>'.$dodatno[$i].'</label>  <br>  '; 
                  $bool = false;
                  break;
                }
                else{
               echo ' <input type="checkbox" checked  name="dodatno[]" value="'.$dodatno[$i].'"> 
                <label class="labeladmina"  for='.$dodatno[$i].'>'.$dodatno[$i].'</label>  <br>  '; 
                $bool = false;
                break;
                }
              }
              }
              if($bool)
              {
                if($i==3)
                {
                  echo '</div><div col-md-5>';
                echo ' <input type="checkbox"   name="dodatno[]" value="'.$dodatno[$i].'"> 
                <label class="labeladmina"  for='.$dodatno[$i].'>'.$dodatno[$i].'</label> <br>  '; 
                }
                else{
                  echo ' <input type="checkbox"   name="dodatno[]" value="'.$dodatno[$i].'"> 
                  <label class="labeladmina"  for='.$dodatno[$i].'>'.$dodatno[$i].'</label> <br>  '; 
                }
              } 
            }
            
            
           
                     /* <input style="width:20px;"  type="checkbox"  name="dodatno[]" value="Parking"> 
                      <label class="labeladmina"  for="parking">Parking</label>  <br> 
                      <input style="width:20px;" type="checkbox"  name="dodatno[]" value="Wifi">
                      <label class="labeladmina"  for="wifi">Wi-Fi</label>  <br>
                      <input class="ml-2" style="width:20px;" type="checkbox"  id="W" name="dodatno[]" value="Restoran">
                      <label class="labeladmina"  for="restoran">Restoran</label> <br>
                      </div>
                      <div class="col-md-7" id="spanright">
                      <label class="labeladmina"  for="osiguranje">Osiguranje</label>
                     <input  style="width:20px;" type="checkbox"  name="dodatno[]" value="Osiguranje"> <br>       
                     <label class="labeladmina"  for="transport">Transfer</label>
                     <input  style="width:20px;" type="checkbox"  name="dodatno[]" value="Transfer">
                     <br>
                     <label class="labeladmina"  for="pogled">Pogled na plazu</label> 
                     <input  style="width:20px;" type="checkbox"   name="dodatno[]" value="Pogled">
                     <br>  
                     <label class="labeladmina"  for="akcija">Akcija</label> 
                     <input  style="width:20px;" type="checkbox" name="dodatno[]" value="Akcija">

                   */
                echo '     
                </div>
                </div>
 </div>
 <div class="col-md-12">
 <select name="pocetna" value="'.$row['pocetna'].'" id="sel" class="form-select" required aria-label="Default select example">
 <option value="'.$row['pocetna'].'">'.$row['pocetna'].'</option>
 
';
$string = explode("|",$row['slideri']);
foreach ($data as $value) {
       echo '<option name="pocetna" value="'.$value['file_name'].'">'.$value['file_name'].'</option>';
 }
 echo '
 
</select>

<select name="slider1" value="'.$string[0].'" id="sel" class="form-select" required aria-label="Default select example">
<option value="'.$string[0].'">'.$string[0].'</option>

';

foreach ($data as $value) {
     echo '<option name="slider1" value='.$value['file_name'].'">'.$value['file_name'].'</option>';
}
echo '

</select>
<select name="slider2" value="'.$string[1].'" id="sel" class="form-select" required aria-label="Default select example">
<option value="'.$string[1].'">'.$string[1].'</option>

';
foreach ($data as $value) {
     echo '<option name="slider2" value="'.$value['file_name'].'">'.$value['file_name'].'</option>';
}
echo '

</select>
<select name="slider3" value="'.$string[2].'" id="sel" class="form-select" required aria-label="Default select example">
<option value="'.$string[2].'">'.$string[2].'</option>

';
foreach ($data as $value) {
     echo '<option name="slider3" value="'.$value['file_name'].'">'.$value['file_name'].'</option>';
}
echo '

</select>
<select name="slider4" id="sel" value="'.$string[3].'" class="form-select" required aria-label="Default select example">
<option value="'.$string[3].'">'.$string[3].'</option>
';
foreach ($data as $value) {
     echo '<option name="slider4" value="'.$value['file_name'].'">'.$value['file_name'].'</option>';
}

echo '

</select>
<hr>
 <textarea class="form-control" name="description" style="width:100%;height:150px;" type="text">'.$row['description'].'</textarea> <br></div>
</div>
</div>
<div class="col-md-3">
 <div class="col-md-12">
 <input class="form-control" name="price" value='.$row['price'].' type="number"> <br>

<span>Smestaj:</span> 
<hr>
   <input  type="radio" onclick="show(1)"'; 
    if($row['apartmans']=='da')
    {
      echo 'checked';
    }
   echo ' style="width:20px;" class="ml-2"  id="smestajda" name="smestaj" value="da">
        <label class="labeladmina"   for="da">Da</label> 
        <input   style="width:20px;" '; 
        if($row['apartmans']=='ne')
        {
          echo 'checked';
        }
        echo' onclick="show(0)" class="ml-2" type="radio" id="smestajne" name="smestaj" value="ne">
        <label class="labeladmina"  for="ne">Ne</label> <br>
        <span id="spanhotel" style="margin: 0; padding:0;';
        if($row['apartmans']=='da')
        {
        echo 'display:block';
        } 
        echo' ">
        <select name="smestajmodel" class="form-select mb-3">
        <option value="'.$row['apartmansway'].'">'.$row['apartmansway'].'</option>
        <option value="Hotel">Hotel</option>
        <option value="Apartman">Apartman</option>
        </select> <br>
       <input class="form-control" type="text" name="smestajime" value='.$row['nameapartamns'].'> <br>
       
       </span>
      <br>
 <span>Hrana:</span>
   
              <hr>
       <input type="radio" onclick="showfood(1)"';
       if($row['food']=='da')
       {
        echo 'checked';
       }
       echo ' style="width:20px;" class="ml-2"  id="hranada" name="hrana" value="da">
        <label class="labeladmina"   for="da">Da</label>   
       <input style="width:20px;"  onclick="showfood(0)"'; 
       if($row['food']=='ne')
       {
        echo 'checked';
       }
       echo '   class="ml-2" type="radio" id="hranane" name="hrana" value="ne">
        <label class="labeladmina"  for="ne">Ne</label> <br>    
         <span id="spanhrana" style="padding:0;margin:0;';  
if($row['food']=='da')
{
 echo 'display:block';
}

echo' ">    
           <select name="hranaway" value=""  class="form-select">
           <option value='.$row['foodway'].'>'.$row['foodway'].'</option>
           <option value="Dorucak">Dorucak</option>
           <option value="Polupansion">Polupansion</option>
           <option value="Punpansion">Punpansion</option>
           </select> <br>
       </span>
</div>
</div>
<input type="submit"  style="width:100%;" class="btn btn-primary" name="btn"  value="Sacuvaj">
<input type="hidden" name="id_to_delete" value='.$row['id'].'>
</form>
';
}
}
elseif($_SESSION['user'])
{
  header("Location:indexuser.php");
}
else{

  header("Location:indexuser.php");
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <title>Document</title>
</head>
<body>
   <style>
      #formacpanel{
       
         padding:30px;
         width:100%;
         background-color:;
        
      }
      #spanhotel{
         display:none;
        background-color: white;
      }
      #spanhrana{
         display:none;
          background-color: white;
      }
      #spanright{
        text-align:right;
      }
      #spantransport{
        display: none;
        background-color: white;
      }
      span{
        padding:9px;
        background-color: grey;
        color:white;
        border-radius:5px;
      }
      .labeladmina{
        padding:5px;
        background-color:  ;
        color:black;
        border-radius:5px;
      }
     #formphoto{
      width:80%;
      margin-left:auto;
     }
   </style>
   
   <script  src="js/funckije.js"></script>
</body>
</html>