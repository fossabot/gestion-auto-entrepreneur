<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['inputType']) && !empty($_POST['inputType']) && isset($_POST['inputActivite']) && !empty($_POST['inputActivite'])) 
{
	// echo $_POST['inputType'] . "<br>";
	// echo $_POST['inputActivite'] . "<br>";

	if(strlen($_POST['inputType']) != 1) 
    {
    	header('Location: /configuration/activite.php');
    }
	
	$idType = $_POST['inputType'];
	$activite = rtrim(ltrim(addslashes(ucfirst($_POST['inputActivite']))));

	// On créé la requête
	$req = "INSERT INTO typeactivitedesc (idtype, description) VALUES ('$idType', '$activite')";
	 
	// on envoie la requête
	if ($res = $conn->query($req) === TRUE) 
	{
		echo "ok";
	} 
	else 
	{
		echo $req . "<br>";
		echo "Error: " . $reqInstall . "<br>" . $conn->error;
	}
	
	header('Location: /configuration/activite.php');
}
echo " - FIN";