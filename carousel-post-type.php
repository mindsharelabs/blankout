<?php

function carousel_post() {
	// creating (registering) the custom type 
	register_post_type('carousel', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		array('labels'              => array(
			'name'               => __('Carousel Slides', 'blankout'), /* This is the Title of the Group */
			'singular_name'      => __('Slide', 'blankout'), /* This is the individual type */
			'all_items'          => __('All Slides', 'blankout'), /* the all items menu item */
			'add_new'            => __('Add New', 'blankout'), /* The add new menu item */
			'add_new_item'       => __('Add New Slide', 'blankout'), /* Add New Display Title */
			'edit'               => __('Edit', 'blankout'), /* Edit Dialog */
			'edit_item'          => __('Edit Slide', 'blankout'), /* Edit Display Title */
			'new_item'           => __('New Slide', 'blankout'), /* New Display Title */
			'view_item'          => __('View Slide', 'blankout'), /* View Display Title */
			'search_items'       => __('Search Slides', 'blankout'), /* Search Custom Type Title */
			'not_found'          => __('Nothing found in the Database.', 'blankout'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'blankout'), /* This displays if there is nothing in the trash */
			'parent_item_colon'  => ''
		), /* end of arrays */
			  'description'         => __('Home page carousel items', 'blankout'), /* Custom Type Description */
			  'public'              => TRUE,
			  'publicly_queryable'  => TRUE,
			  'exclude_from_search' => FALSE,
			  'show_ui'             => TRUE,
			  'query_var'           => TRUE,
			  'menu_position'       => 8, /* this is what order you want it to appear in on the left hand side menu */
			  'menu_icon'           => get_stylesheet_directory_uri().'/img/custom-post-icon.png', /* the icon for the custom post type menu */
			  'rewrite'             => array('slug' => 'carousel', 'with_front' => FALSE), /* you can specify its url slug */
			  'has_archive'         => 'carousel', /* you can rename the slug here */
			  'capability_type'     => 'post',
			  'hierarchical'        => FALSE,
			  /* the next one is important, it tells what's enabled in the post editor */
			  'supports'            => array('title', 'editor', 'thumbnail')
		) /* end of options */
	); /* end of register post type */
}

// adding the function to the Wordpress init
add_action('init', 'carousel_post');

?>
