<?php
if(file_exists("config/nav.xml"))
{
    log_to_console("nav.xml loading");
    $itemlist=simplexml_load_file("config/nav.xml");
?>
    <form id="navi_form">
<?php
    foreach($itemlist->item as $item)
    {
        if(!isset($_SESSION['user']) && !isset($_COOKIE['user']))
        {
            //ANONYMER USER
            
                if($item->anonym=="true" && $item->filename!="login" && $item->filename!="registrierung")
                {
                    echo '<input type="button" class="nav_button col-xs-12 col-sm-4 col-md-2 col-lg-2" name="'.$item->filename.'" value="'.$item->name.'" onclick="getSide(this.name)">';
                }
                elseif($item->anonym=="true" && ($item->filename=="login" || $item->filename=="registrierung"))
                    echo '<input type="button" class="pull-right nav_button col-xs-12 col-sm-4 col-md-2 col-lg-2" name="'.$item->filename.'" value="'.$item->name.'" onclick="getSide(this.name)">';
        }
        else
        {
            if((isset($_SESSION['admin'])&&$_SESSION['admin']=="0") || (isset($COOKIE['admin'])&&$_COOKIE['admin']=="0"))
            {
                //NORMALER USER
                if($item->user=="true" && $item->filename!="logout")
                {
                    echo '<input type="button" class="nav_button col-xs-12 col-sm-4 col-md-2 col-lg-2" name="'.$item->filename.'" value="'.$item->name.'" onclick="getSide(this.name)">';
                }
                elseif($item->user=="true" && $item->filename=="logout")
                    echo '<input type="button" class="pull-right nav_button col-xs-12 col-sm-4 col-md-2 col-lg-2" name="'.$item->filename.'" value="'.$item->name.'" onclick="getSide(this.name)">';
            }
            elseif((isset($_SESSION['admin'])&&$_SESSION['admin']=="1") || (isset($_COOKIE['admin'])&&$_COOKIE['admin']=="1"))
            {
                //ADMIN USER
                if($item->admin=="true" && $item->filename!="logout")
                {
                    echo '<input type="button" class="nav_button col-xs-12 col-sm-4 col-md-2 col-lg-2" name="'.$item->filename.'" value="'.$item->name.'" onclick="getSide(this.name)">';
                }
                elseif($item->admin=="true" && $item->filename=="logout")
                    echo '<input type="button" class="pull-right nav_button col-xs-12 col-sm-4 col-md-2 col-lg-2" name="'.$item->filename.'" value="'.$item->name.'" onclick="getSide(this.name)">';
            }
        }
    }
?>
    </form>
<?php
}
else
{
    log_to_console("nav.xml not available");
}

?>