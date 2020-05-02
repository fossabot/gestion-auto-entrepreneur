<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Client";

		require($racine . $p_php . "head.php");

		if (isset($_GET['id']) &&!empty($_GET['id'])) 
		{
			$id = $_GET['id'];
		}
		else
		{
			header('Location: /client/liste.php');
		}
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1><?php echo clientNom($id); ?></h1>

		<div class="text-center w-25 mx-auto">
			<a href="/client/liste.php"><button type="button" class="btn btnBarre">Retour à la liste des clients</button></a>
		</div>

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

		<div class="info">
			<form method="POST" action="<?php echo $racine . $p_php . "clientEdit.php"; ?>">
				<input type="text" hidden class="form-control" id="inputID" name="inputID" readonly value="<?php echo $id; ?>">
				<div class="form-row">
					<div class="form-group col-md-2">
						<label for="inputType"><span class="warning">*</span>Type <span class="badge badge-danger">*</span></label>
						<select id="inputType" name="inputType" class="form-control" readonly>
							<option value="professionnel" <?php echo (clientInfo("type", $id) == 1 ? "selected" : "disabled"); ?>>Professionnel</option>
							<option value="particulier" <?php echo (clientInfo("type", $id) == 2 ? "selected" : "disabled"); ?>>Particulier</option>
						</select>
					</div>
					<?php
					if (clientInfo("type", $id) == 2) 
					{
						?>
						<div class="form-group col-md-2" id="particulierGenre">
							<label for="inputGenre"><span class="warning">*</span>Genre <span class="badge badge-danger">*</span></label>
							<select id="inputGenre" name="inputGenre" class="form-control" readonly>
								<option value="2" <?php echo (clientInfo("genre", $id) == 2 ? "selected" : "disabled"); ?>>Monsieur</option>
								<option value="3" <?php echo (clientInfo("genre", $id) == 3 ? "selected" : "disabled"); ?>>Madame</option>
							</select>
						</div>
						<div class="form-group col-md-4" id="particulierNom">
							<label for="inputNom"><span class="warning">*</span>Nom <span class="badge badge-danger">*</span></label>
							<input type="text" class="form-control" id="inputNom" name="inputNom" readonly value="<?php echo clientInfo("nom", $id); ?>">
						</div>
						<div class="form-group col-md-4" id="particulierPrenom">
							<label for="inputPrenom"><span class="warning">*</span>Prénom <span class="badge badge-danger">*</span></label>
							<input type="text" class="form-control" id="inputPrenom" name="inputPrenom" readonly value="<?php echo clientInfo("prenom", $id); ?>">
						</div>
						<?php
					}
					elseif (clientInfo("type", $id) == 1) 
					{
						?>
						<div class="form-group col-md-10" id="professionnelNomEntreprise">
							<label for="inputNomEntreprise"><span class="warning">*</span>Nom de l'entreprise <span class="badge badge-danger">*</span></label>
							<input type="text" class="form-control" id="inputNomEntreprise" name="inputNomEntreprise" readonly value="<?php echo clientInfo("entreprise", $id); ?>">
						</div>
						<?php
					}
					?>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputTelF">Téléphone fixe</label>
						<input type="tel" class="form-control" id="inputTelF" name="inputTelF" value="<?php echo clientInfo("tel_fixe", $id); ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="inputTelP">Téléphone portable</label>
						<input type="tel" class="form-control" id="inputTelP" name="inputTelP" value="<?php echo clientInfo("tel_portable", $id); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail"><span class="warning">*</span>Email</label>
					<input type="text" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo clientInfo("email", $id); ?>">
				</div>
				<div class="form-group">
					<label for="inputAdresse"><span class="warning">*</span>Address</label>
					<input type="text" class="form-control" id="inputAdresse" name="inputAdresse" value="<?php echo clientInfo("adresse", $id); ?>" required="true">
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputVille"><span class="warning">*</span>Ville</label>
					<input type="text" class="form-control" id="inputVille" name="inputVille" value="<?php echo clientInfo("ville", $id); ?>" required="true">
					</div>
					<div class="form-group col-md-2">
						<label for="inputCP"><span class="warning">*</span>Code postal</label>
						<input type="text" class="form-control" id="inputCP" name="inputCP"  value="<?php echo clientInfo("cp", $id); ?>" required="true">
					</div>
					<div class="form-group col-md-4">
						<label for="inputPays"><span class="warning">*</span>Pays</label>
					<input type="text" class="form-control" id="inputPays" name="inputPays" value="<?php echo clientInfo("pays", $id); ?>" required="true">
					</div>
				</div>
				<span class="badge badge-danger"> * Cette information n'est pas modifiable</span>
				<div class="text-center">
					<button type="submit" class="btn btnValider">Mettre à jour</button>
				</div>
			</form>
		</div>
		
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>

<script type="text/javascript">

	$('.infoModif').css('display', 'none');
	$('.derniereFacture').css('display', 'none');
	$('.factureHistorique').css('display', 'none');

	$(".menuDetail").change
	(
		function () 
		{
			if (document.getElementBuName('inputType').value == "info") 
			{
				$('.infoModif').hide();
				$('.derniereFacture').hide();
				$('.factureHistorique').hide();
				$('.info').show();
			}
			if (document.getElementBuName('inputType').value == "modifInfo") 
			{
				$('.infoModif').show();
				$('.derniereFacture').hide();
				$('.factureHistorique').hide();
				$('.info').hide();
			}
			if (document.getElementBuName('inputType').value == "derniereFacture") 
			{
				$('.infoModif').hide();
				$('.derniereFacture').show();
				$('.factureHistorique').hide();
				$('.info').hide();
			}
			if (document.getElementBuName('inputType').value == "toutesFactures") 
			{
				$('.infoModif').hide();
				$('.derniereFacture').hide();
				$('.factureHistorique').show();
				$('.info').hide();
			}
		}
	);
</script>