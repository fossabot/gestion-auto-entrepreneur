<!-- HTML -->
	<div class="footer">
		<p>Application par <a href="http://jonathan-brea.fr" target="_blank">Jonathan BREA</a> - <a href="#" target="_blank">Documentation et support de l'application</a> - <a>Version: 20W18dev</a></p>
	</div>

<!-- SCRIPT -->
	<!-- Bootstrap -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- AJAX -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- CACHER ALERTES -->
		<script>
			setTimeout(cacherInfo, 3000);

			function cacherInfo() 
			{
				$('#info').hide();
			}
		</script>

		<script src="<?php echo $racine; ?>/include/ckeditor/ckeditor.js"></script>

		<script>
			CKEDITOR.replace('editor1', {
				width: '90%',
				height: 300
				
			});
			CKEDITOR.replace('editor2', {
				width: '90%',
				height: 300
				
			});
		</script>
