<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_GET['id']) && !empty($_GET['id'])) 
{
	// echo $_GET['idid'] . "<br>";
	
	$id = $_GET['id'];

	// On créé la requête
	$req = "DELETE FROM typeactivitedesc WHERE iddesc='$id'";
	 
	// on envoie la requête
	if ($res = $conn->query($req) == TRUE) 
	{
		echo "ok";
	} 
	else 
	{
		echo $req . "<br>";
		echo "Error: " . $reqInstall . "<br>" . $conn->error;
	}
	
	header('Location: /configuration/activite.php');
}
echo " - FIN";