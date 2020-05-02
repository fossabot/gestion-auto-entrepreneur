<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Thème";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Thème</h1>

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

		<form method="POST" action="<?php echo $racine . $p_php . "themeEdit.php"; ?>">
		
			<div class="text-center">
				<button type="submit" class="btn btnValider">Valider</button>
			</div>
			<div class="d-flex flex-wrap justify-content-around align-self-start">
				<fieldset class="borderForm w-40 ml-2 mr-2">
					<legend>Arrière-plan</legend>

						<div class="form-group col-md-10">
							<label for="inputBackgroung">Couleur d'arrière-plan:</label>
							<input type="color" class="form-control" id="inputBackgroung" name="inputBackgroung" value="<?php echo theme("1", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBackgroungMenu">Couleur d'arrière-plan du menu:</label>
							<input type="color" class="form-control" id="inputBackgroungMenu" name="inputBackgroungMenu" value="<?php echo theme("2", "var1"); ?>">
						</div>
				</fieldset>

				<fieldset class="borderForm w-40 ml-2 mr-2">
					<legend>Titres</legend>

						<div class="form-group col-md-10">
							<label for="inputColorH1">Couleur des titres:</label>
							<input type="color" class="form-control" id="inputColorH1" name="inputColorH1" value="<?php echo theme("3", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputColorH2">Couleur des sous-titres 1:</label>
							<input type="color" class="form-control" id="inputColorH2" name="inputColorH2" value="<?php echo theme("4", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputColorH3">Couleur des sous-titres 2:</label>
							<input type="color" class="form-control" id="inputColorH3" name="inputColorH3" value="<?php echo theme("5", "var1"); ?>">
						</div>
				</fieldset>

				<fieldset class="borderForm w-40 ml-2 mr-2">
					<legend>Boutons</legend>

						<p class="formText">Validation:</p>

						<div class="form-group col-md-10">
							<label for="inputBoutonsValiderBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBoutonsValiderBackground" name="inputBoutonsValiderBackground" value="<?php echo theme("6", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsValiderTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBoutonsValiderTxt" name="inputBoutonsValiderTxt" value="<?php echo theme("7", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsValiderBackgroundHover">Arrière-plan au survol:</label>
							<input type="color" class="form-control" id="inputBoutonsValiderBackgroundHover" name="inputBoutonsValiderBackgroundHover" value="<?php echo theme("8", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsValiderTxt">Texte au survol:</label>
							<input type="color" class="form-control" id="inputBoutonsValiderTxt" name="inputBoutonsValiderTxtHover" value="<?php echo theme("9", "var1"); ?>">
						</div>

						<p class="formText">Suppression (actions importantes):</p>

						<div class="form-group col-md-10">
							<label for="inputBoutonsSupprimerBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBoutonsSupprimerBackground" name="inputBoutonsSupprimerBackground" value="<?php echo theme("10", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsSupprimerTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBoutonsSupprimerTxt" name="inputBoutonsSupprimerTxt" value="<?php echo theme("11", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsSupprimerBackgroundHover">Arrière-plan au survol:</label>
							<input type="color" class="form-control" id="inputBoutonsSupprimerBackgroundHover" name="inputBoutonsSupprimerBackgroundHover" value="<?php echo theme("12", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsSupprimerTxt">Texte au survol:</label>
							<input type="color" class="form-control" id="inputBoutonsSupprimerTxt" name="inputBoutonsSupprimerTxtHover" value="<?php echo theme("13", "var1"); ?>">
						</div>

						<p class="formText">Barre de boutons (menu):</p>

						<div class="form-group col-md-10">
							<label for="inputBoutonsBarreBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBoutonsBarreBackground" name="inputBoutonsBarreBackground" value="<?php echo theme("14", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsBarreTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBoutonsBarreTxt" name="inputBoutonsBarreTxt" value="<?php echo theme("15", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsBarreBackgroundHover">Arrière-plan au survol:</label>
							<input type="color" class="form-control" id="inputBoutonsBarreBackgroundHover" name="inputBoutonsBarreBackgroundHover" value="<?php echo theme("16", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBoutonsBarreTxt">Texte au survol:</label>
							<input type="color" class="form-control" id="inputBoutonsBarreTxt" name="inputBoutonsBarreTxtHover" value="<?php echo theme("17", "var1"); ?>">
						</div>
				</fieldset>

				<fieldset class="borderForm w-40 ml-2 mr-2">
					<legend>Badges</legend>

						<p class="formText">Professionnel:</p>

						<div class="form-group col-md-10">
							<label for="inputBadgeProfessionnelBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBadgeProfessionnelBackground" name="inputBadgeProfessionnelBackground" value="<?php echo theme("24", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBadgeProfessionnelTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBadgeProfessionnelTxt" name="inputBadgeProfessionnelTxt" value="<?php echo theme("25", "var1"); ?>">
						</div>

						<p class="formText">Particulier:</p>

						<div class="form-group col-md-10">
							<label for="inputBadgeParticulierBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBadgeParticulierBackground" name="inputBadgeParticulierBackground" value="<?php echo theme("26", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBadgeParticulierTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBadgeParticulierTxt" name="inputBadgeParticulierTxt" value="<?php echo theme("27", "var1"); ?>">
						</div>

						<p class="formText">Facture:</p>

						<div class="form-group col-md-10">
							<label for="inputBadgeFactureBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBadgeFactureBackground" name="inputBadgeFactureBackground" value="<?php echo theme("28", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBadgeFactureTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBadgeFactureTxt" name="inputBadgeFactureTxt" value="<?php echo theme("29", "var1"); ?>">
						</div>

						<p class="formText">Devis:</p>

						<div class="form-group col-md-10">
							<label for="inputBadgeDevisBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputBadgeDevisBackground" name="inputBadgeDevisBackground" value="<?php echo theme("30", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputBadgeDevisTxt">Texte:</label>
							<input type="color" class="form-control" id="inputBadgeDevisTxt" name="inputBadgeDevisTxt" value="<?php echo theme("31", "var1"); ?>">
						</div>
				</fieldset>

				<fieldset class="borderForm w-40 ml-2 mr-2">
					<legend>Tableaux</legend>

						<p class="formText">Titre (descriptions des colones):</p>

						<div class="form-group col-md-10">
							<label for="inputTableauTitreBackground">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputTableauTitreBackground" name="inputTableauTitreBackground" value="<?php echo theme("18", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputTableauTitreTxt">Texte:</label>
							<input type="color" class="form-control" id="inputTableauTitreTxt" name="inputTableauTitreTxt" value="<?php echo theme("19", "var1"); ?>">
						</div>

						<p class="formText">Ligne style 1:</p>

						<div class="form-group col-md-10">
							<label for="inputTableauLigne1Background">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputTableauLigne1Background" name="inputTableauLigne1Background" value="<?php echo theme("20", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputTableauLigne1TitreTxt">Texte:</label>
							<input type="color" class="form-control" id="inputTableauLigne1TitreTxt" name="inputTableauLigne1TitreTxt" value="<?php echo theme("21", "var1"); ?>">
						</div>

						<p class="formText">Lignes style 2:</p>

						<div class="form-group col-md-10">
							<label for="inputTableauLigne2Background">Arrière-plan:</label>
							<input type="color" class="form-control" id="inputTableauLigne2Background" name="inputTableauLigne2Background" value="<?php echo theme("22", "var1"); ?>">
						</div>
						<div class="form-group col-md-10">
							<label for="inputTableauLigne2Txt">Texte:</label>
							<input type="color" class="form-control" id="inputTableauLigne2Txt" name="inputTableauLigne2Txt" value="<?php echo theme("23", "var1"); ?>">
						</div>
				</fieldset>
			</div>
		
			<div class="text-center mt-4 mb-4">
				<button type="submit" class="btn btnValider">Valider</button>
			</div>
		</form>
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>