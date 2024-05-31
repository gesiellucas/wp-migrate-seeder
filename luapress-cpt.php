<?php
/*
 * LuaPress Custom Post Type
 *
 * @package           luapress
 * @author            Gesiel Lucas
 * @copyright         2024 Gesiel Lucas
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: LuaPress CPT
 * Description: Creates a custom post type for blog posts with a filterable category form.
 * Version: 0.2.0
 * Requires at least: 6.0
 * Requires PHP: 7.2
 * Author: Gesiel Lucas
 * Author URI: https://github.com/gesiellucas
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PREFIX_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'PREFIX_BASE_URL', plugin_dir_url( __FILE__ ) );

define( 'LPCPT_SLUG', 'article_post');
define( 'LPCPT_VERSION', '0.2.0');

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