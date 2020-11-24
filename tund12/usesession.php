 <?php
 //session_start();
  //logime välja
  require("classes/SessionManager.class.php");
  
  SessionManager::sessionStart("vp", 0, "/~enririi/", "greeny.cs.tlu.ee");
  
  
  
 if(isset($_GET["logout"])){
	 session_destroy();
	 header("Location: page.php");
	 exit();
 }
 
 //kas on sisseloginud, kui pole, saadame sisselogimise lehele
 if(!isset($_SESSION["userid"])){
	 header("Location: page.php");
	 exit();
 }