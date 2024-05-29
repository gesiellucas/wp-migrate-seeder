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
// $faker = Faker\Factory::create();
// $faker->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));
// $url = $faker->imageUrl(600, 400); 

// dd($url);


// exit;
// require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
// require plugin_dir_path( __FILE__ ) . 'vendor/wp-migrate-seeder/luapress/helpers.php' ;
// require plugin_dir_path( __FILE__ ) . 'vendor/wp-migrate-seeder/luapress/seeder/SeederPost.php';
// new SeederPost(12);
// exit;

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PREFIX_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'PREFIX_BASE_URL', plugin_dir_url( __FILE__ ) );

define( 'LPCPT_SLUG', 'article_post');
define( 'LPCPT_VERSION', '0.1.5');

define( 'LPCPT_TAXONOMIES', array(
    ['Território', 'Territórios'],
    ['Tema', 'Temas']
));

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require plugin_dir_path( __FILE__ ) . 'includes/functions.php';

// Register custom post type
add_action( 'init', 'lpcpt_create_article_post', 11 );

// Register all taxonomies 
add_action( 'init', 'lpcpt_create_taxonomy', 10 );

// Enqueue scripts and styles for blog page
add_action( 'wp_enqueue_scripts', 'lpcpt_scripts_styles' );
        
// Add custom page template for blog
add_action( 'template_include', 'lpcpt_custom_template' );


// Post Meta Data
add_action( 'add_meta_boxes', 'lpcpt_add_meta_box');
add_action( 'save_post', 'lpcpt_save_meta_box_data');

add_theme_support('post-thumbnails');
if (has_post_thumbnail()) {
    the_post_thumbnail();
}