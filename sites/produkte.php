<?php
require_once("../utility/db.class.php");

$db = new DB();
$db->connect();
$products=$db->getallProducts();
$kategorien=$db->getKatProd();
$db->disconnect();
?>

<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
    <div id="katwahl" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Kategorie</h2>
        <?php foreach($kategorien as $kategorie){ ?>
            <input class="katBtn" type="button" value="<?php echo $kategorie['kategorie']; ?>" name="<?php echo $kategorie['kategorie']; ?>" onclick="prod(this.value);">
        <?php } ?>
    </div>
    <div id="prodsuche" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <input id="search" type="text" placeholder="Search..." onkeypress="search(this.value);">
    </div>
</div>
<div id="prodview" class="col-xs-12 col-sm-8 col-md-10 col-lg-10">
        <?php
        $stdKat = $kategorien[0]['kategorie']; 

        echo '<table>';
        echo "<tr><th>Foto</th><th>Name</th><th>Beschreibung</th><th>Preis</th><th>Bewertung</th><th>Weiteres</th></tr>";
        foreach($products as $product)
        {
            if($product['kategorie']==$stdKat)
            {
                echo '<tr><td><img class="ProdPic" src="'.$product['link'].'"></td>';
                echo '<td>'.$product['name'].'</td>';
                echo '<td>'.$product['besch'].'</td>';
                echo '<td>'.$product['preis'].'</td>';
                echo '<td>'.$product['bewert'].'</td>';
                echo '<td><input class="wkBtn" type="button" name="'.$product['id'].'" value="Zum Warenkorb hinzufügen" onclick="setWK(this.name)"></td></tr>';
            }
        }
        echo '</table>';
        ?>
</div>