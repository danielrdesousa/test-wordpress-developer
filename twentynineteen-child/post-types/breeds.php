<?php

/**
 * Register post type breeds
 */
if ( ! function_exists( 'breeds_custom_post_type' ) ) {
	function breeds_custom_post_type() {
		register_post_type('breeds', array(
			'labels'                => array(
				'name'                  => __('Breeds', 'breeds'),
				'singular_name'         => __('Breeds', 'breeds'),
				'all_items'             => __('All Breeds', 'breeds'),
				'archives'              => __('Breeds Archives', 'breeds'),
				'attributes'            => __('Breeds Attributes', 'breeds'),
				'insert_into_item'      => __('Insert into Breeds', 'breeds'),
				'uploaded_to_this_item' => __('Uploaded to this Breeds', 'breeds'),
				'featured_image'        => _x('Featured Image', 'breeds', 'breeds'),
				'set_featured_image'    => _x('Set featured image', 'breeds', 'breeds'),
				'remove_featured_image' => _x('Remove featured image', 'breeds', 'breeds'),
				'use_featured_image'    => _x('Use as featured image', 'breeds', 'breeds'),
				'filter_items_list'     => __('Filter Breeds list', 'breeds'),
				'items_list_navigation' => __('Breeds list navigation', 'breeds'),
				'items_list'            => __('Breeds list', 'breeds'),
				'new_item'              => __('New Breeds', 'breeds'),
				'add_new'               => __('Add New', 'breeds'),
				'add_new_item'          => __('Add New Breeds', 'breeds'),
				'edit_item'             => __('Edit Breeds', 'breeds'),
				'view_item'             => __('View Breeds', 'breeds'),
				'view_items'            => __('View Breeds', 'breeds'),
				'search_items'          => __('Search Breeds', 'breeds'),
				'not_found'             => __('No Breeds found', 'breeds'),
				'not_found_in_trash'    => __('No Breeds found in trash', 'breeds'),
				'parent_item_colon'     => __('Parent Breeds:', 'breeds'),
				'menu_name'             => __('Breeds', 'breeds'),
			),
			'public'                => true,
			'hierarchical'          => true,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail' ),
			'taxonomies' 			=> array( 'post_tag' ),
			'has_archive'           => true,
			'rewrite' 				=> array( 'slug' => 'breeds', 'with_front' => true ),
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-buddicons-activity',
			'show_in_rest'          => true,
			'rest_base'             => 'breeds',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		));
	}

	add_action('init', 'breeds_custom_post_type');
}
