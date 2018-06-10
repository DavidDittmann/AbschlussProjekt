<!DOCTYPE html>
<!--
/* 
 *Autoren: 	David Dittmann
 *Datum:	17.05.2018
 *Version:	0.1
 */
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="./res/css/style.css">
        <title>Autoshop DittMaster</title>
        <script src="res/js/js_script.js"></script>
        <?php 
            include("utility/helper.php");
            include("utility/db.class.php");
            if(isset($_GET["reg"]))
            {
                include("./utility/val_reg.php");
            }
            if(isset($_GET["log"]))
            {
                include("./utility/val_log.php");
            }
            if(isset($_GET["out"]))
            {
                include("./utility/val_out.php");
            }
            if(isset($_GET["add"]))
            {
                include("./utility/val_add.php");
            }
            if(isset($_GET["kat"]))
            {
                include("./utility/val_kat.php");
            }
            if(isset($_GET["edit"]))
            {
                include("./utility/edit.php");
            }
        ?>
    </head>
    <body>
        <div id="header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="col-xs-12 col-sm-12 col-md-6 col-lg-6">Autoshop DittMaster</h1>
            <?php
                echo '<div id="showStatus" class="pull-right col-xs-6 col-sm-4 col-md-2 col-lg-2">';
                if(!isset($_COOKIE['user']))
                    echo 'Sie sind nicht eingeloggt!';
                else
                    echo '<script type="text/javascript">getStatus();</script>';
                echo '</div>';
            ?>
        </div>
        <div id="nav" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
            include("./inc/navigation.php");
            ?>
        </div>
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Wird per Ajax nachgeladen über die Navigation (Siehe navigation.php) -->
            <?php include("./sites/home.php"); ?>

        </div>
        <div id="footer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
            include("./inc/footer.php");
            ?>
        </div>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
    
</html>
