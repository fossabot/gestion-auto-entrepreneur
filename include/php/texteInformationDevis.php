<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputTexteInformation']) && !empty($_POST['inputTexteInformation'])) 
{
	$texte = htmlspecialchars(addslashes(rtrim(ltrim($_POST['inputTexteInformation']))));
	echo $texte1;

	$reqTexteInformationDevis = "UPDATE parametres SET texte1='$texte' WHERE id='3'";
	if ($conn->query($reqTexteInformationDevis) == TRUE) 
	{
		$retour = "ok";
	} 
	else 
	{
		$retour = "Error: " . $reqTexteInformationDevis . "<br>" . $conn->error;
		echo "<br>Error: " . $reqTexteInformationDevis . "<br>" . $conn->error;
	}
}



header('Location: /configuration/documents.php#texte-information');
?>