<?php
if(isset($_POST['cipoMentese']))
{
    if(isset($_COOKIE['allapot']))
    {
        if($_COOKIE['allapot']==1)
        {
            if(isset($_POST['cnev']))
            {
                $cipoanyagok=json_decode($_COOKIE['anyagokkonf'],true);
                $ciposzinek=json_decode($_COOKIE['szinekkonf'],true);
               $cipoNeve=strip_tags(ucwords(strtolower(trim($_POST['cnev']))));
                $sql="SELECT * FROM cipo.felhasznalok WHERE id= '{$id}' AND felhasznalonev= '{$felhasznalonev}'";
                $vegrehajt=mysqli_query($dbconn, $sql);
                $sorszam=mysqli_num_rows($vegrehajt);
                
                if($sorszam==1)
                {
                $sql= "SELECT * FROM cipo.felhasznalok_cipoi WHERE ciponev='{$cipoNeve}' AND felhasznalo_id='{$id}'";
                $eredmeny=mysqli_query($dbconn,$sql);
                $osszeszamol=mysqli_num_rows($eredmeny);
                
                if($osszeszamol==0)
                {
                    $sql="INSERT INTO cipo.felhasznalok_cipoi (ciponev,felhasznalo_id) VALUES('{$cipoNeve}','{$id}')";
                    if(mysqli_query($dbconn,$sql)===FALSE)
                    {
                    $hibak[]="Mentés sikertelen! Próbálja újra később!";
                    }
                
                    for($i=0;$i<count($cipoanyagok);$i++)
                        {
                        $db=$i+1;
                        $sql="INSERT INTO cipo.cipok (reszek_id,szin,anyagok_id,felhasznalo_id,ciponev_id) VALUES((SELECT id FROM cipo.reszek WHERE id='{$db}'),'{$ciposzinek[$i]}',(SELECT id FROM cipo.anyagok WHERE neve='{$cipoanyagok[$i]}'),'{$id}',(SELECT id FROM cipo.felhasznalok_cipoi WHERE ciponev='{$cipoNeve}' AND felhasznalo_id='{$id}'))";
                        if(mysqli_query($dbconn,$sql)===FALSE)
                            {
                                $hibak[]="Mentés sikertelen! Próbálja újra később!";
                            }                        
                        }
                        $ok[]="A cipőjét sikeresen eltároltuk!";
                }
                else
                    $hibak[]="Egy cipőjének már ez a neve! Kérem válasszon másikat!";
                
            }
            }
            else
                $hibak[]="Mentés sikertelen! Üresen maradt a név mező.";
            
           
        }
        else
            $hibak[]="Mentés sikertelen! Ön nincs bejelentkezve.";
    }
    else
        $hibak[]="Mentés sikertelen! Sütik le vannak tiltva.";
}
?>