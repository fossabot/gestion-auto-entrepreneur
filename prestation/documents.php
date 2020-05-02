<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Documents";

		require($racine . $p_php . "head.php");

		if (isset($_GET['id']) &&!empty($_GET['id'])) 
		{
			$id = $_GET['id'];
		}
		else
		{
			header('Location: /prestations/liste.php');
		}
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<?php 
			if(clientInfo('type', prestationInfo('client', $id)) == 1)
			{
				$nomAff = ucfirst(clientInfo('entreprise', prestationInfo('client', $id))); 
			}
			elseif(clientInfo('type', prestationInfo('client', $id)) == 2)
			{
				$nomAff = clientNom(prestationInfo('client', $id)); 
			}
		?>
		<h1>Documents</h1>
		<h2 class="text-center"><?php echo $nomAff; ?></h2>
		<div class="text-center mb-3">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button"onclick="location.href='liste.php';" class="btn btnBarre">Retour à la liste</button>
				<button type="button"onclick="location.href='editInfo.php?id=<?php echo $id; ?>';" class="btn btnBarre">Informations</button>
				<button type="button"onclick="location.href='editProduits.php?id=<?php echo $id; ?>';" class="btn btnBarre">Produits</button>
				<button type="button"onclick="location.href='documents.php?id=<?php echo $id; ?>';" class="btn btnBarre">Documents</button>
			</div>
		</div>

		<?php
		if (prestationInfo('cloture', $id) == "0") 
		{
			?>
			<fieldset class="borderForm">
				<legend>Devis</legend>
				<form method="POST" action="<?php echo $racine . $p_modeles . fichierModeleNom(parametre('2', 'var1')); ?>">
					<div class="mt-2 mb-2">
						<input type="text" name="id" value="<?php echo $id; ?>" hidden>
						<input type="text" name="type" value="2" hidden>
						<div class="form-group">
						    <label for="inputTexteInformation">Texte d'information:</label>
						    <textarea class="form-control" id="inputTexteInformation" rows="2" name="inputTexteInformation" required ><?php echo parametre("3", "texte1"); ?></textarea>
					  	</div>
						<div class="form-group">
						    <label for="inputTexteNote">Note:</label>
						    <textarea class="form-control" id="inputTexteNote" rows="2" name="inputTexteNote"></textarea>
						    <small id="emailHelp" class="form-text text-muted">Note pour vous-même, n'apparaît pas sur le document.</small>
					  	</div>
					  	<div class="text-center">
							<button type="submit" class="btn btnValider">Générer un devis</button>
					  	</div>
					</div>
				</form>
			</fieldset>

			<fieldset class="borderForm">
				<legend>Facture</legend>

				<?php
					$verifFacture = verifFacture($id);

					$moyenpaiement = $verifFacture->moyenpaiement;
					// echo $moyenpaiement . "<br>";
					$dateFacturation = $verifFacture->dateFacturation;
					// echo $dateFacturation . "<br>";
					$datelivraison = $verifFacture->datelivraison;
					// echo $datelivraison . "<br>";
					$ok = $verifFacture->ok;

					if ($ok == 1) 
					{
						?>
							<form method="POST" mane="name" action="<?php echo $racine . $p_modeles . fichierModeleNom(parametre('2', 'var1')); ?>">
								<div class="mt-2 mb-2">
									<input type="text" name="id" value="<?php echo $id; ?>" hidden>
									<input type="text" name="type" value="1" hidden>
									<div class="form-group">
									    <label for="inputTexteNote">Note:</label>
									    <textarea class="form-control" id="inputTexteNote" rows="2" name="inputTexteNote"></textarea>
									    <small id="emailHelp" class="form-text text-muted">Note pour vous-même, n'apparaît pas sur le document.</small>
								  	</div>
								  	<input type="checkbox" name="epinards" id="epinards" required="true" /> <label for="epinards">Veuillez cocher cette case pour valider la génération du document. Cette action clôturera automatiquement cette prestation, elle ne sera donc plus modifiable.</label><br />
								  	<div class="text-center">
										<button class="btn  btnValider">Générer une facture</button>
								  	</div>
								</div>
							</form>
						<?php
					}
					else
					{
						?>
							<div class="alert alert-success" role="alert">
								<h4 class="alert-heading">Attention</h4>
								<p>Certaines informations essentielles n'ont pas été saisies, les voici:</p>
								<ul>
								<?php
									echo ($moyenpaiement == 0) ? "<li>Le moyen de paiement</li>" : "";
									echo ($dateFacturation == 0) ? "<li>La date de facturation</li>" : "";
									echo ($datelivraison == 0) ? "<li>La date de livraison</li>" : "";
								?>
								</ul>
							</div>
						<?php
					}
				?>
				
			</fieldset>
		<?php
		}
		else
		{
			?>

			<?php
		}
		?>

		<fieldset class="borderForm mb-4" id="listeDoc">
			<legend>Liste des documents</legend>
			<div class="table-responsive">
				<table class="">
					<thead>
						<tr>
							<th scope="col">Type</th>
							<th scope="col">Date d'édition</th>
							<th scope="col">Numéro du document</th>
							<th scope="col">Note:</th>
							<th scope="col" colspan="2">Lien</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// On créé la requête
							$reqListeDocuments = "SELECT * FROM document WHERE idprestation='$id' ORDER BY id DESC";
							 
							// on envoie la requête
							$resListeDocuments = $conn->query($reqListeDocuments);
							 
							while ($dataListeDocuments = mysqli_fetch_array($resListeDocuments)) 
							{
								?>
									<tr>
										<td><?php echo ($dataListeDocuments['type'] == 1) ? "<span class='badge badgeFacture'>Facture</span>" : "<span class='badge badgeDevis'>Devis</span>" ;  ?></td>
										<td><?php echo utf8_encode(strftime('%d/%m/%g', strtotime($dataListeDocuments['dateEdition']))); ?></td>
										<td><?php echo documentNumerotationAffichage($dataListeDocuments['id']); ?></td>
										<td><?php echo $dataListeDocuments['note']; ?></td>
										<td>
											<a href="<?php echo $racine . "/include/documents/" . documentNumerotationAffichage($dataListeDocuments['id']) . ".pdf"; ?>" target="_blank"><i class="fas fa-file-pdf"></i></a>
										</td>
										<td>
											<a href="<?php echo $racine . "/email/nouveau.php?prestation=" . $id . "&document=" . $dataListeDocuments['id'] . ""; ?>" ><i class="fas fa-paper-plane"></i></a>
										</td>
									</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</fieldset>
		
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>