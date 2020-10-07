<?php
$database = "if20_enri_rii";

function signup($firstname, $lastname, $email, $gender, $birthdate, $password){
	$result = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?, ?, ?, ?, ?, ?)");
	echo $conn->error;
	
	//krüpteerime parooli
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	
	$stmt->bind_param("sssiss", $firstname, $lastname, $birthdate, $gender, $email, $pwdhash);
	
	if($stmt->execute()) {
		$result = "ok";
	} else {
		$result = $stmt->error;
	}
	$stmt->close();
	$conn->close();
	return $result;
} //signup lõppeb

function signin($email, $password){
	$result = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
	echo $conn->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordfromdb);
	if($stmt->execute()){
		//kui käsu täitmine õnnestus
		if($stmt->fetch()){
			//kui tuli vaste, kasutaja on olemas
			if(password_verify($password, $passwordfromdb)){
				//parool õige , sisse logimine
				$stmt->close();
				//loen sisse loginud kasutaja nime ja id 
				$stmt = $conn->prepare("SELECT vpusers_id, firstname, lastname FROM vpusers WHERE email = ?");
				echo $conn->error;
				$stmt->bind_param("s", $email);
				$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
				$stmt->execute();
				$stmt->fetch();
				//salvestan saadud info sessioonimuutujatesse
				$_SESSION["userid"] = $idfromdb;
				$_SESSION["userfirstname"] = $firstnamefromdb;
				$_SESSION["userlastname"] = $lastnamefromdb;
				$stmt->close();	
				
				//kasutajaprofiil, tausta ja tekstivärv
				//lugeda andmebaasist kasutajaprofiil, kui saab fetch käsuga värvid, siis need, muidu must (#000000) ja valge (#FFFFFF) 
				$_SESSION["usergbcolor"] = "#CCCCCC";
				$_SESSION["usertxtcolor"] = "#000066";
				
				$conn->close();
				header("Location: home.php");
				exit();
			} else{
				$result = "Kahjuks vale parool!";
			}
		} else{
			$result = "Kasutajat (" .$email .") pole olemas!";
		}
		
	} else {
		$result = $stmt->error;
	}
	

}

function storeuserprofile($description, $bgcolor, $txtcolor){
	$notice = null
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT vpuserprofiles_id FROM vpuserprofiles WHERE userid = ?");
	echo $conn->error;
	$stmt->bind_param("i", $_SESSION["userid"]);
	$stmt->execute();
	if($stmt->fetch()){
		$stmt->close();
		$stmt = $conn->prepare("UPDATE vpuserprofiles_id SET description = ?, bgcolor = ?, txtcolor = ? WHERE userid = ?");
		echo $conn->error;
		$stmt->$bind_param("sssi" $description, $bgcolor, $txtcolor, $_SESSION["userid"]);
	} else {
		$stmt = $conn->prepare("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES(?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("isss" $_SESSION["userid"], $description, $bgcolor, $txtcolor);
			}
	if($stmt->execute()){
		$notice = "Profiil salvestatud!";
	} else {
		$notice = "Profiili salvestamine ebaõnnestus!";
	}
	$stmt->close();
	$conn->close();
	return $result;	
}

function readuserdescription(){
	$notice = null
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt-> $conn->prepare("SELECT description FROM vpuserprofiles WHERE userid = ?");
	
	$stmt->close();
	$conn->close();
	return $result;
}

?>