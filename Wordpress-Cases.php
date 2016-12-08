<?php
/**
* @package Wordpress Cases
* @version 1.0
*/
/*
Plugin Name: Wordpress Cases
Plugin URI: http://renedyhr.dk
Description: A plugin that handles project/cases
Author: René Dyhr
Version: 1.0
Author URI: http://renedyhr.dk
*/


function register_cases() {

    $labels = array(
        'name' => _x( 'Cases', 'cases' ),
        'singular_name' => _x( 'Cases', 'cases' ),
        'add_new' => _x( 'Add New', 'cases' ),
        'add_new_item' => _x( 'Add New Case', 'cases' ),
        'edit_item' => _x( 'Edit Case', 'cases' ),
        'new_item' => _x( 'New Case', 'cases' ),
        'view_item' => _x( 'View Case', 'cases' ),
        'search_items' => _x( 'Search Cases', 'cases' ),
        'not_found' => _x( 'No cases found', 'cases' ),
        'not_found_in_trash' => _x( 'No cases found in Trash', 'cases' ),
        'parent_item_colon' => _x( 'Parent Cases:', 'cases' ),
        'menu_name' => _x( 'Cases', 'cases' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Cases filterable by category',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'categories' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-aside',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'cases', $args );
}

add_action( 'init', 'register_cases' );



function categories_taxonomy() {
    register_taxonomy(
        'categories',
        'cases',
        array(
            'hierarchical' => true,
            'label' => 'Categories',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'case-categories',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'categories_taxonomy');




// Function used to automatically create Music Reviews page.
function create_case_pages()
  {
   //post status and options
    $post = array(
          'comment_status' => 'open',
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'cases',
          'post_status' => 'publish' ,
          'post_title' => 'Cases',
          'post_type' => 'page',
    );
    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'mrpage', $newvalue );
  }

  // // Activates function if plugin is activated
  register_activation_hook( __FILE__, 'create_case_pages');
