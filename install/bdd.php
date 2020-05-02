<!DOCTYPE html>
<html>
<head>
	<?php

		//CONF
		$racine = "..";
		require($racine . "/include/php/general.php");

		//NOM SITE
		$ns_site = "";
		$ns_separateur = "";
		$ns_page = "Installation de la BDD";

		if (file_exists($racine . "/include/conf/bdd.php")) 
		{
			header('Location:' . $racine . '/index.php');
		}

		require($racine . "/include/php/head.php");
	?>
</head>
<body>
	<header>
		<?php echo menuInstall(); ?>
	</header>
	<main>
		<h1>Installation de la BDD</h1>
		<?php
			if (
				isset($_POST['inputAdresse']) && !empty($_POST['inputAdresse']) &&
				isset($_POST['inputUtilisateur']) && !empty($_POST['inputUtilisateur']) &&
				isset($_POST['inputBDD']) && !empty($_POST['inputBDD']) 
			) 
			{
				$Adresse           = $_POST['inputAdresse'];
				$Utilisateur        = $_POST['inputUtilisateur'];
				$Pass         = $_POST['inputPass'];
				$Bdd         = $_POST['inputBDD'];

				$testBDD = mysqli_connect($Adresse,$Utilisateur,$Pass, $Bdd);

				// echo $Adresse;

				if ($testBDD) //Verif si mot de passe pas diff
				{
					$nom_file = $racine . "/include/conf/bdd.php";


				    $texte   = "<?php\n";
				    $texte  .= "\$host  ='$Adresse';\n";
					$texte  .= "\$user  ='$Utilisateur';\n";
					$texte  .= "\$passwd='$Pass';\n";
					$texte  .= "\$mabase='$Bdd';\n";

				    // création du fichier
				    $f = fopen($nom_file, "x+");
				    // écriture
				    fputs($f, $texte );
				    // fermeture
				    fclose($f);
					
					header( "Refresh:5; url=install.php");
					?>
						<div class="alert alert-success" role="alert">
							<h4 class="alert-heading">Succès</h4>
							<p>Vous allez être redirigé vers la page de configuration de votre entreprise dans quelques secondes...</p>
						</div>
					<?php
				}
				else
				{
					?>
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading">Erreur</h4>
							<?php
								echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
								echo "<br>Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
								echo "<br>Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
							?>
							<hr>
						</div>
					<?php
				}
			}
			?>
			<div class="alert alert-danger w-50 mx-auto text-center" role="alert">
				<h4 class="alert-heading">Attention !</h4>
				<p>Vous devez d'abord procéder à la configuration de l'application avant de l'utiliser.</p>
			</div>

			<form method="POST" action="#">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputAdresse"><span class="warning">*</span>Adresse du serveur</label>
						<input type="text" class="form-control" id="inputAdresse" name="inputAdresse" placeholder="Adresse du serveur" required="true">
						<small>Adresse IP ou "localhost" si le serveur web est sur le même serveur que la base de donnée.</small>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputUtilisateur"><span class="warning">*</span>Utilisateur</label>
						<input type="text" class="form-control" id="inputUtilisateur" name="inputUtilisateur" placeholder="Utilisateur" required="true">
					</div>
					<div class="form-group col-md-6">
						<label for="inputPass"><span class="warning">*</span>Mot de passe</label>
						<input type="password" class="form-control" id="inputPass" name="inputPass" placeholder="Mot de passe">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputBDD"><span class="warning">*</span>Base de donnée</label>
						<input type="text" class="form-control" id="inputBDD" name="inputBDD" placeholder="Base de donnée" required="true">
						<small>La BDD doit exister et être vide.</small>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btnValider">Valider</button>
				</div>
			</form>

		
	</main>
	<footer>
		<?php require($racine . "/include/php/footer.php"); ?>
	</footer>
</body>
</html>

<style>
	body
	{
		background-color: #D6D6D6;
	}
	main
	{
		width: 80%;
		margin: auto;
		min-height: 100vh;
	}
	footer
	{
		text-align: center;
	}
	h1
	{
		text-align: center;
	}
</style>