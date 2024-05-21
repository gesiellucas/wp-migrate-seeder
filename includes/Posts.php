<?php 

namespace Lpcpt;

use Symfony\Component\HttpFoundation\Request;

class Posts extends Request
{
    private const TAXONOMY_FIELD = 'slug';
    private const TAXONOMY_SLUG = 'article_post';
    private array $params;
    private array $taxonomy;
    private array $queryArgs;

    public function __construct()
    {
        $this->params = ['territorio', 'tema', 'pag'];
        $this->taxonomy = [];

        $this->handleRequest();

        $this->setQueryArgs([
            'post_type' => self::TAXONOMY_SLUG,
            'posts_per_page' => 9,
            'tax_query' => $this->getTaxonomy(),
        ]);
    }
    
    private function handleRequest():void
    {
        
        foreach($this->getParams() as $param) {
            
            if( null !== Request::createFromGlobals()->query->has($param) && 'pag' != $param ) {
                if(! empty( Request::createFromGlobals()->query->all($param) )) {
                    $terms = array_map('sanitize_text_field', Request::createFromGlobals()->query->all($param));
                    $this->setTaxonomy($param, $terms);
                }
            }

            if(! empty( Request::createFromGlobals()->query->has('pag')) ) {
                $this->setPagination((int) Request::createFromGlobals()->query->get('pag'));
            }
        }

    }

    private function getParams(): array 
    {
       return $this->params;
    }

    private function setTaxonomy(string $tax, array $terms):void 
    {
        if(empty($this->taxonomy)) {
            $this->taxonomy['relation'] = 'OR';
        }

        array_push($this->taxonomy, [
            'taxonomy' => 'lpcpt_' . $tax,
            'field' => self::TAXONOMY_FIELD,
            'terms' => $terms
        ]);
    }

    private function getTaxonomy(): array
    {
        return $this->taxonomy;
    }

    private function setPagination(int $page): void
    {
        $this->queryArgs['paged'] = $page;
    }

    private function setQueryArgs(array $args): void
    {
        if(empty($this->queryArgs)) {
            $this->queryArgs = [];
        }      

        foreach($args as $key => $term) {
            $this->queryArgs[$key] = $term;
        }
    }

    public function getQueryArgs(): array
    {
        return $this->queryArgs;
    }

}