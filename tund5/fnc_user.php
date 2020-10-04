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
				$stmt->close;
				$conn->close;
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
	
	$stmt->close();
	$conn->close();
	return $result;
}

?>