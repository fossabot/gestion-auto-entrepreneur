<!DOCTYPE html>
<html>
<head>
<head>
	<?php
		//CONF
		$racine = "..";
		require($racine . "/include/conf/conf.php");

		//NOM SITE
		$ns_page = "Changer de mot de passe";

		require($racine . $p_php . "head.php");
	?>
</head>
<body>
	<header>
		<?php echo menu(); ?>
	</header>
	<main>
		<h1>Changer de mot de passe</h1>

		<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) 
		{
			if ($_GET['msg'] == "ok") 
			{
				?>
					<div class="alert alert-success text-center w-25 mx-auto mt-3" role="alert">
					  Succes !
					</div>
				<?php
			}
			else
			{
				?>
					<div class="alert alert-danger text-center w-25 mx-auto mt-3" role="alert">
					  <?php echo $_GET['msg']; ?>
					</div>
				<?php
			}
		}
		?>

		<form method="POST" action="<?php echo $racine . $p_php . "passwordEdit.php"; ?>">
			<input type="text" hidden class="form-control" id="inputSIRET" name="inputSIRET" readonly value="<?php echo entrepriseInfo('siret'); ?>">
			<div class="form-group">
				<label for="inputMdpActuel"><span class="warning">*</span>Mot de passe actuel</label>
				<input type="password" class="form-control" id="inputMdpActuel" name="inputMdpActuel">
			</div>
			<div class="form-row">
				<div class="form-group col-md-6" id="particulierNom">
					<label for="inputMdp1"><span class="warning">*</span>Nouveau mot de passe</label>
					<input type="password" class="form-control" id="inputMdp1" name="inputMdp1">
				</div>
				<div class="form-group col-md-6" id="particulierPrenom">
					<label for="inputMdp2"><span class="warning">*</span>Nouveau mot de passe</label>
					<input type="password" class="form-control" id="inputMdp2" name="inputMdp2">
				</div>
			</div>
			<div class="" id="passwordStrength"></div>
			<div class="text-center">
				<button type="submit" class="btn btnValider">Valider</button>
			</div>
		</form>

	</main>
	<footer>
		<?php require($racine . $p_php . "footer.php"); ?>
	</footer>
</body>
</html>

<script>
/**
 * @author Paul
 */

//  $(document).ready(function() {

//     $('#inputMdp1, #inputMdp2').on('keyup', function(e) {

//     	if($('#inputMdp1').val() != '' && $('#inputMdp2').val() != '' && $('#inputMdp1').val() != $('#inputMdp2').val())
//     	{
//     		$('#passwordStrength').removeClass().addClass('alert alert-error').html('Passwords do not match!');

//         	return false;
//     	}

//         // Must have capital letter, numbers and lowercase letters
//         var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

//         // Must have either capitals and lowercase letters or lowercase and numbers
//         var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

//         // Must be at least 6 characters long
//         var okRegex = new RegExp("(?=.{6,}).*", "g");

//         if (okRegex.test($(this).val()) === false) {
//             // If ok regex doesn't match the password
//         	$('#passwordStrength').removeClass().addClass('alert alert-error').html('Le mot de passe doit comporter 6 caractères au moins.');

//         } else if (strongRegex.test($(this).val())) {
//             // If reg ex matches strong password
//             $('#passwordStrength').removeClass().addClass('alert alert-success').html('Good Password!');
//         } else if (mediumRegex.test($(this).val())) {
//             // If medium password matches the reg ex
//             $('#passwordStrength').removeClass().addClass('alert alert-info').html('Make your password stronger with more capital letters, more numbers and special characters!');
//         } else {
//             // If password is ok
//             $('#passwordStrength').removeClass().addClass('alert alert-error').html('Weak Password, try using numbers and capital letters.');
//         }
        
//         return true;
//     });

// });
</script>