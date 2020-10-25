
<?php
$database = "if20_enri_rii";


function readmovietoselect($selectedfilm){
	$notice = "<p>Kahjuks filme ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_id, title FROM movie");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $titlefromdb);
	$stmt->execute();
	$films = "";
	while($stmt->fetch()){
		$films .= '<option value="' .$idfromdb .'"';
		if(intval($idfromdb) == $selectedfilm){
			$films .=" selected";
		}
		$films .= ">" .$titlefromdb ."</option> \n";
	}
	if(!empty($films)){
		$notice = '<select name="filminput" id="filminput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali film</option>' ."\n";
		$notice .= $films;
		$notice .= "</select> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}
function readgenretoselect($selectedgenre){

	$notice = "<p>Kahjuks žanre ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $genrefromdb);
	$stmt->execute();
	$genres = "";
	while($stmt->fetch()){
		$genres .= '<option value="' .$idfromdb .'"';
		if(intval($idfromdb) == $selectedgenre){
			$genres .=" selected";
		}
		$genres .= ">" .$genrefromdb ."</option> \n";
	}
	if(!empty($genres)){
		$notice = '<select name="filmgenreinput" id="filmgenreinput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali žanr</option>' ."\n";
		$notice .= $genres;
		$notice .= "</select> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function readpersontoselect($selectedperson){

	$notice = "<p>Kahjuks inimesi ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT person_id, first_name, last_name FROM person");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
	$stmt->execute();
	$person = "";
	while($stmt->fetch()){
		$person .= '<option value="' .$idfromdb .'"';
		if(intval($idfromdb) == $selectedperson){
			$person .=" selected";
		}
		$person .= ">" .$firstnamefromdb ." " .$lastnamefromdb ."</option> \n";
	}
	if(!empty($person)){
		$notice = '<select name="filmpersoninput" id="filmpersoninput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali inimene</option>' ."\n";
		$notice .= $person;
		$notice .= "</select> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function readpositiontoselect($selectedposition){
	$notice = "<p>Kahjuks rolle ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT position_id, position_name FROM position");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $positionfromdb);
	$stmt->execute();
	$position = "";
	while($stmt->fetch()){
		$position .= '<option value="' .$idfromdb .'"';
		if(intval($idfromdb) == $selectedposition){
			$position .=" selected";
		}
		$position .= ">" .$positionfromdb ."</option> \n";
	}
	if(!empty($position)){
		$notice = '<select name="filmpositioninput" id="filmpositioninput">' ."\n";
		$notice .= '<option value="" selected disabled>Vali roll</option>' ."\n";
		$notice .= $position;
		$notice .= "</select> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function readstudiotoselect($selectedstudio){
	$notice = "<p>Kahjuks stuudioid ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT production_company_id, company_name FROM production_company");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $companyfromdb);
	$stmt->execute();
	$studios= "";
	while($stmt->fetch()){
		$studios .= '<option value="' .$idfromdb .'"';
		if($idfromdb == $selectedstudio){
			$studios .= " selected";
		}
		$studios .= ">" .$companyfromdb ."</option \n";
	}
	if(!empty($studios)){
		$notice= '<select name ="filmstudioinput">' ."\n";
		$notice .= '<option value="" selected disabled> stuudio</option' ."\n";
		$notice .= $studios;
		$notice .= "</select \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function storenewstudiorelation($selectedfilm, $selectedstudio){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_by_production_company_id FROM movie_by_production_company WHERE movie_movie_id = ? AND production_company_id = ?");
	echo $conn->error;
	$stmt->bind_param("ii", $selectedfilm, $selectedstudio);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = "Selline seos on juba olemas!";
	} else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO movie_by_production_company (movie_movie_id, production_company_id) VALUES(?,?)");
		echo $conn->error;
		$stmt->bind_param("ii", $selectedfilm, $selectedstudio);
		if($stmt->execute()){
			$notice = "Uus seos edukalt salvestatud!";
		} else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function storenewpositionrelation($selectedperson, $selectedfilm, $selectedposition){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT position_id FROM person_in_movie WHERE person_id = ? AND movie_id = ? AND position_id = ?");
	echo $conn->error;
	$stmt->bind_param("iii", $selectedperson, $selectedfilm, $selectedposition);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = "Selline seos on juba olemas!";
	} else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id) VALUES(?,?,?)");
		echo $conn->error;
		$stmt->bind_param("iii", $selectedperson, $selectedfilm, $selectedposition);
		if($stmt->execute()){
			$notice = "Uus seos edukalt salvestatud!";
		} else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
			echo $conn->error;
		}
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function storenewgenrerelation($selectedfilm, $selectedgenre){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_genre_id FROM movie_genre WHERE movie_id = ? AND genre_id = ?");
	echo $conn->error;
	$stmt->bind_param("ii", $selectedfilm, $selectedgenre);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = "Selline seos on juba olemas!";
	} else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES(?,?)");
		echo $conn->error;
		$stmt->bind_param("ii", $selectedfilm, $selectedgenre);
		if($stmt->execute()){
			$notice = "Uus seos edukalt salvestatud!";
		} else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}	
	$stmt->close();
	$conn->close();
	return $notice;
}

function old_version_readpersoninmovie(){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt=$conn->prepare("SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id");
	echo $conn->error;
	$stmt->bind_result($firsnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p>" .$firsnamefromdb ." " .$lastnamefromdb;
		if(!empty($rolefromdb)){
			$notice .= " Tegelane " .$rolefromdb;
		}
		$notice .= ' filmis "' .$titlefromdb .'"' ."\n";
	}	
	$stmt->close();
	$conn->close();
	return $notice;
}

function readpersoninmovie($sortby, $sortorder){
	$notice = "<p>Kahjuks ei leidnud filmitegelasi</p>";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$sqlphrase = "SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id ORDER BY title";
	if($sortby == 0){
		$stmt=$conn->prepare($sqlphrase);
	}
	if($sortbyr == 4){
		if($sortorder == 1){
			$stmt=$conn->prepare($sqlphrase ." ORDER BY title DESC");
		} else {
			$stmt=$conn->prepare($sqlphrase ." ORDER BY title");
		}
	}
	
	echo $conn->error;
	$stmt->bind_result($firsnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb);
	$stmt->execute();
	$lines = "";
	while($stmt->fetch()){
		$lines .= "\t <tr> \n";
		$lines .= "\t \t <td>"  .$firsnamefromdb ." " .$lastnamefromdb ."</td>";
		$lines .= "<td>" .$rolefromdb ."</td>";
		$lines .= "<td>" .$titlefromdb ."</td> \n";
		$lines .= "\t </tr> \n";
	}	
	if(!empty($lines)){
		$notice = "<table> \n";
		$notice .= "\t <tr> \n \t \t <th>Isik</th> \n \t \t <th>Roll</th> \n";
		$notice .= "\t \t" .'<th>Film <a href="?sortby=4&sortorder=1">&uarr;</a>&nbsp;<a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n \t </tr> \n";
		$notice .= $lines;
		$notice .= "</table> \n";
	}
	$stmt->close();
	$conn->close();
	return $notice;
}
?>