<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Afficher un email";

		require($racine . $p_php . "head.php");

		if (isset($_GET['id']) && !empty($_GET['id'])) 
		{
			$id = $_GET['id'];
		} 
		else 
		{
			header('Location: liste.php');
		}
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Afficher un email</h1>
		<div class="text-center mb-3">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" onclick="location.href='liste.php';" class="btn btnBarre">Retour à la liste</button>
			</div>
		</div>
		
		<fieldset class="borderForm mb-4">
		<legend>Afficher un email</legend>
			<?php

				
				// On créé la requête
				$reqEmailAffichage = "SELECT * FROM email WHERE id='$id' LIMIT 1";
				 
				// on envoie la requête
				$resEmailAffichage = $conn->query($reqEmailAffichage);
				 
				$dataEmailAffichage = mysqli_fetch_array($resEmailAffichage);
				$dataEmailAffichage['destinataire'];
			?>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputDestinataireAffichage"><span class="warning">*</span>Destinataire</label>
					<input type="text" class="form-control" id="inputDestinataireAffichage" name="inputDestinataireAffichage" readonly value="<?php echo ucfirst(clientNom($dataEmailAffichage['destinataire'])) . ' - ' . clientInfo('email', $dataEmailAffichage['destinataire']); ?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputSujet"><span class="warning">*</span>Sujet</label>
					<input type="text" class="form-control" id="inputSujet" name="inputSujet" readonly value="<?php echo $dataEmailAffichage['objet']; ?>">
				</div>
				<div class="form-group col-md-6">
					<label for="inputDocumentAffichage"><span class="warning">*</span>Document joint</label>

					<?php 
					if ($dataEmailAffichage['objet'] != "") 
					{
						// facture &d evis
						?>
							<input type="text" class="form-control" id="inputDocumentAffichage" name="inputDocumentAffichage" readonly value="<?php echo documentNumerotationAffichage($dataEmailAffichage['document']); ?>">
						<?php
					}
					else
					{
						// pas de doc
						?>
							<input type="text" class="form-control" id="inputDocumentAffichage" name="inputDocumentAffichage" readonly placeholder="Aucun document n'a été joint">
						<?php
					}
					?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label><span class="warning">*</span>Contenu du message:</label>
					<div class="affichageEmailContenu">
						<?php echo $dataEmailAffichage['texte']; ?>
					</div>
				</div>
			</div>
		</fieldset>
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>