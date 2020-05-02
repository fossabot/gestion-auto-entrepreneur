<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = ".";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Accueil";

		require($racine . $p_php . "head.php");
	?>
		
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Accueil</h1>

		<?php //echo nbreClients(); ?>

		<div class="d-flex justify-content-around text-center mt-5 flex-wrap accueil-flex">
			<div class=" m-2 w-25 mt-5">
				<?php 
					echo "<img class='graph' src='" . $racine . "/include/graph/graphPartVenteType.php' >"; 
				?>
			</div>
			<div class=" m-2 w-25 mt-5">
				<?php 
					echo "<img class='graph' src='" . $racine . "/include/graph/graphNbreClients.php' >"; 
				?>
			</div>
			<div class=" m-2 w-25 mt-5">
				<?php 
					echo "<img class='graph' src='" . $racine . "/include/graph/graphNbrePrestations.php' >"; 
				?>
			</div>
			<div class=" m-2 w-25 mt-5">
				<?php 
					echo "<img class='graph' src='" . $racine . "/include/graph/graphNbrePrestationsCeMois.php' >"; 
				?>
			</div>
			<div class=" m-2 w-25 mt-5">
				<?php 
					echo "<img class='graph' src='" . $racine . "/include/graph/graphChiffreAffaireCeMois.php' >"; 
				?>
			</div>
			<div class=" m-2 w-25 mt-5">
				<?php 
					echo "<img class='graph' src='" . $racine . "/include/graph/graphChiffreAffaireMoisDernier.php' >"; 
				?>
			</div>
		</div>
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>