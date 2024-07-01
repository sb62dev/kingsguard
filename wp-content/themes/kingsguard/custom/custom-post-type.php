<?php 
function product_init() {
    $labels = array(
        'name' => 'Header/Footer',
        'singular_name' => 'Header/Footer',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New',
        'edit_item' => 'Edit',
        'new_item' => 'New',
        'all_items' => 'All',
        'view_item' => 'View',
        'search_items' => 'Search',
        'not_found' =>  'No Header/Footer Found',
        'not_found_in_trash' => 'No Header/Footer found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Header/Footer',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'general_settings'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        ),
        'capabilities' => array(
            'create_posts' => false, // Prevent users from creating new posts
        ),
        'map_meta_cap' => true,
    );
    register_post_type( 'general_settings', $args );
}
add_action( 'init', 'product_init' );

?>