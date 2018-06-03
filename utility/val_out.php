<?php
    $cookiePath="/";
    $cookieExpire=time()+36000;//Cookie 1 Stunde gültig
    session_destroy();

    setcookie("PHPSESSID", "", time()-3600,$cookiePath);
    unset($_COOKIE['PHPSESSID']);
    setcookie("user", "", time()-3600,$cookiePath);
    unset($_COOKIE['user']);
    setcookie("admin", "", time()-3600,$cookiePath);
    unset($_COOKIE['admin']);

    echo '<script type="text/javascript">window.location.href ="index.php"</script>';
?>