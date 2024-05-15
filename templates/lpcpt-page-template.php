<?php
/*
Template Name: Custom Blog Page Template
*/

get_header();

?>

<div id="primary" class="content-area bg-white">
    <?php lpcpt_render_header(); ?>

    <main id="main" class="site-main p-4" role="main">

        <div class="border-y border-[color:var(--primary-color)] py-2 my-2">
            <h2 class=" w-15 inline-block">
                <span class="text-5xl font-bold text-[color:var(--primary-color)]">Biblioteca de <br> politicas publicas</span>
            </h2>
        </div>

        <section class="blog-categories px-2 flex flex-col">
            <div class="px-2">
                <button id="clean_filter" class="text-base text-[color:var(--primary-color)]">
                    <span class="underline">Limpar filtros</span>
                </button>
            </div>

            <div class="grid grid-cols-3">
                <?php lpcpt_build_form('Selecionar Territorio', 'lpcpt_territorio', 'lpcpt_territorio') ?>
                <?php lpcpt_build_form('Selecionar Tema', 'lpcpt_tema', 'lpcpt_tema'); ?>
            </div>
        </section>

        <section class="blog-posts p-3 grid grid-cols-3 gap-4 z-10">
            <?php
            
            // The Query
            $query = new WP_Query( lpcpt_select_filter() );

            // The Loop
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    ?>
                    <article class="flex flex-col justify-between" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="relative">
                            <div class="w-full aspect-video	 bg-slate-500 z-10"></div>
                        </header>

                        <section class="entry-header py-1">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </section><!-- .entry-header -->

                        <hr class="py-1">

                        <div class="entry-content py-1">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-content -->

                        

                        <footer class="flex">
                            <button class="text-left text-white text-base px-3 py-2 bg-[color:var(--primary-color)] radius-3 flex-1">
                                conhecer a iniciativa
                            </button>
                        </footer>
                    </article><!-- #post-<?php the_ID(); ?> -->
                <?php
                endwhile;
            else :
                ?>
                <p>Nenhuma postagem encontrada</p>
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