<?php
require("../../../config.php");
require("fnc_main.php");
require("fnc_user.php");
//$database = "if20_enri_rii";
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
$firstname="";
$lastname="";
$birthday= null;
$birthmonth= null;
$birthyear= null;
$birthdate= null;
$gender="";
$email="";
$notice="";


require("header.php"); 
$firstnameerror="";
$lastnameerror="";
$gendererror="";
$birthdayerror= null;
$birthmontherror= null;
$birthyearerror= null;
$birthdateerror=null;
$emailerror="";
$passworderror="";
$passwordsecondaryerror="";
if(isset($_POST["accountdatasubmit"])) {
	if(strlen($_POST["passwordinput"]) < 8) {
	$passworderror=" Salasõna ei tohi olla väiksem kui 8 tähte!";
	}  
	if(empty($_POST["firstnameinput"])) {
		$firstnameerror = "Palun sisestage oma eesnimi!";
	} else {
		$firstname = test_input($_POST["firstnameinput"]);
	}
	if(empty($_POST["lastnameinput"])) {
		$lastnameerror = "Palun sisestage oma perekonnanimi!";
	}else {
		$lastname = test_input($_POST["lastnameinput"]);
	}
	if(($_POST["passwordinput"]) != ($_POST["passwordsecondaryinput"])) {
		$passwordsecondaryerror = "Sisestatud paroolid ei ühti!";
	}
	if(empty($_POST["emailinput"])) {
		$emailerror = "Palun sisestage oma email!";
	} else {
		$email = test_input($_POST["emailinput"]);
	}
	if(isset($_POST["birthdayinput"])){
		$birthday = intval($_POST["birthdayinput"]);
	} else {
		$birtdayerror = "Palun vali sünnikuupäev!";
	}
	if(isset($_POST["birthmonthinput"])){
		$birthmonth = intval($_POST["birthmonthinput"]);
	} else {
		$birtdaymontherror = "Palun vali sünnikuupäev!";
	}
	if(isset($_POST["birthyearinput"])){
		$birthyear = intval($_POST["birthyearinput"]);
	} else {
		$birtyearerror = "Palun vali sünnikuupäev!";
	}	
	
	if(empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror)){
		if(checkdate($birthmonth, $birthday, $birthyear)){
			$tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
			$birthdate = $tempdate->format("Y-m-d");
		} else {
			$birthdateerror = "Valitud kuupäev on ebareaalne!";
		}
	}
	
		if(isset($_POST["birthdayinput"])){
		$birthday = intval($_POST["birthdayinput"]);
	} else {
		$birtdayerror = "Palun vali sünnikuupäev!";
	}
	
	if(empty($_POST["genderinput"])) {
		$gendererror = "Palun sisestage oma sugu!";
	} else {
		$gender = ($_POST["genderinput"]);
	}
	 if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror ) and empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror) and empty($birthdateerror) and empty($emailerror) and empty($passworderror) and empty($confirmpassworderror)){
		$result = signup($firstname, $lastname, $email, $gender, $birthdate, $_POST["passwordinput"]);
		//$notice = "Kõik korras!";
		if($result == "ok"){
			$notice ="kasutaja on edukalt loodud!";
			$firstname= "";
			$lastname = "";
			$gender = "";
			$email = "";
		}			

	  }
}

    
	
 

?>
<a href="page.php">Tagasi kodulehele</a>
<hr>
<p>Uue kasutaja loomine</p>
<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <label for="firstnameinput">Eesnimi</label>
   <input type="text" name="firstnameinput" id="firstnameinput" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
   <br>
   <label for="lastnameinput">Perekonnanimi</label>
   <input type="text" name="lastnameinput" id="lastnameinput" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
   <br>
   <input type="radio" name="genderinput" id="gendermale" value="1"<?php if($gender == "1"){echo " checked";}?>><span><?php echo $gendererror; ?></span>
   <label for="genderinput">Mees</label>
   <input type="radio" name="genderinput" id="genderfemale" value="2"<?php if($gender == "2"){echo " checked";}?>><span><?php echo $gendererror; ?></span>
   <label for="genderinput">Naine</label>
   <br>
   	  <label for="birthdayinput">Sünnipäev: </label>
		  <?php
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i ++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
			echo "</select> \n";
		  ?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
			echo ">" .$monthnameset[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
	  <?php
	    echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthyear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
   <br>
   <label for="emailinput">Email</label>
   <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
   <br>
   <label for="passwordinput">Salasõna</label>
   <input type="password" name="passwordinput" id="passwordinput"><span><?php echo $passworderror; ?></span>
   <br>
   <label for="passwordsecondaryinput">Korrake salasõna</label>
   <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput"><span><?php echo $passwordsecondaryerror; ?></span>
   <br>
   <input type="submit" name="accountdatasubmit" value="loo konto!"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
</form>