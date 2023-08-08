<?php
$alapallapot=false;
$allapotl=false;
$allapot=0;
if(isset($_COOKIE['allapot']))
{
    if($_COOKIE['allapot']==1)
    {
     $allapot=$_COOKIE['allapot'];
    $id=$_COOKIE['id'];
    $felhasznalonev=$_COOKIE['nev'];
    }
}
if(isset($_POST['bejelentkezes']))
{
    if(isset($_POST['lnev']) && isset($_POST['ljelszo']))
    {
        $nev=strip_tags(ucwords(strtolower(trim($_POST['lnev']))));
        $jelszo=strip_tags(trim($_POST['ljelszo'])); 
        $hashjelszo=hash('sha512',$_POST['ljelszo']);
        $sql = "SELECT * FROM cipo.felhasznalok where felhasznalonev = '{$nev}' AND jelszo = '{$hashjelszo}'";
        $vegrehajt=mysqli_query($dbconn, $sql);
        $sorszam=mysqli_num_rows($vegrehajt);
    }
    else
        $hibak[]="A felhasználónév vagy a jelszó mező üresen maradt!";
    if($sorszam>0)
    {
        $sor = mysqli_fetch_assoc($vegrehajt);
        $ok[]="Sikeresen belépett! Üdvözöljük ".$nev."!";
        $egyev=time()+(365*24*60*60);
        if(isset($_POST['emlekezz']) && $_POST['emlekezz'] == 1)
        {
            setcookie("allapot",true,$egyev);
            setcookie("id",$sor['id'],$egyev);
            setcookie("nev",$sor['felhasznalonev'],$egyev);
        }
        else
        {
            setcookie("allapot",true);
            setcookie("id",$sor['id']);
            setcookie("nev",$sor['felhasznalonev']);
        }
        $alapallapot=true;
        $id=$sor['id'];
    }
    else
        $hibak[]="A megadott felhasználónév vagy jelszó helytelen!";   
}

// megnézi hogy van e cipője az adott felhasználónak
if($alapallapot||$allapot==1)
{
    $sql="SELECT * FROM cipo.felhasznalok_cipoi WHERE felhasznalo_id='{$id}'";
    $vegrehajt=mysqli_query($dbconn, $sql);
    $sorszam=mysqli_num_rows($vegrehajt);
    if($sorszam>0)
    {
        $allapotl=true;
    }
    else
        $allapotl=false;
}

?>