<?php
$username = "Enri ja nii ongi";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
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
if ($semestercurrent < 0) {
	$semestercurrentdays = "Semester pole peale alanud";
}	
if ($semestercurrent > $semesterduration) {
    $semestercurrentdays = "Semester on läbi saanud.";	
}
//if($fromsemesterstartdays < 0) (semester pole peale hakanud) 
//leiame erinevuse tänasega (semesterduration jne)
$completion = ($semestercurrent / $semesterduration) * 100
if ($completion = 0) {
	$showcompletion = "Semester pole veel alanud";
}
if ($completion >= 100) {
	$showcompletion = "Semester on läbi! 100";
}	
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> asutatud aastal 2001</title>

</head>
<body>
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kurusse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis ning mulle meeldib dabi visata
<p>Kui sa seda loed, siis tea, et p��sesin ligi oma webi failile ilma oma kodust ega mugavustest lahkumata! Lisaks tahaks veel �elda, et sinul kui lugejal l�heb h�sti! See tekst ka �htlasi t�hendab, et sain oma koduse �lesandega hakkama! K�ige l�puks mainin, et Alu Kuningriik on k�ige v�imsaim!!!</p>
<p>Lehe avamise hetkel oli: <?php echo $fulltimenow; ?>. </p>
<p><?php echo "Parajasti on " .$partofday ."."; ?></p>
<p><?php echo "Esimene semester kestab " .$semesterdurationdays ."päeva."; ?></p>
<p><?php echo "Möödunud päevad pärast semestri algust: " .$semestercurrentdays ."."; ?></p>
<p><?php echo "Teie õppetöö läbitud: " .$showcompletion ."%"; ?></p>

</body>
</html>