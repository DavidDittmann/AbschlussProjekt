<?php
$q=$_GET["q"];

require_once("../utility/db.class.php");

$db = new DB();
$db->connect();
$products=$db->getallProducts($q);
$db->disconnect(); 

echo '<table>';
echo "<tr><th>Foto</th><th>Name</th><th>Beschreibung</th><th>Preis</th><th>Bewertung</th><th>Weiteres</th></tr>";
foreach($products as $product)
{
    echo '<tr><td><img class="ProdPic" src="'.$product['link'].'"></td>';
    echo '<td>'.$product['name'].'</td>';
    echo '<td>'.$product['besch'].'</td>';
    echo '<td>'.$product['preis'].'</td>';
    echo '<td>'.$product['bewert'].'</td>';
    echo '<td><input class="wkBtn" type="button" name="'.$product['id'].'" value="Zum Warenkorb hinzufügen"></td></tr>';
}
echo '</table>';
?>