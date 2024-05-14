<?php 

function lpcpt_seeding_taxonomies()
{
    $taxonomies = [
        [
            'name' => 'lpcpt_tema',
            'items' => [
                'janeiro',
                'fevereiro',
                'julho',
                'dezembro'
            ]
        ],
        [
            'name' => 'lpcpt_territorio',
            'items' => [
                'para',
                'sao paulo',
                'minas gerais',
                'rondonia',
                'pernambuco',
                'acre'
            ]
        ],
    ];

    foreach($taxonomies as $taxonomy) {
        foreach($taxonomy['items'] as $items) {
            $has_term = term_exists($items, $taxonomy['name']);

            if(0 === $has_term || null === $has_term) {
                $result = wp_insert_term(
                    $items,
                    $taxonomy['name']
                );  
            } 
        }
    }
}