<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Nouveau produit";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Nouveau produit</h1>

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
		
		<form method="POST" action="<?php echo $racine . $p_php . "produitNouveau.php"; ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<?php listeActivite(); ?>
				</div>
				<div class="form-group col-md-8">
					<label for="inputProduitNom"><span class="warning">*</span>Nom du produit ou du service <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control" id="inputProduitNom" name="inputProduitNom">
				</div>
			</div>
			<div class="form-group">
			    <label for="inputProduitDescription">Description</label>
			    <textarea class="form-control" id="inputProduitDescription" rows="3" name="inputProduitDescription"></textarea>
		  	</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="inputPrixAchat">Prix d'achat</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputPrixAchat" name="inputPrixAchat" aria-describedby="inputPrixAchatIcon" placeholder="" required="true" value="0">
				    	<div class="input-group-prepend">
				    		<span class="input-group-text" id="inputPrixAchatIcon">€</span>
				    	</div>
				    </div>
				</div>
				<div class="form-group col-md-4">
					<label for="inputCoefMarge">Coefficient de marge</label>
					<div class="input-group">
				    	<input type="text" class="form-control" id="inputCoefMarge" name="inputCoefMarge" aria-describedby="inputCoefMargeIcon" placeholder="" required="true" readonly>
				    	<div class="input-group-prepend">
				    		<span class="input-group-text" id="inputCoefMargeIcon">%</span>
				    	</div>
				    </div>
				    <!-- <small id="inputCoefMargeInfo" class="form-text text-muted">Ne doit pas depasser 100%.</small> -->
				</div>
				<div class="form-group col-md-4">
					<label for="inputPrixVente"><span class="warning">*</span>Prix de vente HT en €</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputPrixVente" name="inputPrixVente"  aria-describedby="inputPrixVenteIcon" placeholder="" required="true">
				    	<div class="input-group-prepend">
				    		<span class="input-group-text" id="inputPrixVenteIcon">€</span>
				    	</div>
				    </div>
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

	$("#inputPrixVente").change
	(
		function () 
		{
			prixAchat = document.getElementById('inputPrixAchat').value;
			prixVente = document.getElementById('inputPrixVente').value;
			if(prixAchat == 0) 
			{
				marge = 100;
			} 
			else 
			{
				marge = prixVente / prixAchat;
			}
			document.getElementById('inputCoefMarge').value = marge;
		}
	);

	$("#inputPrixAchat").change
	(
		function () 
		{
			prixAchat = document.getElementById('inputPrixAchat').value;
			if(prixAchat == 0) 
			{
				document.getElementById("inputCoefMarge").readOnly = true;
				document.getElementById('inputCoefMarge').value = "";
			} 
			else 
			{
				document.getElementById("inputCoefMarge").readOnly = false; 
			}

			coefMarge = document.getElementById('inputCoefMarge').value;

			prixVente = parseFloat(prixAchat) + (prixAchat * (coefMarge/100));

			document.getElementById('inputPrixVente').value = prixVente;
		}
	);

	$("#inputCoefMarge").change
	(
		function () 
		{
			prixAchat = document.getElementById('inputPrixAchat').value;
			coefMarge = document.getElementById('inputCoefMarge').value;

			prixVente = parseFloat(prixAchat) + (prixAchat * (coefMarge/100));

			document.getElementById('inputPrixVente').value = prixVente;
		}
	);

</script>