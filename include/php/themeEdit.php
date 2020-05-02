<?php
$racine = "../..";
require($racine . "/include/conf/conf.php");


themeUpdate("1", "var1", $_POST['inputBackgroung']);

themeUpdate("2", "var1", $_POST['inputBackgroungMenu']);

themeUpdate("3", "var1", $_POST['inputColorH1']);

themeUpdate("4", "var1", $_POST['inputColorH2']);

themeUpdate("5", "var1", $_POST['inputColorH3']);

themeUpdate("6", "var1", $_POST['inputBoutonsValiderBackground']);

themeUpdate("7", "var1", $_POST['inputBoutonsValiderTxt']);

themeUpdate("8", "var1", $_POST['inputBoutonsValiderBackgroundHover']);

themeUpdate("9", "var1", $_POST['inputBoutonsValiderTxtHover']);

themeUpdate("10", "var1", $_POST['inputBoutonsSupprimerBackground']);

themeUpdate("11", "var1", $_POST['inputBoutonsSupprimerTxt']);

themeUpdate("12", "var1", $_POST['inputBoutonsSupprimerBackgroundHover']);

themeUpdate("13", "var1", $_POST['inputBoutonsSupprimerTxtHover']);

themeUpdate("14", "var1", $_POST['inputBoutonsBarreBackground']);

themeUpdate("15", "var1", $_POST['inputBoutonsBarreTxt']);

themeUpdate("16", "var1", $_POST['inputBoutonsBarreBackgroundHover']);

themeUpdate("17", "var1", $_POST['inputBoutonsBarreTxtHover']);

themeUpdate("18", "var1", $_POST['inputTableauTitreBackground']);

themeUpdate("19", "var1", $_POST['inputTableauTitreTxt']);

themeUpdate("20", "var1", $_POST['inputTableauLigne1Background']);

themeUpdate("21", "var1", $_POST['inputTableauLigne1TitreTxt']);

themeUpdate("22", "var1", $_POST['inputTableauLigne2Background']);

themeUpdate("23", "var1", $_POST['inputTableauLigne2Txt']);

themeUpdate("24", "var1", $_POST['inputBadgeProfessionnelBackground']);

themeUpdate("25", "var1", $_POST['inputBadgeProfessionnelTxt']);

themeUpdate("26", "var1", $_POST['inputBadgeParticulierBackground']);

themeUpdate("27", "var1", $_POST['inputBadgeParticulierTxt']);

themeUpdate("28", "var1", $_POST['inputBadgeFactureBackground']);

themeUpdate("29", "var1", $_POST['inputBadgeFactureTxt']);

themeUpdate("30", "var1", $_POST['inputBadgeDevisBackground']);

themeUpdate("31", "var1", $_POST['inputBadgeDevisTxt']);


header('Location: /configuration/theme.php');
