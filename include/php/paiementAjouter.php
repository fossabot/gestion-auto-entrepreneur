<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputNom']) && !empty($_POST['inputNom'])) 
{
	$nom = $_POST['inputNom'];
	$description = $_POST['inputDescription'];

	// On créé la requête
	$req = "INSERT INTO moyenpaiement (nom, description) VALUES ('$nom', '$description')";
	 
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
	
	header('Location: /configuration/paiement.php');
}
echo " - FIN";