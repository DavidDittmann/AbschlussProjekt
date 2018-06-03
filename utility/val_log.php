<?php
$Invalid="registrierung";
$Valid="login";

if(isset($_POST["uname"])&&isset($_POST["pw"]))
{
    $username = $_POST["uname"];
    $pw=$_POST["pw"];

    if (!preg_match("/^[a-zA-Z0-9]{4,}$/",$username)) {
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (Username ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/",$pw)){
        echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! (Passwort ungültig)"); getSide("'.$Invalid.'"); </script>';
    }
    else{
        $pw5=md5($pw);
        $db=new DB();
        $db->connect();
        if($db->check_login($username, $pw5))
        {
            //LOGIN ERFOLGREICH
            $db->disconnect();
            echo '<script type="text/javascript">alert("LOGIN erfolgreich!");getSide("home");</script>';
        }
        else{
            //LOGIN FEHLGESCHLAGEN
            $db->disconnect();
            echo '<script type="text/javascript">alert("LOGIN fehlgeschlagen!");getSide("login");</script>';
        }
    }
}
else
{
    echo '<script type="text/javascript">alert("Server erkennt Eingaben nicht an! (Nicht alle Daten übermittelt)");getSide("'.$Invalid.'");</script>';
}
?>