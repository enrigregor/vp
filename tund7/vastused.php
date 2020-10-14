<?php

 require("../../../config.php");
 require("usesession.php");
 $database = "if20_enri_rii";
 $ideahtml = "";
 $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
 $stmt = $conn->prepare("SELECT idea FROM myideas");
 //seon tulemuse muutujaga
 $stmt->bind_result($ideafromdb);
 $stmt->execute();
 while($stmt->fetch()) {
	 $ideahtml .= "<p>" .$ideafromdb ."</p>";
 }
 $stmt->close();
 $conn->close();
?>
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<a href="home.php">Tagasi kodulehele</a>
<hr>
<p><a href="?logout=1">Logi välja!</p>
<?php echo $ideahtml; ?>