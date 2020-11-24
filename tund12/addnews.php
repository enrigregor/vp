<?php
  require("usesession.php");  
  require("../../../config.php");
  require("fnc_main.php");
  

  $tolink = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
  $tolink .= "\t" .'<script>tinymce.init({selector:"textarea#newsinput", plugins: "link", menubar: "edit",});</script>' ."\n";
    
  $inputerror = "";
  $notice = "";
  $news = "";
  $newstitle = "";

  //kas vajutati salvestusnuppu
  if(isset($_POST["newssubmit"])){
	  if(strlen($_POST["newstitleinput"]) == 0){
		  $intputerror = "Uudise pealkiri on puudu!";
	  } else {
		  $newstitle = test_input($_POST["newstitleinput"]);
	  }
	  if(strlen($_POST["newsinput"]) == 0){
		  $inputerror .= "Uudise sisu on puudu!";
	  } else {
		  $news = test_input($_POST["newsinput"]);
		  //htmlspecialchars teiselndab 
	  }
	  if(empty($inputerror)){
		  //uudis salvestada
		  
	  }
  }

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
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="newstitleinput">Sisesta uudise pealkiri</label>
	<input id="newstitleinput" name="newstitleinput" type="text" value="<?php echo $newstitle; ?>" required>
	<br>
	<label for="newsinput">Kirjuta uudis</label>
	<textarea id="newsinput" name="newsinput" placeholder="Uudise sisu"><?php echo $news; ?>
	</textarea>
	<br>
	<input type="submit" id="newssubmit" name="newssubmit" value="Salvesta uudis">
  </form>
  <p id="notice">
  <?php
	echo $inputerror;
	echo $notice;
  ?>
	</p>
  <hr>  
</body>
</html>