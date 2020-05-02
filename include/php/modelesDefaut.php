<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_GET['id']) && !empty($_GET['id'])) 
{
	$id = $_GET['id'];

	echo "ok";

	// On créé la requête
	$req = "UPDATE parametres SET var1='$id' WHERE id='2'";
	 
	// on envoie la requête
	if ($res = $conn->query($req) === TRUE) 
	{
		echo "ok";
	} 
	else 
	{
		echo $req . "<br>";
		echo "Error: " . $reqInstall . "<br>" . $conn->error;
	}
	
	header('Location: /configuration/documents.php#fichiers-modeles');
}
else
{
	echo "pas ok";
}
echo " - FIN";