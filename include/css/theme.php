<?php
   header('content-type: text/css');
   ob_start('ob_gzhandler');
   header('Cache-Control: max-age=31536000, must-revalidate');
   // etc. 
	$racine = "../..";
	require($racine . "/include/conf/conf.php");
?>
/* ici vos styles statiques */
body
{
	background-color: <?php echo theme("1", "var1"); ?>;
}
nav, footer
{
	background-color: <?php echo theme("2", "var1"); ?>;
}
h1
{
	color: <?php echo theme("3", "var1"); ?>;
}
h2
{
	color: <?php echo theme("4", "var1"); ?>;
}
h3
{
	color: <?php echo theme("5", "var1"); ?>;
}
.btnValider
{
	background-color: <?php echo theme("6", "var1"); ?>;
	color: <?php echo theme("7", "var1"); ?>;
}
.btnValider:hover
{
	background-color: <?php echo theme("8", "var1"); ?>;
	color: <?php echo theme("9", "var1"); ?>;
}

.btnSupprimer
{
	background-color: <?php echo theme("10", "var1"); ?>;
	color: <?php echo theme("11", "var1"); ?>;
}
.btnSupprimer:hover
{
	background-color: <?php echo theme("12", "var1"); ?>;
	color: <?php echo theme("13", "var1"); ?>;
}

.btnBarre
{
	background-color: <?php echo theme("14", "var1"); ?>;
	color: <?php echo theme("15", "var1"); ?>;
}
.btnBarre:hover
{
	background-color: <?php echo theme("16", "var1"); ?>;
	color: <?php echo theme("17", "var1"); ?>;
}
th
{
	background-color: <?php echo theme("18", "var1"); ?>;
	color: <?php echo theme("19", "var1"); ?>;
}
tr 
{
	background-color: <?php echo theme("20", "var1"); ?>;
	color: <?php echo theme("21", "var1"); ?>;
}
tr:nth-child(even)
{
	background-color: <?php echo theme("22", "var1"); ?>;
	color: <?php echo theme("23", "var1"); ?>;
}
table.t-Style2 td, table.t-produits td
{
	background-color: <?php echo theme("1", "var1"); ?>;
}
.badgeProfessionnel
{
	background-color: <?php echo theme("24", "var1"); ?>;
	color: <?php echo theme("25", "var1"); ?>;
}
.badgeParticulier
{
	background-color: <?php echo theme("26", "var1"); ?>;
	color: <?php echo theme("27", "var1"); ?>;
}
.badgeFacture
{
	background-color: <?php echo theme("28", "var1"); ?>;
	color: <?php echo theme("29", "var1"); ?>;
}
.badgeDevis
{
	background-color: <?php echo theme("30", "var1"); ?>;
	color: <?php echo theme("31", "var1"); ?>;
}