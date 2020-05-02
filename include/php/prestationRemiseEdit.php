<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputID']) && !empty($_POST['inputID']) && isset($_POST['inputRemise']) && !empty($_POST['inputRemise']))
{
	$id = $_POST['inputID'];
	$inputRemise = $_POST['inputRemise'];

	$reqRemiseEdit = "UPDATE prestation SET remise='$inputRemise' WHERE id=$id";


	if ($conn->query($reqRemiseEdit) == TRUE) 
	{
		$retour = "ok";
	} 
	else 
	{
		$retour = "Error: " . $reqRemiseEdit . "<br>" . $conn->error;
		echo "<br>Error: " . $reqRemiseEdit . "<br>" . $conn->error;
	}
	echo "<br>FIN";
	header('Location: /prestation/editProduits.php?msg=' . $retour . '&id=' . $id);
}
else
{
	echo "pas OK";
}