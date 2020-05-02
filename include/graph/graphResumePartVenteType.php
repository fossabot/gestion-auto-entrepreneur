<?php

$racine = "../..";

require($racine . "/include/conf/conf.php");

require_once ($racine . '/include/jpgraph/jpgraph.php');
require_once ($racine . '/include/jpgraph/jpgraph_pie.php');

require_once ($racine . '/include/jpgraph/jpgraph_pie3d.php');
 
$liberale = 0;
$artisanale = 0;
$commerciale = 0;

$debut = $_GET['debut'];
$fin = $_GET['fin'];

$req = "SELECT * FROM prestationproduit JOIN prestation ON prestationproduit.facture = prestation.id  WHERE prixfinalunitaire is not null && (dateFacturation >= '$debut' && dateFacturation <= '$fin')";
 
$res = $conn->query($req);
 
while ($data = mysqli_fetch_array($res)) 
{
	if (produitTypeActivite($data['produit']) == 1) 
	{
		$liberale = $liberale + $data['produitqte'];
	}
	if (produitTypeActivite($data['produit']) == 2) 
	{
		$artisanale = $artisanale + $data['produitqte'];
	}
	if (produitTypeActivite($data['produit']) == 3) 
	{
		$commerciale = $commerciale + $data['produitqte'];
	}
}

$data = array($liberale, $artisanale, $commerciale);


// DEFINE("TTF_DIR","/home/www/html/include/jpgraph/fonts/");


if (($liberale + $artisanale + $commerciale) != 0) 
{
	$graph = new PieGraph(300,200);
	$graph->SetShadow();

	$theme_class = new VividTheme();
	$graph->SetTheme($theme_class);

	$graph->title->Set("Parts des ventes\nen fonction des types d'activité");
	$graph->title->ParagraphAlign('center'); 
	$graph->title->SetFont(FF_COURIER,FS_NORMAL, 15);
	$graph->title->SetColor(theme("4", "var1"));

	 
	$p1 = new PiePlot3D($data);


	$p1->SetAngle(20);
	$p1->SetSize(0.5);
	$p1->SetCenter(0.5);
	$graph->legend->SetPos(0.5,0.97,'center','bottom');
	$p1->SetLegends(array("Libérale: " . $liberale, "Artisanale: " . $artisanale, "Commerciale: " . $commerciale));


	$graph->img->SetAntiAliasing(false);
	$graph->SetMarginColor('#C6C6C6:1'); 
	$graph->SetBox(false);

	$graph->SetImgFormat('jpeg',100);
	 
	$graph->Add($p1);
	$graph->Stroke();
}
else
{
	$graph = new PieGraph(300,200);
	$graph->SetShadow();

	$theme_class = new VividTheme();
	$graph->SetTheme($theme_class);

	$graph->title->Set("Parts des ventes\nen fonction des types d'activité");
	$graph->title->ParagraphAlign('center'); 
	$graph->title->SetFont(FF_COURIER,FS_NORMAL, 15);
	$graph->title->SetColor(theme("4", "var1"));

	$graph->img->SetAntiAliasing(false);
	$graph->SetMarginColor('#C6C6C6:1'); 
	$graph->SetBox(false);

	$txt=new Text("Ce graphique sera initialisé\naprès votre première facturation");
	$txt->SetPos(0.5,0.5,'center','center');
	$txt->SetFont(FF_COURIER,FS_NORMAL, 15);
	$txt->ParagraphAlign('center');
	$txt->SetColor('red');
	$graph->AddText($txt);

	$graph->SetImgFormat('jpeg',100);

	$graph->Stroke();
}


 