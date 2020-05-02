<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Envoyer un email";

		require($racine . $p_php . "head.php");

		if (isset($_GET['prestation']) && !empty($_GET['prestation']) && isset($_GET['document']) && !empty($_GET['document'])) 
		{
			
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
		<h1>Envoyer un email</h1>
		<div class="text-center mb-3">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" onclick="location.href='liste.php';" class="btn btnBarre">Retour à la liste</button>
			</div>
		</div>

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
		
		<fieldset class="borderForm mb-4">
		<legend>Envoi d'un email</legend>
			<form method="POST" action="<?php echo $racine . $p_php . "emailEnvoi.php"; ?>">
				<?php
					$prestation = $_GET['prestation'];
				?>
				<input type="hidden" class="form-control" id="inputPrestation" name="inputPrestation" readonly value="<?php echo $prestation; ?>">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputDestinataireAffichage"><span class="warning">*</span>Destinataire</label>
						<?php 
						if (documentType($_GET['document']) == 1) 
						{
							// facture
							?>
								<input type="hidden" class="form-control" id="inputDestinataire" name="inputDestinataire" readonly value="<?php echo prestationInfo('client', $_GET['prestation']); ?>">

								<input type="text" class="form-control" id="inputDestinataireAffichage" name="inputDestinataireAffichage" readonly value="<?php echo ucfirst(clientNom(prestationInfo('client', $_GET['prestation']))) . ' - ' . clientInfo('email', prestationInfo('client', $_GET['prestation'])); ?>" required>
							<?php
						}
						elseif (documentType($_GET['document']) == 2) 
						{
							// devis
							?>
								<input type="hidden" class="form-control" id="inputDestinataire" name="inputDestinataire" readonly value="<?php echo prestationInfo('client', $_GET['prestation']); ?>">
								
								<input type="text" class="form-control" id="inputDestinataireAffichage" name="inputDestinataireAffichage" readonly value="<?php echo ucfirst(clientNom(prestationInfo('client', $_GET['prestation']))) . ' - ' . clientInfo('email', prestationInfo('client', $_GET['prestation'])); ?>" required>
							<?php
						}
						else
						{
							?>
								<select class="form-control" id="inputDestinataire" name="inputDestinataire" required>
									<option disabled>Selectionnez un destinataire</option>
							<?php
							// On créé la requête
							$reqListeClientsMail = "SELECT * FROM clients";
							 
							// on envoie la requête
							$resListeClientsMail = $conn->query($reqListeClientsMail);
							 
							// on va scanner tous les tuples un par un
							while ($dataListeClientsMail = mysqli_fetch_array($resListeClientsMail)) 
							{
							    // on affiche les résultats
							    echo "<option value='" . $dataListeClientsMail['id'] . "'>" . clientNom($dataListeClientsMail['id']) . "</option>";
							}
								echo "</select>";
						}
						?>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputSujet"><span class="warning">*</span>Sujet</label>
						<?php 
						if (documentType($_GET['document']) == 1) 
						{
							// facture
							?>
								<input type="text" class="form-control" id="inputSujet" name="inputSujet" value="<?php echo emailVariableRenplace(parametre("6", "texte1") ,$_GET['prestation'] , $_GET['document']); ?>" required>
							<?php
						}
						elseif (documentType($_GET['document']) == 2) 
						{
							// devis
							?>
								<input type="text" class="form-control" id="inputSujet" name="inputSujet" value="<?php echo emailVariableRenplace(parametre("8", "texte1") ,$_GET['prestation'] , $_GET['document']); ?>" required>
							<?php
						}
						else
						{
							// devis
							?>
								<input type="text" class="form-control" id="inputSujet" name="inputSujet" required>
							<?php
						}
						?>
					</div>
					<div class="form-group col-md-6">
						<label for="inputDocument"><span class="warning">*</span>Document joint</label>
						<?php 
						if (documentType($_GET['document']) == 1 || documentType($_GET['document']) == 2) 
						{
							// facture &d evis
							?>
								<input type="hidden" class="form-control" id="inputDocument" name="inputDocument" readonly value="<?php echo $_GET['document']; ?>">
								<input type="text" class="form-control" id="inputDocumentAffichage" name="inputDocumentAffichage" readonly value="<?php echo documentNumerotationAffichage($_GET['document']); ?>">
							<?php
						}
						else
						{
							// pas de doc
							?>
								<input type="text" class="form-control" id="inputDocument" name="inputDocument" readonly placeholder="Pour joindre un document, vous devez utiliser la page de la prestation associée">
							<?php
						}
						?>
					</div>
				</div>
				<div class="form-row">
					<textarea cols="80" id="editor2" name="inputContenu" rows="10" data-sample-short>
						<?php 
						if (documentType($_GET['document']) == 1) 
						{
							// facture
							echo emailVariableRenplace(parametre("7", "texte1"),$_GET['prestation'] , $_GET['document']); 
						}
						elseif (documentType($_GET['document']) == 2) 
						{
							// devis
							echo emailVariableRenplace(parametre("9", "texte1"),$_GET['prestation'] , $_GET['document']); 
						}
						?>
					</textarea>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btnValider mt-4">Valider</button>
				</div>
			</form>
		</fieldset>
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>