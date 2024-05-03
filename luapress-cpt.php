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


require plugin_dir_path( __FILE__ ) . 'includes/functions.php';

// Register custom post type
add_action( 'init', 'custom_blog_post_type' );

function custom_blog_post_type() {
    $labels = array(
        'name' => 'Blog',
        'singular_name' => 'Blog Post',
        'menu_name' => 'Blog',
        'add_new' => 'Add New Post',
        'add_new_item' => 'Add New Blog Post',
        'edit_item' => 'Edit Blog Post',
        'new_item' => 'New Blog Post',
        'view_item' => 'View Blog Post',
        'search_items' => 'Search Blog Posts',
        'not_found' => 'No blog posts found',
        'not_found_in_trash' => 'No blog posts found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'blog_post', $args );
}

add_action( 'init', 'create_taxonomy', 0 );


// Add custom page template for blog
add_action( 'template_include', 'custom_blog_page_template' );
function custom_blog_page_template( $template ) {
  
    if ( is_singular( 'blog_post' ) ) {
        $new_template = plugin_dir_path( __FILE__ ) . 'templates/blog-page-template.php';
        if ( '' !== $new_template ) {
            return $new_template;
        }
    }
    return $template;
}

// Enqueue scripts and styles for blog page
add_action( 'wp_enqueue_scripts', 'custom_blog_scripts_styles' );

function custom_blog_scripts_styles() {
    if ( is_singular( 'blog_post' ) ) {
        wp_enqueue_script( 'custom-blog-tailwind', plugins_url( 'assets/js/tailwind.js', __FILE__ ), null, '0.1.0' );
        wp_enqueue_style( 'custom-blog-style', plugins_url( 'assets/css/custom-blog-style.css?v=1', __FILE__), null, '0.1.0' );
    }
    
}

select_filter();