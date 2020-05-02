<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Lecteur de PDF";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Lecteur de PDF</h1>



		<?php
			if (isset($_GET['url']) && !empty($_GET['url'])) 
			{
				?>
					<iframe class="docReader" src="<?php echo $_GET['url']; ?>"></iframe>
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
		?>

		
	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>