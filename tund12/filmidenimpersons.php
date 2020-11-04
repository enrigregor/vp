<?php
require("../../../config.php");
require("usesession.php");
require("fnc_filmrelations.php");
  
  $sortby = 0;
  $sortorder = 0;
  
  require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <html lang="et">
  <p>Filmide nimekiri<p>
  <ul>
   <li><a href="home.php">Avaleht</a></li>
  </ul>
  <li><a href="?logout=1">Logi välja!</a></li>
  <hr>
  <?php
    if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
		if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 5){
			$sortby = intval($_GET["sortby"]);
		}
		if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
			$sortorder = intval($_GET["sortorder"]);
		}
	}
    echo readpersoninmovie($sortby, $sortorder);
  ?>
</body>
</html>
