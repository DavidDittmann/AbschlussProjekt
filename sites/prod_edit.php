<?php require_once("../utility/db.class.php")?>

<div id="add_kat" class="col-md-3 col-lg-3 col-sm-4">
    <h2>Kategorie hinzufügen:</h2>
    <form id="add_kat_form" method="POST" action="?kat=1" onsubmit="return validateKat()">
    <div class="container">
        <label for="kat"><b>Kategorie</b></label>
        <br><input class="reg_form_input" name="kat" id="kat" type="text" placeholder="Limousine" required>
        <br><button type="submit" value="Hinzufügen">Hinzufügen</button>
    </div>
    </form>
</div>
<div id="add_prod" class="col-md-6 col-lg-6 col-sm-8">
    <h2>Produkt hinzufügen:</h2>
    <form id="add_prod_form" enctype="multipart/form-data" method="POST" action="?add=1"  onsubmit="return validateAdd()">
    <div class="container">
        <label for="kat"><b>Name</b></label>
            <input class="reg_form_input" name="prod_name" id="prod_name" type="text" placeholder="Produktname" required>
        <label for="prod_beschreibung"><b>Beschreibung</b></label>
            <input class="reg_form_input" name="prod_beschreibung" id="prod_beschreibung" type="text" placeholder="Beschreibung" required>
        <label for="prod_preis"><b>Preis</b></label>
            <input class="reg_form_input" name="prod_preis" id="prod_preis" type="number" step="1" min="0" placeholder="12345.99" required>
        <label for="prod_kat"><b>Kategorie</b></label>
            <select name="prod_kat" required>
            <?php
                $db=new DB();
                $db->connect();
                $db->get_Kat();
            ?>
            </select>
        <label for="prod_bewertung"><b>Bewertung</b></label>
            <input class="reg_form_input" name="prod_bewertung" id="prod_bewertung" type="text" placeholder="Bewertung">
            <label for="prod_file"><b>Foto</b></label>
            <input name="prod_file" onchange="ValidateSize(this)" type="file" id="fi" required>
        <button type="submit" value="Hinzufügen">Hinzufügen</button>
    </div>
    </form>
</div>
<div id="show_prod_edit">
<?php
    echo '<table>';
    echo "<tr><th>Foto</th><th>Name</th><th>Beschreibung</th><th>Preis</th><th>Kategorie</th><th>Bewertung</th><th>Bearbeiten</th></tr>";
    $db->getProductEdit();
    echo '</table>';
    $db->disconnect();
?>
</div>