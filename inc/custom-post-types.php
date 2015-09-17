<?php

/**
 * Register custom post types
 *
 */
function blankout_custom_types() {
	register_post_type('carousel',
		array(
			'labels'              => array(
				'name'               => __('Slides', 'blankout'),
				'singular_name'      => __('Slide', 'blankout'),
				'all_items'          => __('All Slides', 'blankout'),
				'add_new'            => __('Add New', 'blankout'),
				'add_new_item'       => __('Add New Slide', 'blankout'),
				'edit'               => __('Edit', 'blankout'),
				'edit_item'          => __('Edit Slide', 'blankout'),
				'new_item'           => __('New Slide', 'blankout'),
				'view_item'          => __('View Slide', 'blankout'),
				'search_items'       => __('Search Slides', 'blankout'),
				'not_found'          => __('Nothing found in the Database.', 'blankout'),
				'not_found_in_trash' => __('Nothing found in Trash', 'blankout'),
				'parent_item_colon'  => ''
			),
			'description'         => __('Homepage Slides', 'blankout'),
			'public'              => FALSE,
			'publicly_queryable'  => TRUE,
			'exclude_from_search' => TRUE,
			'show_ui'             => TRUE,
			'query_var'           => FALSE,
			'menu_position'       => 8,
			'menu_icon'           => get_stylesheet_directory_uri() . '/img/custom-post-icon.png',
			//'rewrite'             => array('slug' => 'carousel', 'with_front' => FALSE),
			//'has_archive'         => 'carousel',
			'capability_type'     => 'post',
			'hierarchical'        => FALSE,
			'supports'            => array( 'title', 'editor', 'thumbnail' )
		)
	);
}

add_action('init', 'blankout_custom_types');

/* add_action( 'init', 'custom_taxonomy', 0 );

// create two taxonomies, genres and writers for the post type "book"
function custom_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Terms', 'taxonomy general name' ),
		'singular_name'     => _x( 'Term', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Terms' ),
		'all_items'         => __( 'All Terms' ),
		'parent_item'       => __( 'Parent Term' ),
		'parent_item_colon' => __( 'Parent Term:' ),
		'edit_item'         => __( 'Edit Term' ),
		'update_item'       => __( 'Update Term' ),
		'add_new_item'      => __( 'Add New Term' ),
		'new_item_name'     => __( 'New Term Name' ),
		'menu_name'         => __( 'Terms' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'term' ),
	);

	register_taxonomy( 'term', array( 'carousel' ), $args );
}*/
