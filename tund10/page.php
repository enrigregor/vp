<?php
 //var_dump($_POST);
//session_start();
require("classes/SessionManager.class.php");
SessionManager::sessionStart("vp", 0, "/~enririi/", "greeny.cs.tlu.ee");
  
require("../../../config.php");
require("fnc_main.php");
require("fnc_user.php");
$email="";
$password="";
$emailerror="";
$passworderror="";
$result="";

	 
$username = "";
$yearnow = date("Y");
$datenow = date("d.");
$clocknow = date("H:i:s");
$monthnow = date("n"); 
$weekdaynow = date("N");
$hournow = date("H");
$partofday = "lihtsalt aeg";
$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
//echo $weekdaynameset[1];
$weekdaynow = date("N");

if(isset($_POST["accountlogin"])) {
	if (!empty($_POST["emailinput"])){
		$email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		} else {
		  $emailerror = "Palun sisesta õige kujuga e-postiaadress!";
		}
	}
	if(empty($_POST["passwordinput"])) {
		$passworderror = "Palun sisestage oma salasõna!";
	} else {
		$password = ($_POST["passwordinput"]);
	}
	if(empty ($emailerror) and empty ($passworderror)){
		$result = signin($email, $password);
	}		
}



$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
if ($hournow < 7) {
    $partofday = "uneaeg";
}
if ($hournow >= 8 and $hournow < 18) {
	$partofday = "akadeemilise aktiivsuse aeg";
}	
if ($hournow >=11 and $hournow < 12) {
	$partofday = "aeg lõunasöögiks";
}
if ($hournow > 18 and $hournow < 19) {
	$partofday = "aeg süüa õhtusööki";
}
if ($hournow > 19 and $hournow < 23) {
	$partofday = "aeg vaadata telekat, käia pesus ja üleüldse niisama olla";
}

//vaatame semestri kulgemist
$semesterstart = new DateTime("2020-8-31");
$semesterend = new DateTime("2020-12-13");
//selgitame välja nende vahe ehk erinevuse
$semesterduration = $semesterstart->diff($semesterend);
//leiame selle päevade arvuna
$semesterdurationdays = $semesterduration->format("%r%a");

  
//tänane päev
$today = new DateTime("now");
$semestercurrent = $semesterstart->diff($today);
$semestercurrentdays = $semestercurrent->format("%r%a");


if ($semestercurrentdays < 0) {
	$semestercurrentdays = "Semester pole peale alanud";
}	
if ($semestercurrentdays > $semesterduration) {
    $semestercurrentdays = "Semester on läbi saanud.";	
}
//if($fromsemesterstartdays < 0) (semester pole peale hakanud) 
//leiame erinevuse tänasega (semesterduration jne)
$completion = ($semestercurrentdays / $semesterdurationdays)*100;
if ($completion == 0) {
	$completion = "Semester pole veel alanud";
}
if ($completion >= 100) {
	$completion = "Semester on läbi! 100";
}	
 //loeme kataloogist piltide nimekirja
 $allfiles = scandir("../vp_pics/");
 //var_dump($allfiles);
 $picfiles = array_slice($allfiles, 2);
 //var_dump($allfiles);
 $imghtml = "";
 $piccount = count($picfiles);
 //$i = €$i + 1;
 //$i ++;
 //$i +=3
 $randompicnum = mt_rand (0, ($piccount - 1));
 for($i = 0;$i < $piccount; $i ++) {
	 //<img src="../img/pildifail" alt="tekst">
	 $imghtml = '<img src="../vp_pics/' .$picfiles[mt_rand(0,($piccount - 1))] .'" alt="Tallinna Ülikool">';
 }
 
 require("header.php");
 
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kurusse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis ning mulle meeldib dabi visata
<p>Kui sa seda loed, siis tea, et pääsesin ligi oma webi failile ilma oma kodust ega mugavustest lahkumata! Lisaks tahaks veel öelda, et loodan sinul kui lugejal läheb hästi! See tekst ka ühtlasi tähendab, et sain oma koduse ülesandega hakkama! Kõige lõpuks mainin, et Alu Kuningriik on kõige võimsaim!!!</p>
<p>Lehe avamise hetkel oli: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$datenow ." " .$monthnameset[$monthnow - 1] ." " .$yearnow .", kell " .$clocknow; ?></p>
<p><?php echo "Parajasti on " .$partofday ."."; ?></p>
<p><?php echo "Esimene semester kestab " .$semesterdurationdays ." päeva."; ?></p>
<p><?php echo "Möödunud päevad pärast semestri algust: " .$semestercurrentdays ."."; ?></p>
<p><?php echo "Teie õppetöö läbitud: " .$completion ."%"; ?></p>
<ul>
     <li><a href="logindata.php">Loo omale kasutaja!</a> </li>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <label for="emailinput">Email</label>
   <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
   <br>
   <br>
   <label for="passwordinput">Salasõna</label>
   <input type="password" name="passwordinput" id="passwordinput"><span><?php echo $passworderror; ?></span>
   <br>
   <br>
   <input type="submit" name="accountlogin" value="Sisene!">
   <br> <?php echo $result; ?>
   <br>
</form> 
<?php echo $imghtml; ?>
<hr>


</body>
</html>