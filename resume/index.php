<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Résumé";

		require($racine . $p_php . "head.php");
	?>
		
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Résumé</h1>

		<fieldset class="borderForm mb-4">
			<legend>Séléction de la période</legend>
			<form method="GET" action="#">
				<div class="d-flex justify-content-around">
					<div class="form-group col-md-4">
						<label for="inputDateDebut">Début:</label>
						<input type="date" class="form-control text-center" name="inputDateDebut" value="<?php echo (isset($_GET['inputDateDebut']) && !empty($_GET['inputDateDebut'])) ? $_GET['inputDateDebut'] : "" ; ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inputDateFin">Fin:</label>
						<input type="date" class="form-control text-center" name="inputDateFin" value="<?php echo (isset($_GET['inputDateFin']) && !empty($_GET['inputDateFin'])) ? $_GET['inputDateFin'] : "" ; ?>">
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btnValider mt-2 mb-2">Valider</button>
				</div>
			</form>
		</fieldset>

		<?php
			if (isset($_GET['inputDateDebut']) && !empty($_GET['inputDateDebut']) && isset($_GET['inputDateFin']) && !empty($_GET['inputDateFin'])) 
			{
				?>
				<fieldset class="borderForm mb-4">
		
					<legend >Informations (<?php echo "du" . strftime('%d/%m/%G', strtotime($_GET['inputDateDebut'])) . " au " . strftime('%d/%m/%G', strtotime($_GET['inputDateFin'])); ?>)</legend>
					<div class="d-flex justify-content-around text-center mt-5 flex-wrap accueil-flex">
						<div class=" m-2 w-25 mt-5">
							<?php 
								echo "<img class='graph' src='" . $racine . "/include/graph/graphResumePartVenteType.php?debut=" . $_GET['inputDateDebut'] . "&fin=" . $_GET['inputDateFin'] . "' >"; 
							?>
						</div>
						<div class=" m-2 w-25 mt-5">
							<?php 
								echo "<img class='graph' src='" . $racine . "/include/graph/graphResumeNbrePrestations.php?debut=" . $_GET['inputDateDebut'] . "&fin=" . $_GET['inputDateFin'] . "' >"; 
							?>
						</div>
						<div class=" m-2 w-25 mt-5">
							<?php 
								echo "<img class='graph' src='" . $racine . "/include/graph/graphResumeChiffreAffaire.php?debut=" . $_GET['inputDateDebut'] . "&fin=" . $_GET['inputDateFin'] . "' >"; 
							?>
						</div>
						<div class=" m-2 w-25 mt-5">
							<?php 
								echo "<img class='graph' src='" . $racine . "/include/graph/graphResumeChiffreAffaireLiberale.php?debut=" . $_GET['inputDateDebut'] . "&fin=" . $_GET['inputDateFin'] . "' >"; 
							?>
						</div>
						<div class=" m-2 w-25 mt-5">
							<?php 
								echo "<img class='graph' src='" . $racine . "/include/graph/graphResumeChiffreAffaireArtisanale.php?debut=" . $_GET['inputDateDebut'] . "&fin=" . $_GET['inputDateFin'] . "' >"; 
							?>
						</div>
						<div class=" m-2 w-25 mt-5">
							<?php 
								echo "<img class='graph' src='" . $racine . "/include/graph/graphResumeChiffreAffaireCommerciale.php?debut=" . $_GET['inputDateDebut'] . "&fin=" . $_GET['inputDateFin'] . "' >"; 
							?>
						</div>
					</div>
				</fieldset>
				<?php
			}
			elseif ((isset($_GET['inputDateDebut']) && !empty($_GET['inputDateDebut'])) || (isset($_GET['inputDateFin']) && !empty($_GET['inputDateFin']))) 
			{
				?>
				<div class="alert alert-danger" role="alert">
					La date de début ou la date de fin n'est pas saisie !
				</div>
				<?php
			}
		?>

	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>