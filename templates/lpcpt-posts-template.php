
<article class="flex flex-col justify-between hover:shadow" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <a href="<?= lpcpt_get_post_link(get_the_ID()); ?>">
        <header class="relative">
            <span class="w-7 h-7 bg-[color:var(--primary-color)] block absolute top-0 right-0 flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
                </svg>
            </span>
            <div class="w-full aspect-video <?= lpcpt_get_thumbnail(get_the_ID()); ?> z-10">

            </div>
        </header>
    </a>

    <section class="entry-header py-1">
        <h2 class="entry-title font-['landform-bold'] text-[color:var(--primary-color)]">
            <a href="<?= lpcpt_get_post_link(get_the_ID()); ?>"class="text-lg">
                <?php the_title(); ?>
            </a>
        </h2>
    </section>

    <hr class="border-[color:var(--primary-color-50)]">

    <div class="entry-content py-4 [&>p]:text-sm font-['landform-bold'] text-dark">
        <?php the_excerpt(); ?>
    </div>

    <footer class="flex">
        <a href="<?= lpcpt_get_post_link(get_the_ID()); ?>" class="text-left text-white text-sm px-3 py-2 hover:bg-slate-600 bg-[color:var(--primary-color)] radius-3 flex-1 font-['landform-bold'] flex flex-row justify-between">
            <span>conhecer a iniciativa</span>
            <span class="flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
                </svg>
            </span>
        </a>
    </footer>
</article><!-- #post-<?php the_ID(); ?> -->

    