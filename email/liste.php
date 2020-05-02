<!DOCTYPE html>
<html>
<head>
	<?php
		//CONF
		$racine = "../";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Email";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Email</h1>

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

		<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th scope="col">Date</th>
						<th scope="col" colspan="2">Destinataire</th>
						<th scope="col">Objet</th>
						<th scope="col">Fichier joint</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// On créé la requête
						$reqTableauEmail = "SELECT * FROM email ORDER BY id";
						 
						// on envoie la requête
						$resTableauEmail = $conn->query($reqTableauEmail);
						 
						while ($dataTableauEmail = mysqli_fetch_array($resTableauEmail)) 
						{
							if (clientInfo("type", $dataTableauEmail['destinataire']) == 1)
							{
								?>
									<tr>
										<td><?php echo strftime('%d %B %g à %Hh%M', strtotime($dataTableauEmail['datetime'])); ?></td>
										<td class="text-right"><span class="badge badgeProfessionnel"><?php echo ucfirst(clientType(clientInfo("type", $dataTableauEmail['destinataire']))); ?></span></td>
										<td class="text-left"><?php echo clientNom($dataTableauEmail['destinataire']); ?></td>
										<td><?php echo $dataTableauEmail['objet']; ?></td>
										<td><a href="<?php echo $racine . "/include/documents/" . documentNumerotationAffichage($dataTableauEmail['document']) . ".pdf"; ?>" target="_blank"><i class="fas fa-file-pdf"></i></a></td>
										<td><a href="<?php echo "affichage.php?id=" . $dataTableauEmail['id']; ?>"><i class="fas fa-eye"></i></a></td>
									</tr>
								<?php
							}
							elseif (clientInfo("type", $dataTableauEmail['destinataire']) == 2) 
							{
								?>
									<tr>
										<td><?php echo strftime('%d %B %g à %Hh%M', strtotime($dataTableauEmail['datetime'])); ?></td>
										<td class="text-right"><span class="badge badgeParticulier"><?php echo ucfirst(clientType(clientInfo("type", $dataTableauEmail['destinataire']))); ?></span></td>
										<td class="text-left"><?php echo clientNom($dataTableauEmail['destinataire']); ?></td>
										<td><?php echo $dataTableauEmail['objet']; ?></td>
										<td><a href="<?php echo $racine . "/include/documents/" . documentNumerotationAffichage($dataTableauEmail['document']) . ".pdf"; ?>" target="_blank"><i class="fas fa-file-pdf"></i></a></td>
										<td><a href="<?php echo "affichage.php?id=" . $dataTableauEmail['id']; ?>"><i class="fas fa-eye"></i></a></td>
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