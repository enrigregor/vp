<?php
class generic{
	//muutujad, klassis omadused (properties)
	private $mysecret;
	public $yoursecret;
	
	function __construct(){
		$this->mysecret = mt_rand(0, 10);
		$this->yoursecret = mt_rand(0, 100);
		echo "Loositud arvude korrutis on: " .$this->mysecret .$this->yoursecret;
	} //construct lõppeb
	
	function _ 
	
	
	//funktsioonid, klassis meetod (method)
	private function tellSecret(){
		echo " Näidisklass on mõttetu";
	}
	
	public function showValue(){
		echo " Väga salajane arv on: " .$this->mysecret;
	}
	
	
}
//klass lõppeb



?>