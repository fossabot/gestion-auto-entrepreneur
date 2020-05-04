<?php

function random($car) 
{
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ01234567890";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) 
    {
    	$string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}

function ifInstall() 
{
	global $conn;

    // On créé la requête
	$reqIfInstall = "SELECT var1 FROM parametres WHERE id=1";
	 
	// on envoie la requête
	$resIfInstall = $conn->query($reqIfInstall);
	 
	// on va scanner tous les tuples un par un
	$dataIfInstall = mysqli_fetch_array($resIfInstall);

    return $dataIfInstall['var1'];
}

function parametre($id, $nomColonne) 
{
	global $conn;

    // On créé la requête
	$reqParam = "SELECT $nomColonne FROM parametres WHERE id='$id'";
	 
	// on envoie la requête
	$resParam = $conn->query($reqParam);
	 
	// on va scanner tous les tuples un par un
	$dataParam = mysqli_fetch_array($resParam);

    return $dataParam[$nomColonne];
}
function theme($id, $nomColonne) 
{
	global $conn;

    // On créé la requête
	$reqTheme = "SELECT $nomColonne FROM theme WHERE id='$id'";
	 
	// on envoie la requête
	$resTheme = $conn->query($reqTheme);
	 
	// on va scanner tous les tuples un par un
	$dataTheme = mysqli_fetch_array($resTheme);

    return $dataTheme[$nomColonne];
}

function parametreUpdate($id, $nomColonne, $val) 
{
	global $conn;

    // On créé la requête
	$req = "UPDATE parametres SET $nomColonne='$val' WHERE id=$id";
	 
	// on envoie la requête
	$res = $conn->query($req);
}

function themeUpdate($id, $nomColonne, $val) 
{
	global $conn;

    // On créé la requête
	$reqThemeUpdate = "UPDATE theme SET $nomColonne='$val' WHERE id=$id";
	 
	// on envoie la requête
	$resThemeUpdate = $conn->query($reqThemeUpdate);
}

function entrepriseInfo($nomColonne) 
{
	global $conn;

    // On créé la requête
	$reqEntrepriseInfo = "SELECT $nomColonne FROM entreprise LIMIT 1";
	 
	// on envoie la requête
	$resEntrepriseInfo = $conn->query($reqEntrepriseInfo);
	 
	// on va scanner tous les tuples un par un
	$dataEntrepriseInfo = mysqli_fetch_array($resEntrepriseInfo);

    return $dataEntrepriseInfo[$nomColonne];
}

function clientInfo($nomColonne, $id) 
{
	global $conn;

    // On créé la requête
	$reqClientInfo = "SELECT $nomColonne FROM clients WHERE id=$id LIMIT 1";
	 
	// on envoie la requête
	$resClientInfo = $conn->query($reqClientInfo);
	 
	// on va scanner tous les tuples un par un
	$dataClientInfo = mysqli_fetch_array($resClientInfo);

    return $dataClientInfo[$nomColonne];
}

function clientType($id) 
{
	global $conn;
	$nomColonne = "description";

    // On créé la requête
	$reqClientType = "SELECT $nomColonne FROM typeclient WHERE id=$id LIMIT 1";
	 
	// on envoie la requête
	$resClientType = $conn->query($reqClientType);
	 
	// on va scanner tous les tuples un par un
	$dataClientType = mysqli_fetch_array($resClientType);

    return $dataClientType[$nomColonne];
}

function clientGenre($version, $id) 
{
	global $conn;

	if ($version == "C" || $version == "c" || $version == "court") {$nomColonne = "court";}
	if ($version == "L" || $version == "l" || $version == "long") {$nomColonne = "complet";}

    // On créé la requête
	$reqClientGenre = "SELECT $nomColonne FROM genre WHERE id=$id LIMIT 1";
	 
	// on envoie la requête
	$resClientGenre = $conn->query($reqClientGenre);
	 
	// on va scanner tous les tuples un par un
	$dataClientGenre = mysqli_fetch_array($resClientGenre);

    return $dataClientGenre[$nomColonne];
}

function clientNom($id) 
{
	global $conn;
	$nomColonne = "description";

	$type = clientInfo("type", $id);

	if ($type == 1) 
	{
		$nom = clientInfo("entreprise", $id);
	}
	elseif ($type == 2) 
	{
		$nom = clientGenre("c", clientInfo("genre", $id)) . " " . clientInfo("prenom", $id) . " " . clientInfo("nom", $id);
	}

    return $nom;
}

function password($password)
{
	// On récupère le pass entré par l'utilisateur
	$mdp = $password;
	// On prends la longueur de la chaine
	$code = strlen($mdp);
	// On fait quelques opérations
	$code = ($code * 5)*($code/1);
	// Le premier sel correspond à la longueur du mot de passe
	$sel = strlen($mdp);
	// Le deuxième sel est égal à la longueur des chaines $code et $mdp
	$sel2 = strlen($code.$mdp);
	// On termine en beauté avec quelques hashs
	$texte_hash = sha1($sel.$mdp.$sel2);
	$texte_hash_2 = md5($texte_hash.$sel2);

	// On assemble tout ça pour obtenir une chaine de 82 caractères
	$final = $texte_hash.$texte_hash_2;
	// On supprime 2 caractère pour brouiller les pistes (ici 7 et 8)
	substr($final , 7, 8);
	// On finit par tout mettre en majuscule
	$final = strtoupper($final);

	return $final;
}

function tel($str) 
{
    if(strlen($str) == 10) 
    {
	    $res = substr($str, 0, 2) .' ';
	    $res .= substr($str, 2, 2) .' ';
	    $res .= substr($str, 4, 2) .' ';
	    $res .= substr($str, 6, 2) .' ';
	    $res .= substr($str, 8, 2) .' ';
	    return $res;
    }
    return $str;
}

function tableauActivite($idActivite) 
{
    global $conn;
    global $racine;
    global $p_php;
    ?>
		<table class="t-Style2">
			<thead class="">
				<tr>
					<th class="w-75" scope="col">Nom</th>
					<th class="w-25 text-center" scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<form method="POST" action="<?php echo $racine . $p_php . "activiteAjouter.php"; ?>">
						<td>
							<div class="">
								<input type="text" class="form-control" id="inputType" name="inputType" aria-describedby="inputType" value="<?php echo $idActivite; ?>" hidden>
								<input type="text" class="form-control" id="inputActivite" name="inputActivite" aria-describedby="inputActivite" placeholder="Nouveau" required>
							<div>
						</td>
						<td class="text-center">
							<button type="submit" class="btn btnValider">Ajouter</button>
						</td>
					</form>
				</tr>
				<?php
				// On créé la requête
				$reqConfAct = "SELECT * FROM typeactivitedesc JOIN typeactivite ON typeactivitedesc.idtype = typeactivite.id WHERE idtype=$idActivite";
				 
				// on envoie la requête
				$resConfActs = $conn->query($reqConfAct);
				 
				// on va scanner tous les tuples un par un
				while ($dataConfAct = mysqli_fetch_array($resConfActs)) {
				    // on affiche les résultats
				    echo "<tr>";
				    echo "<td>" . $dataConfAct['description'] . "</td>";
				    echo "<td class=\"text-center\"><a href=\"" . $racine . $p_php . "activiteSupprimer.php?id=" . $dataConfAct['iddesc'] . "\"><i class=\"fas fa-trash-alt\"></i></a></td>";
				    echo "</tr>";
				}
				?>
			</tbody>
		</table>
    <?php
}

function listeActivite()
{
    global $conn;

	?>
		<label for="inputTypeListeActivite"><span class="warning">*</span>Type <span class="badge badge-danger">*</span></label>
		<select id="inputTypeListeActivite" name="inputTypeListeActivite" class="form-control">
		<option disabled selected>Selectionner le type correspondant</option>
		<?php
			// On créé la requête
			$reqType = "SELECT * FROM typeactivite";
			 
			// on envoie la requête
			$resType = $conn->query($reqType);
			 
			// on va scanner tous les tuples un par un
			while ($dataType = mysqli_fetch_array($resType)) {
			    // on affiche les résultats
			    echo "<optgroup label=\"".ucfirst($dataType['nom'])."\">";
				// On créé la requête
				$id = $dataType['id'];
				$reqDescription = "SELECT * FROM typeactivitedesc WHERE idtype=$id";
				$resDescription = $conn->query($reqDescription);

				while ($dataDescription = mysqli_fetch_array($resDescription)) {
				    // on affiche les résultats
			    	echo "<option value=\"".$dataDescription['iddesc']."\">".$dataDescription['description']."</option>";
				}
			    echo "</optgroup>";
			}
			echo "</table>";
		?>
		</select>
	<?php
}

function ref($ref) 
{
	//AFFICHAGE SOUS FORME: x0000

	global $conn;

	$nbreCar = strlen($ref);

	$nbreZ = 4 - $nbreCar;

    // On créé la requête
	$reqRef = "SELECT * FROM produits JOIN typeactivitedesc ON produits.categorie = typeactivitedesc.iddesc JOIN typeactivite ON typeactivitedesc.idtype = typeactivite.id WHERE ref=$ref";
	// on envoie la requête
	$resRef = $conn->query($reqRef);
	// on va scanner tous les tuples un par un
	$dataRef = mysqli_fetch_array($resRef);

    $categorie = $dataRef['nom'];
    $ref = ucfirst(substr($categorie, 0, 1)) . str_repeat("0", $nbreZ) . $ref;

    return $ref;
}

function produitInfo($nomColonne, $ref) 
{
	global $conn;

    // On créé la requête
	$reqProduitInfo = "SELECT $nomColonne FROM produits WHERE ref=$ref LIMIT 1";
	 
	// on envoie la requête
	$resProduitInfo = $conn->query($reqProduitInfo);
	 
	// on va scanner tous les tuples un par un
	$dataProduitInfo = mysqli_fetch_array($resProduitInfo);

    return $dataProduitInfo[$nomColonne];
}
function produitTypeActivite($ref) 
{
	global $conn;

    // On créé la requête
	$reqProduitTypeActivite = "SELECT * FROM produits JOIN typeactivitedesc ON produits.categorie = typeactivitedesc.iddesc JOIN typeactivite ON typeactivitedesc.idtype = typeactivite.id WHERE ref=$ref LIMIT 1";
	 
	// on envoie la requête
	$resProduitTypeActivite = $conn->query($reqProduitTypeActivite);
	 
	// on va scanner tous les tuples un par un
	$dataProduitTypeActivite = mysqli_fetch_array($resProduitTypeActivite);

    return $dataProduitTypeActivite["id"];
}

function categorieNom($id) 
{
	//AFFICHAGE SOUS FORME: x0000

	global $conn;

    // On créé la requête
	$reqCatNom = "SELECT * FROM produits JOIN typeactivitedesc ON produits.categorie = typeactivitedesc.iddesc WHERE categorie=$id";
	// on envoie la requête
	$resCatNom = $conn->query($reqCatNom);
	// on va scanner tous les tuples un par un
	$dataCatNom = mysqli_fetch_array($resCatNom);

    $categorieNom = $dataCatNom['description'];

    return $categorieNom;
}

function listeClients($type, $name)
{
    global $conn;

	?>
		<label for="<?php echo $name; ?>"><span class="warning">*</span>Selectionnez un client: <span class="badge badge-danger">*</span></label>
		<select id="<?php echo $name; ?>" name="<?php echo $name; ?>" class="form-control">
		<option disabled selected>Selectionner un client</option>
		<?php
			// On créé la requête
			$reqListeClient = "SELECT * FROM clients WHERE type=$type";
			 
			// on envoie la requête
			$resListeClient = $conn->query($reqListeClient);
			 
			// on va scanner tous les tuples un par un
			while ($dataListeClient = mysqli_fetch_array($resListeClient)) 
			{
			    // on affiche les résultats
			    if ($type == 1) 
			    {
			    	echo "<option value=\"" . $dataListeClient['id'] . "\">" . $dataListeClient['entreprise'] . "</option>";
			    }
				elseif ($type == 2)
				{
			    	echo "<option value=\"" . $dataListeClient['id'] . "\">" . clientGenre("c", $dataListeClient['id']) . $dataListeClient['nom'] . " " . $dataListeClient['prenom'] . "</option>";
				}
			}
		?>
		</select>
	<?php
}

function ListeProduitsRef($id) 
{
	global $conn;

	if ($id != "") 
	{
		$reqListeProduitsRef = "SELECT * FROM produits WHERE desactiver='0'";
		$resListeProduitsRef = $conn->query($reqListeProduitsRef);

		while ($dataListeProduitsRef = mysqli_fetch_array($resListeProduitsRef)) 
		{
			$produit = $dataListeProduitsRef['ref'];

			$reqListeProduitsFacture = "SELECT * FROM prestationproduit WHERE produit=$produit && facture=$id";
			$resListeProduitsFacture = $conn->query($reqListeProduitsFacture) or die();
			 
			if ( $resListeProduitsFacture->num_rows > 0 )
			{
			    //On affiche rien
			}
			else
			{
			    echo "<option value=\"" . $dataListeProduitsRef['ref'] . "\">" . ref($dataListeProduitsRef['ref']) . "  - " . $dataListeProduitsRef['designation'] . "</option>";
			}
		}
	}
	else
	{
		$reqListeProduitsRef = "SELECT * FROM produits WHERE desactiver='0'";
		$resListeProduitsRef = $conn->query($reqListeProduitsRef);

		while ($dataListeProduitsRef = mysqli_fetch_array($resListeProduitsRef)) 
		{
		    echo "<option value=\"" . $dataListeProduitsRef['ref'] . "\">" . ref($dataListeProduitsRef['ref']) . "  - " . $dataListeProduitsRef['designation'] . "</option>";
		}
	}
}

function prestationInfo($nomColonne, $id) 
{
	global $conn;

    // On créé la requête
	$reqPrestationInfo = "SELECT $nomColonne FROM prestation WHERE id=$id LIMIT 1";
	 
	// on envoie la requête
	$resPrestationInfo = $conn->query($reqPrestationInfo);
	 
	// on va scanner tous les tuples un par un
	$dataPrestationInfo = mysqli_fetch_array($resPrestationInfo);

    return $dataPrestationInfo[$nomColonne];
}

function totalPrixFacture($id) 
{
	global $conn;

	$somme = 0;

	$reqTotalPrixFacture = "SELECT * FROM prestationproduit JOIN produits ON prestationproduit.produit = produits.ref WHERE facture=$id";
	$resTotalPrixFacture = $conn->query($reqTotalPrixFacture);

	while ($dataTotalPrixFacture = mysqli_fetch_array($resTotalPrixFacture)) 
	{
		$somme = $somme + ($dataTotalPrixFacture['prixvente'] * $dataTotalPrixFacture['produitqte']);
	}

    return $somme;
}

function fichierModeleNom($id)
{
	global $conn;

	$reqFichierModelNom = "SELECT * FROM modelesFactures WHERE id='$id'";
	 
	$resFichierModelNom = $conn->query($reqFichierModelNom);
	 
	$dataFichierModelNom = mysqli_fetch_array($resFichierModelNom);
	
	return $dataFichierModelNom['fichier'];
}

function documentNumerotation($type, $idPrestation, $note)
{
	// 1 - facture
	// 2 - devis
	global $conn;

	$annee = date('Y');
	$date = date('Y-m-d');

	$reqDocumentNumerotation = "SELECT * FROM document WHERE type='$type' && annee='$annee' ORDER BY numero DESC LIMIT 1";
	 
	// on envoie la requête
	$resDocumentNumerotation = $conn->query($reqDocumentNumerotation) or die();
	 
	// Si on a des lignes...
	if ( $resDocumentNumerotation->num_rows > 0 )
	{
		$resDocumentNumerotation = $conn->query($reqDocumentNumerotation);
		$dataDocumentNumerotation = mysqli_fetch_array($resDocumentNumerotation);

		// echo $dataDocumentNumerotation['numero'] . "<br>";
		$dernierNumero = $dataDocumentNumerotation['numero'];
		$numeroDoc = $dernierNumero + 1;
		// echo $numeroDoc;
	}
	else
	{
		$numeroDoc = 1;
	}



	$reqInsertDocInfo = "INSERT INTO document(idprestation, type, annee, numero, dateedition, note) VALUES ('$idPrestation', '$type', '$annee', '$numeroDoc', '$date', '$note')";

	$resInsertDocInfo = $conn->query($reqInsertDocInfo);
	
	return $annee . "-" . $numeroDoc;
}

function documentNumerotationAffichage($id)
{
	// 1 - facture
	// 2 - devis
	global $conn;

	$reqDocumentNumerotationAffichage = "SELECT * FROM document WHERE id='$id'";

	$resDocumentNumerotationAffichage = $conn->query($reqDocumentNumerotationAffichage);
	$dataDocumentNumerotationAffichage = mysqli_fetch_array($resDocumentNumerotationAffichage);

	$dernierNumero = $dataDocumentNumerotationAffichage['numero'];

	if ($dataDocumentNumerotationAffichage['type'] == 1) 
	{
		$type = "F";
	}
	elseif($dataDocumentNumerotationAffichage['type'] == 2) 
	{
		$type = "D";
	}
	else
	{
		$type = "ERREUR";
	}

	$annee = $dataDocumentNumerotationAffichage['annee'];
	$numero = $dataDocumentNumerotationAffichage['numero'];

	$retour = $type . "-" . $annee . "-" . $numero;
	
	return $retour;
}

function verifFacture($id)
{
	// 1 - facture
	// 2 - devis
	global $conn;

	$reqVerifFacture = "SELECT * FROM prestation WHERE id='$id'";

	$resVerifFacture = $conn->query($reqVerifFacture);
	$dataVerifFacture = mysqli_fetch_array($resVerifFacture);

	if ($dataVerifFacture['moyenpaiement'] != "") 
	{
		$moyenpaiement = 1;
	}
	else
	{
		$moyenpaiement = 0;
	}

	if ($dataVerifFacture['dateFacturation'] != "" && $dataVerifFacture['dateFacturation'] != "0000-00-00") 
	{
		$dateFacturation = 1;
	}
	else
	{
		$dateFacturation = 0;
	}

	if ($dataVerifFacture['datelivraison'] != "" && $dataVerifFacture['datelivraison'] != "0000-00-00") 
	{
		$datelivraison = 1;
	}
	else
	{
		$datelivraison = 0;
	}

	if ($moyenpaiement == 0 || $dateFacturation == 0 || $datelivraison == 0) 
	{
		$ok = 0;
	}
	else
	{
		$ok = 1;
	}
	
	$out = new \stdClass();
	$out->moyenpaiement = $moyenpaiement;
	$out->dateFacturation = $dateFacturation;
	$out->datelivraison = $datelivraison;
	$out->ok = $ok;

	return $out;
}

function nbreClients()
{
	global $conn;

	$reqNbreClients = "SELECT * FROM clients";
	 
	$resNbreClients = $conn->query($reqNbreClients) or die();
	 
	return $resNbreClients->num_rows;
	// return "10";
}

function nbrePrestations($debut, $fin)
{
	global $conn;

	if ($debut != "" && $fin != "") 
	{
		$reqNbrePrestations = "SELECT * FROM prestation WHERE (dateFacturation >= '$debut' && dateFacturation <= '$fin')";

	}
	else
	{
		$reqNbrePrestations = "SELECT * FROM prestation";
	}
	 
	$resNbrePrestations = $conn->query($reqNbrePrestations) or die();
	 
	return $resNbrePrestations->num_rows;
	// return "10";
}

function nbrePrestationsMoisActuel()
{
	global $conn;

	$numMois = date('m');

	$reqNbrePrestationsCeMois = "SELECT * FROM prestation WHERE extract(MONTH from dateFacturation) = '$numMois'";
	 
	$resNbrePrestationsCeMois = $conn->query($reqNbrePrestationsCeMois) or die();
	 
	return $resNbrePrestationsCeMois->num_rows;
	// return "10";
}

function prestationCloture($id)
{
 // 	--------------------------------------------------------------------------------------------------------------------------------------------- PAS OK
	global $conn;

    // On créé la requête
	$reqPrestationCloture = "UPDATE prestation SET cloture='1', datecloture=NOW() WHERE id=$id";
	 
	// on envoie la requête
	$resPrestationCloture = $conn->query($reqPrestationCloture);

	$reqPrestationClotureProduitDefSelect = "SELECT *, prestationproduit.id as ppID FROM prestationproduit JOIN prestation ON prestationproduit.facture = prestation.id JOIN produits ON prestationproduit.produit = produits.ref WHERE facture=$id";

	$resPrestationClotureProduitDefSelect = $conn->query($reqPrestationClotureProduitDefSelect);

	while ($dataPrestationClotureProduitDefSelect = mysqli_fetch_array($resPrestationClotureProduitDefSelect))
	{
		if($dataPrestationClotureProduitDefSelect['remise'] != "")
		{
	    	$prix = ($dataPrestationClotureProduitDefSelect['prixvente'] * (1 - $dataPrestationClotureProduitDefSelect['remise'] / 100)) - $dataPrestationClotureProduitDefSelect['prixachat'];
		}
		else
		{
	    	$prix = $dataPrestationClotureProduitDefSelect['prixvente'] - $dataPrestationClotureProduitDefSelect['prixachat'];
		}

	    $id2 = $dataPrestationClotureProduitDefSelect['ppID'];
	    // echo $id2 . " -> " . $prix . "<br>";
    
	    // On créé la requête
		$reqPrestationClotureProduitDef = "UPDATE prestationproduit SET prixfinalunitaire='$prix' WHERE id='$id2'";

		// echo $reqPrestationClotureProduitDef . "<br>";
		 
		// on envoie la requête
		$resPrestationClotureProduitDef = $conn->query($reqPrestationClotureProduitDef);

	}
}

function calculeChiffreAffaire($offset, $debut, $fin, $type)
{
	global $conn;
	
	$somme = 0;

	if (isset($offset) && !empty($offset)) 
	{
		$numMois = date('m');
		$numMois = $numMois - $offset;
		$reqCalculeCA = "SELECT * FROM prestationproduit JOIN produits ON prestationproduit.produit = produits.ref JOIN prestation ON prestationproduit.facture = prestation.id WHERE extract(MONTH from dateFacturation) = '$numMois' && cloture = 1";
	} 
	elseif (isset($debut) && !empty($debut) && isset($fin) && !empty($fin)) 
	{
		$reqCalculeCA = "SELECT * , typeactivite.id as activiteID FROM prestationproduit JOIN produits ON prestationproduit.produit = produits.ref JOIN prestation ON prestationproduit.facture = prestation.id JOIN typeactivitedesc ON produits.categorie = typeactivitedesc.iddesc JOIN typeactivite ON typeactivitedesc.idtype = typeactivite.id WHERE (dateFacturation >= '$debut' && dateFacturation <= '$fin') && cloture = 1";
	}
	else 
	{
		$numMois = date('m');
		$reqCalculeCA = "SELECT * FROM prestationproduit JOIN produits ON prestationproduit.produit = produits.ref JOIN prestation ON prestationproduit.facture = prestation.id WHERE extract(MONTH from dateFacturation) = '$numMois' && cloture = 1";
	}
	


	$resCalculeCA = $conn->query($reqCalculeCA);

	while ($dataCalculeCA = mysqli_fetch_array($resCalculeCA)) 
	{
		if (isset($type) && !empty($type)) 
		{
			if ($dataCalculeCA["activiteID"] == $type) 
			{
				$somme = $somme + ($dataCalculeCA['prixfinalunitaire'] * $dataCalculeCA['produitqte']);
			}
		}
		else
		{
			$somme = $somme + ($dataCalculeCA['prixfinalunitaire'] * $dataCalculeCA['produitqte']);
		}
	}

    return $somme;
}

function documentInfo($nomColonne, $ref) 
{
	global $conn;

    // On créé la requête
	$reqDocumentInfo = "SELECT $nomColonne FROM document WHERE id=$ref LIMIT 1";
	 
	// on envoie la requête
	$resDocumentInfo = $conn->query($reqDocumentInfo);
	 
	// on va scanner tous les tuples un par un
	$dataDocumentInfo = mysqli_fetch_array($resDocumentInfo);

    return $dataDocumentInfo[$nomColonne];
}

function documentIcon($id)
{
	global $conn;
	// On créé la requête
	$reqListeDocumentsCount = "SELECT * FROM document JOIN prestation ON document.idprestation = prestation.id WHERE client = '$id'";
	
	// on envoie la requête
	$resListeDocumentsCount = $conn->query($reqListeDocumentsCount) or die();
	 
	// Si on a des lignes...
	if ( $resListeDocumentsCount->num_rows > 0 )
	{
		$retour = 1;
	}
	else
	{
		$retour = 0;
	}
	return $retour;
}

function prestationIcon($id)
{
	global $conn;
	// On créé la requête
	$reqListePrestationCount = "SELECT * FROM prestation WHERE client = '$id'";
	
	// on envoie la requête
	$resListePrestationCount = $conn->query($reqListePrestationCount) or die();
	 
	// Si on a des lignes...
	if ( $resListePrestationCount->num_rows > 0 )
	{
		$retour = 1;
	}
	else
	{
		$retour = 0;
	}
	return $retour;
}

function documentType($id) 
{
	global $conn;
	$nomColonne = "type";

    // On créé la requête
	$reqDocumentType = "SELECT $nomColonne FROM document WHERE id=$id LIMIT 1";
	 
	// on envoie la requête
	$resDocumentType = $conn->query($reqDocumentType);
	 
	// on va scanner tous les tuples un par un
	$dataDocumentType = mysqli_fetch_array($resDocumentType);

    return $dataDocumentType[$nomColonne];
}

function emailVariableRenplace($content, $idPrestation, $idDocument)
{
	$search  = array(
		'{documentNumero}',
		'{documentDateEdition}',
		'{prestationOuverture}',
		'{prestationFacturation}',
		'{prestationLivraison}',
		'{prestationCloture}',
		'{prestationCommentaire}',
		'{prestationMoyenPaiement}',
		'{clientNom}',
		'{clientEmail}',
		'{clientAdresse}',
		'{clientCP}',
		'{clientVille}',
		'{clientPays}',
		'{clientTelFixe}',
		'{clientTelPortable}',
		'{entrepriseSiret}',
		'{entrepriseNomEntreprise}',
		'{entrepriseNom}',
		'{entreprisePrenom}',
		'{entrepriseEmail}',
		'{entrepriseAdresse}',
		'{entrepriseCP}',
		'{entrepriseVille}',
		'{entreprisePays}',
		'{entrepriseTelFixe}',
		'{entrepriseTelPortable}'
	);
	$replace  = array(
		documentNumerotationAffichage($idDocument),
		strftime('%d/%m/%g', strtotime(documentInfo("dateEdition", $idDocument))),
		strftime('%d/%m/%g', strtotime(prestationInfo("dateouverture", $idPrestation))),
		strftime('%d/%m/%g', strtotime(prestationInfo("dateFacturation", $idPrestation))),
		strftime('%d/%m/%g', strtotime(prestationInfo("dateLivraison", $idPrestation))),
		strftime('%d/%m/%g', strtotime(prestationInfo("datecloture", $idPrestation))),
		prestationInfo("commentaire", $idPrestation),
		prestationInfo("moyenpaiement", $idPrestation),
		clientNom(prestationInfo("client", $idPrestation)),
		clientInfo("email", prestationInfo("client", $idPrestation)),
		clientInfo("adresse", prestationInfo("client", $idPrestation)),
		clientInfo("cp", prestationInfo("client", $idPrestation)),
		clientInfo("ville", prestationInfo("client", $idPrestation)),
		clientInfo("pays", prestationInfo("client", $idPrestation)),
		clientInfo("tel_fixe", prestationInfo("client", $idPrestation)),
		clientInfo("tel_portable", prestationInfo("client", $idPrestation)),
		entrepriseInfo("siret"),
		entrepriseInfo("nomentreprise"),
		entrepriseInfo("nom"),
		entrepriseInfo("prenom"),
		entrepriseInfo("email"),
		entrepriseInfo("adresseSiege"),
		entrepriseInfo("cp"),
		entrepriseInfo("ville"),
		entrepriseInfo("pays"),
		entrepriseInfo("telF"),
		entrepriseInfo("telP")
	);
	
	return str_replace($search, $replace, $content);
}

function envoiMail($destinataire, $sujet, $contenu, $fichierJoint)
{

	global $racine;

	require ($racine . "/include/PHPMailer/PHPMailerAutoload.php");

	$mail = new PHPmailer();

	$mail->SMTPDebug = 0;
	$mail->CharSet = "utf-8";
	$mail->Timeout =  10;
	$mail->isSMTP(); 																					// Paramétrer le Mailer pour utiliser SMTP 
	$mail->Host = parametre("10", "texte1"); 															// Spécifier le serveur SMTP
	$mail->SMTPAuth = true; 																			// Activer authentication SMTP
	$mail->Username = parametre("11", "texte1"); 														// Votre adresse email d'envoi
	$mail->Password = parametre("12", "texte1"); 														// Le mot de passe de cette adresse email
	$mail->SMTPSecure = parametre("13", "texte1"); 
	$mail->Port = parametre("14", "texte1");

	$mail->setFrom(parametre("15", "texte1"), parametre("16", "texte1")); 								// Personnaliser l'envoyeur
	if ($destinataire == "test") 
	{
		$mail->addAddress(entrepriseInfo("email"), entrepriseInfo("nom") . " " . entrepriseInfo("prenom")); 										// Ajouter le destinataire
	}
	else
	{
		$mail->addAddress(clientInfo('email', $destinataire) , clientNom($destinataire)); 										// Ajouter le destinataire
	}
	$mail->addReplyTo(entrepriseInfo("email"), entrepriseInfo("nom") . " " . entrepriseInfo("prenom"));	// Ajouter le destinataire

	if (isset($fichierJoint) && !empty($fichierJoint)) 
	{
		$mail->addAttachment($racine . '/include/documents/' . documentNumerotationAffichage($fichierJoint) . ".pdf"); 				// Ajouter un fichier
	}

	$mail->isHTML(true); 																				// Paramétrer le format des emails en HTML ou non

	$mail->Subject = $sujet;
	$mail->Body = $contenu;
	$mail->AltBody = 'Votre lecteur de mail ne prend pas en charge le HTML, utilisez une application compatible pour lire ce mail.';

	if(!$mail->send()) 
	{
	   return 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else 
	{
	   return "ok";
	}
}

function menu()
{
	?>
		<nav class="navbar navbar-expand-lg navbar-light">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navBar">
		        <a class="navbar-brand" href="/"><?php echo entrepriseInfo('nomentreprise'); ?></a>
		        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		            <li class="nav-item active">
		                <a class="nav-link" href="/">Accueil</a>
		            </li>
		            <li class="nav-item dropdown active">
		                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                    Produits
		                </a>
		                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		                    <a class="dropdown-item" href="/produit/liste.php">Liste des produits</a>
		                	<div class="dropdown-divider"></div>
		                    <a class="dropdown-item" href="/produit/nouveau.php">Nouveau produits</a>
		                </div>
		            </li>
		            <li class="nav-item dropdown active">
		                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                    Clients
		                </a>
		                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		                    <a class="dropdown-item" href="/client/liste.php">Liste des clients</a>
		                	<div class="dropdown-divider"></div>
		                    <a class="dropdown-item" href="/client/nouveau.php">Nouveau client</a>
		                </div>
		            </li>
		            <li class="nav-item dropdown active">
		                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                    Prestations
		                </a>
		                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		                    <a class="dropdown-item" href="/prestation/liste.php">Liste des prestations</a>
		                	<div class="dropdown-divider"></div>
		                    <a class="dropdown-item" href="/prestation/nouveau.php">Nouvelle prestation</a>
		                </div>
		            </li>
		            <li class="nav-item active">
		                <a class="nav-link" href="/documents/liste.php">Documents</a>
		            </li>
		            <li class="nav-item active">
		                <a class="nav-link" href="/email/liste.php">Email</a>
		            </li>
		            <li class="nav-item active">
		                <a class="nav-link" href="/resume/">Résumé</a>
		            </li>
		        </ul>
		         <ul class="nav navbar-nav ml-auto">
		            <li class="nav-item dropdown active">
		                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                    Configuration
		                </a>
		                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		                    <a class="dropdown-item" href="/configuration/infoentreprise.php">Informations de l'entreprise</a>
		                    <a class="dropdown-item" href="/configuration/activite.php">Liste des activités</a>
		                    <a class="dropdown-item" href="/configuration/documents.php">Documents</a>
		                    <a class="dropdown-item" href="/configuration/email.php">Email de notifications</a>
		                    <a class="dropdown-item" href="/configuration/mot-de-passe.php">Changer le mot de passe</a>
		                    <a class="dropdown-item" href="/configuration/paiement.php">Moyens de paiements</a>
		                    <a class="dropdown-item" href="/configuration/theme.php">Thème</a>
		                </div>
		            </li>
		            <li class="nav-item active">
		                <a class="nav-link" href="/deconnexion.php">Déconnexion<!-- <i class="fas fa-sign-out-alt"> --></i></a>
		            </li>
			    </ul>
		    </div>
		</nav>
	<?php
}

function menuInstall()
{
	?>
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FF9B42;">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarInstall" aria-controls="		navBarInstall" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navBarInstall">
		        <a class="navbar-brand" href="#">Gestion M.E</a>
		        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		            <li class="nav-item active">
		                <a class="nav-link" href="#">Installation</a>
		            </li>
		        </ul>
		    </div>
		</nav>
	<?php
}

function menuConnexion()
{
	?>
		<nav class="navbar navbar-expand-lg navbar-light">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarConnexion" aria-controls="navBarConnexion" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		    <div class="collapse navbar-collapse" id="navBarConnexion">
		        <a class="navbar-brand" href="#"><?php echo entrepriseInfo('nomentreprise'); ?></a>
		        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		            <li class="nav-item active">
		                <a class="nav-link" href="#">Connexion</a>
		            </li>
		        </ul>
		    </div>
		</nav>
	<?php
}