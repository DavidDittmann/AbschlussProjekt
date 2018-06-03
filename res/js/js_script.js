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
   
function DisplayMSG(str){
    alert(str);
}