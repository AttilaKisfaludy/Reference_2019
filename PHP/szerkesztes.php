<?php
if(isset($_GET['id']))
{
    require("kapcsolat.php");
    $idcnev=(int)$_GET['id'];
    setcookie("cipo",$idcnev);
    $sql="SELECT reszek.neve AS 'reszek',szin,anyagok.neve AS 'anyagok' FROM ((cipo.cipok INNER JOIN cipo.reszek ON cipok.reszek_id=reszek.id)INNER JOIN cipo.anyagok ON cipok.anyagok_id=anyagok.id) WHERE ciponev_id='{$idcnev}'";
    $vegrehajt=mysqli_query($dbconn, $sql);
    $sorszam=mysqli_num_rows($vegrehajt);
    if($sorszam>0)
    {
        $i=0;
        while($egysor=mysqli_fetch_assoc($vegrehajt))
        {
            $cipoanyagok[$i]=$egysor["anyagok"];
            $ciposzinek[$i]=$egysor["szin"];
            $i++;
        }
    }
    else
        {
        $hiba[]="Hiba lépett fel. Próbálja újra!";
        header("Location:../cipoim.php");
        }
}
?>
<script type="text/javascript">
    var anyagokTomb=<?php echo json_encode($cipoanyagok);?>;
    var szinekTomb=<?php echo json_encode($ciposzinek);?>;
    var szovegesitesAnyagok=JSON.stringify(anyagokTomb);
    var szovegesitesSzinek=JSON.stringify(szinekTomb);
    document.cookie="anyagok=;expires=Thu, 18 Dec 1900 12:00:00 UTC";
    document.cookie="szinek=;expires=Thu, 18 Dec 1900 12:00:00 UTC";
    document.cookie="anyagok="+szovegesitesAnyagok+"; expires=Thu, 18 Dec 2100 12:00:00 UTC; path=/";
    document.cookie="szinek="+szovegesitesSzinek+"; expires=Thu, 18 Dec 2100 12:00:00 UTC; path=/";
    window.location.replace("../konfigurator_szerk.php");
</script>