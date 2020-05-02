<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_GET['nom']) && !empty($_GET['nom'])) 
{
	// echo $_GET['idid'] . "<br>";
	
	$nom = $_GET['nom'];

	// On créé la requête
	$req = "DELETE FROM moyenpaiement WHERE nom='$nom'";
	 
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
	
	header('Location: /configuration/paiement.php');
}
echo " - FIN";