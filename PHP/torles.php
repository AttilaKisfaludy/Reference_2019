<?php
if(isset($_GET['id']))
{
    require("kapcsolat.php");
    $id=(int)$_GET['id'];
    $sql="DELETE FROM cipo.cipok WHERE ciponev_id={$id}";
    mysqli_query($dbconn,$sql);
    $sql="DELETE FROM cipo.felhasznalok_cipoi WHERE id={$id}";
    mysqli_query($dbconn,$sql);
}
header("Location:../cipoim.php");
?>