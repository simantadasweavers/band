<?php
/*****************************************
* Weaver's Web Functions & Definitions *
*****************************************/
$functions_path = get_template_directory().'/functions/';
$post_type_path = get_template_directory().'/inc/post-types/';
$theme_function_path = get_template_directory().'/inc/theme-functions/';
/*--------------------------------------*/
/* Multipost Thumbnail Functions
/*--------------------------------------*/
require_once($functions_path.'multipost-thumbnail/multi-post-thumbnails.php');
if(class_exists('MultiPostThumbnails')){
	$types = array('page');
	foreach($types as $type){
		new MultiPostThumbnails(array(
			'label' => 'Top Banner Image',
			'id' => 'top-banner-image',
			'post_type' => $type
			));
		}		
	}
add_image_size('top-banner-size-image', 1920, 700,true);
/*--------------------------------------*/
/* Optional Panel Helper Functions
/*--------------------------------------*/
// require_once($functions_path.'admin-functions.php');
// require_once($functions_path.'admin-interface.php');
// require_once($functions_path.'theme-options.php');
function weaversweb_ftn_wp_enqueue_scripts(){
    if(!is_admin()){
        wp_enqueue_script('jquery');
        if(is_singular()and get_site_option('thread_comments')){
            wp_print_scripts('comment-reply');
			}
		}
	}
add_action('wp_enqueue_scripts','weaversweb_ftn_wp_enqueue_scripts');
function weaversweb_ftn_get_option($name){
    $options = get_option('weaversweb_ftn_options');
    if(isset($options[$name]))
        return $options[$name];
	}
function weaversweb_ftn_update_option($name, $value){
    $options = get_option('weaversweb_ftn_options');
    $options[$name] = $value;
    return update_option('weaversweb_ftn_options', $options);
}
function weaversweb_ftn_delete_option($name){
    $options = get_option('weaversweb_ftn_options');
    unset($options[$name]);
    return update_option('weaversweb_ftn_options', $options);
}
function get_theme_value($field){
	$field1 = weaversweb_ftn_get_option($field);
	if(!empty($field1)){
		$field_val = $field1;
		return	$field_val;
		}
	}
/*--------------------------------------*/
/* Post Type Helper Functions
/*--------------------------------------*/
// require_once($post_type_path.'clients.php');
// require_once($post_type_path.'mso.php');
// require_once($post_type_path.'services.php');
/*--------------------------------------*/
/* Theme Helper Functions
/*--------------------------------------*/
if(!function_exists('weaversweb_theme_setup')):
	function weaversweb_theme_setup(){
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		register_nav_menus(array(
			'primary' => __('Primary Menu','weaversweb'),
			'secondary'  => __('Secondary Menu','weaversweb'),
			));
		add_theme_support('html5',array('search-form','comment-form','comment-list','gallery','caption'));
		}
	endif;
add_action('after_setup_theme','weaversweb_theme_setup');
function weaversweb_widgets_init(){
	register_sidebar(array(
		'name'          => __('Widget Area','weaversweb'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.','weaversweb'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
	}
add_action('widgets_init','weaversweb_widgets_init');
function weaversweb_scripts() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '5.3.1');
    
    // Enqueue Bootstrap Icons
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css', array(), '1.10.5');
    
    // Enqueue Theme Main CSS
    wp_enqueue_style('ohs-main', get_template_directory_uri() . '/css/theme.css', array());

    // Enqueue jQuery (already included with WordPress)
    wp_enqueue_script('jquery');

    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.1', true);

    // Enqueue Theme JS
    wp_enqueue_script('ohs-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20240101', true);
}

add_action('wp_enqueue_scripts', 'weaversweb_scripts');



add_filter('comments_template','legacy_comments');
function legacy_comments($file){
	if(!function_exists('wp_list_comments'))	$file = TEMPLATEPATH .'/legacy.comments.php';
	return $file;
}


/** authentication */
add_action('wp_ajax_form_register', 'register_user');
add_action('wp_ajax_nopriv_form_register', 'register_user');
function register_user()
{
    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $password = $_POST['password'];    
    $confirm_password = $_POST['confpassword'];    

   try{
	if($password == $confirm_password){
   	 $user_id = wp_create_user($username, $password, $email);
   	 if ( is_wp_error( $user_id ) ) {
   		 echo 'Error: ' . $user_id->get_error_message();
   		}
   		return wp_send_json_success(array('data'=>"Account registered successfully!"));
   		wp_die();
    }else{
   	 return wp_send_json_success(array('data'=>"Passwords not match!"));
    }
   }catch(Exception $e){
	return wp_send_json_error(array('data'=>'error'));
   }
}


add_action('wp_ajax_form_login', 'login_user');
add_action('wp_ajax_nopriv_form_login', 'login_user');
function login_user()
{
    print_r($_POST);

    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);

    $user = wp_signon(
   	 array(
   		 'user_login' => $username,
   		 'user_password' => $password,
   		 'remember' => true // You can enable remember me option if needed
   	 )
    );

    if (is_wp_error($user)) {
   	 echo $user->get_error_message();
    } else {
   	 // Login successful
   	 echo 'Login successful!';
    }
	wp_die();
}

/** end of authentication */

try{
	add_role(
		'clients', //  System name of the role.
		__('Clients'), // Display name of the role.
		array(
			'read' => true,
			'delete_posts'  => false,
			'delete_published_posts' => false,
			'edit_posts'   => false,
			'publish_posts' => false,
			'edit_published_posts'   => false,
			'upload_files'  => false,
			'moderate_comments'=> false, // This user will be able to moderate the comments.
		)
	);


	add_role(
		'suppliers',
		__('Suppliers'), 
		array(
			'read' => true,
		'delete_posts'  => true,
		'delete_published_posts' => true,
		'edit_posts'   => true,
		'publish_posts' => true,
		'edit_published_posts'   => true,
		'upload_files'  => true,
		'moderate_comments'=> false,
		)
	);


	add_role(
		'service providers', //  System name of the role.
		__('Service Providers'), // Display name of the role.
		array(
			'read' => true,
			'delete_posts'  => true,
			'delete_published_posts' => true,
			'edit_posts'   => true,
			'publish_posts' => true,
			'edit_published_posts'   => true,
			'upload_files'  => true,
			'moderate_comments'=> false,
		)
	);
	
}catch(Exception $e){
	echo $e->getMessage();
}