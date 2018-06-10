<?php
$subdir = "./pic/";

//----------------------
//HIER REGEX ÜBERPRÜFUNG UND FILENAMEN ERSTELLEN
if(isset($_POST['prod_name'])&&isset($_POST['prod_beschreibung'])&&isset($_POST['prod_preis'])&&isset($_POST['prod_kat']))
{
    $name=$_POST['prod_name'];
    $besch=$_POST['prod_beschreibung'];
    $preis=$_POST['prod_preis'];
    $kat=$_POST['prod_kat'];
    if(isset($_POST['prod_bewertung']))
        $bewert=$_POST['prod_bewertung'];
    else
        $bewert="";

    if (isset($_FILES['prod_file'])) 
    {	
        $db=new DB();
        $db->connect();
        $id_file=$db->getLastProdId()+1;

        $fileupload=$_FILES['prod_file'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
    
        if ($_FILES['prod_file']['size'] > 2048000) //Filesize check 2MB
        {
            echo '<script type="text/javascript">alert("File zu groß");</script>';
            echo '<script type="text/javascript">window.location.href = "index.php"</script>';
        }
        if (false === $ext = array_search($finfo->file($_FILES['prod_file']['tmp_name']),array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),true)) // Filetype check ... jpg,png,gif
        {
            echo '<script type="text/javascript">alert("FOTO: Falscher Dateityp");</script>';
            echo '<script type="text/javascript">window.location.href = "index.php"</script>';
        }
        if ( !$fileupload['error'] && $fileupload['size']>0 && $fileupload['size'] < 2048000 && $fileupload['tmp_name']	&& is_uploaded_file($fileupload['tmp_name'])) 
        //nur true wenn file gerade hochgeladen wurde
            {   
                $p = $_FILES['prod_file']['name'];
                $e = pathinfo($p, PATHINFO_EXTENSION);
                move_uploaded_file($fileupload['tmp_name'],$subdir.$id_file.".".$e);  // in das Speicherverzeichnis verschieben --- filename hier änderbar '$fileupload['name']'
                
                $pathToFile="./pic/".$id_file.".".$e;
                //echo $pathToFile;

                $db->insertProduct($name, $besch, $preis, $kat, $bewert,$pathToFile);
                $db->disconnect();

                echo '<script type="text/javascript">alert("Produkt erfolgreich angelegt!");getSide("prod_edit");</script>'; // refreshed nach dem upload
    
            }
        else echo 'Fehler beim Upload';
    }
}
else
    echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! Es fehlen Eingaben"); getSide("prod_edit"); </script>';
?>