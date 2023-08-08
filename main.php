<!Doctype html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alkosd meg saját cipődet!</title>
        <link rel="stylesheet" href="W3.css">
        <link rel="stylesheet" href="my.css">
        <script type="text/javascript" src="script/script.js"></script>
        <script type="text/javascript" src="regisztracio.php"></script>
    </head>
    <body>
        <?php
        include("PHP/kapcsolat.php");
        include("PHP/regisztracio.php");
        include("PHP/bejelentkezes.php");
        include("PHP/kijelentkezes.php");
        ?>
        <!-- megjelenites gepen-->
        <nav class="w3-top">
        <div id="savmenu" class="savmenu w3-white w3-animate-right w3-bar w3-row-padding w3-hide-small w3-padding-small w3-container">
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
                    <p class="mutato w3-block w3-button w3-left-align" id="regisztracio" onclick="regmenu()">Regisztráció</p>
                    <div class="regisztracio w3-card w3-padding-small" id="reg">
                        <form method="post" action="">
                            Felhasználó név:<br>
                            <input type="text" name="nev" maxlength="30" minlength="5" required><br>
                            Jelszó:<br>
                            <input type="password" name="jelszo" minlength="8" required><br>
                            Jelszó ismét:<br>
                            <input type="password" name="jelszo2" minlength="8" required><br>
                            e-mail cím:<br>
                            <input type="email" name="email" maxlength="50" required><br>
                            Neme:<br><br>
                            <label for="ferfi">Férfi</label><input type="radio" id="ferfi" value="ferfi" name="neme" required><label for="no">Nő</label><input type="radio" name="neme" id="no" value="no" required><br><br>
                            <input class="gombok" name="regisztral" type="submit" value="Regisztráció"><br>
                            <input class="gombok" type=reset value="Vissza" onclick="regmenu()">
                        </form>
                    </div>
                    <p class="mutato w3-block w3-button w3-left-align" id="bejelentkezes" onclick="bejmenu()">Bejelentkezés</p>
                    <div class="regisztracio w3-card w3-padding-small" id="bej">
                        <form method="post" action="">
                            Felhasználó név:<br>
                            <input type="text" name="lnev" required><br>
                            Jelszó:<br>
                            <input type="password" name="ljelszo" required><br><br>
                            <label for="check">Emlékezz rám:</label>
                            <input type="checkbox" id="check" name="emlekezz" value="1"><br><br>
                            <input class="gombok" type="submit" name="bejelentkezes" value="Bejelentkezés"><br>
                            <input class="gombok" type="reset" value="Vissza" onclick="bejmenu()"><br>
                        </form>
                    </div>
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
                <a href="konfigurator.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Konfigurátor</a>
                <a href="galeria.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Galéria</a>
                <div id="cipoimmenurejtTel">
                <a href="cipoim.php" class="w3-bar-item w3-button w3-center" onclick="legorduloTelefon()">Cipőim</a>
                </div>
                </div>
            <div id="telregmenurejt" class="w3-card w3-hide attetszo w3-white w3-hide-large w3-animate-bottom w3-hide-medium">
                    <p class=" w3-button w3-dropdown-click w3-bar" id="regisztraciotel" onclick="telReglenyilo()">Regisztráció</p>
                    <div class="regisztracio w3-card w3-hide w3-block w3-dropdown-content w3-animate-opacity w3-center " id="regtel">
                        <form method="post" action="">
                            Felhasználó név:<br>
                            <input type="text" name="nev" maxlength="30" minlength="5" required><br>
                            Jelszó:<br>
                            <input type="password" name="jelszo" minlength="8" required><br>
                            Jelszó ismét:<br>
                            <input type="password" name="jelszo2" minlength="8" required><br>
                            e-mail cím:<br>
                            <input type="email" name="email" maxlength="50" required><br>
                            Neme:<br><br>
                            <label for="ferfi">Férfi</label><input type="radio" id="ferfi" value="ferfi" name="neme" required><label for="no">Nő</label><input type="radio" name="neme" id="no" value="no" required><br><br>
                            <input class="gombok" name="regisztral" type="submit" value="Regisztráció"><br>
                            <input class="gombok" type=reset value="Vissza" onclick="telReglenyilo()">
                        </form>
                    </div>
                    <p class=" w3-button w3-dropdown-click w3-bar" id="bejelentkezestel" onclick="telBejlenyilo()">Bejelentkezés</p>
                    <div class="regisztracio w3-card w3-hide w3-block w3-dropdown-content w3-animate-opacity w3-center" id="bejtel">
                        <form method="post" action="">
                            Felhasználó név:<br>
                            <input type="text" name="lnev" required><br>
                            Jelszó:<br>
                            <input type="password" name="ljelszo" required><br><br>
                            <label for="check">Emlékezz rám:</label>
                            <input type="checkbox" id="check" name="emlekezz" value="1"><br><br>
                            <input class="gombok" type="submit" name="bejelentkezes" value="Bejelentkezés"><br>
                            <input class="gombok" type="reset" value="Vissza" onclick="telBejlenyilo()"><br>
                        </form>
                    </div>
            </div>
        </nav>
        <form method="post">
            <input type="submit" class="rejtett" id="kij" name="kijelentkez">
        </form>
        <div class="uzenetsav w3-animate-opacity w3-display-container" id="savmegjelenit"><p class="szovegmeret" id="szoveg" >Hiba</p><img class=" w3-hide-small w3-hide-medium" id="jelzokep" src="media/ikonok/hiba.png"></div>

        <nav id="balmenu" class="w3-display-top balmenu w3-hide-small w3-animate-zoom w3-white" onmouseover="menujelzes()" onmouseout="menujelvissza()">
            <div id="atvaltas">
            <a href="konfigurator.php">Konfigurátor</a>
            <a href="galeria.php">Galéria</a>
          <div id="cipoimmenurejt">
            <a href="cipoim.php">Cipőim</a>
          </div>
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
            document.getElementById("szoveg").innerHTML="<?php echo $hiba;?>";
            document.getElementById("telmenu").style.borderBottomLeftRadius="0px";
            document.getElementById("telmenu").style.borderBottomRightRadius="0px";
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
            document.getElementById("szoveg").innerHTML="<?php echo $rendben;?>";
            document.getElementById("telmenu").style.borderBottomLeftRadius="0px";
            document.getElementById("telmenu").style.borderBottomRightRadius="0px";
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
        if($allapot==1||$alapallapot)
        {
            ?>
            <script type="text/javascript">
                var eltuntet=document.getElementById("regisztracio");
                var eltuntet2=document.getElementById("regisztraciotel");
                document.getElementById("bejelentkezes").innerHTML="Kijelentkezés";
                document.getElementById("bejelentkezestel").innerHTML="Kijelentkezés";
                document.getElementById("bejelentkezes").setAttribute('onclick','kijelentkezes()');
                document.getElementById("bejelentkezestel").setAttribute('onclick','kijelentkezes()');
                eltuntet.className+=" w3-hide";
                eltuntet2.className+=" w3-hide";
                <?php
                if($allapotl)
                {
                    ?>
                    document.getElementById("cipoimmenurejt").style.display= "block";
                    document.getElementById("cipoimmenurejtTel").style.display= "block";
                    <?php
                }
                if($alapallapot)
                    {
                    ?>
                        var datum=new Date();
                        var ora=datum.getHours();
                        if(ora<10)
                            document.getElementById("udvozol").innerHTML="Jó reggelt <?php echo $nev;?>!";
                        else if(ora<18)
                            document.getElementById("udvozol").innerHTML="Szép napot <?php echo $nev;?>!";
                        else if(ora<=23||ora<4)
                            document.getElementById("udvozol").innerHTML="Jó estét <?php echo $nev;?>!";
                        
                        function visszaallit()
                        {
                            document.getElementById("udvozol").innerHTML="<?php echo $nev;?>"; 
                        }
                        setTimeout(visszaallit,5000);
                <?php
                    }
                    else
                    {
                        ?>
                        document.getElementById("udvozol").innerHTML="<?php echo $felhasznalonev;?>";
                        <?php
                    }
                    ?>
                        
                
                function kijelentkezes()
                {
                    document.getElementById("kij").click();    
                }
            </script>
            <?php
            
        }
        ?>
        <div class="hatter1 w3-display-container">
        <video src="media/Hatter/JoyousGlisteningHawk.webm" width='100%' height='100%' autoplay  ></video>
              <div class="w3-display-middle" style="white-space:nowrap;">
    <span class=" w3-center w3-circle w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">Alkosd meg egyedi cipőd</span>
  </div>
    </div>
        <div class="w3-content w3-container w3-padding-64">
  <h3 class="w3-center">Cipő Galaxis</h3>
  <p class="w3-center"><em>A te galaxisod... a te cipőd</em></p>
  <p>Bemutatkozik Ön előtt a végtelenségig testreszabható univerzális cipő. Gondolt már arra, hogy milyen lenne az élete egy saját ízlése álltal összerakott cipőben megjelenni munkahelyén vagy akár kedvenc időtöltése közben? Most megalkodhatja álmai cipőjét a legújabb cipő konfigurátor segítségével a Cipő Galaxissal.</p>
  <div class="">
    <div class="w3-row m6 w3-center w3-padding-large">
      <img src="media/kepek/1.png" class="w3-round w3-third w3-image" width="500" height="333">
      <img src="media/kepek/2.png" class="w3-round w3-third w3-image" width="500" height="333">
      <img src="media/kepek/3.png" class="w3-round w3-third w3-image" width="500" height="333">
    </div>
    </div>
        </div>
            <div class=" w3-content w3-container m6">
            <h3 class="w3-left">Kézreálló konfigurátor</h3>
            <br><br>
      <p>Konfigurátorunk segítségével könnyedén változtathatja meg cipője kinézetét. Legyen szó akár textúrájáról, akár színéről. Cipőjét ugyan nem tudja majd felpróbálni, de a fejlett technológiának köszönhetően, digitálisan szinte egy karnyújtásnyira van a cipője.<img src="media/kepek/4.png" class="w3-round w3-third w3-right w3-image" width="500" height="333"> Összesen 10 féle textúra közül választhat a textúra kapszulából, mindegyik az adott cipő részéhez megfelelően fog megjelenni.A textúrák magas felbontásának köszönhetően közelről, illetve távolról is a valódi cipő hatását kelti. A színösszeállításról egy színkör gondoskodik megközelítőleg 16 millió szín közűl választhat, illetve a szín sötétségét is testreszabhatja.Cipőjének 12 különböző részét ezekkel a lehetőségekkel ruházhatja fel. Jelenleg egy cipő modellt tartalmaz a konfigurátor, de a jövőben bővebb kínálattal szolgálunk.</p>
    </div>
    <div class="hatter2 w3-display-container w3-opacity-min">
    <div class="w3-display-middle">
    <span class="w3-xxlarge w3-text-white w3-wide">CIPŐTÁROLÓ</span>
    </div>
        </div>
    <div class="w3-content w3-container w3-padding-64" id="portfolio">
  <h3 class="w3-center">Tárolja el elkészített cipőit</h3>
  <p>Virtuális cipői sosem kopnak el, ezért az idők végezetéig tárolhatjuk őket. Miután a profilkezelő felületen sikeresen regisztrált, igénybe veheti a Cipő Galaxis további funkcióit. Miután elkészült gondosan összerakott cipőjével, elmentheti név adást követően. Mentés után automatikusan bekerül a cipő virtuális szekrényébe, amely bejelentkezés után megnyílik. Virtuális szekrényében jelenleg annyi cipőt tárolhat, ahány csillag van az égen. Véletlenül bezárta az oldalt? Fontos tehendője volt? A Cipő Galaxis megjegyzi a legutóbbi állását a konfigurátorban és ott folytathatja cipőjének a szerkesztését, ahol abbahagyta. Ha szeretne megszabadulni jelenleg szerkesztett cipőjétől, akkor szemetes gombra kattintva törölheti.</p>
        </div>
    <div class="hatter3 w3-display-container">
  <div class="w3-display-middle">
 <span class=" w3-xxlarge w3-text-white w3-wide">ÖN A FŐNÖK</span>
  </div>
</div>
<div class="w3-content w3-container w3-padding-64" id="contact">
  <h3 class="w3-center">Tartsa számon cipőit</h3>
  <p>Cipőinek könnyebb elérése érdekében létrehoztuk önnek a "Cipőim" menüpontot. Itt megtalálja az összes létrehozott és elmentett cipőjét. Ha nem tart már igényt a kiválasztott cipőre, akkor képes végleg eltávolítani cipői közül. Változott az ízlése? Nem tetszik a régebben létrehozott cipő? Szerkessze újra! A szerkesztés gomb segítségével lekérheti a listából az adott cipőjét és módosíthatja, majd újra elmentheti. Módosította cipője színét, de már nem passzol a nevéhez? A lehetőségek közűl megtalálja a Név átírást is, amely segítségével bármikor átírhatja a kiválasztott cipője nevét.</p><img src="media/kepek/10.png" class="w3-round w3-third w3-left w3-image" width="500" height="333">
<p>Vágjon is bele azonnal! A bal oldali menüsávon megtalálhatja a konfigurátort. Nincs ötlete? Nézzen be a Galériánkba, itt meríthet ötleteket saját cipőjéhez!</p>
</div>
    </body>
</html>