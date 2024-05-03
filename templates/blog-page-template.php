<?php
/*
Template Name: Custom Blog Page Template
*/

get_header();

?>

<div id="primary" class="content-area bg-slate-100 p-5">
    <?php render_header(); ?>

    <main id="main" class="site-main bg-sky-700 p-4" role="main">

        <div class="border border-blue-400 p-2 my-2">
            <h2>Biblioteca de politicas publicas</h2>
        </div>

        <section class="blog-categories border border-red-200 bg-red-50 p-2 my-2 flex flex-col">
            <div class="bg-green-500 text-white p-2 m-2">
                <a href="#">Limpar pesquisa</a>
            </div>

            <div class="grid grid-cols-3 text-dark">
                <div class="bg-green-500  p-2 m-2">
                    <?php build_form('Selecionar Territorio', 'lpcpt_territorio', 'lpcpt_territorio') ?>
                </div>

                <div class="bg-green-500 p-2 m-2">
                    <?php build_form('Selecionar Tema', 'lpcpt_tema', 'lpcpt_tema'); ?>
                </div>
            </div>

            
        </section>

        <section class="blog-posts bg-red-500 p-3 grid grid-cols-3 gap-3 z-10">
            <?php
            // Query posts based on category filter
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
            );

            // Check if category filter is set
            if ( isset( $_GET['category-filter'] ) && $_GET['category-filter'] != '' ) {
                $args['category_name'] = $_GET['category-filter'];
            }

            // The Query
            $query = new WP_Query( $args );

            // The Loop
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    ?>
                    <article class="bg-sky-400 p-5 flex flex-col justify-between" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header>
                            <div class="w-10 h-10 bg-slate-500 z-10">

                            </div>
                        </header>

                        <section class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </section><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-content -->

                        <hr>

                        <footer>
                            <button class="p-3 bg-slate-300 radius-3">Link para sair do site</button>
                        </footer>
                    </article><!-- #post-<?php the_ID(); ?> -->
                <?php
                endwhile;
            else :
                ?>
                <p>No posts found.</p>
            <?php
            endif;

            // Restore original Post Data
            wp_reset_postdata();
            ?>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();