<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputID']) && !empty($_POST['inputID']))
{
	$id = $_POST['inputID'];
	echo "<br>";
	echo $_POST['inputType'];
	echo "<br>";
	echo $_POST['inputGenre'];
	echo "<br>";
	echo $_POST['inputNom'];
	echo "<br>";
	echo $_POST['inputPrenom'];
	echo "<br>";
	echo $_POST['inputNomEntreprise'];
	echo "<br>";
	echo $_POST['inputAdresse'];
	echo "<br>";
	echo $_POST['inputVille'];
	echo "<br>";
	echo $_POST['inputPays'];
	echo "<br>";
	echo $_POST['inputCP'];

	if (
		isset($_POST['inputType']) && !empty($_POST['inputType']) && 
		((isset($_POST['inputGenre']) && !empty($_POST['inputGenre']) && 
		isset($_POST['inputNom']) && !empty($_POST['inputNom']) && 
		isset($_POST['inputPrenom']) && !empty($_POST['inputPrenom'])) || 
		(isset($_POST['inputNomEntreprise']) && !empty($_POST['inputNomEntreprise']))) && 
		isset($_POST['inputAdresse']) && !empty($_POST['inputAdresse']) && 
		isset($_POST['inputVille']) && !empty($_POST['inputVille']) && 
		isset($_POST['inputPays']) && !empty($_POST['inputPays']) && 
		isset($_POST['inputCP']) && !empty($_POST['inputCP'])
		) 
	{
		if (isset($_POST['inputTelF']) && !empty($_POST['inputTelF'])) 
		{
			$TelF = tel($_POST['inputTelF']);
		}
		else
		{
			$TelF = NULL;
		}

		if (isset($_POST['inputTelP']) && !empty($_POST['inputTelP'])) 
		{
			$TelP = tel($_POST['inputTelP']);
		}
		else
		{
			$TelP = NULL;
		}

		if (isset($_POST['inputEmail']) && !empty($_POST['inputEmail'])) 
		{
			$Email = $_POST['inputEmail'];
		}
		else
		{
			$Email = NULL;
		}

		echo "cond test ok<br><br><br>";

		$Entreprise = rtrim(ltrim(addslashes(ucfirst($_POST['inputNomEntreprise']))));
		$Adresse    = rtrim(ltrim($_POST['inputAdresse']));
		$CP         = rtrim(ltrim($_POST['inputCP']));
		$Ville      = rtrim(ltrim(ucfirst($_POST['inputVille'])));
		$Pays       = rtrim(ltrim(ucfirst($_POST['inputPays'])));

		$reqInstall = "UPDATE clients SET adresse='$Adresse', cp='$CP', ville='$Ville', pays='$Pays', tel_fixe='$TelF', tel_portable='$TelP', email='$Email'  WHERE id=$id";

		echo $reqInstall . "<br><br>";

		if ($conn->query($reqInstall) == TRUE) 
		{
			$retour = "ok";
		} 
		else 
		{
			$retour = "Error: " . $reqInstall . "<br>" . $conn->error;
			echo "<br>Error: " . $reqInstall . "<br>" . $conn->error;
		}
	}
	else
	{
		$retour = "Vous devez saisir toutes les informations obligatoires";
		echo "Vous devez saisir toutes les informations obligatoires";
	}
	echo "<br>FIN";
	header('Location: /client/edit.php?msg=' . $retour . '&id=' . $id);
}