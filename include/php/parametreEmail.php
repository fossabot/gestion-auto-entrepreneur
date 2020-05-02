<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

if (isset($_POST['valider']) && !empty($_POST['valider'])) 
{
	if ($_POST['valider'] == "parametreExedition") 
	{
		parametreUpdate("10", "texte1", $_POST['inputServeurSMTP']);
		parametreUpdate("13", "texte1", $_POST['inputSecurite']);
		parametreUpdate("14", "texte1", $_POST['inputPort']);
		parametreUpdate("11", "texte1", $_POST['inputUtilisateur']);
		parametreUpdate("12", "texte1", $_POST['inputMotDePasse']);
		parametreUpdate("16", "texte1", $_POST['inputNomEnvoi']);
		parametreUpdate("15", "texte1", $_POST['inputNomEmail']);


		$retour = "ok";
		$ancre = "#parametreExedition";
	}
	elseif ($_POST['valider'] == "parametreExeditionEmailTest") 
	{
		$sujet = "Email de test";
		$contenu = "Bonjour, ceci est un email de test envoyé depuis votre application de gestion. Si vous voyez ce message, cela signifie que vous l'avez correctement configuré, <b>félicitation</b> !<br>Vous pouvez maintenant l'utilisée. <br><br> Cordialement.";

		$retour = envoiMail("test", $sujet, $contenu, "");

		$ancre = "#parametreExedition";
	}
	elseif ($_POST['valider'] == "envoiFactre") 
	{
		parametreUpdate("6", "texte1", rtrim(ltrim(addslashes(ucfirst($_POST['inputSujet'])))));
		parametreUpdate("7", "texte1", $_POST['inputContenu']);
		$retour = "ok";
		$ancre = "#envoiFactre";
	}
	elseif ($_POST['valider'] == "envoiDevis") 
	{
		parametreUpdate("8", "texte1", rtrim(ltrim(addslashes(ucfirst($_POST['inputSujet'])))));
		parametreUpdate("9", "texte1", $_POST['inputContenu']);
		$retour = "ok";
		$ancre = "#envoiDevis";
	}
}
else
{
	$retour = "Erreur !";
	$ancre = "";
}
header('Location: /configuration/email.php?msg=' . $retour . $ancre);