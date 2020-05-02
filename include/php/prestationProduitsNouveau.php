<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputID']) && !empty($_POST['inputID']))
{
	$id = $_POST['inputID'];
	// echo $id;
	// echo "<br>";

	// var_dump($_POST['inputProduit']);
	// echo "<br>";
	var_dump($_POST['inputPrixOffert']);
	// echo "<br>";

	$inputProduit = $_POST['inputProduit'];
	$inputProduitQte = $_POST['inputProduitQte'];
	$inputPrixOffert = $_POST['inputPrixOffert'];

	if ($inputProduit != 0)
	{
		echo $inputProduit;
		echo "<br>";
		echo $inputProduitQte;	
		echo "<br>";
		echo $inputPrixOffert;	
		echo "<br>";

		$offert = ($inputPrixOffert == "on") ? "1" : "0";

		echo "offert: " . $offert;
		echo "<br>";

		// on crée la requête SQL
		$reqCount = "SELECT * FROM prestationproduit WHERE facture=$id && produit=$inputProduit";
		// on envoie la requête
		$resCount = $conn->query($reqCount) or die();
		// Si on a des lignes...
		if ( $resCount->num_rows >= 1 )
		{
			$retour = "Une erreur critique a été détectée dans la BDD !";
		}
		else
		{
			// On créé la requête
			$reqInsertSiExistePas = "INSERT INTO prestationproduit(facture, produit, produitqte, offert) VALUES ('$id', '$inputProduit', '$inputProduitQte', '$offert')";
			 
			// on envoie la requête
			$resInsertSiExistePas = $conn->query($reqInsertSiExistePas);
			echo "produit ajouter<br>";
			$retour = "ok";
		}
	}
	echo "<br>FIN";
	header('Location: /prestation/editProduits.php?msg=' . $retour . '&id=' . $id);
}
else
{
	echo "pas OK";
}