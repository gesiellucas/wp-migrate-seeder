<?php 

function render_header()
{
    require PREFIX_BASE_PATH . '/templates/blog-header-template.php';
}

function create_taxonomy()
{
    $taxonomies = [
        ['Território', 'Territórios'],
        ['Tema', 'Temas']
    ];

    foreach ($taxonomies as $taxonomy) {
        save_taxonomy($taxonomy[0], $taxonomy[1]);
    }

    // seeding_taxonomies();
}

function save_taxonomy($singular, $plural)
{
    $post_type = ['post'];
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

function seeding_taxonomies()
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

function build_form($title, $taxonomy, $slug)
{
?>
    <section class="p-4 bg-slate-100 text-white flex flex-row justify-between items-center">
        <div id="<?=$slug?>" class="dropdown-check-list inline-block relative" tabindex="100">
            <span class="anchor relative cursor-pointer inline-block py-[5px] pr-[200px] pl-[10px] border border-orange-600 text-orange-600">
                <?= $title ?>
            </span>
            <ul class="items absolute z-[9999] w-full bg-slate-100 py-5">
                <?php foreach(lpcpt_get_taxonomy($taxonomy) as $key => $value): ?>
                <li class="hover:bg-orange-100">
                    <div class="flex items-center">
                        <label for="<?=$slug?>-checkbox-<?=$key?>" class="text-sm font-medium text-orange-600 w-full px-2 cursor-pointer flex flex-row items-center">
                            <input id="<?=$slug?>-checkbox-<?=$key?>" type="checkbox" value="" class="w-4 h-4 text-orange-600 ring-offset-orange-600 bg-white checked:bg-orange-600 border-orange-600 focus:ring-orange-600 focus:ring-1">
                            <span class="mx-2">
                                <?= ucfirst($value) ?>
                            </span>
                        </label>
                    </div>
                </li>
                <?php endforeach; ?>
                <li>
                    <div class="relative inline-flex items-center justify-center py-1 px-2 m-2 overflow-hidden text-sm font-medium text-orange-600 border border-orange-600 hover:bg-orange-600 hover:text-white">
                        <button class="m-0 p-0">Filtrar</button>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <script>
        let checkList_<?=$slug?> = document.querySelector('#<?=$slug?>');
        
        checkList_<?=$slug?>.querySelector('#<?=$slug?> .anchor').onclick = function(evt) {
            console.log(checkList_<?=$slug?>.classList);
            if (checkList_<?=$slug?>.classList.contains('visible'))
                checkList_<?=$slug?>.classList.remove('visible');
            else
                checkList_<?=$slug?>.classList.add('visible');
        }
    </script>
<?php
}