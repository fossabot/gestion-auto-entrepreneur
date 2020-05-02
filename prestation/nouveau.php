<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Nouvelle prestation";

		require($racine . $p_php . "head.php");
	?>
</head>
<body onload="init();">
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Nouvelle prestation</h1>

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

		<h2 class="text-left">Informations</h2>

		<form method="POST" action="<?php echo $racine . $p_php . "prestationNouveau.php"; ?>">
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="inputType"><span class="warning">*</span>Type: <span class="badge badge-danger">*</span></label>
					<select id="inputType" name="inputType" class="form-control">
						<option value="professionnel" selected>Professionnel</option>
						<option value="particulier">Particulier</option>
					</select>
				</div>
				<div class="form-group col-md-10" id="particulierListe">
					<?php  listeClients(2, "inputNomClientParticulier"); ?>
				</div>
				<div class="form-group col-md-10" id="entrepriseListe">
					<?php  listeClients(1, "inputNomClientEntreprise"); ?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="inputDateOuverture"><span class="warning">*</span>Date d'ouverture: <span class="badge badge-danger">*</span></label>
					<input type="date" class="form-control text-center" name="inputDateOuverture" value="<?php echo date("Y-m-d"); ?>" readonly>
				</div>
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-4">
					<label for="inputUrgence"><span class="warning">*</span>Ugrence: </label>
					<select id="inputUrgence" name="inputUrgence" class="form-control">
						<option value="1">Bas</option>
						<option value="2" selected>Normal</option>
						<option value="3">Haut</option>
						<option value="4">Urgent</option>
					</select>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputProduitDescription">Description & Commentaire:</label>
			    <textarea class="form-control" id="inputProduitDescription" rows="3" name="inputProduitDescription" required></textarea>
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
	$('#particulierListe').css('display', 'none');

	$("#inputType").change
	(
		function () 
		{
			if (document.getElementById('inputType').value == "professionnel") 
			{
				$('#particulierListe').hide();
				$('#entrepriseListe').show();
			}
			if (document.getElementById('inputType').value == "particulier") 
			{
				$('#particulierListe').show();
				$('#entrepriseListe').hide();
			}
		}
	);
</script>