<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Produits";
		
		session_start();
		if (!isset($_SESSION['utilisateur'])) {
			header ('Location: connexion.php');
			exit();
		}
		if (isset($_GET['ref']) &&!empty($_GET['ref'])) 
		{
			$ref = $_GET['ref'];
		}
		else
		{
			header('Location: /produit/liste.php');
		}
		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1><?php echo produitInfo("designation", $ref); ?></h1>

		<div class="text-center w-25 mx-auto">
			<a href="/produit/liste.php"><button type="button" class="btn btnBarre">Retour à la liste des produits</button></a>
		</div>

		<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) 
		{
			if ($_GET['msg'] == "ok") 
			{
				?>
					<div id="info" class="alert alert-success text-center w-25 mx-auto mt-3" role="alert">
					  Succes !
					</div>
				<?php
			}
			else
			{
				?>
					<div id="info" class="alert alert-danger text-center w-25 mx-auto mt-3" role="alert">
					  <?php echo $_GET['msg']; ?>
					</div>
				<?php
			}
		}
		?>

		
		<form method="POST" action="<?php echo $racine . $p_php . "produitEdit.php"; ?>" class="mt-3">
			<input type="text" hidden class="form-control" id="inputREF" name="inputREF" readonly value="<?php echo $ref; ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="inputProduitType"><span class="warning">*</span>Type <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control" id="inputProduitType" name="inputProduitType" value="<?php echo categorieNom(produitInfo("categorie", $ref)); ?>" readonly>
				</div>
				<div class="form-group col-md-8">
					<label for="inputProduitNom"><span class="warning">*</span>Nom du produit ou du service <span class="badge badge-danger">*</span></label>
					<input type="text" class="form-control" id="inputProduitNom" name="inputProduitNom" value="<?php echo produitInfo("designation", $ref); ?>" readonly>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputProduitDescription">Description</label>
			    <textarea class="form-control" id="inputProduitDescription" rows="3" name="inputProduitDescription"><?php echo produitInfo("commentaire", $ref); ?></textarea>
		  	</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="inputPrixAchat">Prix d'achat</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputPrixAchat" name="inputPrixAchat" aria-describedby="inputPrixAchatIcon" placeholder="" required="true" value="<?php echo produitInfo("prixachat", $ref); ?>" >
				    	<div class="input-group-prepend">
				    		<span class="input-group-text" id="inputPrixAchatIcon">€</span>
				    	</div>
				    </div>
				</div>
				<div class="form-group col-md-4">
					<label for="inputCoefMarge">Coefficient de marge</label>
					<div class="input-group">
				    	<input type="text" class="form-control" id="inputCoefMarge" name="inputCoefMarge" aria-describedby="inputCoefMargeIcon" placeholder="" required="true" value="<?php echo produitInfo("coefmarge", $ref); ?>" readonly>
				    	<div class="input-group-prepend">
				    		<span class="input-group-text" id="inputCoefMargeIcon">%</span>
				    	</div>
				    </div>
				    <!-- <small id="inputCoefMargeInfo" class="form-text text-muted">Ne doit pas depasser 100%.</small> -->
				</div>
				<div class="form-group col-md-4">
					<label for="inputPrixVente"><span class="warning">*</span>Prix de vente HT en €</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputPrixVente" name="inputPrixVente"  aria-describedby="inputPrixVenteIcon" placeholder="" required="true" value="<?php echo produitInfo("prixvente", $ref); ?>" >
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

		<hr>

		<form method="POST" action="<?php echo $racine . $p_php . "produitEtat.php"; ?>" class="mt-3">
			<div class="text-center">
			<?php 
			if (produitInfo("desactiver", $ref) == 1) 
			{
				echo "<input type=\"text\" hidden class=\"form-control\" id=\"inputREF\" name=\"inputREF\" readonly value=\"" . produitInfo("ref", $ref) . "\">";
				echo "<button type=\"submit\" class=\"btn btnValider\">Activer le produit</button>";
			}
			else
			{
				echo "<input type=\"text\" hidden class=\"form-control\" id=\"inputREF\" name=\"inputREF\" readonly value=\"" . produitInfo("ref", $ref) . "\">";
				echo "<small>Si vous désactivez se produit, il ne sera plus possible de l'ajouter à une facture.<br>Vous pourrez le réactiver par la suite.</small><br>";
				echo "<button type=\"submit\" class=\"btn btnSupprimer\">Désactiver le produit</button>";
			}
			?>
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