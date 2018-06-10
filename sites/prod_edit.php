<?php require_once("../utility/db.class.php")?>

<div id="add_kat">
    <h2>Kategorie hinzufügen:</h2>
    <form id="add_kat_form" method="POST" action="?kat=1" onsubmit="return validateKat()">
        <div class="reg_form_input_txt">Kategorie: </div>
            <input class="reg_form_input" name="kat" id="kat" type="text" placeholder="Limousine" required>
            <input type="submit" value="Hinzufügen">
    </form>
</div>
<div id="add_prod">
    <h2>Produkt hinzufügen:</h2>
    <form id="add_prod_form" enctype="multipart/form-data" method="POST" action="?add=1"  onsubmit="return validateAdd()">
        <div class="reg_form_input_txt">Name des Produkts: </div>
            <input class="reg_form_input" name="prod_name" id="prod_name" type="text" placeholder="Produktname" required>
        <div class="reg_form_input_txt">Beschreibung des Produkts: </div>
            <input class="reg_form_input" name="prod_beschreibung" id="prod_beschreibung" type="text" placeholder="Beschreibung" required>
        <div class="reg_form_input_txt">Preis des Produkts: </div>
            <input class="reg_form_input" name="prod_preis" id="prod_preis" type="number" step="0.01" min="0" placeholder="12345.99" required>
        <div class="reg_form_input_txt">Kategorie des Produkts: </div>
            <select name="prod_kat" required>
            <?php
                $db=new DB();
                $db->connect();
                $db->get_Kat();
            ?>
            </select>
        <div class="reg_form_input_txt">Bewertung des Produkts: </div>
            <input class="reg_form_input" name="prod_bewertung" id="prod_bewertung" type="text" placeholder="Bewertung">
        <div class="reg_form_input_txt">Foto zum Produkt: </div>
            <input name="prod_file" onchange="ValidateSize(this)" type="file" id="fi" required>
        <input type="submit" value="Hinzufügen">
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