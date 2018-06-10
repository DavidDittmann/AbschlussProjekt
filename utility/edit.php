<?php
$subdir = "./pic/";

//----------------------
//HIER REGEX ÜBERPRÜFUNG UND FILENAMEN ERSTELLEN
if(isset($_POST['prod_name'])&&isset($_POST['prod_beschreibung'])&&isset($_POST['prod_preis'])&&isset($_POST['prod_kat'])&&isset($_POST['id']))
{
    $id=$_POST['id'];
    $name=$_POST['prod_name'];
    $besch=$_POST['prod_beschreibung'];
    $preis=$_POST['prod_preis'];
    $kat=$_POST['prod_kat'];
    if(isset($_POST['prod_bewertung']))
        $bewert=$_POST['prod_bewertung'];
    else
        $bewert="";
 
    if (isset($_FILES['prod_file'])&&$_FILES['prod_file']['tmp_name']!="") 
    {	
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
                move_uploaded_file($fileupload['tmp_name'],$subdir.$id.".".$e);  // in das Speicherverzeichnis verschieben --- filename hier änderbar '$fileupload['name']'
                
                $pathToFile="./pic/".$id.".".$e;
                //echo $pathToFile;

                $db=new DB();
                $db->connect();
                if($db->editProduct($id,$name, $bewert,$besch, $preis,$pathToFile,$kat))
                    echo '<script type="text/javascript">alert("Produkt erfolgreich bearbeitet!");window.location.href ="index.php";</script>'; // refreshed nach dem upload
                else
                    echo '<script type="text/javascript">alert("Produkt nicht bearbeitet!");window.location.href ="index.php";</script>'; // refreshed nach dem upload
                $db->disconnect();

                
    
            }
        else echo 'Fehler beim Upload';
    }
    else
    {
        $pathToFile="";
        $db=new DB();
        $db->connect();
        if($db->editProduct($id,$name, $bewert,$besch, $preis,$pathToFile,$kat))
            echo '<script type="text/javascript">alert("Produkt erfolgreich bearbeitet2!");window.location.href ="index.php";</script>'; // refreshed nach dem upload
        else
            echo '<script type="text/javascript">alert("Produkt nicht bearbeitet2!");window.location.href ="index.php";</script>'; // refreshed nach dem upload
        $db->disconnect();
    }
}
else
    echo'<script type="text/javascript"> alert("Server erkennt Eingaben nicht an! Es fehlen Eingaben"); getSide("prod_edit"); </script>';
?>