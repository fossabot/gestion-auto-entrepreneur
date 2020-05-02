<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Mise à jour d'une prestation";

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
<body onload="init();">
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
		<h1>Mise à jour d'une prestation</h1>
		<h2 class="text-center"><?php echo $nomAff; ?></h2>
		<div class="text-center mb-3">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" onclick="location.href='liste.php';" class="btn btnBarre">Retour à la liste</button>
				<button type="button" onclick="location.href='editInfo.php?id=<?php echo $id; ?>';" class="btn btnBarre">Informations</button>
				<button type="button" onclick="location.href='editProduits.php?id=<?php echo $id; ?>';" class="btn btnBarre">Produits</button>
				<button type="button" onclick="location.href='documents.php?id=<?php echo $id; ?>';" class="btn btnBarre">Documents</button>
			</div>
		</div>

		<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) 
		{
			if ($_GET['msg'] == "ok") 
			{
				?>
					<div class="alert alert-success text-center w-25 mx-auto mt-2" role="alert" id="info">
					  Succes !
					</div>
				<?php
			}
			else
			{
				?>
					<div class="alert alert-danger text-center w-25 mx-auto mt-2" role="alert" id="info">
					  <?php echo $_GET['msg']; ?>
					</div>
				<?php
			}
		}
		?>

		<?php
		if (prestationInfo('cloture', $id) == "0") 
		{
			$reqCountProduits = "SELECT * FROM produits;";
			$resCountProduits = $conn->query($reqCountProduits) or die();
			$nbreProduits = $resCountProduits->num_rows;

			$reqCountProduitsFacture = "SELECT * FROM prestationproduit WHERE facture=$id;";
			$resCountProduitsFacture = $conn->query($reqCountProduitsFacture) or die();
			$nbreProduitsPrasta = $resCountProduitsFacture->num_rows;

			if ($nbreProduitsPrasta < $nbreProduits) 
			{
			?>
				<fieldset class="borderForm mb-4">
				<legend id="liste-produits">Nouveau produit</legend>
				<form method="POST" action="<?php echo $racine . $p_php . "prestationProduitsNouveau.php"; ?>">
						<input type="text" class="form-control text-center" id="inputID" name="inputID" readonly value="<?php echo $id; ?>" hidden>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputProduit">Produit:</label>
								<select class="custom-select col-md-12" id="inputProduit" name="inputProduit">
									<option value="0" selected>Inserer un nouveau produit</option>
									<?php
										ListeProduitsRef($id); 
									?>
								</select>
							</div>
							<div class="col-md-2">
							</div>
							<div class="form-group col-md-2">
								<label for="inputProduitQte">Quantité:</label>
								<input type="number" class="form-control text-center" value="1" name="inputProduitQte">
							</div>
							<div class="form-group col-md-4">
								<label for="inputPrixOffert">Offert:</label>
								<input name="inputPrixOffert" type="checkbox">
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btnValider mt-2 mb-2">Ajouter</button>
						</div>
					</form>
				</fieldset>
			<?php
			}
		}
		?>

		<fieldset class="borderForm">
			<legend id="liste-produits">Liste des produits</legend>
			<form method="POST" action="<?php echo $racine . $p_php . "prestationProduitsEdit.php"; ?>">
				<input type="text" class="form-control text-center" id="inputID" name="inputID" readonly value="<?php echo $id; ?>" hidden>
				<div class="table-responsive">
					<table class="t-produits">
						<thead class="">
							<tr>
								<th class="produit">Produit</th>
								<th class="offert">Offert</th>
								<th class="quantite">Quantité</th>
								<th class="action">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								// On créé la requête
								$reqAffichageFacture = "SELECT * FROM prestationproduit WHERE facture=$id";
								 
								// on envoie la requête
								$resAffichageFacture = $conn->query($reqAffichageFacture);

								while ($dataAffichageFacture = mysqli_fetch_assoc($resAffichageFacture)) 
								{
								    $produit = $dataAffichageFacture['produit'];
								    ?>
										<tr>
												<td>
													<input type="text" class="form-control text-center" id="inputProduit" name="inputProduit[]" readonly value="<?php echo $dataAffichageFacture['produit']; ?>" hidden>
													<?php  echo ref($dataAffichageFacture['produit']) . "  - " . produitInfo("designation", $dataAffichageFacture['produit']) . ""; ?>
												</td>
												<td>
								    				<input name="inputPrixOffert[]" type="checkbox" <?php echo ($dataAffichageFacture['offert'] == 1) ? "checked " : "" ; ?>  <?php echo (prestationInfo('cloture', $id) == "1") ? "disabled='true'" : "" ; ?>>
												</td>
												<td>
													<input type="number" class="form-control text-center w-100" value="<?php  echo $dataAffichageFacture['produitqte']; ?>" name="inputProduitQte[]" <?php echo (prestationInfo('cloture', $id) == "1") ? "disabled='true'" : "" ; ?>>
												</td>
												<td>
													<?php
													if (prestationInfo('cloture', $id) == "0") 
													{
														?>
															<button type="submit" class="btn btnSupprimer" name="supprimer" value="<?php  echo $dataAffichageFacture['produit']; ?>">-</button>
														<?php
													}
													?>
												</td>
											</tr>
								    <?php
								}
							?>
							</tbody>
					</table>
				</div>

				<?php
				if (prestationInfo('cloture', $id) == "0") 
				{
					?>
					<div class="text-center">
						<button type="submit" class="btn btnValider mt-2 mb-2">Valider</button>
					</div>
					<?php
				}
				?>
			</form>
		</fieldset>


		<fieldset class="borderForm mb-5">
			<legend id="prix">Prix</legend>

			<form method="POST" action="<?php echo $racine . $p_php . "prestationRemiseEdit.php"; ?>">
				<input type="text" class="form-control text-center" id="inputID" name="inputID" readonly value="<?php echo $id; ?>" hidden>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputPrix">Prix (€)</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inputPrix" name="inputPrix" aria-describedby="inputPrixIcon" placeholder="" required="true" readonly value="<?php echo totalPrixFacture($id); ?>">
					    	<div class="input-group-prepend">
					    		<span class="input-group-text" id="inputPrixIcon">€</span>
					    	</div>
					    </div>
					</div>
					<div class="form-group col-md-4">
						<label for="inputRemise">Remise (%)</label>
						<div class="input-group">
					    	<input type="text" class="form-control" id="inputRemise" name="inputRemise" aria-describedby="inputRemiseIcon" placeholder="" required="true" value="<?php echo prestationInfo('remise', $id); ?>" <?php echo (prestationInfo('cloture', $id) == "1") ? "readonly='true'" : "" ; ?>>
					    	<div class="input-group-prepend">
					    		<span class="input-group-text" id="inputRemiseIcon">%</span>
					    	</div>
					    </div>
					    <small id="inputRemiseInfo" class="form-text text-muted">Ne doit pas depasser 100%.</small>
					</div>
					<div class="form-group col-md-4">
						<label for="inputPrixFinal">Prix final (€)</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inputPrixFinal" name="inputPrixFinal"  aria-describedby="inputPrixFinalIcon" placeholder="" required="true" value="<?php echo (totalPrixFacture($id) * (1-(prestationInfo('remise', $id)/100))); ?>" readonly>
					    	<div class="input-group-prepend">
					    		<span class="input-group-text" id="inputPrixFinalIcon">€</span>
					    	</div>
					    </div>
					</div>
				</div>

				<?php
				if (prestationInfo('cloture', $id) == "0") 
				{
					?>
					<div class="text-center">
						<button type="submit" class="btn btnValider mt-2 mb-2">Valider</button>
					</div>
					<?php
				}
				?>
			</form>
		</fieldset>




	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>
<script>

$("#inputRemise").change
(
	function () 
	{
		prix = document.getElementById('inputPrix').value;
		remise = document.getElementById('inputRemise').value;
		
		prixCalc = prix * (1-(remise/100));

		// arondiPrix = Math.round(prixCalc);
		arondiPrix = prixCalc.toFixed(2);

		tauxRemise = ((prix - arondiPrix)*100)/prix;

		document.getElementById('inputPrixFinal').value = arondiPrix;
		document.getElementById('inputRemise').value = tauxRemise;
	}
);
</script>