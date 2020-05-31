<?php

/**
 * Twentynineteen-child Theme functions and definitions
 *
 * @author Daniel Rodrigues <https://github.com/danielrdesousa>
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package twentynineteen-child
 */

add_action( 'wp_enqueue_scripts', 'twentynineteen_parent_theme_enqueue_styles' );

/**
 * Enqueue styles.
 */
function twentynineteen_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'twentynineteen-style', get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'twentynineteen-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'twentynineteen-style' )
	);
}


add_action( 'wp_enqueue_scripts', 'twentynineteen_parent_theme_enqueue_scripts' );

/**
 * Enqueue scripts.
 */
function twentynineteen_parent_theme_enqueue_scripts() {
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery') );

	wp_localize_script( 'loadmore', 'breeds_loadmore_params', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'security' => wp_create_nonce( 'load_more_posts' ),
	) );

 	wp_enqueue_script( 'loadmore' );
}

/**
 * Register Custom Post Breeds
 */
require("post-types/breeds.php");


add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );
/**
 * Load More Breeds
 *
 * @uses AJAX in Plugins <https://codex.wordpress.org/AJAX_in_Plugins>
 *
 */
function load_more_posts(){
	check_ajax_referer('load_more_posts', 'security');

	$paged = $_POST['page'];
    $args = array(
        'post_type' => 'breeds',
        'posts_per_page' => 6,
        'order' => 'DESC',
		'orderby' => 'id',
		'paged' => $paged,
		'post_status' => 'publish'
	);

	$query = new WP_Query( $args );

    if ( $query->have_posts() ):
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part("template-parts/breed");
		endwhile;
		wp_reset_postdata();
	endif;

    wp_die();
}

add_shortcode( 'breeds_list', 'breeds_custom_post_listing_shortcode' );
/**
 * Edit labels comment form
 *
 * @uses add_shortcode <https://developer.wordpress.org/reference/functions/add_shortcode/>
 *
 */
function breeds_custom_post_listing_shortcode( $atts ) {
	ob_start();

	$args = array(
        'post_type' => 'breeds',
        'posts_per_page' => 6,
        'order' => 'DESC',
		'orderby' => 'id',
		'paged' => 1,
		'post_status' => 'publish'
	);

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        echo '<section id="breeds-listing">';
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part("template-parts/breed");
		endwhile;
		wp_reset_postdata();
		echo '</section>';

		if( $query->max_num_pages > 1 ){ echo '<button class="loadmore">Load More Breeds</button>'; }

	}else{
		echo '<div class="page-content"><p>It seems we can’t find what you’re looking for.</p></div>';
	}

	return ob_get_clean();
}



add_filter( 'comment_form_defaults','edit_labels_comment_form' );
/**
 * Edit labels comment form
 *
 * @uses comment_form_defaults <https://developer.wordpress.org/reference/hooks/comment_form_defaults/>
 *
 */
function edit_labels_comment_form($fields) {
	$fields['comment_notes_before'] = '';

	$fields['title_reply_before'] = 'Tell us about your experience with this breed';
	$fields['label_submit'] = 'Send Experience';

	return $fields;
}

add_filter( 'comment_form_default_fields','remove_fields_comment_form' );
/**
 * Order fields comment form
 *
 * @uses comment_form_fields <https://developer.wordpress.org/reference/hooks/comment_form_fields/>
 *
 */
function remove_fields_comment_form($fields){
	$fields['url'] = '';

	return $fields;
}

add_filter( 'comment_form_fields', 'edit_order_fields_comment_form_fields' );
/**
 * Order fields comment form
 *
 * @uses comment_form_fields <https://developer.wordpress.org/reference/hooks/comment_form_fields/>
 *
 */
function edit_order_fields_comment_form_fields( $fields ) {
	$comment_field = $fields['comment'];
	$cookies_field = $fields['cookies'];
	unset( $fields['comment'] );
	unset( $fields['cookies'] );
	$fields['comment'] = $comment_field;
	$fields['cookies'] = $cookies_field;

	return $fields;
}

add_filter( 'comment_form_defaults', 'edit_default_comment_notes_before' );
/**
 * Change the text output that appears before the comment form
 * Note: Logged in user will not see this text.
 *
 * @uses comment_notes_before <https://developer.wordpress.org/reference/functions/comment_form/>
 *
 */
function edit_default_comment_notes_before( $arg ) {
	$arg['comment_notes_before'] = "<p>Get a free custom avatar at <a href='http://www.gravatar.com' target='_blank' >Gravatar</a>.</p>";

	return $arg;
}
