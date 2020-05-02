<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if ($_POST['inputType'] == "professionnel") 
{
	$clientType = 1;
	if (
		isset($_POST['inputNomEntreprise']) && !empty($_POST['inputNomEntreprise']) && 
		isset($_POST['inputAdresse']) && !empty($_POST['inputAdresse']) && 
		isset($_POST['inputVille']) && !empty($_POST['inputVille']) && 
		isset($_POST['inputPays']) && !empty($_POST['inputPays']) && 
		isset($_POST['inputCP']) && !empty($_POST['inputCP']) && 
		isset($_POST['inputEmail']) && !empty($_POST['inputEmail'])
		) 
	{
		if (isset($_POST['inputTelF']) && !empty($_POST['inputTelF'])) 
		{
			$TelF = $_POST['inputTelF'];
		}
		else
		{
			$TelF = NULL;
		}

		if (isset($_POST['inputTelP']) && !empty($_POST['inputTelP'])) 
		{
			$TelP = $_POST['inputTelP'];
		}
		else
		{
			$TelP = NULL;
		}

		$Entreprise = rtrim(ltrim(addslashes(ucfirst($_POST['inputNomEntreprise']))));
		$Adresse    = rtrim(ltrim($_POST['inputAdresse']));
		$CP         = rtrim(ltrim($_POST['inputCP']));
		$Ville      = rtrim(ltrim(ucfirst($_POST['inputVille'])));
		$Pays       = rtrim(ltrim(ucfirst($Pays)));
		$Email       = $_POST['inputEmail'];
		$Pays       = $_POST['inputPays'];

		$reqInstall = "INSERT INTO clients(entreprise, adresse, cp, ville, tel_fixe, tel_portable, type, email, pays) VALUES ('$Entreprise', '$Adresse', '$CP', '$Ville','$TelF', '$TelP', '$clientType', '$Email', '$Pays')";
		if ($conn->query($reqInstall) === TRUE) 
		{
			$retour = "ok";
		} 
		else 
		{
			$retour = "Error: " . $reqInstall . "<br>" . $conn->error;
		}
	}
	else
	{
		$retour = "Vous devez saisir toutes les informations obligatoires";
	}
}
elseif ($_POST['inputType'] == "particulier")
{
	$clientType = 2;
	if (
		isset($_POST['inputGenre']) && !empty($_POST['inputGenre']) && 
		isset($_POST['inputNom']) && !empty($_POST['inputNom']) && 
		isset($_POST['inputPrenom']) && !empty($_POST['inputPrenom']) && 
		isset($_POST['inputAdresse']) && !empty($_POST['inputAdresse']) && 
		isset($_POST['inputVille']) && !empty($_POST['inputVille']) && 
		isset($_POST['inputPays']) && !empty($_POST['inputPays']) && 
		isset($_POST['inputCP']) && !empty($_POST['inputCP'])
		) 
	{
		if (isset($_POST['inputTelF']) && !empty($_POST['inputTelF'])) 
		{
			$TelF = $_POST['inputTelF'];
		}
		else
		{
			$TelF = NULL;
		}

		if (isset($_POST['inputTelP']) && !empty($_POST['inputTelP'])) 
		{
			$TelP = $_POST['inputTelP'];
		}
		else
		{
			$TelP = NULL;
		}

		$Genre = $_POST['inputGenre'];

		if ($Genre != 2 && $Genre != 3) 
		{
			$Genre = 1;
		}	

		$Nom     = strtoupper($_POST['inputNom']);
		$Prenom  = ucfirst($_POST['inputPrenom']);
		$Adresse = $_POST['inputAdresse'];
		$CP      = $_POST['inputCP'];
		$Ville   = ucfirst($_POST['inputVille']);
		$Pays    = ucfirst($Pays);

		$reqInstall = "INSERT INTO clients(genre, nom, prenom, adresse, cp, ville, tel_fixe, tel_portable, type) VALUES ('$Genre', '$Nom', '$Prenom', '$Adresse', '$CP', '$Ville','$TelF', '$TelP', '$clientType')";
		if ($conn->query($reqInstall) === TRUE) 
		{
			$retour = "ok";
		} 
		else 
		{
			$retour = "Error: " . $reqInstall . "<br>" . $conn->error;
		}
	}
	else
	{
		$retour = "Vous devez saisir toutes les informations obligatoires";
	}
}
else
{
	$retour = "Une erreur est survenue, merci de réessayer.";
}
header('Location: /client/nouveau.php?msg=' . $retour);