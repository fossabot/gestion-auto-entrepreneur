<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");

$dir = "../modeles/";

$files = scandir($dir);

foreach($files as $valeur)
{
	$file = explode(".", $valeur);
	$extension = $file[1];

	if ($valeur == "." || $valeur == ".." || $extension != "xml") 
	{
		
	} 
	else 
	{
		// echo $valeur . "<br>";
		$parametres = simplexml_load_file($dir . $valeur);

		$titre = $parametres->titre;
		$auteur = $parametres->auteur;
		$description = $parametres->description;
		$version = $parametres->version;
		$fichier = $parametres->fichier;

		if (file_exists($dir . $fichier)) 
		{
		    echo "Le fichier " . $fichier . " existe.";
		
			$reqListeFichiers1 = "SELECT * FROM modelesFactures";
			 
			$resListeFichiers1 = $conn->query($reqListeFichiers1);

			$existe = 0;
			
			while ($dataListeFichiers1 = mysqli_fetch_array($resListeFichiers1)) 
			{

				if (
					$titre == $dataListeFichiers1['titre'] &&
					$auteur == $dataListeFichiers1['auteur'] &&
					$description == $dataListeFichiers1['description'] &&
					$version == $dataListeFichiers1['version']  &&
					$fichier == $dataListeFichiers1['fichier'] 
				) 
				{
					$existe = 1;
					// echo $titre . "<br>";:
					// echo $dataListeFichiers1['titre'] . "<br>";:
					// echo $fichier . "<br>";:
					// echo $dataListeFichiers1['fichier'] . "<br>";:
				}
			}
			if ($existe == 1) 
			{
				echo "Le fichier: " . $valeur . "est déja dans la BDD<br>";
			}
			elseif ($existe == 0) 
			{
				echo "Le fichier: " . $valeur . "n'est pas dans la BDD, il vas etre inserer<br>";

				$reqModelesInsert = "INSERT INTO modelesFactures (titre, auteur, description, version, fichier) VALUES ('$titre', '$auteur', '$description', '$version', '$fichier')";
				
				if ($resModelesInsert = $conn->query($reqModelesInsert) === TRUE) 
				{
					echo "Le fichier: " . $valeur . "à été inserer avec succes<br>";
				} 
				else 
				{
					echo $reqModelesInsert . "<br>";
					echo "Error: " . $reqModelesInsert . "<br>" . $conn->error;
				}
			}
		} 
		else 
		{
		    echo "Le fichier " . $fichier . " n'existe pas.<br>";
		}
		echo "--------------------<br>";
	}
}

$reqListeFichiers2 = "SELECT * FROM modelesFactures";
 
$resListeFichiers2 = $conn->query($reqListeFichiers2);
 
while ($dataListeFichiers2 = mysqli_fetch_array($resListeFichiers2)) 
{
	$existe = 0;
	foreach($files as $valeur)
	{
		$file = explode(".", $valeur);
		$extension = $file[1];

		if ($valeur == "." || $valeur == ".." || $extension != "xml") 
		{
			
		} 
		else 
		{
			$parametres = simplexml_load_file($dir . $valeur);

			$titre = $parametres->titre;
			$auteur = $parametres->auteur;
			$description = $parametres->description;
			$version = $parametres->version;
			$fichier = $parametres->fichier;

			if (
				$titre == $dataListeFichiers2['titre'] &&
				$auteur == $dataListeFichiers2['auteur'] &&
				$description == $dataListeFichiers2['description'] &&
				$version == $dataListeFichiers2['version']  &&
				$fichier == $dataListeFichiers2['fichier'] 
			) 
			{
				$existe = 1;
			}
		}
	}
	if ($existe == 1) 
	{
		echo "Le fichier " . $dataListeFichiers2['fichier'] . " est toujours présent.<br>";
	}
	if ($existe == 0)
	{
		$bdd_titre = $dataListeFichiers2['titre'];
		$bdd_auteur = $dataListeFichiers2['auteur'];
		$bdd_description = $dataListeFichiers2['description'];
		$bdd_version = $dataListeFichiers2['version'];
		$bdd_fichier = $dataListeFichiers2['fichier'];

		echo "Le fichier " . $dataListeFichiers2['fichier'] . " n'est plus présent, il vas etre supprimer.<br>";
		// On créé la requête
		$reqSupprFichier = "DELETE FROM modelesFactures WHERE titre='$bdd_titre' && auteur='$bdd_auteur' && description='$bdd_description' && version='$bdd_version' && fichier='$bdd_fichier'";
		 
		// on envoie la requête
		$resSupprFichier = $conn->query($reqSupprFichier);
		echo "Le fichier " . $dataListeFichiers2['fichier'] . " à été supprimer.<br>";
	}
}

header('Location: /configuration/documents.php#fichiers-modeles');
?>