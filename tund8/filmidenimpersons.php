<?php
require("../../../config.php");
require("usesession.php");
require("fnc_filmrelations.php");

$sortby = 0;
$sortorder = 0;

require("fnc_film.php");
//loen andmebaasist filmide info
$filmhtml = readfilms();
require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<a href="home.php">Tagasi kodulehele</a>
<hr>
<p><a href="?logout=1">Logi välja!</p>
</ul>
<?php
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
	if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
		$sortby = intval($_GET["sortby"]);
	}
	if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
		$sortorder = intval($_GET["sortorder"]);
	}
}
 echo readpersoninmovie(); 
?>
</body>
</html>
