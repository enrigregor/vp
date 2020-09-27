<?php
 //var_dump($_POST);
 require("../../../config.php");

	 
$username = "Enri Gregor";
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
	 <li><a href="mottedjatujud.php">Tule siia ja kirjuta oma mõtted!</a> </li>
     <li><a href="vastused.php">Siit saad lugeda inimeste kirjutatud mõtteid</a> </li>
     <li><a href="filmidenim.php">Filmide nimekiri</a> </li>
	 <li><a href="addfilms.php">Filmi info lisamine</a> </li>
</ul>
<hr>
<?php echo $imghtml; ?>
<hr>


</body>
</html>