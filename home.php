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
//selgitame vÃ¤lja nende vahe ehk erinevuse
$semesterduration = $semesterstart->diff($semesterend);
//leiame selle pÃ¤evade arvuna
$semesterdurationdays = $semesterduration->format("%r%a");
  
//tÃ¤nane pÃ¤ev
$today = new DateTime("now");
//if($fromsemesterstartdays < 0) (semester pole peale hakanud) 
//leiame erinevuse tÃ¤nasega (semesterduration jne)
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> asutatud aastal 2001</title>

</head>
<body>
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud ÃµppetÃ¶Ã¶ kÃ¤igus ning ei sisalda mingit tÃµsiseltvÃµetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kurusse raames <a href="http://www.tlu.ee">Tallinna Ãœlikooli</a> Digitehnoloogiate instituudis ning mulle meeldib dabi visata
<p>Kui sa seda loed, siis tea, et pääsesin ligi oma webi failile ilma oma kodust ega mugavustest lahkumata! Lisaks tahaks veel öelda, et sinul kui lugejal läheb hästi! See tekst ka ühtlasi tähendab, et sain oma koduse ülesandega hakkama! Kõige lõpuks mainin, et Alu Kuningriik on kõige võimsaim!!!</p>
<p>Lehe avamise hetkel oli: <?php echo $fulltimenow; ?>. </p>
<p><?php echo "Parajasti on " .$partofday ."."; ?></p>

</body>
</html>