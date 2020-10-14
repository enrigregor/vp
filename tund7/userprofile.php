<?php 
 require("../../../config.php");
 require("usesession.php");
 $database = "if20_enri_rii";
 require("fnc_main.php");
 
 $notice="";
 $userdescription=""; //edaspidi püüate andmebaasist lugeda, kui on, kasutate seda väärtust
 //$description="";
 
 if(isset($_POST["profilesubmit"])) {
	 $description = test_input($_POST["descriptioninput"]);
	 $result = storeuserprofile($description, $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
	 //sealt peaks tulema kas "ok" või mingi error
	 if($result == "ok"){
		 $notice = "Kasutajaprofiil on salvestatud!";
		 $_SESSION["bgcolorinput"] = $_POST["bgcolorinput"];
		 $_SESSION["txtcolorinput"] = $_POST["txtcolorinput"];
	 } else {
		 $notice = "Profiili salvestamine ebaõnnestunud!";
	 }
	 
 }
 

 require("header.php");
?>

<ul>
 <li><a href="home.php">Avalehele</a></li>
 <li><a href="?logout=1">Logi välja</a>!</li>
</ul>
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="descriptioninput">Minu lühitutvustus:</label>
	<br>
	<textarea name="descriptioninput" id="descriptioninput" rows="10" cols="80" placeholder="Minu tutvustus ..."><?php echo $userdescription; ?></textarea>
	<br>
	<label for="bgcolorinput">Minu valitud taustavärv: </label>
	<input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["userbgcolor"]; ?>">
	<br>
	<label for="txtcolorinput">Minu valitud tekstivärv: </label>
	<input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["usertxtcolor"]; ?>">
	<br>
	<input type="submit" name="profilesubmit" value="Salvesta profiil!">
	<span><?php echo $notice; ?></span>
  </form>
<hr>

</body>
</html>