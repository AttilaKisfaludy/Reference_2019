<!doctype html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <title>Alkosd meg saját cipődet!</title>
        <link rel="stylesheet" href="W3.css">
        <link rel="stylesheet" href="my.css">
        <link rel="stylesheet" href="my_konfigurator.css">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    </head>
    <body onresize="szinkorMeretez()">
        <script type="text/javascript" src="script/three.js"></script>
        <script type="text/javascript" src="script/GLTFLoader.js"></script>
        <script type="text/javascript" src="script/OrbitControls.js"></script>
        <script type="text/javascript" src="script/iro.js"></script>
        <script type="text/javascript" src="script/script_konf_szerk.js"></script>
        <script type="text/javascript" src="script/script.js"></script>
        
        <?php
        include("PHP/kapcsolat.php");
        include("PHP/bejelentkezes.php");
        include("PHP/kijelentkezes.php");
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
                <a href="cipoim.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Cipőim</a>
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
            <a href="cipoim.php">Cipőim</a>
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
            ?>
        <canvas id="vaszon"></canvas>
        <div class="szinDoboz w3-animate-opacity" id="elrejt"></div>
        <div class="cipoGombokKerete">
            <div class="cipoGombok" title="Cipő orr" alt="Cipő orr" id="orr_Box002">
                <img src="media/cipo_ikonok/orr.png">
            </div>
            <div class="cipoGombok" title="Cipő talp" alt="Cipő talp" id="talp_taban001">
                <img src="media/cipo_ikonok/talp.png">
            </div>
            <div class="cipoGombok" title="Cipő oldala" alt="Cipő oldala" id="oldala_002">
                <img src="media/cipo_ikonok/oldala_egesz.png">
            </div>
            <div class="cipoGombok" title="Cipő oldalsáv" alt="Cipő oldalsáv" id="oldalsav_gri001">
                <img src="media/cipo_ikonok/oldala.png">
            </div>
            <div class="cipoGombok" title="Gumicsík" alt="Gumicsík" id="diszcsik_Line002">
                <img src="media/cipo_ikonok/diszcsik.png">
            </div>
            <div class="cipoGombok" title="Cipő sarok" alt="Cipő sarok" id="sarkantyu_arka001">
                <img src="media/cipo_ikonok/sarok.png">
            </div>
            <br>
            <br>
            <div class="cipoGombok" title="Cipő nyelv" alt="Cipő nyelv" id="nyelv_dil001">
                <img src="media/cipo_ikonok/nyelv.png">
            </div>
            <div class="cipoGombok" title="Felső fűző" alt="Felső fűző" id="fuzo1_Arc004">
                <img src="media/cipo_ikonok/fuzo1.png">
            </div>
            <div class="cipoGombok" title="Középső fűző" alt="Középső fűző" id="fuzo2_Arc005">
                <img src="media/cipo_ikonok/fuzo2.png">
            </div>
            <div class="cipoGombok" title="Alsó fűző" alt="Alsó fűző" id="fuzo3_Arc006">
                <img src="media/cipo_ikonok/fuzo3.png">
            </div>
            <div class="cipoGombok" title="Bal oldali cipőfűző lyuk" alt="Jobb oldali cipőfűző lyuk" id="korbal_Circle014">
                <img src="media/cipo_ikonok/fuzo_kor.png">
            </div>
            <div class="cipoGombok" title="Jobb oldali cipőfűző lyuk" alt="Jobb oldali cipőfűző lyuk" id="korjobb_Circle011">
                <img src="media/cipo_ikonok/fuzo_kor_jobb.png">
            </div>
        </div>
        
        <div class="cipoGombokKereteJobbra w3-animate-opacity" id="fehergomb">
        <div class="fehergomb">Fehér<br>szín</div>
        </div>
        
        <div class="gombKeretOk w3-animate-zoom" id="ok">
         <div class="okgomb" onclick="mentes()"><img src="media/ikonok/kesz.png"></div>
        </div>
        <div class="texturaKeret w3-animate-zoom" id="kerekit">
            <div class="texturaValasztas" alt="Bőr" title="Bőr" id="media/textura/bor.jpg"><img src="media/textura/bor.jpg"></div>
            <div class="texturaValasztas" alt="Gyapjú" title="Gyapjú" id="media/textura/gyapju.jpg"><img src="media/textura/gyapju.jpg"></div>
            <div class="texturaValasztas" alt="Farmer" title="Farmer" id="media/textura/bronson.jpg"><img src="media/textura/bronson.jpg"></div>
            <div class="texturaValasztas" alt="Bronson" title="Bronson" id="media/textura/bronson1.jpg"><img src="media/textura/bronson1.jpg"></div>
            <div class="texturaValasztas" alt="Kötött" title="Kötött" id="media/textura/kotottrombusz.jpg"><img src="media/textura/kotottrombusz.jpg"></div>
            <div class="texturaValasztas" alt="Szőrme" title="Szőrme" id="media/textura/fur.jpg"><img src="media/textura/fur.jpg"></div>
            <div class="texturaValasztas" alt="Gumi" title="Gumi" id="media/textura/gumi.jpg"><img src="media/textura/gumi.jpg"></div>
            <div class="texturaValasztas" alt="Mintás vászon" title="Mintás vászon" id="media/textura/egyedi2.jpg"><img src="media/textura/egyedi2.jpg"></div>
            <div class="texturaValasztas" alt="Vászon" title="Vászon" id="media/textura/farmer.jpg"><img src="media/textura/farmer.jpg"></div>
            <div class="texturaValasztas" alt="Szőtt" title="Szőtt" id="media/textura/szott.jpg"><img src="media/textura/szott.jpg"></div>
        </div>
    </body>
</html>