<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");


if (isset($_POST['inputID']) && !empty($_POST['inputID']))
{
	$id = $_POST['inputID'];

	if (isset($_POST['supprimer']) && !empty($_POST['supprimer'])) 
	{
		$produit = $_POST['supprimer'];

		// On créé la requête
		$reqSuppressionArticle = "DELETE FROM prestationproduit WHERE facture=$id && produit=$produit";
		echo $reqSuppressionArticle;
		 
		// on envoie la requête
		$resSuppressionArticle = $conn->query($reqSuppressionArticle);
		$retour = "ok";
	}
	else
	{
		$inputProduit = $_POST['inputProduit'];
		$inputProduitQte = $_POST['inputProduitQte'];
		$inputPrixOffert = $_POST['inputPrixOffert'];

		for ($i=0; $i < count($inputProduit); $i++) 
		{ 
			if ($inputProduit[$i] != 0)
			{
				echo $inputProduit[$i];
				echo "<br>";
				echo $inputProduitQte[$i];	
				echo "<br>";
				echo $inputPrixOffert[$i];	
				echo "<br>";

				$offert = ($inputPrixOffert[$i] == "on") ? "1" : "0";

				echo "offert: " . $offert;
				echo "<br>";

				// on crée la requête SQL
				$reqCount = "SELECT * FROM prestationproduit WHERE facture=$id && produit=$inputProduit[$i]";
				// on envoie la requête
				$resCount = $conn->query($reqCount) or die();
				// Si on a des lignes...
				if ( $resCount->num_rows > 1 )
				{
					$retour = "Une erreur critique a été détectée dans la BDD !";
				}
				elseif ( $resCount->num_rows == 1 )
				{
				    // On créé la requête
					$reqModifDeLaQuantite = "UPDATE prestationproduit SET produitqte='$inputProduitQte[$i]', offert='$offert' WHERE facture=$id && produit=$inputProduit[$i]";
					 
					// on envoie la requête
					$resModifDeLaQuantite = $conn->query($reqModifDeLaQuantite);
					echo "produit deja present<br>";
					$retour = "ok";
				}
				else
				{
					// On créé la requête
					$reqInsertSiExistePas = "INSERT INTO prestationproduit(facture, produit, produitqte, offert) VALUES ('$id', '$inputProduit[$i]', '$inputProduitQte[$i]', '$offert')";
					 
					// on envoie la requête
					$resInsertSiExistePas = $conn->query($reqInsertSiExistePas);
					echo "produit ajouter<br>";
					$retour = "ok";
				}
			}
		}
	}
	echo "<br>FIN";
	header('Location: /prestation/editProduits.php?msg=' . $retour . '&id=' . $id);
}
else
{
	echo "pas OK";
}