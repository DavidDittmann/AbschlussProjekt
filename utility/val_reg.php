<?php
$Invalid="registrierung";
$Valid="login";

if(isset($_POST["user_val"])&&isset($_POST["pw1_val"])&&isset($_POST["pw2_val"])&&isset($_POST["addr_val"])&&isset($_POST["plz_val"])&&isset($_POST["ort_val"])&&isset($_POST["mail_val"])&&isset($_POST["vname_val"])&&isset($_POST["nname_val"]))
{
    $username = $_POST["user_val"];
    $pw1=$_POST["pw1_val"];
    $pw2=$_POST["pw2_val"];
    $addr=$_POST["addr_val"];
    $plz=$_POST["plz_val"];
    $ort=$_POST["ort_val"];
    $mail=$_POST["mail_val"];
    $vname=$_POST["vname_val"];
    $nname=$_POST["nname_val"];

    if($pw1!=$pw2){
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (Passwörter stimmen nicht überein)"); getSide("'.$Invalid.'"); </script>';
    }
    elseif (!preg_match("/^[a-zA-Z0-9]{4,}$/",$username)) {
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (Username ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    elseif((!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/",$pw1))||(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/",$pw2))){
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (PAsswort ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    elseif ((!preg_match("/^(?=.*[a-zA-Z])(?=.*[\s])(?=.*[0-9])[a-zA-Z]{3,}[\s]{1,}[0-9]{1,}$/",$addr))||(!preg_match("/^[a-zA-Z0-9]{2,}$/",$plz))||(!preg_match("/^[a-zA-Z]{2,}$/",$ort))) {
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (1 Addressparameter ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    elseif ((!preg_match("/^[A-Za-z]{1,}$/",$vname))||(!preg_match("/^[A-Za-z]{1,}$/",$nname))) {
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (Namensparameter ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    elseif(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/",$mail)){
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (Email ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    else{
        $pw5=md5($pw1);
        $db=new DB();
        $db->connect();
        $db->register_user($username, $pw5, $addr, $plz, $ort, $vname, $nname, $mail);
        $db->disconnect();
        echo '<script type="text/javascript">alert("Registrierung erfolgreich!");getSide("login");</script>';
    }
}
else
{
    echo '<script type="text/javascript">alert("Server erkennt Eingaben nicht an! (Nicht alle Daten übermittelt)");getSide("'.$Invalid.'");</script>';
}


?>