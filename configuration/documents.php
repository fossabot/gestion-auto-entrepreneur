<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Configuration des documents";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Configuration des documents</h1>


		<fieldset class="borderForm">
			<legend id="fichiers-modeles">Liste des fichiers modèles</legend>
			<div class="alert alert-dark text-center" role="alert">
				Cette section vous permet de sélectionner le fichier modèle pour les documents (factures et devis), utilisez les icons pour changer la sélection.
				<br>
				Vous pouvez déposer vos propres modèles dans le répertoire <code>"/include/modeles/"</code>, puis actualiser le tableau avec le bouton dédié.
			</div>

			<div class="table-responsive ">
				<table class="">
					<thead>
						<tr>
							<th scope="col">Activé</th>
							<th scope="col">Titre</th>
							<th scope="col">Auteur</th>
							<th scope="col">Description</th>
							<th scope="col">Version</th>
							<th scope="col">Fichier</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// On créé la requête
							$reqModelFactures = "SELECT * FROM modelesFactures ORDER BY id";
							 
							// on envoie la requête
							$resModelFactures = $conn->query($reqModelFactures);
							 
							while ($dataModelFactures = mysqli_fetch_array($resModelFactures)) 
							{
								?>
								
									<tr>
										<td><?php echo (parametre("2", "var1") == $dataModelFactures['id']) ? "<i class='fas fa-check-square'></i>" : "<a href='" .$racine . $p_php . "modelesDefaut.php?id=" . $dataModelFactures['id'] . "'><i class='fas fa-window-close'></i></a>"; ?></td>
										<td><?php echo $dataModelFactures['titre']; ?></td>
										<td><?php echo $dataModelFactures['auteur']; ?></td>
										<td><?php echo $dataModelFactures['description']; ?></td>
										<td><?php echo $dataModelFactures['version']; ?></td>
										<td><?php echo $dataModelFactures['fichier']; ?></td>
									</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>

			<form method="POST" action="<?php echo $racine . $p_php . "modelesActualisation.php"; ?>">
				<div class="text-center mt-2 mb-2">
					<button type="submit" class="btn btnValider">Mettre à jour la liste</button>
				</div>
			</form>
			<small><i>Cliquez sur un icon pour changer de selection.</i></small>
		</fieldset>

		<fieldset class="borderForm">
			<legend id="texte-information">Texte "information" des devis</legend>
			<div class="alert alert-dark text-center" role="alert">
				Vous pouvez ici définir le texte d'informations par défaut des devis, celui-ci est modifiable à la création de la facture.
				<br>
				Par exemple, vous pouvez indiquer la durée de validité du devis ainsi que certaines clauses par rapport au prix.
			</div>

			<form method="POST" action="<?php echo $racine . $p_php . "texteInformationDevis.php"; ?>" class="">
				<div class="form-group">
				    <label for="inputTexteInformation">Texte d'information:</label>
				    <textarea class="form-control" id="inputTexteInformation" rows="4" name="inputTexteInformation" required ><?php echo parametre("3", "texte1"); ?></textarea>
			  	</div>
				<div class="text-center mt-2">
					<button type="submit" class="btn btnValider">Mettre à jour</button>
				</div>
			</form>
		</fieldset>

	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>
<!-- Devis valable 30 jours à compter de la date d'émission. Le prix final peut-être impacté en fonction d'événement imprévisibles -->