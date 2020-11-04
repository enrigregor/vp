<?php
 //var_dump($_POST);
 require("usesession.php");

 require("../../../config.php");

	 
//$username = "Enri Gregor";
	
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
 //require("classes/generic_class.php");
 //$myfirstclass = new Generic();
 //echo $myfirstclass->mysecret;
 //echo $myfirstclass->yoursecret;
 //$myfirstclass->showValue();
 //unset ();
 
 require("header.php");
 
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kurusse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis ning mulle meeldib dabi visata
<p>Kui sa seda loed, siis tea, et pääsesin ligi oma webi failile ilma oma kodust ega mugavustest lahkumata! Lisaks tahaks veel öelda, et loodan sinul kui lugejal läheb hästi! See tekst ka ühtlasi tähendab, et sain oma koduse ülesandega hakkama! Kõige lõpuks mainin, et Alu Kuningriik on kõige võimsaim!!!</p>
<p><a href="?logout=1">Logi välja!</p>

<ul>
	 <li><a href="mottedjatujud.php">Tule siia ja kirjuta oma mõtted!</a> </li>
     <li><a href="vastused.php">Siit saad lugeda inimeste kirjutatud mõtteid</a> </li>
     <li><a href="filmidenim.php">Filmide nimekiri</a> </li>
	 <li><a href="addfilms.php">Filmi info lisamine</a> </li>
	 <li><a href="addfilmrelations.php">Filmiinfo seoste lisamine</a></li>
	 <li><a href="filmidenimpersons.php">Inimesed filmides</a></li>
	 <li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
	 <li><a href="photoupload.php">Galeriipiltide üleslaadimine</a></li>
</ul>
<hr>
<?php echo $imghtml; ?>
<hr>


</body>
</html>