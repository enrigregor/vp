<?php
 require("../../../config.php");
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
<a href="home.php">Tagasi kodulehele</a>
<hr>
<?php echo $ideahtml; ?>