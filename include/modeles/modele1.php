<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");
require_once ($racine . "/include/dompdf/autoload.inc.php");

if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['type']) && !empty($_POST['type'])) 
{
	$id = $_POST['id'];
	$type = $_POST['type'];
	$note = $_POST['inputTexteNote'];
}
else
{
	echo "erreur";
	exit();
}

$numeroDoc = documentNumerotation($type, $id, $note);

echo $id;
echo ($type == "1") ? "<h1>FACTURE</h1>" :"" ;
echo ($type == "2") ? "<h1>DEVIS</h1>" :"" ;

if ($type == "1") 
{
	$typeText = "facture";
	$typeTextC = "F";

	$verifFacture = verifFacture($id);
	$ok = $verifFacture->ok;

	if ($ok == 1) 
	{
		prestationCloture($id);
	}
	else
	{
		exit();
	}
}
elseif ($type == "2") 
{
	$typeText = "devis";
	$typeTextC = "D";
	$infoDevis = $_POST['inputTexteInformation'];
}
else
{
	exit();
}

use Dompdf\Dompdf;
ob_start();
?>
<!-- CSS -->
<style>
	body
	{
		width: 18cm;
		height: 29.7cm; 
		margin: 0; 
		padding-left: 0.5cm; 
		color: #001028;
		background: #FFFFFF; 
		font-family: Arial, sans-serif; 
		/*font-size: 12px; */
		/*border: solid 1px black;*/
		font-size: 80%;
	}
	#page
	{
		margin: 0; 
		padding: 0;
		/*border: solid 1px black;*/
	}
	#titre
	{
		width: 100%;
		text-transform: capitalize;
		/*border: solid 1px black;*/
	}
	#titre > h1
	{
		text-align: center;
		font-size: xx-large;
		/*border: solid 1px black;*/
		margin-bottom: 0;
	}
	#titre > span
	{
		text-align: center;
		font-size: medium;
		margin-top: 10px;
		margin-bottom: 10px;
		margin-left: auto;
		margin-right: auto;
		display: block;
		border: solid 1px black;
		width: 15%;
		background-color: #D2D2D2;
	}
	#tab1
	{
		border-collapse: collapse;
		width: 100%;
		margin-top: 1cm;
	}
	#tab1 td
	{
		/*border: solid 1px black;*/
		width: 50%;
		height: 3cm;
		vertical-align: top;
	}
	#tab1 h2
	{
		margin-top: 0;
		margin-bottom: 0;
		border-bottom: solid 1px;
		font-size: 110%;
		width: 80%;
	}
	#tab1 p
	{
		margin-top: 0;
		margin-bottom: 0;
		margin-left: 0.5cm;
		font-size: medium;
	}
	.nom
	{
		font-weight: 600;
	}

	#tab2
	{
		border-collapse: collapse;
		width: 100%;
		margin-top: 1cm;
	}
	#tab2 .titre td
	{
		text-align: center;
		background-color: #F87718;
		padding: 8px 0;
		vertical-align: middle;
		color: #FFFFFF;
		font-size: medium;
		font-weight: 600;
	}
	#tab2 .info td
	{
		text-align: center;
		vertical-align: middle;
		background-color: #f2f2f2;
		font-size: small;
	}
	#tab2 td
	{
		/*border: solid 1px black;*/
		width: 25%;
		/*height: 3cm;*/
		vertical-align: top;
	}
	#tab2 h2
	{
		margin-top: 0;
		margin-bottom: 0;
		border-bottom: solid 1px;
		font-size: 120%;
		width: 80%;
	}
	#tab2 p
	{
		margin-top: 0;
		margin-bottom: 0;
		margin-left: 0.5cm;
	}

	#tab3
	{
		border-collapse: collapse;
		width: 100%;
		margin-top: 1cm;
	}
	#tab3 .titre td
	{
		text-align: center;
		background-color: #F87718;
		padding: 8px 0;
		vertical-align: middle;
		color: #FFFFFF;
		font-size: medium;
		font-weight: 600;
	}
	#tab3 .info td
	{
		text-align: center;
		vertical-align: middle;
		background-color: #f2f2f2;
		font-size: small;
	}
	#tab3 td.date
	{
		/*border: solid 1px black;*/
		width: 30%;
		/*height: 3cm;*/
		vertical-align: top;
	}
	#tab3 td.info
	{
		/*border: solid 1px black;*/
		width: 70%;
		/*height: 3cm;*/
		vertical-align: top;
	}
	#tab3 h2
	{
		margin-top: 0;
		margin-bottom: 0;
		border-bottom: solid 1px;
		font-size: 120%;
		width: 80%;
	}
	#tab3 p
	{
		margin-top: 0;
		margin-bottom: 0;
		margin-left: 0.5cm;
	}
	


	.tableProduits 
	{
		border-collapse: collapse;
		width: 100%;
		border-bottom: 1px solid #707070;
		margin-top: 1cm;
	}
	.tableProduits th
	{
		text-align: center;
		padding: 8px;
		background-color: #F87718;
		color: white;
		font-weight: 600;
	}
	.tableProduits td 
	{
		padding: 8px;
	}

	.tableProduits tr:nth-child(even){background-color: #f2f2f2}


	
	.tablePrix 
	{
		border-collapse: collapse;
		width: 100%;
		margin-top: 2cm;
	}
	.tablePrix td 
	{
		padding: 8px;
	}
	.tablePrix th
	{
		text-align: center;
		padding: 8px;
		background-color: #F87718;
		color: white;
	}
	.tablePrix .description
	{
		text-align: right;
		width: 15%;
		letter-spacing: 1px;
	}
	.tablePrix .valeure
	{
		text-align: center;
		width: 15%;
		border-bottom: 1px dotted #707070;
	}
	.tablePrix .info
	{
		text-align: center;
		width: 70%;
		/*border-bottom: 1px dotted #707070;*/
		vertical-align: bottom;
		color: #B8B8B8;
		background-color: #FFFFFF;
	}
	.fin .description
	{
		text-align: right;
		/*width: 25%;*/
		padding-top: 10px;
		padding-bottom: 10px;
		font-weight: 900;
		letter-spacing: 1px;
		/*border: solid 1px black;*/
	}
	.fin .valeure
	{
		text-align: center;
		width: 15%;
		border-bottom: 1px dotted #707070;
		padding-top: 10px;
		padding-bottom: 10px;
		background-color: #FF9F51;
		font-weight: 900;
	}
	.text-center
	{
		text-align: center;
	}
	.text-left
	{
		text-align: left;
	}
	footer
	{
		width: 18cm;
		height: 2cm;
		margin-top: 2cm;
		/*border-top: solid 1px black;*/
		/*border-bottom: solid 1px black;*/
		text-align: center;
	}
	
</style>
<!-- FIN CSS -->


<!-- HTML -->
<body>    
	<div id="page">
		<div id="titre">
			<h1><?php  echo $typeText; ?></h1>
			<span>N° <?php  echo $numeroDoc; ?></span>
		</div>
		<table id="tab1">
			<tr>
				<td>
					<h2>Facturé par</h2>
					<p class="nom"><?php echo entrepriseInfo("nomentreprise"); ?></p>
					<p><?php echo entrepriseInfo("adresseSiege"); ?></p>
					<p><?php echo entrepriseInfo("cp") . " " . entrepriseInfo("ville"); ?></p>
					<?php echo (entrepriseInfo("telP") != "") ? "<p>" . entrepriseInfo("telP") . "</p>" : "" ; ?>
					<?php echo (entrepriseInfo("telF") != "") ? "<p>" . entrepriseInfo("telF") . "</p>" : "" ; ?>
					<p><?php echo entrepriseInfo("email"); ?></p>
					<p>SIRET: <?php echo entrepriseInfo("siret"); ?></p>
				</td>
				<td>
					<h2>Facturé à</h2>
					<p class="nom"><?php echo clientNom(prestationInfo("client", $id)); ?></p>
					<p><?php echo clientInfo("adresse", prestationInfo("client", $id)); ?></p>
					<p><?php echo clientInfo("cp", prestationInfo("client", $id)) . " " . clientInfo("ville", prestationInfo("client", $id)); ?></p>
					<?php echo (clientInfo("tel_portable", prestationInfo("client", $id)) != "") ? "<p>" . clientInfo("tel_portable", prestationInfo("client", $id)) . "</p>" : ""; ?>
					<?php echo (clientInfo("tel_fixe", prestationInfo("client", $id)) != "") ? "<p>" . clientInfo("tel_fixe", prestationInfo("client", $id)) . "</p>" : ""; ?>
					<p><?php echo clientInfo("email", prestationInfo("client", $id)); ?></p>
				</td>
			</tr>
		</table>

		<?php 
			//FACTURE
			if ($type == 1) 
			{
				?>
					<table id="tab2">
						<tr class="titre">
							<td>Date de facturation</td>
							<td>Date de livraison</td>
							<td>Conditions et moyen de règlement</td>
							<td>Echéance de paiement</td>
						</tr>
						<tr class="info">
							<td><?php echo utf8_encode(strftime('%d %B %Y', strtotime(prestationInfo("datefacturation", $id)))); ?></td>
							<td><?php echo utf8_encode(strftime('%d %B %Y', strtotime(prestationInfo("datelivraison", $id)))); ?></td>
							<td><?php echo prestationInfo("moyenpaiement", $id); ?></td>
							<td><?php echo utf8_encode(strftime('%d %B %Y', strtotime(prestationInfo("datefacturation", $id) . " +30 days"))); ?></td>
						</tr>
					</table>
				<?php
			}

			//DEVIS
			elseif ($type == 2) 
			{
				?>
					<table id="tab3">
						<tr class="titre col-6">
							<td class="date">Date d'émission du devis</td>
							<td class="info">Informations</td>
						</tr>
						<tr class="info col-12">
							<td><?php echo utf8_encode(strftime('%d %B %Y')); ?></td>
							<td><?php echo $infoDevis; ?></td>
						</tr>
					</table>

				<?php
			}
		?>

		
		
		<table class="tableProduits">
			<tr>
				<th style="width: 10%;">Ref</th>
				<th style="width: 50%;">Description</th>
				<th style="width: 10%;">Quantité</th>
				<th style="width: 15%;">Prix unitaire</th>
				<th style="width: 15%;">Total</th>
			</tr>
			<?php
				$reqSelectProduits = "SELECT * FROM prestationproduit WHERE facture='$id'";
				 
				$resSelectProduits = $conn->query($reqSelectProduits);
				
				$calcPrix = 0;

				while ($dataSelectProduits = mysqli_fetch_array($resSelectProduits))
				{
					if ($dataSelectProduits['offert'] == "0") 
					{
						$calcPrix = (produitInfo("prixvente", $dataSelectProduits['produit']) * $dataSelectProduits['produitqte']);
						$calcPrixTotal = $calcPrixTotal + $calcPrix;
					}
				    ?>
				    <tr>
						<td class="text-center"><?php echo ref(produitInfo("ref", $dataSelectProduits['produit'])); ?></td>
						<td class="text-left"><?php echo produitInfo("designation", $dataSelectProduits['produit']); ?></td>
						<td class="text-center"><?php echo $dataSelectProduits['produitqte']; ?></td>
						<td class="text-center"><?php echo produitInfo("prixvente", $dataSelectProduits['produit']) . "€"; ?></td>
						<td class="text-center"><?php echo ($dataSelectProduits['offert'] == "1") ? "OFFERT" : $calcPrix . "€"; ?></td>
					</tr>
				    <?php
				}
			?>
		</table>
		<table class="tablePrix">
			<tr>
				<th class="info" rowspan="4">
					<a>TVA non applicable, art. 293B du CGI</a>
				</th>
				<th class="titre" colspan="2">Facture total</th>
			</tr>
			<tr>
				<td class="description">Sous-total</td>
				<td class="valeure"><?php echo $calcPrixTotal; ?>€</td>
			</tr>
			<tr>
				<td class="description">Remise</td>
				<td class="valeure"><?php echo number_format(prestationInfo('remise', $id), 2, ',', ' '); ?>%</td>
			</tr>
			<tr class="fin">
				<td class="description">Solde du</td>
				<td class="valeure"><?php $number = ($calcPrixTotal * (1-(prestationInfo('remise', $id)/100))); echo number_format($number, 2, ',', ' '); ?>€</td>
			</tr>
		</table>
	</div>
</body>
<!-- FIN HTML -->

<!-- FIN HTML -->
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);

$dompdf->get_canvas()->page_text(490, 770, "Page {PAGE_NUM}/{PAGE_COUNT}", 'Arial', 13, array(0,0,0));

$dompdf->render();
// $dompdf->stream($typeTextC . "-" . $numeroDoc);

file_put_contents($racine . "/include/documents/" . $typeTextC . "-" . $numeroDoc . ".pdf", $dompdf->output());

// $output = $dompdf->output();
// file_put_contents($typeTextC . "-" . $numeroDoc . ".pdf", $output);


header('Location: /prestation/documents.php?&id=' . $id . '#listeDoc');
// exit();
?>