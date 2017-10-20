<?php 
function connectDB(){
	try{
		$bdd = new PDO ('mysql:host=localhost;dbname=slam;charset=utf8','slam_user','1234');
	}
	catch(PDOException $e)
	{
		print "Erreur !:" .$e->getMessage() . "<br/>";
		die();
	}
	return $bdd;

}
?>