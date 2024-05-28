<?php

use Lpcpt\Classes\Posts;

function lpcpt_custom_template( $template ) 
{      

    if( is_home() && is_main_query() ) {
        if( isset($_GET['post']) ) {
            $new_template = PREFIX_BASE_PATH . 'templates/lpcpt-page-opened-template.php';
        } else {
            $new_template = PREFIX_BASE_PATH . 'templates/lpcpt-page-template.php';
        }
        
        if ( '' !== $new_template ) {
            return $new_template;
        }
        
        return $template;
    }

    
}

function getPostsArgs()
{
    return (new Posts)->getQueryArgs();
}

function lpcpt_show_posts($id = null)
{
    $query = new WP_Query(  getPostsArgs() );

    if ( $query->have_posts() ) {
        
        while ( $query->have_posts() ) {
            $query->the_post();
            require PREFIX_BASE_PATH . 'templates/lpcpt-posts-template.php';
        }

        lpcpt_posts_paginate($query->max_num_pages);
        
    } else {
        echo "<p>Nenhum post encontrado!</p>";
    }

    wp_reset_postdata();
}

function lpcpt_one_post($id)
{
    
    $args = array(
        'p' => $id,
        'post_type' => 'article_post'
    );
    
    $query = new WP_Query( $args );

    $post = $query->get_posts()[0];
    // dd($post);

    if(isset($post)) {
        require PREFIX_BASE_PATH . 'templates/lpcpt-one-page-template.php';
    }



    wp_reset_postdata();

}

function lpcpt_build_form($title, $taxonomy, $slug, $color = null)
{
    if($color == null) {
        $color = 'orange-600 ';
    }
    
    require PREFIX_BASE_PATH . 'templates/lpcpt-form-template.php'; 
}

function lpcpt_posts_paginate($total)
{
    $base = add_query_arg('pag', '%#%');
    $paginate = paginate_links(array(
        'base' => $base,
        'format' => '',
        'current' => max(1, get_query_var('pag', 1)),
        'total' => $total,
        'add_args'  => false,
    ));

    echo '<div class="lpcpt-pagination bg-green-500 col-span-1 sm:col-span-2 md:col-span-3 py-4">' . $paginate . '</div>';

}

function lpcpt_render_footer()
{
    require PREFIX_BASE_PATH . 'templates/lpcpt-footer-template.php';
}

function lpcpt_get_post_link($id)
{
    return '?post&postid=' . $id;
}

function lpcpt_create_article_post() 
{
    $labels = array(
        'name' => 'Artigos',
        'singular_name' => 'Artigo',
        'menu_name' => 'Artigos',
        'add_new' => 'Adicionar novo artigo',
        'add_new_item' => 'Adicionar novo artigo',
        'edit_item' => 'Editar item artigo',
        'new_item' => 'Novo artigo',
        'view_item' => 'Ver artigo',
        'search_items' => 'Buscar artigos',
        'not_found' => 'Nenhum artigo encontrado',
        'not_found_in_trash' => 'Nenhum artigo encontrado na lixeira',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-aside',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
    );

    register_post_type( LPCPT_SLUG, $args );
}

function lpcpt_create_taxonomy()
{
    foreach (LPCPT_TAXONOMIES as $taxonomy) {
        lpcpt_save_taxonomy($taxonomy[0], $taxonomy[1]);
    }
}

function lpcpt_scripts_styles(): void
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'lpcpt-blog-tailwind', PREFIX_BASE_URL . 'assets/js/tailwind.js', null, LPCPT_VERSION );
    wp_enqueue_script( 'lpcpt-blog-script', PREFIX_BASE_URL . 'assets/js/lpcpt-blog-script.js?v=1', 'jquery', LPCPT_VERSION );
    wp_enqueue_style( 'lpcpt-blog-style', PREFIX_BASE_URL . 'assets/css/lpcpt-blog-style.css?v=1', null, LPCPT_VERSION );   
}

function lpcpt_render_header()
{
    require PREFIX_BASE_PATH . 'templates/lpcpt-header-template.php';
}

function lpcpt_save_taxonomy($singular, $plural)
{
    $post_type = [LPCPT_SLUG];
    $prefix = 'lpcpt_';

    $labels = array(
        'name'                       => _x( $singular, 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( $singular, 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( $prefix . $singular, 'text_domain' ),
        'all_items'                  => __( 'Todos ' . $plural, 'text_domain' ),
        'parent_item'                => __( $plural . ' Acima', 'text_domain' ),
        'parent_item_colon'          => __( $singular . ' Acima:', 'text_domain' ),
        'new_item_name'              => __( 'Novo ' . $singular, 'text_domain' ),
        'add_new_item'               => __( 'Novo ' . $singular, 'text_domain' ),
        'edit_item'                  => __( 'Editar ' . $singular, 'text_domain' ),
        'update_item'                => __( 'Alterar ' . $singular, 'text_domain' ),
        'view_item'                  => __( 'Ver ' . $singular, 'text_domain' ),
        'separate_items_with_commas' => __( 'Separar ' . $plural . ' com vírgula', 'text_domain' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover ' . $plural, 'text_domain' ),
        'choose_from_most_used'      => __( 'Escolher ' . $plural . ' mais usados', 'text_domain' ),
        'popular_items'              => __( $plural . ' populares', 'text_domain' ),
        'search_items'               => __( 'Buscar ' . $plural, 'text_domain' ),
        'not_found'                  => __( 'Não encontrado', 'text_domain' ),
        'no_terms'                   => __( 'Nada encontrado', 'text_domain' ),
        'items_list'                 => __( 'Lista de ' . $plural, 'text_domain' ),
        'items_list_navigation'      => __( 'Lista de ' . $plural . ' navegação', 'text_domain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false, // Set this to true if you want your taxonomy to behave like categories
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => true
    );

    register_taxonomy( remove_accents(strtolower($prefix . $singular)), $post_type, $args );
}

function lpcpt_get_taxonomy($taxonomy = null)
{
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => false
    ]);

    return array_map(function($value){
        return $value->name ;
    }, $terms);

}

function lpcpt_remove_prefix($taxonomy)
{
    return str_replace('lpcpt_', '', $taxonomy);
}

function lpctp_check_query_params($taxonomy, $term)
{
    switch(lpcpt_remove_prefix($taxonomy)) {
        case 'territorio':
            if(isset($_GET['territorio'])) {
                $territorio = $_GET['territorio'];
        
                if(is_array($territorio)) {
                    $territorio = array_map(function($item) {
                        return sanitize_text_field( urldecode($item) );
                    }, $territorio);
                } else {
                    $territorio = sanitize_text_field( $item );
                }
        
                echo !in_array($term, $territorio) ?: 'checked="checked"';
            }
            break;
        case 'tema': 
            if(isset($_GET['tema'])) {
                $tema = $_GET['tema'];
        
                if(is_array($tema)) {
                    $tema = array_map(function($item) {
                        return sanitize_text_field( urldecode($item) );
                    }, $tema);
                } else {
                    $tema = sanitize_text_field( urldecode($item) );
                }
        
                echo !in_array($term, $tema) ?: 'checked="checked"';
            }
            break;
        default:
    }
}

function lpcpt_select_filter()
{
    $taxonomy['relation'] = 'OR';

    if(isset($_GET['territorio'])) {
        $territorio = $_GET['territorio'];

        if(is_array($territorio)) {
            $territorio = array_map(function($item){
                return sanitize_text_field( $item );
            }, $territorio);
        } else {
            $territorio = sanitize_text_field( $item );
        }

        array_push($taxonomy, [
            'taxonomy' => 'lpcpt_territorio',
            'field' => 'slug',
            'terms' => $territorio
        ]);
    }

    if(isset($_GET['tema'])) {
        $tema = $_GET['tema'];

        if(is_array($tema)) {
            $tema = array_map(function($item){
                return sanitize_text_field( $item );
            }, $tema);
        } else {
            $tema = sanitize_text_field( $item );
        }

        array_push($taxonomy, [
            'taxonomy' => 'lpcpt_tema',
            'field' => 'slug',
            'terms' => $tema
        ]);
    }

    $args = array(
        'post_type' => LPCPT_SLUG,
        'posts_per_page' => -1,
        'tax_query' => $taxonomy,
    );

    return $args;

}

function lpcpt_get_thumbnail($post_id)
{
    global $wpdb;

    // Get the attachment ID of the post thumbnail
    $thumbnail_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = '_thumbnail_id'",
            $post_id
        )
    );

    if (!$thumbnail_id) return false;

    // Get the URL of the attachment
    $thumbnail_url = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT guid FROM $wpdb->posts WHERE ID = %d",
            $thumbnail_id
        )
    );

    return $thumbnail_url != '' ? 'bg-[url(' . $thumbnail_url .')] bg-no-repeat bg-cover' : 'bg-slate-600' ;
}