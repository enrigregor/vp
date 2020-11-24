<?php

function readnews(){
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT title, content, userid
	
	$stmt->close();
    $conn->close();
    return $notice;
}