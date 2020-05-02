<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Installation";

		require($racine . $p_php . "head.php");

		if (ifInstall() == 1) 
		{
			header('Location:' . $racine . '/');
		}
	?>
</head>
<body>
	<header>
		<?php echo menuInstall(); ?>
	</header>
	<main>
		<h1>Installation</h1>
		<?php
			if (
				isset($_POST['inputNom'])          && !empty($_POST['inputNom']) &&
				isset($_POST['inputPrenom'])       && !empty($_POST['inputPrenom']) &&
				isset($_POST['inputEmail'])        && !empty($_POST['inputEmail']) &&
				isset($_POST['inputPass1'])        && !empty($_POST['inputPass1']) &&
				isset($_POST['inputPass2'])        && !empty($_POST['inputPass2']) &&
				isset($_POST['inputNomEntreprise'])&& !empty($_POST['inputNomEntreprise']) &&
				isset($_POST['inputSiret'])        && !empty($_POST['inputSiret']) &&
				isset($_POST['inputAdresse'])      && !empty($_POST['inputAdresse']) &&
				isset($_POST['inputVille'])        && !empty($_POST['inputVille']) &&
				isset($_POST['inputPays'])         && !empty($_POST['inputPays']) &&
				isset($_POST['inputCP'])           && !empty($_POST['inputCP']) 
			) 
			{
				$Nom           = $_POST['inputNom'];
				$Prenom        = $_POST['inputPrenom'];
				$Email         = $_POST['inputEmail'];
				$Pass1         = $_POST['inputPass1'];
				$Pass2         = $_POST['inputPass2'];
				$NomEntreprise = $_POST['inputNomEntreprise'];
				$Siret         = str_replace(' ', '', $_POST['inputSiret']);
				$Adresse       = $_POST['inputAdresse'];
				$Ville         = $_POST['inputVille'];
				$Pays          = $_POST['inputPays'];
				$CP            = $_POST['inputCP'];

				if ($Pass1 == $Pass2) //Verif si mot de passe pas diff
				{
					if (strlen($Siret) == 14) //Verif si longueur du siret est bien de 14 caracteres sans les accents
					{
						if (ctype_digit($Siret)) //Verif si le siret ne contient pas de lettre
						{
							if (isset($_POST['inputTelF'])          && !empty($_POST['inputTelF'])) 
							{
								$TelF = $_POST['inputTelF'];
							}
							else
							{
								$TelF = NULL;
							}

							if (isset($_POST['inputTelP'])          && !empty($_POST['inputTelP'])) 
							{
								$TelP = $_POST['inputTelP'];
							}
							else
							{
								$TelP = NULL;
							}

							//Mise en forme des chaines de caractères
							$Nom    = ucfirst($Nom);
							$Prenom = ucfirst($Prenom);
							$Ville  = ucfirst($Ville);
							$Pays   = ucfirst($Pays);

							//Securisation du mot de passe:
							$Pass1 = password($Pass1);

							//INSERT SQL
							// On créé la requête
							$reqInstall = "INSERT INTO entreprise(siret, nomentreprise, nom, prenom, email, adresseSiege, cp, ville, pays, telP, telF, password) VALUES('$Siret', '$NomEntreprise', '$Nom', '$Prenom','$Email', '$Adresse', '$CP', '$Ville', '$Pays', '$TelP', '$TelF', '$Pass1')";
							if ($conn->query($reqInstall) === TRUE) 
							{
								// echo "New record created successfully";
								?>
									<div class="alert alert-success w-50 mx-auto text-center" role="alert">
										<h4 class="alert-heading">Votre application est maintenant prête à l'utilisation !</h4>
										<p>Vous pouvez maintenant retourner à la page d'<a href="/" class="alert-link">accueil</a>.</p>
										<hr>
										<p class="mb-0">Attention: Pour plus de sécurité, la page d'installation a été désactivée.</p>
									</div>
								<?php
								parametreUpdate(1, "var1", 1);
							} else 
							{
								echo "Error: " . $reqInstall . "<br>" . $conn->error;
							}
						}
						else
						{
							?>
								<div class="alert alert-danger" role="alert">
									<h4 class="alert-heading">Erreur</h4>
									<p>Votre numéro SIRET ne semble pas correct, il doit comporter seulement des chiffres. Merci de recommencer votre saisie.</p>
									<hr>
									<p class="mb-0"><a href="/install.php" class="alert-link">Retour au formulaire</a></p>
								</div>
							<?php
						}
					}
					else
					{
						?>
							<div class="alert alert-danger" role="alert">
								<h4 class="alert-heading">Erreur</h4>
								<p>Votre numéro SIRET ne semble pas correct, il doit comporter 14 chiffres. Merci de recommencer votre saisie.</p>
								<hr>
								<p class="mb-0"><a href="/install.php" class="alert-link">Retour au formulaire</a></p>
							</div>
						<?php
					}
				}
				else
				{
					?>
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading">Erreur</h4>
							<p>Les mots de passe sont différents !</p>
							<hr>
							<p class="mb-0"><a href="/install.php" class="alert-link">Retour au formulaire</a></p>
						</div>
					<?php
				}
			}
			else
			{
				?>
					<div class="alert alert-danger w-50 mx-auto text-center" role="alert">
						<h4 class="alert-heading">Attention !</h4>
						<p>Vous devez d'abord procéder à la configuration de l'application avant de l'utiliser.</p>
						<hr>
						<p class="mb-0">Ces informations sont très importantes, vérifiez bien votre saisie avant de valider.</p>
					</div>

					<form method="POST" action="#">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputNom"><span class="warning">*</span>Nom</label>
								<input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Nom" required="true">
							</div>
							<div class="form-group col-md-4">
								<label for="inputPrenom"><span class="warning">*</span>Prénom</label>
								<input type="text" class="form-control" id="inputPrenom" name="inputPrenom" placeholder="Prénom" required="true">
							</div>
							<div class="form-group col-md-4">
								<label for="inputEmail"><span class="warning">*</span>Email professionnel</label>
								<input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required="true">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPass1"><span class="warning">*</span>Mot de passe</label>
								<input type="password" class="form-control" id="inputPass1" name="inputPass1" placeholder="Mot de passe" required="true">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPass2"><span class="warning">*</span>Mot de passe</label>
								<input type="password" class="form-control" id="inputPass2" name="inputPass2" placeholder="Mot de passe" required="true">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputTelF">Téléphone fixe</label>
								<input type="tel" class="form-control" id="inputTelF" name="inputTelF" placeholder="Téléphone fixe">
							</div>
							<div class="form-group col-md-6">
								<label for="inputTelP">Téléphone portable</label>
								<input type="tel" class="form-control" id="inputTelP" name="inputTelP" placeholder="Téléphone portable">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputNomEntreprise"><span class="warning">*</span>Nom de l'entreprise</label>
								<input type="text" class="form-control" id="inputNomEntreprise" name="inputNomEntreprise" placeholder="Nom de l'entreprise" required="true">
							</div>
							<div class="form-group col-md-6">
								<label for="inputSiret"><span class="warning">*</span>Siret</label>
								<input type="number" class="form-control" id="inputSiret" name="inputSiret" placeholder="Siret" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="inputAdresse"><span class="warning">*</span>Adresse du siège</label>
							<input type="text" class="form-control" id="inputAdresse" name="inputAdresse" placeholder="Adresse (numéro & rue)" required="true">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputVille"><span class="warning">*</span>Ville</label>
							<input type="text" class="form-control" id="inputVille" name="inputVille" placeholder="Ville" required="true">
							</div>
							<div class="form-group col-md-4">
								<label for="inputPays"><span class="warning">*</span>Pays</label>
							<input type="text" class="form-control" id="inputPays" name="inputPays" placeholder="Pays" required="true">
							</div>
							<div class="form-group col-md-2">
								<label for="inputCP"><span class="warning">*</span>Code postal</label>
								<input type="text" class="form-control" id="inputCP" name="inputCP" min="00000" max="99999" placeholder="Code postal" required="true">
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btnValider">Valider</button>
						</div>
					</form>
				<?php
			}
		?>

		
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>