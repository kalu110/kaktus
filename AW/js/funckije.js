

spisakzaposlenih=[];


function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


function show(x)
    {
      if(x==0)
      {
      document.querySelector('#spanhotel').style.display="";
      }
      else{
         document.querySelector('#spanhotel').style.display="block";
      }
}
function showfood(x)
    {
      if(x==0)
      {
      document.querySelector('#spanhrana').style.display="none";
      }
      else{
         document.querySelector('#spanhrana').style.display="block";
      }
    }

function showtransport(x)
    {
      if(x==0)
      {
      document.querySelector('#spantransport').style.display="none";
      }
      else{
         document.querySelector('#spantransport').style.display="block";
      }
    }
function  asss(id){
  createCookie("id", id, "1");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
   document.querySelector(".homeca").innerHTML =
   this.responseText;
 }
}
xhttp.open("GET","prikaz.php", true);
xhttp.send();
document.querySelector('#nazb').style.visibility="visible";
document.querySelector('#br').style.visibility="hidden";
document.querySelector('#imgus').style.visibility="hidden";
document.querySelector('#rezus').style.visibility="visible";
}


function izmenadest(id){
    createCookie("idizmena", id, "1");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.querySelector(".homeca").innerHTML =
     this.responseText;
   }
  }
  xhttp.open("GET","izmenadest.php", true);
  xhttp.send();
  
   
  }


function  dodaj(){
  
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
   document.querySelector(".homeca").innerHTML =
   this.responseText;
 }
 document.querySelector("#myInput").style.display="none";
}
xhttp.open("GET","admina.php", true);
xhttp.send();

}

function searchdestination(string) {
  // Declare variables
  
  let html = document.querySelector('.homeca');
  html.innerHTML=" ";
  // Loop through all list items, and hide those who don't match the search query
  for(let i of spisakzaposlenih)
  {
    if(i.country.toLowerCase().includes(string.toLowerCase()) || i.city.toLowerCase().includes(string.toLowerCase()))
    {
      html.innerHTML+=`
    
    <div class="card ml-4" style="width: 30%;">
  <img style="width:100%; height:150px; " src="uploads/${i['city']}.jpg" class="card-img-top" alt="...">
  <div class="card-body">
  <form action="admin/snimi.php" method="POST">
    <h5 class="card-title">${i['country']}</h5>
    <h4 class="card-title">${i['city']} - ${i['price']}€</h5>
    <p class="card-text">${i['description']}</p>
    <button class="btn btn-primary" onclick="izmenadest(${i['id']})">Izmeni</button>
    <input name="delete" type="submit"  class="btn btn-primary" value="Obrisi">
    <p style="font-size:12px;">${i['date']}</p>
    <input type="hidden" name="id_to_delete" value="${i['id']}">
      </form>
      
      <input type="hidden" name="id" value="${i['id']}">
      <button type="submit" name="btn2" id="btn2" class="btn-block btn-primary" onclick="asss(${i['id']})">Prikazi</button>
     
      </div>
  </div>
    `
    }
  }
}

function searchimages(string) {
  // Declare variables
  
  let html = document.querySelector('.homeca');
  html.innerHTML=" ";
  // Loop through all list items, and hide those who don't match the search query
  for(let i of spisakzaposlenih)
  {
    if(i.file_name.toLowerCase().includes(string.toLowerCase()))
    {
      html.innerHTML+=`
    
      <div class="col-md-3 mt-4">
      <div class="card"">
    <img style="width:100%; height:150px; " src="uploads/${i['file_name']}">
    <p class="text-center">${i['file_name']}</p>
    </div>
    </div>
    `
    }
  }
}

function searchusers(string) {
  // Declare variables
  
  let html = document.querySelector('tbody');
  html.innerHTML=" ";
  // Loop through all list items, and hide those who don't match the search query
 for(let i of spisakzaposlenih)
  {
    if(i.name.toLowerCase().includes(string.toLowerCase()) || i.email.toLowerCase().includes(string.toLowerCase())  || i.phone.toLowerCase().includes(string.toLowerCase()))
    {
      html.innerHTML+=`
    
      <tr>
      <th scope="row">${i['id']}</th>
      <td>${i['name']}</td>
      <td>${i['email']}</td>
      <td>${i['phone']}</td>
      <td><button class="btn btn-dark" onclick="obrisi()">Obrisi</button></td>
    </tr> <br>
   
    `
    }
  }
}
function  undo(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
   document.querySelector("body").innerHTML =
   this.responseText;
 }
}
xhttp.open("GET",html, true);
xhttp.send();
 
}

// Function to create the cookie
function createCookie(name, value, days) {
  var expires;
    
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
  }
  else {
      expires = "";
  }
    
  document.cookie = escape(name) + "=" + 
      escape(value) + expires + "; path=/";
}
function ajaxadmin() {
    var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("body").innerHTML =
      this.responseText;
    }
    xhttp.open("GET", "../admin/dbsend.php", true);
    xhttp.send();
  }
}

function ajaxprikaz() {
  var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.querySelector("body").innerHTML =
    this.responseText;
  }
  xhttp.open("GET", "../prikaz.php", true);
  xhttp.send();
}
}
function ajaxrezervisi(niz,id) {

  let idd = getCookie('id');
  let idu = id;
  let tacno = true;

  if(niz.length > 0)
  {
  for(let i of niz)
   {
    if(i['iduser']==idu && i['iddestination']==idd)
     { alert('Vec ste rezervisali ovu destinaciju!');
      tacno=false;
      break;
    }
    }
  }
    if(tacno){  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       document.querySelector("body").innerHTML =
       this.responseText;
     }
    }
    xhttp.open("GET", "admin/usersend.php", true);
    xhttp.send();
    alert('Vaša rezervacija je uspešno poslata!');
    }
 
}

  

 
  function validacijaslika(niz){
   
    let image = document.forms["myFormImage"]["fileToUpload"].value;
    let imgname = image.split("\\");
    if(image=="")
    {
      alert("Niste odabrali fotografiju!");
      return false;
    }
    else{
      for(let i of niz)
      {
       if(i['file_name']==imgname[2])
       {
        alert ('Fotografija sa ovim imenom vec postoji!');
        return false;
       }
      }
      return alert('Uspesno ste dodali fotografiju!');
      }
        
      }
    
   
  
  function validacija(){
    
    let country = document.forms["myForm"]["country"].value;
    let city = document.forms["myForm"]["city"].value;
    let price = document.forms["myForm"]["price"].value;
    let transport = document.forms["myForm"]["transport"].value;
    let smestaj = document.forms["myForm"]["smestaj"].value;
    let hrana = document.forms["myForm"]["hrana"].value;
    let description = document.forms["myForm"]["description"].value;
    let pocetna = document.forms["myForm"]["pocetna"].value;
    let slider1 = document.forms["myForm"]["slider1"].value;
    let slider2 = document.forms["myForm"]["slider2"].value;
    let slider3 = document.forms["myForm"]["slider3"].value;
    let slider4 = document.forms["myForm"]["slider4"].value;
    let datestart = document.forms["myForm"]["datestart"].value;
    let dateend = document.forms["myForm"]["dateend"].value;
   
    if (datestart == "" || dateend == "" || country == "" || city == "" || price == "" || description == "" || transport=="" || smestaj==""  || hrana=="" || pocetna==""  || slider1==""  || slider2==""  || slider3=="" || slider4==""  ) {
    alert("Niste uneli neko od polja!");
    return false;
    }
    else if(Date.Parse(datestart) < Date.now())
    {
    return alert("Datum ne moze biti manji od danasnjeg!");
    }
  else{
     admindodaj();
    return alert('Uspesno ste dodali destinaciju');  
  }
    }

function validacijasignup(){
    
      let name = document.forms["myFormSign"]["name"].value;
      let email = document.forms["myFormSign"]["email"].value;
      let phone = document.forms["myFormSign"]["phone"].value;
      let pass = document.forms["myFormSign"]["pass"].value;
      let reppass = document.forms["myFormSign"]["reppass"].value;
      let error1 = document.querySelector("#error1");
      let error2 = document.querySelector("#error2");
      let error4 = document.querySelector("#error4");
      let error5 = document.querySelector("#error5");
      if (name == "" || email == "" ||  pass == "" || reppass==""){
        
       if(name=="")
       {
          error1.innerHTML="<p style='margin-top:5px;color:red; font-weight:bolder;'>Niste uneli ime</p>";
       }
       if(email=="")
       {
          error2.innerHTML="<p style='margin-top:5px;color:red; font-weight:bolder;'>Niste uneli email</p>";
       }
      if(pass=="")
       {
          error4.innerHTML="<p style='margin-top:5px;color:red; font-weight:bolder;'>Niste uneli lozinku</p>";
       }
      if(reppass=="")
       {
          error5.innerHTML="<p style='margin-top:5px;color:red; font-weight:bolder;'>Niste uneli  lozinku</p>";
       }

        return false;
    }
    else{
      userdodaj();
      return alert('Uspesno ste se registrovali!');  
    }
  
      }

   
    function stringContainsNumber(_string) {
      return /\d/.test(_string);
    }
  function admindodaj() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.querySelector("body").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "admin/dbsend.php", true);
    xhttp.send();
  }

  function userdodaj() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.querySelector("body").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "admin/usersend.php", true);
    xhttp.send();
  }

 