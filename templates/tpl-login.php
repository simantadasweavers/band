<?php /*Template Name: Login */
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
                    	<label for="username">Username</label>
                    	<input type="text" class="form-control" id="username" placeholder="Enter Username">
                	</div>
            	</div>

            	<div class="form-row">
                	<div class="form-group col-md-12">
                    	<label for="password">Password</label>
                    	<input type="password" class="form-control" id="password" placeholder="Enter Password">
                	</div>
            	</div>
          	 
            	<button type="button" id="submit_btn" class="btn btn-primary">Login</button>
        	</form>

    	</div>
    	<div class="col-2"></div>
	</div>


	<script>
    	jQuery(document).ready(function(){
        	jQuery('#submit_btn').click(function(){
                	var username = jQuery('#username').val();
                	var password = jQuery('#password').val();

                	console.log(username, password);

                	jQuery.ajax({
                    	type: "POST",
                    	url: ajaxurl,
                    	data: {
                        	action: 'form_login',
                        	username: username,
                        	password: password,
                    	},
                    	success: function (response) {
                        	console.log(response);
                    	},

                	});


            	});
     	 
    	});
	</script>




<?php get_footer(); ?>