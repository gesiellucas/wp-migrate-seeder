<div class="lpcpt-pagination bg-green-500 col-span-3 py-4">

    <?php
        $big = 999999999; // need an unlikely integer

        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?pag=%#%',
            'current' => max(1, get_query_var('pag')),
            'total' => $total
        ));
        
        ?>
</div>