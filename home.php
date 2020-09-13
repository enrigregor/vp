<?php
$username = "Enri ja nii ongi";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
if ($hournow < 7) {
    $partofday = "uneaeg";
}
if($hournow >= 8 and $hournow < 18){
	$partofday = "akadeemilise aktiivsuse aeg";
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
//if($fromsemesterstartdays < 0) (semester pole peale hakanud) 
//leiame erinevuse tänasega (semesterduration jne)
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

</body>
</html>