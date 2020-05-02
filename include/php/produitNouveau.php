<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");
if (
	isset($_POST['inputTypeListeActivite']) && !empty($_POST['inputTypeListeActivite']) && 
	isset($_POST['inputProduitNom']) && !empty($_POST['inputProduitNom']) && 
	// isset($_POST['inputProduitDescription']) && !empty($_POST['inputProduitDescription']) && 
	// isset($_POST['inputPrixAchat']) && !empty($_POST['inputPrixAchat']) && 
	isset($_POST['inputCoefMarge']) && !empty($_POST['inputCoefMarge']) && 
	isset($_POST['inputPrixVente']) && !empty($_POST['inputPrixVente'])
	) 
{
	$Nom    = rtrim(ltrim(addslashes(ucfirst($_POST['inputProduitNom']))));
	$Description    = rtrim(ltrim(addslashes(ucfirst($_POST['inputProduitDescription']))));
	$PAchat    = rtrim(ltrim($_POST['inputPrixAchat']));
	$CoefMarge         = rtrim(ltrim($_POST['inputCoefMarge']));
	$PVente         = rtrim(ltrim($_POST['inputPrixVente']));
	$IDAct         = $_POST['inputTypeListeActivite'];

	$reqInstall = "INSERT INTO produits(designation, categorie, prixachat, coefmarge, prixvente, commentaire) VALUES ('$Nom','$IDAct','$PAchat','$CoefMarge','$PVente','$Description')";

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
header('Location: /produit/nouveau.php?msg=' . $retour);