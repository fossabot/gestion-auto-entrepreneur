<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

// echo "inputDestinataire:  " . $_POST['inputDestinataire'] . "<br>";
// echo "inputSujet:  " . $_POST['inputSujet'] . "<br>";
// echo "inputContenu:  " . $_POST['inputContenu'] . "<br>";
// echo "inputPrestation:  " . $_POST['inputPrestation'] . "<br>";

if (isset($_POST['inputDestinataire']) && !empty($_POST['inputDestinataire']) && isset($_POST['inputSujet']) && !empty($_POST['inputSujet']) &&  isset($_POST['inputContenu']) && !empty($_POST['inputContenu']) &&  isset($_POST['inputPrestation']) && !empty($_POST['inputPrestation']))
{
	// $destinataireEmail = clientInfo('email', prestationInfo('client', $_GET['prestation']));
	$destinataireID = $_POST['inputDestinataire'];

	$prestation = $_POST['inputPrestation'];
	echo $prestation . "<br>";

	$sujet = $_POST['inputSujet'];
	$contenu = $_POST['inputContenu'];

	if (isset($_POST['inputDocument']) && !empty($_POST['inputDocument'])) 
	{
		$document = $_POST['inputDocument'];
	} 
	else 
	{
		$document = "";
	}
	
	$retour = envoiMail($destinataireID, $sujet, $contenu, $document);
	
	if ($retour == "ok") 
	{
		// On créé la requête
		$datetime = date("Y-m-d H:i:s");
		$reqInsertMail = "INSERT INTO email(datetime, destinataire, prestation, document, objet, texte) VALUES ('$datetime', '$destinataireID', '$prestation', '$document', '$sujet', '$contenu')";
		 echo $reqInsertMail;
		// on envoie la requête
		$resInsertMail = $conn->query($reqInsertMail);
	} 
	else 
	{
		
	}
	
}
else
{
	echo "non";
}

echo "<br>FIN";
header('Location: /email/liste.php?msg=' . $retour);
