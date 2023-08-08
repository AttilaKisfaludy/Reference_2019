<?php
if(isset($_POST['nevatiras']))
{
    if(isset($_POST['felhazon'])&& isset($_POST['cnevsz'])&&isset($_POST['azon']))
       {
          $ujcipoNeve=strip_tags(ucwords(strtolower(trim($_POST['cnevsz']))));
          $felhid=$_POST['felhazon'];
          $id=$_POST['azon'];
          $sql="UPDATE cipo.felhasznalok_cipoi SET ciponev='{$ujcipoNeve}' WHERE id= '{$id}' AND felhasznalo_id= '{$felhid}'";
          if(mysqli_query($dbconn, $sql)===FALSE)
          {
              $hibak[]="Átnevezés sikertelen!";
          }
         header("Location:cipoim.php");
       }

}
?>