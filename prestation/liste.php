<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Liste des prestations";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Liste des prestations</h1>

		<div class="table-responsive">
			<table class="">
				<thead>
					<tr>
						<th scope="col">Num</th>
						<th scope="col">Urgence</th>
						<th scope="col">Client</th>
						<th scope="col">Date d'ouverture</th>
						<th scope="col">Commentaire</th>
						<th scope="col">Date de clôture</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// On créé la requête
						if (isset($_GET['id']) && !empty($_GET['id'])) 
						{
							$idClient = $_GET['id'];
							$reqTableauPrestations = "SELECT * FROM prestation WHERE client=$idClient ORDER BY id";
						}
						else
						{
							$reqTableauPrestations = "SELECT * FROM prestation ORDER BY id";
						}
						 
						// on envoie la requête
						$resTableauPrestations = $conn->query($reqTableauPrestations);
						 
						while ($dataTableauPrestations = mysqli_fetch_array($resTableauPrestations)) 
						{
							$commentaire = $dataTableauPrestations['commentaire'];
							if (strlen($commentaire)>50) $commentaire=substr($commentaire, 0, 50)."...";
							?>
								<tr>
									<td><?php echo $dataTableauPrestations['id']; ?></td>
									<td>
										<?php 
											echo ($dataTableauPrestations['urgence'] == 1) ? "<i class=\"fas fa-bookmark urgence1\"></i>" :""; 
											echo ($dataTableauPrestations['urgence'] == 2) ? "<i class=\"fas fa-bookmark urgence2\"></i>" :""; 
											echo ($dataTableauPrestations['urgence'] == 3) ? "<i class=\"fas fa-bookmark urgence3\"></i>" :""; 
											echo ($dataTableauPrestations['urgence'] == 4) ? "<i class=\"fas fa-bookmark urgence4\"></i>" :""; 
										?>
									</td>
									<td><?php echo clientNom($dataTableauPrestations['client']); ?></td>
									<td><?php echo utf8_encode(strftime('%d/%m/%g', strtotime($dataTableauPrestations['dateouverture']))); ?></td>
									<td><?php echo $commentaire; ?></td>
									<td><?php echo ($dataTableauPrestations['cloture'] == 1) ? utf8_encode(strftime('%d/%m/%g', strtotime($dataTableauPrestations['datecloture']))) : "-"; ?></td>
									<td><a href="<?php echo "editInfo.php?id=" . $dataTableauPrestations['id']; ?>"><i class="fas fa-pen-square"></a></i></td>
								</tr>
							<?php
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
