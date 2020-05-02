<?php

$racine = "../..";

require($racine . "/include/conf/conf.php");

require_once ($racine . '/include/jpgraph/jpgraph.php');
require_once ($racine . '/include/jpgraph/jpgraph_pie.php');

require_once ($racine . '/include/jpgraph/jpgraph_pie3d.php');
 
$debut = $_GET['debut'];
$fin = $_GET['fin'];

$nbreClients = nbrePrestations($debut, $fin, "");


$graph = new PieGraph(300,200);
$graph->SetShadow();

$theme_class = new VividTheme();
$graph->SetTheme($theme_class);


$graph->title->Set("Nombre de prestations");
$graph->title->ParagraphAlign('center'); 
$graph->title->SetFont(FF_COURIER,FS_NORMAL, 15);
$graph->title->SetColor(theme("4", "var1"));


$graph->SetMarginColor('#C6C6C6:1'); 
$graph->SetBox(false);

$txt=new Text("" . $nbreClients . "");
$txt->SetPos(0.5,0.5,'center','center');
$txt->SetFont(FF_COURIER,FS_NORMAL, 50);
$txt->ParagraphAlign('center');
// $txt->SetBox('yellow','navy','gray');
$txt->SetColor('red');
$graph->AddText($txt);


$graph->Stroke();


 