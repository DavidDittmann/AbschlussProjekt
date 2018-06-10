function getSide(str) {
    if (str.length==0) { 
        document.getElementById("content").innerHTML="";
        return;
    }
    xmlhttp=new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","./utility/getSide.php?q="+str,true);
    xmlhttp.send();
}

function prod(str){
    if (str.length==0) { 
        document.getElementById("prodview").innerHTML="";
        return;
    }
    xmlhttp=new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById("prodview").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","./utility/prod.php?q="+str,true);
    xmlhttp.send();
}

function search(str){
    if (str.length==0) { 
        document.getElementById("prodview").innerHTML="";
        return;
    }
    xmlhttp=new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById("prodview").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","./utility/search.php?q="+str,true);
    xmlhttp.send();
}

function getStatus() {
    //document.getElementById("showStatus").innerHTML="";
    
    xmlhttp=new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById("showStatus").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","./utility/getStatus.php",true);
    xmlhttp.send();
}


function validateReg() {
    var reg_user = /^[a-zA-Z0-9]{4,}$/;
    var reg_pw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
    var reg_plz =/^[a-zA-Z0-9]{2,}$/;
    var reg_ort =/^[a-zA-Z]{2,}$/;
    var reg_addr =/^(?=.*[a-zA-Z])(?=.*[\s])(?=.*[0-9])[a-zA-Z]{3,}[\s]{1,}[0-9]{1,}$/;
    var reg_mail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var reg_name = /^[A-Za-z]{1,}$/;

    var user = document.forms["regForm"]["user_val"].value;
    var pw1 = document.forms["regForm"]["pw1_val"].value;
    var pw2 = document.forms["regForm"]["pw2_val"].value;
    var vname = document.forms["regForm"]["vname_val"].value;
    var nname = document.forms["regForm"]["nname_val"].value;
    var addr = document.forms["regForm"]["addr_val"].value;
    var plz = document.forms["regForm"]["plz_val"].value;
    var ort = document.forms["regForm"]["ort_val"].value;
    var mail = document.forms["regForm"]["mail_val"].value;


    if (!user.match(reg_user)) {
        alert("Username mind. 4 Zeichen lang!");
        return false;
    }
    if(pw1!=pw2)
    {
        alert("Passwörter sind nicht gleich!");
    }
    if (!pw1.match(reg_pw)) {
        alert("Passwort ist entweder: nicht mind. 8 Zeichen lang oder enthält nicht mind. einen Großbuchstaben, Zahl und Sonderzeichen!");
        return false;
    }
    if (!vname.match(reg_name)) {
        alert("Vorname muss mindestens 1 Zeichen lang sein!");
        return false;
    }
    if (!nname.match(reg_name)) {
        alert("Nachname muss mindestens 1 Zeichen lang sein!");
        return false;
    }
    if (!addr.match(reg_addr)) {
        alert('Strasse mind. 3 Zeichen und Hausnummer angeben -> <Strasse> <Hausnummer>');
        return false;
    }
    if (!ort.match(reg_ort)) {
        alert("Ortsname mind. 2 Zeichen!");
        return false;
    }
    if (!plz.match(reg_plz)) {
        alert("Postleitzahl mind. 2 Zeichen!");
        return false;
    }
    if (!mail.match(reg_mail)) {
        alert("Dies ist keine gültige Email-Addresse!");
        return false;
    }

    return true;
}

function validateLog() {
    var reg_user = /^[a-zA-Z0-9]{4,}$/;
    var reg_pw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;

    var user = document.forms["logForm"]["uname"].value;
    var pw = document.forms["logForm"]["pw"].value;

    if (!user.match(reg_user)) {
        alert("Username mind. 4 Zeichen lang!");
        return false;
    }
    if (!pw.match(reg_pw)) {
        alert("Passwort ist entweder: nicht mind. 8 Zeichen lang oder enthält nicht mind. einen Großbuchstaben, Zahl und Sonderzeichen!");
        return false;
    }

    return true;
}

function validateKat()
{
    var kat=document.forms["add_kat_form"]["kat"].value;
    reg_kat=/^[a-zA-Z]+$/;

    if (!kat.match(reg_kat)) {
        alert("Kategorie ist nicht konform!");
        return false;
    }
    return true
}

function validateAdd()
{
    var name = document.forms["add_prod_form"]["prod_name"].value;
    var besch = document.forms["add_prod_form"]["prod_beschreibung"].value;
    var preis = document.forms["add_prod_form"]["prod_preis"].value;
    var kat = document.forms["add_prod_form"]["prod_kat"].value;
    var bewert = document.forms["add_prod_form"]["prod_bewertung"].value;
    var file = document.forms["add_prod_form"]["prod_file"].value;

    var reg_name = /^[a-zA-Z0-9\s]+$/;
    var reg_besch = /^[A-Za-z0-9\s-+/*]+$/;
    var reg_bewert= /^[A-Za-z0-9\s-+/*]{0,}$/;
    var reg_preis = /^[+-]?([0-9]*[.])?[0-9]+$/; //floatingpoint
    var reg_kat = /^[a-zA-Z\s]+$/;

    if (!name.match(reg_name)) {
        alert("Titel ist nicht konform!");
        return false;
    }
    if (!besch.match(reg_besch)) {
        alert("Beschreibung ist nicht konform!");
        return false;
    }
    if (!preis.match(reg_preis)) {
        alert("Preis ist nicht konform!");
        return false;
    }
    if (!kat.match(reg_kat)) {
        alert("Kategorie ist nicht konform!");
        return false;
    }
    if (!bewert.match(reg_bewert)) {
        alert("Bewertung ist nicht konform!");
        return false;
    }

    if (file == '') {
        alert("Please select an image to upload");  
        return false;
    } 
    else 
    {
        var Extension = file.substring(file.lastIndexOf('.') + 1).toLowerCase();

        if (Extension == "gif" || Extension == "png" || Extension == "jpeg" || Extension == "jpg")
        {
            //alert("alles ok");
        }
        else
        {
            alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
            return false;
        }
    }
    return true;
}

function ValidateSize(file) {
    var FileSize = file.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        $("#fi").val("");
        alert('File size exceeds 2 MB');
    }
}
   
function DisplayMSG(str){
    alert(str);
}