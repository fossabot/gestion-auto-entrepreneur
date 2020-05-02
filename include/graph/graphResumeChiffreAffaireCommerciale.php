<?php

$racine = "../..";

require($racine . "/include/conf/conf.php");

require_once ($racine . '/include/jpgraph/jpgraph.php');
require_once ($racine . '/include/jpgraph/jpgraph_pie.php');

require_once ($racine . '/include/jpgraph/jpgraph_pie3d.php');


$debut = $_GET['debut'];
$fin = $_GET['fin'];
$type = "3";

$CA = calculeChiffreAffaire("", $debut, $fin, $type);

$graph = new PieGraph(300,200);
$graph->SetShadow();

$theme_class = new VividTheme();
$graph->SetTheme($theme_class);


$graph->title->Set("Chiffre d'affaire");
$graph->title->ParagraphAlign('center'); 
$graph->title->SetFont(FF_COURIER,FS_NORMAL, 15);
$graph->title->SetColor(theme("4", "var1"));

$graph->subtitle->Set('Commerciale');
$graph->subtitle->SetFont(FF_COURIER,FS_NORMAL, 10);
$graph->subtitle->SetColor(theme("5", "var1"));


$graph->SetMarginColor('#C6C6C6:1'); 
$graph->SetBox(false);

$txt=new Text("" . $CA . " €");
$txt->SetPos(0.5,0.5,'center','center');
$txt->SetFont(FF_COURIER,FS_NORMAL, 50);
$txt->ParagraphAlign('center');
$txt->SetColor('red');
$graph->AddText($txt);


$graph->Stroke();


 