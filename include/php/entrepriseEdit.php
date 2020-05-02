<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

// echo $_POST['inputEntreprise'] . "<br>";
// echo $_POST['inputSiret'] . "<br>";
// echo $_POST['inputNom'] . "<br>";
// echo $_POST['inputPrenom'] . "<br>";
// echo $_POST['inputEmail'] . "<br>";
// echo $_POST['inputAdresse'] . "<br>";
// echo $_POST['inputVille'] . "<br>";
// echo $_POST['inputCP'] . "<br>";
// echo $_POST['inputPays'] . "<br>";
// echo $_POST['inputTelF'] . "<br>";
// echo $_POST['inputTelP'] . "<br>";


if (
	isset($_POST['inputEntreprise']) && !empty($_POST['inputEntreprise']) &&
	isset($_POST['inputSiret']) && !empty($_POST['inputSiret']) &&
	isset($_POST['inputNom']) && !empty($_POST['inputNom']) &&
	isset($_POST['inputPrenom']) && !empty($_POST['inputPrenom']) &&
	isset($_POST['inputEmail']) && !empty($_POST['inputEmail']) &&
	isset($_POST['inputAdresse']) && !empty($_POST['inputAdresse']) &&
	isset($_POST['inputVille']) && !empty($_POST['inputVille']) &&
	isset($_POST['inputCP']) && !empty($_POST['inputCP']) &&
	isset($_POST['inputPays']) && !empty($_POST['inputPays'])
)
{
	if (isset($_POST['inputTelF']) && !empty($_POST['inputTelF']))
	{
		$inputTelF = tel($_POST['inputTelF']);
		$telOK = 1;
	}
	else
	{
		$inputTelF = $_POST['inputTelF'];
	}
	if (isset($_POST['inputTelP']) && !empty($_POST['inputTelP']))
	{
		$inputTelP = tel($_POST['inputTelP']);
		$telOK = 1;
	}
	else
	{
		$inputTelP = $_POST['inputTelP'];
	}
	if ($telOK == 0)
	{
		$retour ="Vous devez saisir un numéro de téléphone.";
		echo "tel pas ok";
		header('Location: /configuration/infoentreprise.php?msg=' . $retour);
	}

	$inputEntreprise    = rtrim(ltrim(addslashes(ucfirst($_POST['inputEntreprise']))));
	$inputNom = ucfirst($_POST['inputNom']);
	$inputPrenom = ucfirst($_POST['inputPrenom']);
	$inputSiret = $_POST['inputSiret'];
	$inputEmail = $_POST['inputEmail'];
	$inputAdresse = $_POST['inputAdresse'];
	$inputVille = $_POST['inputVille'];
	$inputCP = $_POST['inputCP'];
	$inputPays = $_POST['inputPays'];

	
	$reqEntrepriseEdit = "UPDATE entreprise SET nomentreprise='$inputEntreprise',nom='$inputNom',prenom='$inputPrenom',email='$inputEmail',adresseSiege='$inputAdresse',cp='$inputCP',ville='$inputVille',pays='$inputPays',telP='$inputTelP',telF='$inputTelF' WHERE siret='$inputSiret'";

	echo $reqEntrepriseEdit . "<br><br>";

	if ($conn->query($reqEntrepriseEdit) == TRUE) 
	{
		$retour = "ok";
		echo "<br> ok";
	} 
	else 
	{
		$retour = "Error: " . $reqEntrepriseEdit . "<br>" . $conn->error;
		echo "<br>Error: " . $reqEntrepriseEdit . "<br>" . $conn->error;
	}
	echo "<br>FIN";
	header('Location: /configuration/infoentreprise.php?msg=' . $retour);
}
else
{
	echo "pas OK";
}