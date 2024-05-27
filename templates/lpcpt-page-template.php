<?php
/*
Template Name: Custom Blog Page Template
*/

get_header();

?>

<div id="primary" class="content-area bg-white ">
    <?php lpcpt_render_header(); ?>

    <main id="main" class="site-main px-4 sm:px-6 md:px-10 py-4 sm:py-10" role="main">

        <div class="border-y border-[color:var(--primary-color)] py-2 my-2">
            <h2 class=" w-15 inline-block">
                <span class="text-xl sm:text-3xl md:text-5xl font-bold text-[color:var(--primary-color)] font-['landform-bold']">Biblioteca de <br> Políticas Públicas</span>
            </h2>
        </div>

        <section class="blog-categories py-5 flex flex-col">
            <div class="px-2">
                <button id="clean_filter" class="text-base text-[color:var(--primary-color)]">
                    <span class="underline font-['landform']">Limpar filtros</span>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                <?php lpcpt_build_form('Selecionar Territorio', 'lpcpt_territorio', 'lpcpt_territorio', '[color:var(--second-color)]') ?>
                <?php lpcpt_build_form('Selecionar Tema', 'lpcpt_tema', 'lpcpt_tema', '[color:var(--third-color)]'); ?>
            </div>
        </section>

        <section class="blog-posts max:sm:flex sm:grid max:sm:flex-col grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:gap-x-4 gap-y-10 sm:gap-y-10 z-10">
            <?php lpcpt_show_posts(); ?>
        </section>

    </main><!-- #main -->

    <?php lpcpt_render_footer(); ?>
</div><!-- #primary -->

<?php
get_footer();