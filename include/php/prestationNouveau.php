<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");


if (
	isset($_POST['inputType']) && !empty($_POST['inputType']) && 
	isset($_POST['inputDateOuverture']) && !empty($_POST['inputDateOuverture']) && 
	isset($_POST['inputUrgence']) && !empty($_POST['inputUrgence']) && 
	isset($_POST['inputProduitDescription']) && !empty($_POST['inputProduitDescription'])
	) 
{
	if (
		(isset($_POST['inputNomClientParticulier']) && !empty($_POST['inputNomClientParticulier'])) ||
		(isset($_POST['inputNomClientEntreprise']) && !empty($_POST['inputNomClientEntreprise'])) 
		) 
	{
		echo "ok";

		$inputType = $_POST['inputType'];
		$inputDateOuverture = $_POST['inputDateOuverture'];
		$inputUrgence = $_POST['inputUrgence'];
		$inputProduitDescription = rtrim(ltrim(addslashes(ucfirst($_POST['inputProduitDescription']))));
		
		if ($inputType == "professionnel") 
		{
			$inputNomClient = $_POST['inputNomClientEntreprise'];
		}
		elseif ($inputType == "particulier") 
		{
			$inputNomClient = $_POST['inputNomClientParticulier'];
		}

		$reqPrestationNouveau = "INSERT INTO prestation(client, dateouverture, urgence, commentaire) VALUES ('$inputNomClient', '$inputDateOuverture', '$inputUrgence', '$inputProduitDescription')";

		if ($conn->query($reqPrestationNouveau) == TRUE) 
		{
			$retour = "ok";
		} 
		else 
		{
			$retour = "Error: " . $reqPrestationNouveau . "<br>" . $conn->error;
		}
	}
	else
	{
		$retour =  "NON";
	}
}
else
{
	$retour =  "NON - FIN";
}

header('Location: /prestation/nouveau.php?msg=' . $retour);