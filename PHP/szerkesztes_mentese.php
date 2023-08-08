<?php
include("kapcsolat.php");
include("bejelentkezes.php");
include("szerkesztes.php");
$idcnev=$_COOKIE['cipo'];
if(isset($_COOKIE['allapot']))
{
    if($_COOKIE['allapot']==1)
    {
        $cipoanyagok=json_decode($_COOKIE['anyagok'],true);
        $ciposzinek=json_decode($_COOKIE['szinek'],true);
        setcookie("anyagok","",time()-3600);
        setcookie("szinek","",time()-3600);
        setcookie("cipo","",time()-3600);
        $sql="SELECT * FROM cipo.felhasznalok WHERE id= '{$id}' AND felhasznalonev= '{$felhasznalonev}'";
        $vegrehajt=mysqli_query($dbconn, $sql);
        $sorszam=mysqli_num_rows($vegrehajt);
        if($sorszam==1)
        {
            for($i=0;$i<count($cipoanyagok);$i++)
            {
                $db=$i+1;
                $sql="UPDATE cipo.cipok SET cipok.szin='{$ciposzinek[$i]}', cipok.anyagok_id=(SELECT id FROM cipo.anyagok WHERE anyagok.neve='{$cipoanyagok[$i]}') WHERE cipok.reszek_id='{$db}' AND cipok.ciponev_id='{$idcnev}'";
            if(mysqli_query($dbconn,$sql)===FALSE)
                {
                    $hibak[]="Módosítás sikertelen! Próbálja újra később!";
                }                        
            }
            $ok[]="A cipőjét sikeresen módosította!";
        }

    }
    else
        $hibak[]="Mentés sikertelen! Ön nincs bejelentkezve.";
}
else
    $hibak[]="Mentés sikertelen! Sütik le vannak tiltva.";
header("Location:../cipoim.php");
?>