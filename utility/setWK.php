<?php
$ProdID=$_GET["q"];
require_once("../utility/db.class.php");

if(isset($_COOKIE['user']))
{
    $user = $_COOKIE['user'];

    //Database
    $db = new DB();
    $db->connect();
    $db->addProductWarenkorb($user,$ProdID);

    $anz = $db->anzahlProdukteWarenkorb($user);

    foreach($anz as $a)
    {
        //echo $a['sum'];
        echo '<script txpe="text/javascript">';
        echo 'setWKBtn('.$a['sum'].');';
        echo '</script>';
    }
    $db->disconnect(); 

    
}
else
{
    //Session
}

?>