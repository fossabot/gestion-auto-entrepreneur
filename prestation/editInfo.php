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
			header('Location: /prestation/liste.php');
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
				<button type="button"onclick="location.href='liste.php';" class="btn btnBarre">Retour à la liste</button>
				<button type="button"onclick="location.href='editInfo.php?id=<?php echo $id; ?>';" class="btn btnBarre">Informations</button>
				<button type="button"onclick="location.href='editProduits.php?id=<?php echo $id; ?>';" class="btn btnBarre">Produits</button>
				<button type="button"onclick="location.href='documents.php?id=<?php echo $id; ?>';" class="btn btnBarre">Documents</button>
			</div>
		</div>

		<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) 
		{
			if ($_GET['msg'] == "ok") 
			{
				?>
					<div id="info" class="alert alert-success text-center w-25 mx-auto" role="alert">
					  Succes !
					</div>
				<?php
			}
			else
			{
				?>
					<div id="info" class="alert alert-danger text-center w-25 mx-auto" role="alert">
					  <?php echo $_GET['msg']; ?>
					</div>
				<?php
			}
		}
		?>


		<h3 class="text-left">Informations</h3>

		<form method="POST" action="<?php echo $racine . $p_php . "prestationInfoEdit.php"; ?>" class="mb-5">
			<input type="text" class="form-control text-center" id="inputID" name="inputID" readonly value="<?php echo $id; ?>" hidden>
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="inputType"><span class="warning">*</span>Type: <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control text-center" id="inputType" name="inputType" readonly value="<?php echo ucfirst(clientType(clientInfo('type', prestationInfo('client', $id)))); ?>">
				</div>
				<div class="form-group col-md-10">
					<label for="inputNom"><span class="warning">*</span>Nom Prénom / Entreprise: <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control text-center" id="inpuNom" name="inpuNom" readonly value="<?php echo $nomAff; ?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="inputDateOuverture"><span class="warning">*</span>Date d'ouverture: <span class="badge badge-danger">*</span></label>
					<input type="date" class="form-control text-center" name="inputDateOuverture" value="<?php echo strftime('%Y-%m-%d', strtotime(prestationInfo('dateouverture', $id))); ?>" readonly>
				</div>
				<div class="form-group col-md-7">
				</div>
				<div class="form-group col-md-3">
					<label for="inputUrgence"><span class="warning">*</span>Ugrence: </label>
					<select id="inputUrgence" name="inputUrgence" class="form-control" <?php echo (prestationInfo('cloture', $id) == 1) ? "disabled" : "" ; ?>>
						<option value="1" <?php echo (prestationInfo('urgence', $id) == 1) ? "selected" : "" ; ?>>Bas</option>
						<option value="2" <?php echo (prestationInfo('urgence', $id) == 2) ? "selected" : "" ; ?>>Normal</option>
						<option value="3" <?php echo (prestationInfo('urgence', $id) == 3) ? "selected" : "" ; ?>>Haut</option>
						<option value="4" <?php echo (prestationInfo('urgence', $id) == 4) ? "selected" : "" ; ?>>Urgent</option>
					</select>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="inputMoyenPaiement"><span class="warning">*</span>Moyen de paiement</label>
					<select id="inputMoyenPaiement" name="inputMoyenPaiement" class="form-control" <?php echo (prestationInfo('cloture', $id) == 1) ? "disabled" : "" ; ?>>
					<option disabled selected>Moyen de paiement</option>
					<?php
						// On créé la requête
						$reqMoyenPaiement = "SELECT * FROM moyenpaiement";
						 
						// on envoie la requête
						$resMoyenPaiement = $conn->query($reqMoyenPaiement);
						 
						// on va scanner tous les tuples un par un
						while ($dataMoyenPaiement = mysqli_fetch_array($resMoyenPaiement))
						{
							if ($dataMoyenPaiement['description'] != "") 
							{
								$description = " - " . $dataMoyenPaiement['description'] . "";
							}
							if ($dataMoyenPaiement['nom'] == prestationInfo('moyenpaiement', $id)) 
							{
								echo "<option selected  value=\"" . $dataMoyenPaiement['nom'] . "\">" . $dataMoyenPaiement['nom'] . $description . "</option>";
							}
							else
							{
								echo "<option  value=\"" . $dataMoyenPaiement['nom'] . "\">" . $dataMoyenPaiement['nom'] . $description . "</option>";
							}
						}
					?>
					</select>
				</div>
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-2">
					<label for="inputDateFacturation"><span class="warning">*</span>Date de facturation:</label>
					<input type="date" class="form-control text-center" name="inputDateFacturation" <?php echo (prestationInfo('dateFacturation', $id) != "") ? "value='" . strftime('%Y-%m-%d', strtotime(prestationInfo('dateFacturation', $id))) . "'" : ""; ?> <?php echo (prestationInfo('cloture', $id) == 1) ? "readonly" : "" ; ?>>
				</div>
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-2">
					<label for="inputDateLivraison"><span class="warning">*</span>Date de livraison:</label>
					<input type="date" class="form-control text-center" name="inputDateLivraison" <?php echo (prestationInfo('dateLivraison', $id) != "") ? "value='" . strftime('%Y-%m-%d', strtotime(prestationInfo('dateLivraison', $id))) . "'" : ""; ?> <?php echo (prestationInfo('cloture', $id) == 1) ? "readonly" : "" ; ?>>
				</div>
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-3">
					<label for="inputEtat"><span class="warning">*</span>Etat: </label>
					<select id="inputEtat" name="inputEtat" class="form-control" disabled>
						<option value="0">En cours</option>
						<option value="1" <?php echo (prestationInfo('cloture', $id) == 1) ? "selected=\"\"" : "" ; ?>><?php echo (prestationInfo('cloture', $id) == 1) ? "Clôturer le " . strftime('%d / %m / %Y', strtotime(prestationInfo('datecloture', $id))) . "" : "Clôturer" ; ?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputProduitDescription">Description & Commentaire:</label>
			    <textarea class="form-control" id="inputProduitDescription" rows="4" name="inputProduitDescription" required <?php echo (prestationInfo('cloture', $id) == 1) ? "readonly" : "" ; ?>><?php echo prestationInfo('commentaire', $id); ?></textarea>
		  	</div>
			<span class="badge badge-danger"> * Cette information n'est pas modifiable</span>
			<div class="text-center">
				<?php echo (prestationInfo('cloture', $id) == 1) ? "" : "<button type=\"submit\" class=\"btn btnValider\">Valider</button>" ; ?>
				
			</div>
		</form>
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>