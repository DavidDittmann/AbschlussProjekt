<?php

if(isset($_POST['kat']))
{
    $kat=$_POST['kat'];
    $db=new DB();
    $db->connect();
    if($db->addKat($kat))
    {
        echo '<script type="text/javascript">alert("Kategorie erfolgreich angelegt!");getSide("prod_edit");</script>';
    }
    else
    {
        echo '<script type="text/javascript">alert("ERROR: Kategorie nicht angelegt!");getSide("prod_edit");</script>';
    }
    $db->disconnect();
}
else
{
    echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! Es fehlen Eingaben"); getSide("prod_edit"); </script>';
}
?>