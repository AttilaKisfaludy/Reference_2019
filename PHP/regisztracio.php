<?php
header("Content-Type:text/html;charset=utf-8");
if(isset($_POST['regisztral']))
{
  $nev=strip_tags(ucwords(strtolower(trim($_POST['nev']))));
  $jelszo=strip_tags(trim(hash('sha512',$_POST['jelszo']))); 
  $email=strip_tags(strtolower(trim($_POST['email'])));
    if (empty($nev)||strlen($nev)<5||strlen($nev)>30)
        $hibak[]="A kiválaszott név hossza nem megfelelő! (kikötések: min 5 max 30)";
    if($_POST['jelszo']!=$_POST['jelszo2'])
        $hibak[]="A két jelszónak meg kell egyeznie!";
    if(empty($jelszo)||empty($_POST['jelszo'])||strlen($jelszo)<8)
        $hibak[]="A kiválasztott jelszó hossza nem megfelelő! (kikötések: nem lehet üres. min:8)";
    if(empty($email)||!filter_var($email,FILTER_VALIDATE_EMAIL))
        $hibak[]="A kiválasztott e-mail cím színtaktikája helytelen!";
    if(isset($_POST['neme']))
    {
        $neme=$_POST['neme'];
    }
    else
        $hibak[]="Nem választotta ki a nemét!";
    
    $sql= "SELECT * FROM cipo.felhasznalok WHERE felhasznalonev='{$nev}'";
    $eredmeny=mysqli_query($dbconn,$sql);
    $osszeszamol=mysqli_num_rows($eredmeny);
    
    if (isset($hibak))
    {
        echo "hiba";
    }
    else
    {
        if($osszeszamol<1)
        {
            $sql="INSERT INTO cipo.felhasznalok (felhasznalonev,jelszo,email,neme) VALUES ('{$nev}','{$jelszo}','{$email}','{$neme}')";
            if(mysqli_query($dbconn,$sql)===TRUE)
            {
                $ok[]="Sikeresen regisztrált!";
            }  
        }
        else
            $hibak[]="Ilyen nevű felhasználó már létezik!";
    }
}
?>