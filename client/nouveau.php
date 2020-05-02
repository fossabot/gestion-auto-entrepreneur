<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Nouveau client";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Nouveau client</h1>

		<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) 
		{
			if ($_GET['msg'] == "ok") 
			{
				?>
					<div class="alert alert-success text-center w-25 mx-auto" role="alert">
					  Succes !
					</div>
				<?php
			}
			else
			{
				?>
					<div class="alert alert-danger text-center w-25 mx-auto" role="alert">
					  <?php echo $_GET['msg']; ?>
					</div>
				<?php
			}
		}
		?>
		
		<form method="POST" action="<?php echo $racine . $p_php . "clientNouveau.php"; ?>">
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="inputType"><span class="warning">*</span>Type <span class="badge badge-danger">*</span></label>
					<select id="inputType" name="inputType" class="form-control">
						<option value="professionnel" selected>Professionnel</option>
						<option value="particulier">Particulier</option>
					</select>
				</div>
				<div class="form-group col-md-2" id="particulierGenre">
					<label for="inputGenre"><span class="warning">*</span>Genre <span class="badge badge-danger">*</span></label>
					<select id="inputGenre" name="inputGenre" class="form-control">
						<option value="2" selected>Monsieur</option>
						<option value="3">Madame</option>
					</select>
				</div>
				<div class="form-group col-md-4" id="particulierNom">
					<label for="inputNom"><span class="warning">*</span>Nom <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control" id="inputNom" name="inputNom">
				</div>
				<div class="form-group col-md-4" id="particulierPrenom">
					<label for="inputPrenom"><span class="warning">*</span>Prénom <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control" id="inputPrenom" name="inputPrenom">
				</div>
				<div class="form-group col-md-10" id="professionnelNomEntreprise">
					<label for="inputNomEntreprise"><span class="warning">*</span>Nom de l'entreprise <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control" id="inputNomEntreprise" name="inputNomEntreprise">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputTelF">Téléphone fixe</label>
					<input type="tel" class="form-control" id="inputTelF" name="inputTelF" placeholder="">
				</div>
				<div class="form-group col-md-6">
					<label for="inputTelP">Téléphone portable</label>
					<input type="tel" class="form-control" id="inputTelP" name="inputTelP" placeholder="">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail"><span class="warning">*</span>Email</label>
				<input type="text" class="form-control" id="inputEmail" name="inputEmail">
			</div>
			<div class="form-group">
				<label for="inputAdresse"><span class="warning">*</span>Address</label>
				<input type="text" class="form-control" id="inputAdresse" name="inputAdresse" required="true">
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputVille"><span class="warning">*</span>Ville</label>
				<input type="text" class="form-control" id="inputVille" name="inputVille" placeholder="" required="true">
				</div>
				<div class="form-group col-md-2">
					<label for="inputCP"><span class="warning">*</span>Code postal</label>
					<input type="text" class="form-control" id="inputCP" name="inputCP" min="00000" max="99999" placeholder="" required="true">
				</div>
				<div class="form-group col-md-4">
					<label for="inputPays"><span class="warning">*</span>Pays</label>
					<select id="inputPays" name="inputPays" class="form-control">
						<option value="France" selected>France</option>
						<option value="Suisse">Suisse</option>
					</select>
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

<script type="text/javascript">

	$('#particulierNom').css('display', 'none');
	$('#particulierPrenom').css('display', 'none');
	$('#particulierGenre').css('display', 'none');

	$("#inputType").change
	(
		function () 
		{
			if (document.getElementById('inputType').value == "professionnel") 
			{
				$('#particulierNom').hide();
				$('#particulierPrenom').hide();
				$('#particulierGenre').hide();
				$('#professionnelNomEntreprise').show();
			}
			if (document.getElementById('inputType').value == "particulier") 
			{
				$('#particulierNom').show();
				$('#particulierPrenom').show();
				$('#particulierGenre').show();
				$('#professionnelNomEntreprise').hide();
			}
		}
	);
</script>