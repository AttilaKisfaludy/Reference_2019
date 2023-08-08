<?php
include("atiras.php");
$sql="SELECT * FROM cipo.felhasznalok_cipoi WHERE felhasznalo_id='{$id}'";
$vegrehajt=mysqli_query($dbconn,$sql);
setcookie("anyagok","",time()-3600);
setcookie("szinek","",time()-3600);
$kimenet="<div><table class=' w3-container w3-center w3-display-middle  w3-responsive'>
<tr>
    <th colspan='6'>Cipő neve</th>
    </tr>";
while ($sor=mysqli_fetch_assoc($vegrehajt)) //asszociatív tömbbe helyezi addig megy amíg van adat
{
    $kimenet.="<tr class='sor'>
            <td>{$sor['ciponev']}</td>
            <td><div class='rejt' id={$sor['id']}><form method='post'><input type='text' minlength='3' maxlength='20' name='cnevsz' required><input type='submit' id='{$sor['id']}' class='rejtett' name='nevatiras'><input type='hidden' value='{$sor['id']}' name='azon'><input type='hidden' value='{$sor['felhasznalo_id']}' name='felhazon'></form><img class='ikon' src='media/ikonok/atir.png' onclick='atiranyit({$sor['id']})'></div></td>
            <td><a href=\"PHP/torles.php?id={$sor['id']}\"><img class='ikon' src='media/ikonok/kuka_lista.png'></a></td>
            <td><img class='ikon' id='modosit' src='media/ikonok/atir_lista.png' onclick='atiras({$sor['id']})'></td>
            <td><img class='ikon' src='media/ikonok/bemutato_lista.png'></td>
            <td><a href=\"PHP/szerkesztes.php?id={$sor['id']}\"><img class='ikon' src='media/ikonok/szerkeszt_lista.png'></a></td>
            </tr>";
}
$kimenet.="</table>";
?>
<script type="text/javascript">

function atiras(sorok)
    {
        var hossz=document.querySelectorAll(".rejt");
        for(var i=0;i<hossz.length;i++)
            {
                if(hossz[i].id==sorok)
                    {
                        if(hossz[i].style.visibility=="visible")
                            hossz[i].style.visibility="hidden";
                        else
                            hossz[i].style.visibility="visible";
                    }
                else
                    hossz[i].style.visibility="hidden";
            }
    }
    
function atiranyit(sorszam)
    {
        var hossz=document.querySelectorAll(".rejtett");
        for(var i=0;i<hossz.length;i++)
            {
                if(hossz[i].id==sorszam)
                    {
                        hossz[i].click();
                    }
            }

    }
</script>