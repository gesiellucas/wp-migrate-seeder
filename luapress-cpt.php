<?php
/*
 * Plugin Name: LuaPress CPT
 * Description: Creates a custom post type for blog posts with a filterable category form.
 * Version: 1.1
 * Author: LuaPress
 */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// // Testar
// require plugin_dir_path( __FILE__ ) . 'vendor/wp-migrate-seeder/luapress/helpers.php' ;
// require plugin_dir_path( __FILE__ ) . 'vendor/wp-migrate-seeder/luapress/seeder/SeederPost.php';
// new SeederPost(12);
// exit;

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require plugin_dir_path( __FILE__ ) . 'includes/functions.php';

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PREFIX_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'PREFIX_BASE_URL', plugin_dir_url( __FILE__ ) );

define( 'LPCPT_SLUG', 'article_post');
define( 'LPCPT_VERSION', '0.1.4');

define( 'LPCPT_TAXONOMIES', array(
    ['Território', 'Territórios'],
    ['Tema', 'Temas']
));


// Register custom post type
add_action( 'init', 'lpcpt_create_article_post', 11 );

// Register all taxonomies 
add_action( 'init', 'lpcpt_create_taxonomy', 10 );

// Add custom page template for blog
add_action( 'template_include', 'lpcpt_custom_template' );

// Enqueue scripts and styles for blog page
add_action( 'wp_enqueue_scripts', 'lpcpt_scripts_styles' );
