<?php
require("../../../config.php");
require("usesession.php");
$username = "Enri Gregor";

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
<?php echo $filmhtml; ?>
</body>
</html>
