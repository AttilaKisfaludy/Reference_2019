<!doctype html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alkosd meg saját cipődet!</title>
        <link rel="stylesheet" href="W3.css">
        <link rel="stylesheet" href="my.css">
        <link rel="stylesheet" href="cipoim_stilus.css">
        <script type="text/javascript" src="script/script.js"></script>
    </head>
    <body>
        <?php
        include("PHP/kapcsolat.php");
        include("PHP/bejelentkezes.php");
        include("PHP/kijelentkezes.php");
        include("PHP/listazas.php");
        ?>
        <!-- megjelenites gepen-->
        <nav class="w3-top">
        <div id="savmenu" class=" savmenu w3-white w3-animate-right w3-bar w3-row-padding w3-hide-small w3-padding-small w3-container">
            <img class="ikonok w3-animate-right w3-left" src="media/ikonok/sotet_fel.png" title="Sötét Mód" alt="Sötét Mód" id="sotetVilagos" onclick="sotet()">
            <img class="ikonok w3-animate-right w3-margin-left w3-left" title="Hamarosan érkezik!" alt="Hamarosan érkezik!" src="media/ikonok/kontraszt_inaktiv.png">
            <a href="main.php"><img id="logokep" class="logo w3-image w3-display-middle  w3-hide-small" src="media/Hatter/logo.png"></a>
            <img class="ikonok w3-animate-right w3-right " src="media/ikonok/felhasznalo_inaktiv.png"  title="Profilkezelés" alt="Profilkezelés" id="felhasznalo" onclick="gordulomenu()">
            <img class="ikonok w3-animate-right w3-margin-right  w3-right "  title="Hamarosan érkezik!" alt="Hamarosan érkezik!" src="media/ikonok/kosar_inaktiv.png">
            <p class="udvozles w3-animate-zoom w3-margin-bottom w3-right-align w3-hide-small w3-hide-medium" id="udvozol"></p>
        </div>
                <div class="legodulomenu w3-hide-small">
                <div id="menukapcsolo" class="legordulo-tartalom w3-animate-opacity">
                    <p class="mutato w3-block w3-left-align" id="dinamikus_eltunes"></p>
                    <p class="mutato w3-block w3-button w3-left-align" id="bejelentkezes" onclick="bejmenu()">Bejelentkezés</p>
                </div>
            </div>
            </nav>

        <!-- megjelenites telefonon -->
        <nav class="w3-top">
            <div id="telmenu" class="w3-animate-top savmenu w3-bar kerekitsav w3-white w3-hide-medium w3-hide-large  w3-padding-small">
                <a href="main.php"><img class="logo w3-round  w3-image w3-display-topleft w3-margin-small  w3-hide-medium w3-hide-large" src="media/Hatter/logo.png"></a>
                <img id="menuvalt" class="ikonok w3-animate-zoom telefonmenu w3-hide-medium w3-hide-large w3-margin-left w3-right" src="media/ikonok/menu.png" onclick="legorduloTelefon()">
                <img id="ikoncsere" class="ikonok w3-animate-zoom telefonmenu w3-right w3-hide-medium w3-hide-large" src="media/ikonok/felhasznalo_inaktiv.png" onclick="telRegmenu()">
                </div>
            <div id="telmenuelrejt" class="w3-card attetszo w3-bar-block w3-hide w3-white w3-hide-large w3-hide-medium w3-animate-bottom">
                <a href="main.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Főoldal</a>
                <a href="konfigurator.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Konfigurátor</a>
                <a href="galeria.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Galéria</a>
                </div>
            <div id="telregmenurejt" class="w3-card w3-hide attetszo w3-white w3-hide-large w3-animate-bottom w3-hide-medium">
                    <p class=" w3-button w3-dropdown-click w3-bar" id="bejelentkezestel" onclick="telBejlenyilo()">Bejelentkezés</p>
            </div>
        </nav>
        <form method="post">
            <input type="submit" class="rejtett" id="kij" name="kijelentkez">
        </form>
        <div class="uzenetsav w3-animate-opacity w3-display-container" id="savmegjelenit"><p class="szovegmeret" id="szoveg" >Hiba</p><img class=" w3-hide-small w3-hide-medium" id="jelzokep" src="media/ikonok/hiba.png"></div>

        <nav id="balmenu" class="w3-display-top balmenu w3-hide-small w3-animate-zoom w3-white" onmouseover="menujelzes()" onmouseout="menujelvissza()">
            <div id="atvaltas">
            <a href="main.php">Főoldal</a>
            <a href="konfigurator.php">Konfigurátor</a>
            <a href="galeria.php">Galéria</a>
                <div id="menujel" class="w3-display-middle w3-animate-fading">
                <img id="kepvalt" src="media/ikonok/menujel.png">
                <p>M</p>
                <p>E</p>
                <p>N</p>
                <p>Ü</p>
                <img id="kepvalt2" src="media/ikonok/menujel.png">
                </div>
            </div>
      </nav>
        <?php
        if(isset($hibak))
        {
          foreach($hibak as $hiba)
            {
            ?>
            <script type="text/javascript">
            document.getElementById("savmegjelenit").style.display= "block";
            document.getElementById("savmegjelenit").style.backgroundColor= "red";
            document.getElementById("jelzokep").src= "media/ikonok/hiba.png";
            document.getElementById("telmenu").style.borderBottomLeftRadius="0px";
            document.getElementById("telmenu").style.borderBottomRightRadius="0px";
            document.getElementById("szoveg").innerHTML="<?php echo $hiba;?>";
            function hideMessage() 
            {
                document.getElementById("savmegjelenit").style.display = "none";
                document.getElementById("telmenu").style.borderBottomLeftRadius="25px";
                document.getElementById("telmenu").style.borderBottomRightRadius="25px";
            };
            setTimeout(hideMessage, 2000);
            </script>
            
            <?php
            }
        }
        if(isset($ok))
        {
            foreach($ok as $rendben)
            {
            ?>
            <script type="text/javascript">
            document.getElementById("savmegjelenit").style.display= "block";
            document.getElementById("savmegjelenit").style.backgroundColor= "green";
            document.getElementById("jelzokep").src= "media/ikonok/ok.png";
            document.getElementById("telmenu").style.borderBottomLeftRadius="0px";
            document.getElementById("telmenu").style.borderBottomRightRadius="0px";
            document.getElementById("szoveg").innerHTML="<?php echo $rendben;?>";
            function hideMessage() 
            {
                document.getElementById("savmegjelenit").style.display = "none";
                document.getElementById("telmenu").style.borderBottomLeftRadius="25px";
                document.getElementById("telmenu").style.borderBottomRightRadius="25px";
            };
            setTimeout(hideMessage, 2000);
            </script>
            
            <?php
            }
        }
        if($allapot==1)
        {
            ?>
            <script type="text/javascript">
                document.getElementById("bejelentkezes").innerHTML="Kijelentkezés";
                document.getElementById("bejelentkezestel").innerHTML="Kijelentkezés";
                document.getElementById("bejelentkezes").setAttribute('onclick','kijelentkezes()');
                document.getElementById("bejelentkezestel").setAttribute('onclick','kijelentkezes()');
                <?php
                if($allapotl==false)
                {
                    ?>
                    window.location.href="main.php";
                    <?php
                }
                ?>
                document.getElementById("udvozol").innerHTML="<?php echo $felhasznalonev;?>";
                function kijelentkezes()
                {
                    document.getElementById("kij").click();
                }
            </script>
            <?php
            
        }
        else if(isset($ok))
        {
            ?>
            <script type="text/javascript">
                function visszalep()
                {
                    window.location.href="main.php";
                }
            setTimeout(visszalep,2000);
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
                window.location.href="main.php";
            </script>
            <?php
        }
            print $kimenet;
            ?>
        <div class="w3-animate-right">
            <img class="hatterek" src="media/Hatter/hatter1.jpg">
            <img class="hatterek" src="media/Hatter/hatter2.jpg">
            <img class="hatterek" src="media/Hatter/hatter3.jpg">
            <img class="hatterek" src="media/Hatter/hatter4.jpg">
            <img class="hatterek" src="media/Hatter/hatter5.jpg">
        </div>
<script type="text/javascript">
var index = 0;
kepValt();
function kepValt() {
  var kepek = document.getElementsByClassName("hatterek");
  for (var i = 0; i < kepek.length; i++) 
  {
      
  }
  index++;
  if (index > kepek.length) {index = 1}
        document.body.style.backgroundImage= "url('')";
    document.body.style.backgroundImage="url('"+kepek[index-1].src+"'), linear-gradient(rgba(255,255,255,0.5),rgba(255,255,255,0.5))";

  setTimeout(kepValt, 8000);    
}
</script>
    </body>
</html>