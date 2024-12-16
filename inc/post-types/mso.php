<?php
/***
* MSO Post Type
***/

if(! class_exists('Progressive_MSO_Post_Type')):
class Progressive_MSO_Post_Type{

	function __construct(){
		// Adds the mso post type and taxonomies
		add_action('init',array(&$this,'mso_init'),0);
		// Thumbnail support for mso posts
		add_theme_support('post-thumbnails',array('mso'));
	}

	function mso_init(){
		/**
		 * Enable the mso_init custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$labels = array(
			'name'					=> __('MSO','Progressive'),
			'singular_name'		=> __('MSO Name','Progressive'),
			'add_new'				=> __('Add New','Progressive'),
			'add_new_item'			=> __('Add New MSO','Progressive'),
			'edit_item'			=> __('Edit MSO','Progressive'),
			'new_item'				=> __('Add New MSO','Progressive'),
			'view_item'			=> __('View MSO','Progressive'),
			'search_items'			=> __('Search MSO','Progressive'),
			'not_found'			=> __('No mso items found','Progressive'),
			'not_found_in_trash'	=> __('No mso found in trash','Progressive')
		);
		
		$args = array(
		    'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => 'dashicons-portfolio',
			'rewrite' => true,			
			'map_meta_cap' => true,
			'hierarchical' => false,
			'menu_position' => 4,
			'supports' => array('title','thumbnail','editor','page-attributes')
		); 
		
		$args = apply_filters('Progressive_mso_args',$args);
		register_post_type('mso',$args);
	}
}
new Progressive_MSO_Post_Type;
endif;