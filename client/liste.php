<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Liste des clients";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Liste des clients</h1>

		<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th scope="col">Type</th>
						<th scope="col">Entreprise</th>
						<th scope="col">Nom Prénom</th>
						<th scope="col">Adresse</th>
						<th scope="col">Téléphone fixe</th>
						<th scope="col">Téléphone portable</th>
						<th scope="col" colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// On créé la requête
						$reqTableauClient = "SELECT * FROM clients ORDER BY id";
						 
						// on envoie la requête
						$resTableauClient = $conn->query($reqTableauClient);
						 
						while ($dataTableauClient = mysqli_fetch_array($resTableauClient)) 
						{
							if ($dataTableauClient['type'] == 1)
							{
								?>
									<tr>
										<td scope="row"><span class="badge badgeProfessionnel"><?php echo ucfirst(clientType($dataTableauClient['type'])); ?></span></td>
										<td><?php echo $dataTableauClient['entreprise']; ?></td>
										<td></td>
										<td><?php echo $dataTableauClient['adresse'] . ", " . $dataTableauClient['cp'] . " " . $dataTableauClient['ville'] . " " . $dataTableauClient['pays']; ?></td>
										<td><?php echo $dataTableauClient['tel_fixe']; ?></td>
										<td><?php echo $dataTableauClient['tel_portable']; ?></td>
										<td>
										<?php 
											if (documentIcon($dataTableauClient['id']) == 1)
											{
												?><a href="<?php echo $racine . "/documents/liste.php?id=" . $dataTableauClient['id']; ?>"><i class="fas fa-file-pdf"></i></a><?php
											} 
										?>
										</td>
										<td>
										<?php 
											if (prestationIcon($dataTableauClient['id']) == 1)
											{
												?><a href="<?php echo $racine . "/prestation/liste.php?id=" . $dataTableauClient['id']; ?>"><i class="fas fa-list"></i></a><?php
											} 
										?>
										</td>
										<td><a href="<?php echo "edit.php?id=" . $dataTableauClient['id']; ?>"><i class="fas fa-pen-square"></i></a></td>
									</tr>
								<?php
							}
							elseif ($dataTableauClient['type'] == 2) 
							{
								?>
									<tr>
										<td scope="row"><span class="badge badgeParticulier"><?php echo ucfirst(clientType($dataTableauClient['type'])); ?></span></td>
										<td></td>
										<td><?php echo clientNom($dataTableauClient['id']); ?></td>
										<td><?php echo $dataTableauClient['adresse'] . ", " . $dataTableauClient['cp'] . " " . $dataTableauClient['ville'] . " " . $dataTableauClient['pays']; ?></td>
										<td><?php echo $dataTableauClient['tel_fixe']; ?></td>
										<td><?php echo $dataTableauClient['tel_portable']; ?></td>
										<td>
										<?php 
											if (documentIcon($dataTableauClient['id']) == 1)
											{
												?><a href="<?php echo $racine . "/documents/liste.php?id=" . $dataTableauClient['id']; ?>"><i class="fas fa-file-pdf"></i></a><?php
											} 
										?>
										</td>
										<td>
										<?php 
											if (prestationIcon($dataTableauClient['id']) == 1)
											{
												?><a href="<?php echo $racine . "/prestation/liste.php?id=" . $dataTableauClient['id']; ?>"><i class="fas fa-list"></i></a><?php
											} 
										?>
										</td>
										<td><a href="<?php echo "edit.php?id=" . $dataTableauClient['id']; ?>"><i class="fas fa-pen-square"></i></a></td>
									</tr>
								<?php
							}
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