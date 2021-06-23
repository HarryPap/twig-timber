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

}






if (is_post_type_archive('recipe')) {
    $data['title'] = post_type_archive_title('', false);
    $data['categories'] = Timber::get_terms(['taxonomy' => 'recipe_category', 'hide_empty' => false]);
    array_unshift($templates, 'template-recipes.twig');
}
if (is_tax('recipe_category')) {
    $data['category'] = new Term(get_queried_object_id());
    $data['categories'] = Timber::get_terms(['taxonomy' => 'recipe_category', 'hide_empty' => false]);
    array_unshift($templates, 'template-recipes.twig');
}
if (is_post_type_archive('download')) {
    $data['title'] = post_type_archive_title('', false);
    $data['categories'] = Timber::get_terms(['taxonomy' => 'download_category', 'hide_empty' => false, 'parent' => 0]);
    array_unshift($templates, 'template-downloads.twig');
}
if (is_tax('download_category')) {
    $data['category'] = new Term(get_queried_object_id());
    $data['categories'] = Timber::get_terms(['taxonomy' => 'download_category', 'hide_empty' => false, 'parent' => 0]);
    array_unshift($templates, 'template-downloads.twig');
}


Timber::render($templates, $data);
