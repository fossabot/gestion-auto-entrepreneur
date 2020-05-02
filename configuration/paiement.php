<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Moyens de paiement";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Moyens de paiement</h1>

		<div class="d-flex justify-content-around flex-wrap flex-sm-wrap">
			<table class="t-Style2 w-50">
				<thead class="">
					<tr>
						<th class="w-50" scope="col">Nom</th>
						<th class="w-25" scope="col">Description</th>
						<th class="w-25 text-center" scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<form method="POST" action="<?php echo $racine . $p_php . "paiementAjouter.php"; ?>">
							<td>
								<div class="">
									<input type="text" class="form-control" id="inputNom" name="inputNom" aria-describedby="inputNom" placeholder="Nouveau" required>
								<div>
							</td>
							<td>
								<div class="">
									<input type="text" class="form-control" id="inputDescription" name="inputDescription" aria-describedby="inputDescription" placeholder="Nouveau">
								<div>
							</td>
							<td class="text-center">
								<button type="submit" class="btn btnValider">Ajouter</button>
							</td>
						</form>
					</tr>
					<?php
					// On créé la requête
					$reqPaiement = "SELECT * FROM moyenpaiement";
					 
					// on envoie la requête
					$resPaiements = $conn->query($reqPaiement);
					 
					// on va scanner tous les tuples un par un
					while ($dataPaiement = mysqli_fetch_array($resPaiements)) {
					    // on affiche les résultats
					    echo "<tr>";
					    echo "<td>" . $dataPaiement['nom'] . "</td>";
					    echo "<td>" . $dataPaiement['description'] . "</td>";
					    echo "<td class=\"text-center\"><a href=\"" . $racine . $p_php . "paiementSupprimer.php?nom=" . $dataPaiement['nom'] . "\"><i class=\"fas fa-trash-alt\"></i></a></td>";
					    echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>


	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>