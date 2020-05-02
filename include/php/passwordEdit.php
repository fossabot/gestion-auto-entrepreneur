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
	isset($_POST['inputMdpActuel']) && !empty($_POST['inputMdpActuel']) &&
	isset($_POST['inputMdp1']) && !empty($_POST['inputMdp1']) &&
	isset($_POST['inputMdp2']) && !empty($_POST['inputMdp2']) &&
	isset($_POST['inputSIRET']) && !empty($_POST['inputSIRET'])
)
{
	$passAct = $_POST['inputMdpActuel'];
	$passNv1 = $_POST['inputMdp1'];
	$passNv2 = $_POST['inputMdpActuel2'];
	$inputSiret = $_POST['inputSIRET'];

	if ($passNv1 == $passNv2) 
	{
		if (entrepriseInfo('password') == password($passAct)) 
		{
			$password = password($passNv1);
		}
		else
		{
			$retour = "Error: Le mot de passe actuel n'est pas correct";
		}
	}
	else
	{
		$retour = "Error: Les deux mots de passe sont différents";
	}

	
	$reqEntrepriseEditPassword = "UPDATE entreprise SET password='$password'WHERE siret='$inputSiret'";

	echo $reqEntrepriseEditPassword . "<br><br>";

	if ($conn->query($reqEntrepriseEditPassword) == TRUE) 
	{
		$retour = "ok";
		echo "<br> ok";
	} 
	else 
	{
		$retour = "Error: " . $reqEntrepriseEditPassword . "<br>" . $conn->error;
		echo "<br>Error: " . $reqEntrepriseEditPassword . "<br>" . $conn->error;
	}
	echo "<br>FIN";
	header('Location: /configuration/mot-de-passe.php?msg=' . $retour);
}
else
{
	echo "pas OK";
}