<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (
	isset($_POST['inputID']) && !empty($_POST['inputID']) && 
	isset($_POST['inputUrgence']) && !empty($_POST['inputUrgence']) && 
	isset($_POST['inputProduitDescription']) && !empty($_POST['inputProduitDescription'])
)
{
	$id = $_POST['inputID'];

	$inputUrgence = $_POST['inputUrgence'];
	$inputMoyenPaiement = $_POST['inputMoyenPaiement'];
	$inputDateFacturation = $_POST['inputDateFacturation'];
	$inputDateLivraison = $_POST['inputDateLivraison'];
	$inputProduitDescription = $_POST['inputProduitDescription'];

	echo " - " . $inputDateFacturation . "<br>";
	echo " - " . $inputDateLivraison . "<br>";

	if ($inputDateFacturation == "") 
	{
		$inputDateFacturation = "0000-00-00";
	}
	if ($inputDateLivraison == "") 
	{
		$inputDateLivraison = "0000-00-00";
	}
	if ($inputMoyenPaiement != "") 
	{
		$reqProduitEditMoyenDePayement = "UPDATE prestation SET moyenpaiement='$inputMoyenPaiement' WHERE id=$id";
		if ($conn->query($reqProduitEditMoyenDePayement) == TRUE) 
		{
			$retour = "ok";
		} 
		else 
		{
			$retour = "Error: " . $reqProduitEditMoyenDePayement . "<br>" . $conn->error;
			echo "<br>Error: " . $reqProduitEditMoyenDePayement . "<br>" . $conn->error;
		}
	}


	$Description    = htmlspecialchars(rtrim(ltrim($_POST['inputProduitDescription'])));

	if ($_POST['inputEtat'] == 1)
	{
		$date = date('Y-m-d H:i:s');
		$reqProduitEdit = "UPDATE prestation SET dateFacturation='$inputDateFacturation', datelivraison='$inputDateLivraison', urgence='$inputUrgence', commentaire='$inputProduitDescription', datecloture='$date', cloture='1' WHERE id=$id";
	}
	else
	{
		$reqProduitEdit = "UPDATE prestation SET dateFacturation='$inputDateFacturation', datelivraison='$inputDateLivraison', urgence='$inputUrgence', commentaire='$inputProduitDescription' WHERE id=$id";
	}

	echo $reqProduitEdit . "<br><br>";

	if ($conn->query($reqProduitEdit) == TRUE) 
	{
		$retour = "ok";
	} 
	else 
	{
		$retour = "Error: " . $reqProduitEdit . "<br>" . $conn->error;
		echo "<br>Error: " . $reqProduitEdit . "<br>" . $conn->error;
	}
	echo "<br>FIN";
	header('Location: /prestation/editInfo.php?msg=' . $retour . '&id=' . $id);
}
else
{
	echo "pas OK";
}