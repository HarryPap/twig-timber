<?php

use Timber\PostQuery;
use Timber\Timber;
use Timber\Term;

$templates = ['archive.twig', 'index.twig'];

$data = Timber::get_context();

if (is_category()) {
    $data['title'] = single_cat_title('', false);
    $data['categories'] = Timber::get_terms(['taxonomy' => 'category', 'hide_empty' => false]);
    array_unshift($templates, 'archive-' . get_query_var('cat') . '.twig');

}
if (is_post_type_archive('product')) {
    $data['title'] = post_type_archive_title('', false);
    // $data['categories'] = Timber::get_terms(['taxonomy' => 'product_category', 'hide_empty' => false]);
    array_unshift($templates, 'template-products.twig');

}
if (is_tax('product_category')) {
    $data['category'] = new Term(get_queried_object_id());
    // $data['categories'] = Timber::get_terms(['taxonomy' => 'product_category', 'hide_empty' => false]);
    array_unshift($templates, 'template-products.twig');
    
    **This is the query i am working on and i dont know where should i pass that to
     $data['customquery'] = new PostQuery([
        'post_type' => 'product',
         'posts_per_page' => -1,
        'meta_key' => 'product_order',
         'orderby' => 'meta_value',
        'order' => 'desc'
     ]);**
        
}



Timber::render($templates, $data);
