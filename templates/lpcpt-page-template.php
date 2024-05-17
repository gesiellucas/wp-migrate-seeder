<?php
/*
Template Name: Custom Blog Page Template
*/

get_header();

?>

<div id="primary" class="content-area bg-white ">
    <?php lpcpt_render_header(); ?>

    <main id="main" class="site-main px-20 py-10" role="main">

        <div class="border-y border-[color:var(--primary-color)] py-2 my-2">
            <h2 class=" w-15 inline-block">
                <span class="text-5xl font-bold text-[color:var(--primary-color)] font-['landform-bold']">Biblioteca de <br> Políticas Públicas</span>
            </h2>
        </div>

        <section class="blog-categories py-5 flex flex-col">
            <div class="px-2">
                <button id="clean_filter" class="text-base text-[color:var(--primary-color)]">
                    <span class="underline font-['landform']">Limpar filtros</span>
                </button>
            </div>

            <div class="grid grid-cols-3">
                <?php lpcpt_build_form('Selecionar Territorio', 'lpcpt_territorio', 'lpcpt_territorio') ?>
                <?php lpcpt_build_form('Selecionar Tema', 'lpcpt_tema', 'lpcpt_tema'); ?>
            </div>
        </section>

        <section class="blog-posts p-3 grid grid-cols-3 gap-x-4 gap-y-20 z-10">
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
                            <span class="w-7 h-7 bg-[color:var(--primary-color)] block absolute top-0 right-0 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
                                </svg>
                            </span>
                            <div class="w-full aspect-video <?= lpcpt_get_thumbnail(get_the_ID()); ?> z-10">

                            </div>
                        </header>

                        <section class="entry-header py-1">
                            <h2 class="entry-title font-['landform-bold'] text-[color:var(--primary-color)]">
                                <a href="<?php the_permalink(); ?>"class="text-lg">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </section>

                        <hr class="border-[color:var(--primary-color-50)]">

                        <div class="entry-content py-4 [&>p]:text-sm font-['landform-bold'] text-dark">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="flex">
                            <button class="text-left text-white text-sm px-3 py-2 hover:bg-slate-600 bg-[color:var(--primary-color)] radius-3 flex-1 font-['landform-bold'] flex flex-row justify-between">
                                <span>conhecer a iniciativa</span>
                                <span class="flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
                                    </svg>
                                </span>
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