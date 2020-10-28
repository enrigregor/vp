<?php
require("../../../config.php");
require("usesession.php");
  $inputerror = "";
  $notice="";
  $fileuploadsizelimit = 1048576;
  $filename = "";
  $filenameprefix = "";
  $photoupload_orig = "../photoupload_orig/";
  $fileupload_normal = "../photoupload_normal/";
  $photomaxw = 600;
  $photomaxh = 400;
  //kas vajutati salvestusnuppu
  if(isset($_POST["photosubmit"])){
	  //kontrollime kas on pilt
	$check = getimagesize($_FILES["photoinput"]["tmp_name"]);
	if($check !== false){
		//var_dump($check);
		if($check["mime"] == "image/jpeg"){
			$filetype = "jpg";
		}
		if($check["mime"] == "image/png"){
			$filetype = "png";
		}
		if($check["mime"] == "image/gif"){
			$filetype = "gif";
		}
	} else {
		$inputerror = "Valitud fail ei ole pilt!";
	}	
	//ega pole liiga suur fail
	if($_FILES["photoinput"]["size"] > $fileuploadsizelimit){
		$inputerror .= " Valitud fail on liiga suur!";
	}
	$timestamp = microtime(1) * 10000;
	$filename = $filenameprefix .timestamp ."." .$filetype;
	
	
	
	//kas fail on olemas
	if(file_exists($photoupload_orig .$filename)){
		$inputerror .= " Sellise nimega fail on juba olemas!";
	}	
	
	if(empty($inputerror)){
		//teen väiksemaks
		//loome image objekti ehk pikslitekogumi
		if($filetype == "jpg"){
			$mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["name"]);
		}
		if($filetype == "png"){
			$mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["name"]);
		}
		if($filetype == "gif"){
			$mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["name"]);
		}
		$imagew = imagesx($mytempimage);
		$imageh = imagesy($mytempimage);
		//kas lähtuda laiusest või kõrgusest
		if($imagew / $photomaxw > imageh / photomaxh){
			$photosizeratio = $imagew / $photomaxw;
		} else {
			$photosizeratio = $imageh / $photomaxh;
		}
		//arvutan uued mõõdud
		$neww = round($imagew / $photosizeratio);
		$newh = round($imageh / $photosizeratio);
		//loon uue suurusega pildiobjekti
		
		$mynewtempimage =  imagecreatetruecolor($neww, $newh);
		//säilitamaks png piltide läbipaistmatut osa
		imagesavealpha($mynewtempimage, true);
		$transparentcolor = imagecolorallocatealpha($mynewtempimage, 0,0,0,127);
		imagefill($mynewtempimage, 0, 0, $transparencolor); 
		
		imagecopyresampled($mynewtempimage, $mytempimage, 0, 0, 0, 0, $neww, $newh, $imagew, $imageh);
		
		//salvestame failiks
		if($filetype == "jpg"){
			if(imagejpeg($mynewtempimage, $fileupload_normal, $filename, 90)){
				$notice = "Vähendatud pildi salvestamine õnnestus!";
			} else{
				$notice = "Vähendatud pildi salvestamine ebaõnnestus";
				
			}
			if(imagepng($mynewtempimage, $fileupload_normal, $filename, 7)){
				$notice = "Vähendatud pildi salvestamine õnnestus!";
			} else{
				$notice = "Vähendatud pildi salvestamine ebaõnnestus";
				
			}
			if(imagegif($mynewtempimage, $fileupload_normal, $filename)){
				$notice = "Vähendatud pildi salvestamine õnnestus!";
			} else{
				$notice = "Vähendatud pildi salvestamine ebaõnnestus";
				
			}
		}
		imagedestroy($mynewtempimage);
		imagedestroy($mytempimage);
		
	}
	
	if(empty($inputerror)){
		if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photoupload_orig .$_FILES["photoinput"]["name"])){
			$notice .= " Originaalpildi üleslaadimine õnnestus!";
		} else {
			$notice .= "Originaalpildi üleslaadimisel tekkis viga!";
		}
	}
  }
  //lisasime photoupload_orig kaustale õiguse KÕIGIL sinna muudatus teha. Väga unsafe, aga siin võime seda teha, sest see on meie kooli sisevõrk ehk keegi muu ligi ei pääse.
  require("header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
   <li><a href="home.php">Avalehele</a></li>
   <li><a href="?logout=1">Logi välja</a>!</li>
  </ul>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <label for="photoinput">Vali pildifail!</label>
	<input id="photoinput" name="photoinput" type="file" required>
	<br>
	<label for="altinput">Lisa pildi lühikirjeldus (alternatiivtekst)</label>
	<input id="altinput" name="altinput" type="text" placeholder="Pildi lühikirjeldus ...">
	<br>
	<label>Määra privaatsustase</label>
	<br>
	<input id="privinput1" name="privinput" type="radio" value="1">
	<label for="privinput1">Privaatne (ise näed)</label>
	<input id="privinput2" name="privinput" type="radio" value="2">
	<label for="privinput2">Sisseloginud kasutajatele</label>
	<input id="privinput3" name="privinput" type="radio" value="3">
	<label for="privinput3">Avalik</label>	
	<br>
	<input type="submit" name="photosubmit" value="Lae pilt üles">
  </form>
  <p>
  <?php 
  echo $inputerror; 
  echo $notice
  ?>
  </p>
  
  <hr>  
</body>
</html>
