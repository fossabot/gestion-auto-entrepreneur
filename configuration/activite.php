<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Liste des activités";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Liste des activités</h1>

		<div class="d-flex justify-content-around flex-wrap flex-sm-wrap">
			<div class="p-2">
				<h2>Libérale</h2>
				<?php echo tableauActivite(1); ?>
			</div>
			<div class="p-2">
				<h2>Artisanale</h2>
				<?php echo tableauActivite(2); ?>
			</div>
			<div class="p-2">
				<h2>Commerciale</h2>
				<?php echo tableauActivite(3); ?>
			</div>
		</div>


	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>