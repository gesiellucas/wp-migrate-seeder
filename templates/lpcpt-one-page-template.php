<section class="flex flex-row  px-20 gap-x-6 pb-10 pt-2">
        <div class="flex-1 p-2 flex flex-col justify-between">
            <div class="heading border-y border-[color:var(--primary-color)] py-4">
                <h2 class="font-['landform-bold'] text-[color:var(--primary-color)]"><?= $post->post_title; ?></h2>
            </div>

            <div class="flex flex-col">
                <p class="font-['landform-bold']"><?= $post->post_title; ?></p>

                <?php if(!empty(lpcpt_get_external_link($post->ID))) :?>
                <a href="<?= lpcpt_get_external_link($post->ID); ?>" class="w-full text-left text-white text-sm px-3 py-2 hover:bg-slate-600 bg-[color:var(--primary-color)] radius-3 font-['landform-bold'] flex flex-row justify-between place-self-center">
                    <span>conhecer a iniciativa </span>
                    <span class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
                        </svg>
                    </span>
                </a>
                <?php endif; ?>
            </div>
        
            <button class="text-left text-white text-sm hover:bg-slate-600 bg-[color:var(--primary-color)] radius-3 font-['landform-bold'] flex flex-row justify-between place-self-start p-1 gap-3">
                <span class="flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
                <span>voltar</span>
            </button>
        </div>

        <div class="flex-1">
            <div class="bg-slate-200 w-full aspect-video <?= lpcpt_get_thumbnail( $post->ID ); ?>"></div>

            <p class="p-4"><?= $post->post_content; ?></p>
        </div>
    </section>
