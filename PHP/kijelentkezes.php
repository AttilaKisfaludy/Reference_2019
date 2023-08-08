<?php
if(isset($_POST['kijelentkez']))
{
    if(isset($_COOKIE['allapot']))
    {
    setcookie("allapot","false",time()-3600);
    setcookie("id","",time()-3600);
    setcookie("nev","",time()-3600);
    $allapot=0;
    $ok[]="Sikeresen kijelentkezett!";
    }
}

?>