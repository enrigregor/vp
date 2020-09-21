<?php
require("../../../config.php");
$username = "Enri Gregor";

require("fnc_film.php");

//loen andmebaasist filmide info
$filmhtml = "";
require("header.php");
$inputerror = "";
//kas vajutati salvestusnuppu
if(isset($_POST["filmsubmit"])) {
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])) {
		$inputerror .= "Osa infot on sisestamata.";
	}
	if($_POST["yearinput"] < 1895 or $_POST["yearinput"] > date("Y")) {
		$inputerror .= "Ebareaalne valmimisaasta.";
	}
	if(empty($inputerror)){
		$storeinfo = sotrefilminfo($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
		if($storeinfo == 1) {
			$filmhtml = readfilms(1);
		} else {
			$filmhtml = "<p>Kahjuks filmi andmeid sisestada ei õnnestunud.</p>";
		}
	}
}
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?></h1>
<a href="home.php">Tagasi kodulehele</a>
<form method="POST">
	<label for="titleinsert">Filmi pealkiri</label>
	<input type="text" name="titleinput" id="titleinput" placeholder="Filmi pealkiri">
	<br>
	<label for="yearinput">Filmi valmismisaasta</label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y")?>">
	<br>
	<label for="durationinput">Filmi kestus</label>
	<input type="number" name="durationinput" id="durationinput" value="90">
	<br>
	<label for="genreinput">Filmi žanr</label>
	<input type="text" name="genreinput" id="genreinput" placeholder="Filmi žanr">
	<br>
	<label for="studioinput">Filmi tootja</label>
	<input type="text" name="studioinput" id="studioinput" placeholder="Filmi tootja">
	<br>
	<label for="directorinput">Filmi lavastaja</label>
	<input type="text" name="directorinput" id="directorinput" placeholder="Filmi lavastaja">
	<br>
	<hr>
	<input type="submit" name="filmsubmit" value="Salvesta film">
</form>
<p><?php echo $inputerror; ?>
<hr>
</ul>
<?php echo $filmhtml; ?>
</body>
</html>
