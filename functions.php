<?php
function bobe_theme_enqueue_styles() {

    $parent_style = 'beautypack-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    // wp_enqueue_style( 'bobe-style',
    //     get_stylesheet_directory_uri() . '/style.css',
    //     array( $parent_style ),
    //     wp_get_theme()->get('Version')
    // );
}
add_action( 'wp_enqueue_scripts', 'bobe_theme_enqueue_styles' );


// Register Custom Post Type
function bobe_custom_post_type() {

    $labels = array(
        'name'                  => _x( 'Services', 'Post Type General Name', 'bobe' ),
        'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'bobe' ),
        'menu_name'             => __( 'Services', 'bobe' ),
        'name_admin_bar'        => __( 'Service', 'bobe' ),
        'archives'              => __( 'Item Archives', 'bobe' ),
        'attributes'            => __( 'Item Attributes', 'bobe' ),
        'parent_item_colon'     => __( 'Parent Item:', 'bobe' ),
        'all_items'             => __( 'All Services', 'bobe' ),
        'add_new_item'          => __( 'Add New Item', 'bobe' ),
        'add_new'               => __( 'Add New', 'bobe' ),
        'new_item'              => __( 'New Item', 'bobe' ),
        'edit_item'             => __( 'Edit Item', 'bobe' ),
        'update_item'           => __( 'Update Item', 'bobe' ),
        'view_item'             => __( 'View Service', 'bobe' ),
        'view_items'            => __( 'View Services', 'bobe' ),
        'search_items'          => __( 'Search Service', 'bobe' ),
        'not_found'             => __( 'Not found', 'bobe' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'bobe' ),
        'featured_image'        => __( 'Featured Image', 'bobe' ),
        'set_featured_image'    => __( 'Set featured image', 'bobe' ),
        'remove_featured_image' => __( 'Remove featured image', 'bobe' ),
        'use_featured_image'    => __( 'Use as featured image', 'bobe' ),
        'insert_into_item'      => __( 'Insert into item', 'bobe' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'bobe' ),
        'items_list'            => __( 'Items list', 'bobe' ),
        'items_list_navigation' => __( 'Items list navigation', 'bobe' ),
        'filter_items_list'     => __( 'Filter items list', 'bobe' ),
    );
    $args = array(
        'label'                 => __( 'Service', 'bobe' ),
        'description'           => __( 'Post Type Description', 'bobe' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
        'taxonomies'            => array( 'service-type' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-images-alt2',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'service', $args );

}
add_action( 'init', 'bobe_custom_post_type', 0 );

function bobe_add_service_taxonomies(){

    $category_labels = array(
        'name' => __( 'Service Categories', 'bobe'),
        'singular_name' => __( 'Service Category', 'bobe'),
        'search_items' =>  __( 'Search Service Categories', 'bobe'),
        'all_items' => __( 'All Service Categories', 'bobe'),
        'parent_item' => __( 'Parent Service Category', 'bobe'),
        'edit_item' => __( 'Edit Service Category', 'bobe'),
        'update_item' => __( 'Update Service Category', 'bobe'),
        'add_new_item' => __( 'Add New Service Category', 'bobe'),
        'menu_name' => __( 'Service Categories', 'bobe')
    );

    register_taxonomy("service-type",
            array("service"),
            array("hierarchical" => true,
                    'labels' => $category_labels,
                    'show_ui' => true,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => 'szolgaltatasok' )
    ));
}

add_action( 'init', 'bobe_add_service_taxonomies' );

/*******************************HEADER IMG******************************/
add_action( 'add_meta_boxes', 'bobe_nd_options_metabox_services_header_img' );
function bobe_nd_options_metabox_services_header_img() {
    add_meta_box( 'nd-options-meta-box-post-header-img-id', __('ND Options Header Image','nd-shortcodes'), 'nd_options_metabox_post_header_img', 'service', 'normal', 'high' );
}



function bobe_modify_services_archive($query)
{
    if ( ($query->is_main_query()) && ($query->is_archive('service') || $query->is_tax('service-type')  ) && (!is_admin()) ) {
      $query->set('posts_per_page', -1);
      $query->set('orderby', 'menu_order');
      $query->set('order', 'ASC');
      $query->set('post_status', array('publish' ));
    }
}
add_action('pre_get_posts', 'bobe_modify_services_archive');