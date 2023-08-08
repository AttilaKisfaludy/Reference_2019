<?php
header("Content-Type:text/html;charset=utf-8");
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","cipo");
$dbconn=@mysqli_connect(DBHOST,DBUSER,DBPASS);


if($dbconn== false)
{
   die("Nem sikerült kapcsolódni az adatbázishoz!".mysqli_connect_error());
}

//adatbázis létrehozása ha nem létezik
$sql = "CREATE DATABASE IF NOT EXISTS ".DBNAME." DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_hungarian_ci";
mysqli_query($dbconn,$sql);
$dbconn=@mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
mysqli_query($dbconn,"SET NAMES utf8");
//felhasznalok tábla létrehozása
$sql="CREATE TABLE IF NOT EXISTS cipo.felhasznalok(
id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
felhasznalonev VARCHAR(30) NOT NULL,
jelszo VARCHAR(128) NOT NULL,
email VARCHAR(50) NOT NULL,
neme VARCHAR(5) NOT NULL,
regisztracio TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci";
if(mysqli_query($dbconn,$sql)===FALSE)
{
    $fatal[]="Hiba lépett fel a felhasználók tábla létrehozásakor!";
}

//reszek tábla létrehozása
$sql="CREATE TABLE IF NOT EXISTS cipo.reszek(
id INT(2) NOT NULL PRIMARY KEY,
neve VARCHAR(30) NOT NULL
)DEFAULT CHARACTER SET=utf8 COLLATE = utf8_hungarian_ci";
if(mysqli_query($dbconn,$sql)===FALSE)
{
    $fatal[]="Hiba lépett fel a részek tábla létrehozásakor!";
}
//anyagok tábla létrehozása
$sql="CREATE TABLE IF NOT EXISTS cipo.anyagok(
id INT(2) NOT NULL PRIMARY KEY,
neve VARCHAR(60) NOT NULL
)DEFAULT CHARACTER SET=utf8 COLLATE=utf8_hungarian_ci";
if(mysqli_query($dbconn,$sql)===FALSE)
{
    $fatal[]="Hiba lépett fel az anyagok tábla létrehozásakor!";
}

//cipo tábla létrehozása
$sql="CREATE TABLE IF NOT EXISTS cipo.cipok(id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
reszek_id INT(2) NOT NULL,
szin VARCHAR(20) NOT NULL,
anyagok_id INT(2) NOT NULL,
felhasznalo_id INT(6) NOT NULL,
ciponev_id INT(6) NOT NULL,
CONSTRAINT emberek_kapcs FOREIGN KEY (felhasznalo_id) REFERENCES felhasznalok(id),
CONSTRAINT ciponev_kapcs FOREIGN KEY (ciponev_id) REFERENCES felhasznalok_cipoi(id),
CONSTRAINT reszek_kapcs FOREIGN KEY (reszek_id) REFERENCES reszek (id),
CONSTRAINT anyagok_kapcs FOREIGN KEY (anyagok_id) REFERENCES anyagok (id)
)DEFAULT CHARACTER SET=utf8 COLLATE=utf8_hungarian_ci";
if(mysqli_query($dbconn,$sql)===FALSE)
{
    $fatal[]="Nem sikerült létrehozni a cipők táblát!";
}

//felhasznalokcipoi tábla létrehozása
$sql="CREATE TABLE IF NOT EXISTS cipo.felhasznalok_cipoi(id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
ciponev VARCHAR(20) NOT NULL,
felhasznalo_id INT(6) NOT NULL
)DEFAULT CHARACTER SET=utf8 COLLATE=utf8_hungarian_ci";
if(mysqli_query($dbconn,$sql)===FALSE)
{
    $fatal[]="Nem sikerült létrehozni a felhasználók cipői táblát!";
}


//részek tábla feltöltése
$tomb=array("","talp_taban001","sarkantyu_arka001","orr_Box002","oldalsav_gri001","oldala_002","nyelv_dil001","korjobb_Circle011","korbal_Circle014","fuzo3_Arc006","fuzo2_Arc005","fuzo1_Arc004","diszcsik_Line002");
for($i=1;$i<13;$i++)
{
    $sql="INSERT IGNORE INTO cipo.reszek (id,neve) VALUES ('{$i}','{$tomb[$i]}')";
    if(mysqli_query($dbconn,$sql)===FALSE)
    {
        $fatal[]="Hiba lépett fel a részek tábla feltöltésekor!";
        break;
    }
}
//anyagok tábla feltöltése
$tomb=array("","media/textura/bor.jpg","media/textura/gyapju.jpg","media/textura/bronson.jpg","media/textura/bronson1.jpg","media/textura/kotottrombusz.jpg","media/textura/fur.jpg","media/textura/gumi.jpg","media/textura/egyedi2.jpg","media/textura/farmer.jpg","media/textura/szott.jpg","1");
for($i=1;$i<12;$i++)
{
    $sql="INSERT IGNORE INTO cipo.anyagok (id,neve) VALUES ('{$i}','{$tomb[$i]}')";
    if(mysqli_query($dbconn,$sql)===FALSE)
    {
        $fatal[]="Hiba lépett fel az anyagok tábla feltöltésekor!";
        break;
    }
}
?>