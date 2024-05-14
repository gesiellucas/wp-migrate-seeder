<?php
/*
 * Plugin Name: LuaPress CPT
 * Description: Creates a custom post type for blog posts with a filterable category form.
 * Version: 1.1
 * Author: LuaPress
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PREFIX_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'LPCPT_SLUG', 'article_post');
define( 'LPCPT_TAXONOMIES', array(
    ['Território', 'Territórios'],
    ['Tema', 'Temas']
));


require plugin_dir_path( __FILE__ ) . 'includes/functions.php';
// require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
// require plugin_dir_path( __FILE__ ) . 'vendor/wp-seeder/seeder/src/SeederClass.php';


// use Seeder\SeederPost;

// $insert = new SeederPost(10);


// Register custom post type
add_action( 'init', 'lpcpt_create_article_post', 11 );

// Register all taxonomies 
add_action( 'init', 'lpcpt_create_taxonomy', 10 );

// Add custom page template for blog
add_action( 'plugin_loaded', 'lpcpt_custom_template' );

// Enqueue scripts and styles for blog page
add_action( 'wp_enqueue_scripts', 'lpcpt_scripts_styles' );




