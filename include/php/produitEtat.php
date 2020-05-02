<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputREF']) && !empty($_POST['inputREF']))
{
	$ref = $_POST['inputREF'];
	// echo $ref;

	if (produitInfo("desactiver", $ref) == 1) 
	{
		$etat = 0;
	}
	else
	{
		$etat = 1;
	}

	$reqProduitEtat = "UPDATE produits SET desactiver='$etat' WHERE ref=$ref";

	echo $reqProduitEtat . "<br><br>";

	if ($conn->query($reqProduitEtat) == TRUE) 
	{
		$retour = "ok";
	} 
	else 
	{
		$retour = "Error: " . $reqProduitEtat . "<br>" . $conn->error;
		echo "<br>Error: " . $reqProduitEtat . "<br>" . $conn->error;
	}
	echo "<br>FIN";
	header('Location: /produit/edit.php?msg=' . $retour . '&ref=' . $ref);
}
else
{
	echo "pas OK";
}