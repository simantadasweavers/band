<?php /*Template Name: Register */
get_header();
get_sidebar('banner');
?>

<br>
<br>

<div class="row">
	<div class="col-2"></div>
	<div class="col-8">

		<form action="#" method="post">
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="inputEmail4">Email</label>
					<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" placeholder="Enter Password">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" placeholder="Enter Username">
				</div>
			</div>

			<button type="button" id="submit_btn" class="btn btn-primary">Register</button>
		</form>

	</div>
	<div class="col-2"></div>
</div>

<script>
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

	jQuery(document).ready(function () {
		jQuery('#submit_btn').click(function () {
			var email = jQuery('#inputEmail4').val();
			var username = jQuery('#username').val();
			var password = jQuery('#password').val();

			// register user via functions.php custom function    				 
			jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: 'form_register',
					useremail: email,
					username: username,
					password: password,
					confpassword: password,
				},
				success: function (response) {
					console.log(response);
				},
				error: function (response) {
					console.error(response);
				},
			});
		});
	});
</script>


<?php get_footer(); ?>