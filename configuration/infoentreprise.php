<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Informations de l'entreprise";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Informations de l'entreprise</h1>

		<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) 
		{
			if ($_GET['msg'] == "ok") 
			{
				?>
					<div class="alert alert-success text-center w-25 mx-auto mt-3" role="alert">
					  Succes !
					</div>
				<?php
			}
			else
			{
				?>
					<div class="alert alert-danger text-center w-25 mx-auto mt-3" role="alert">
					  <?php echo $_GET['msg']; ?>
					</div>
				<?php
			}
		}
		?>

		<form method="POST" action="<?php echo $racine . $p_php . "entrepriseEdit.php"; ?>">
			<div class="form-group">
				<label for="inputEntreprise"><span class="warning">*</span>Nom de l'entreprise</label>
				<input type="text" class="form-control" id="inputEntreprise" name="inputEntreprise" value="<?php echo entrepriseInfo("nomentreprise"); ?>">
			</div>
			<div class="form-group">
				<label for="inputSiret"><span class="warning">*</span>SIRET <span class="badge badge-danger">*</span></label>
				<input type="text" class="form-control" id="inputSiret" name="inputSiret" readonly value="<?php echo entrepriseInfo("siret"); ?>">
			</div>
			<div class="form-row">
				<div class="form-group col-md-6" id="particulierNom">
					<label for="inputNom"><span class="warning">*</span>Nom</label>
					<input type="text" class="form-control" id="inputNom" name="inputNom" value="<?php echo entrepriseInfo("nom"); ?>">
				</div>
				<div class="form-group col-md-6" id="particulierPrenom">
					<label for="inputPrenom"><span class="warning">*</span>Prénom</label>
					<input type="text" class="form-control" id="inputPrenom" name="inputPrenom" value="<?php echo entrepriseInfo("prenom"); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail"><span class="warning">*</span>Adresse mail professionnelle</label>
				<input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo entrepriseInfo("email"); ?>">
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputTelP">Téléphone portable</label>
					<input type="tel" class="form-control" id="inputTelP" name="inputTelP" value="<?php echo entrepriseInfo("telP"); ?>">
					<small id="emailHelp" class="form-text text-muted">Vous devez saisir au moins un des deux téléphones (portable ou fixe)</small>
				</div>
				<div class="form-group col-md-6">
					<label for="inputTelF">Téléphone fixe</label>
					<input type="tel" class="form-control" id="inputTelF" name="inputTelF" value="<?php echo entrepriseInfo("telF"); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputAdresse"><span class="warning">*</span>Address</label>
				<input type="text" class="form-control" id="inputAdresse" name="inputAdresse" value="<?php echo entrepriseInfo("adresseSiege"); ?>">
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputVille"><span class="warning">*</span>Ville</label>
					<input type="text" class="form-control" id="inputVille" name="inputVille" placeholder="" required="true" value="<?php echo entrepriseInfo("ville"); ?>">
				</div>
				<div class="form-group col-md-2">
					<label for="inputCP"><span class="warning">*</span>Code postal</label>
					<input type="text" class="form-control" id="inputCP" name="inputCP" min="00000" max="99999" placeholder="" required="true" value="<?php echo entrepriseInfo("cp"); ?>">
				</div>
				<div class="form-group col-md-4">
					<label for="inputPays"><span class="warning">*</span>Pays</label>
					<input type="text" class="form-control" id="inputPays" name="inputPays" placeholder="" required="true" value="<?php echo entrepriseInfo("pays"); ?>">
				</div>
			</div>
			<span class="badge badge-danger"> * Cette information n'est pas modifiable</span>
			<div class="text-center">
				<button type="submit" class="btn btnValider">Valider</button>
			</div>
		</form>
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>