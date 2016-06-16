<?php
/*
 *      Custom Post Type Registeration File
 * --------------------------------------------------------
 *      @author      GopaThemes
 *      @link        http://www.gopathemes.com
 *      @link        http://themeforest.net/user/gopathemes
 *      @copyright   Copyright (c) GopaThemes
 * --------------------------------------------------------
 *      This file contains functions for Custom Post Type.
 * --------------------------------------------------------
 * 
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Custom post type for Testimonials
 */

add_action('init', 'gopathemes_cpt_testimonials');
function gopathemes_cpt_testimonials() {
    
    $labels = array (
            'name'                  => __('Testimonials', 'gtpe'),
            'singular_name'         => __('Testimonial', 'gtpe'),
            'menu_name'             => __('Testimonials', 'gtpe'),
            'add_new'               => __('Add Testimonial', 'gtpe'),
            'add_new_item'          => __('Add New Testimonial', 'gtpe'),
            'edit'                  => __('Edit', 'gtpe'),
            'edit_item'             => __('Edit Testimonial', 'gtpe'),
            'new_item'              => __('New Testimonial', 'gtpe'),
            'view'                  => __('View Testimonial', 'gtpe'),
            'view_item'             => __('View Testimonial', 'gtpe'),
            'search_items'          => __('Search Testimonials', 'gtpe'),
            'not_found'             => __('No Testimonials Found', 'gtpe'),
            'not_found_in_trash'    => __('No Testimonials Found in Trash', 'gtpe'),
            'parent'                => __('Parent Testimonial', 'gtpe'),
    );
    
    $args = array(
            'label'                 => __('Testimonials', 'gtpe'),
            'description'           => '',
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'rewrite'               => array('slug' => 'testimonials', 'with_front' => 1),
            'query_var'             => true,
            'exclude_from_search'   => true,
            'supports'              => array(),
            'labels'                => $labels
    );
    
    register_post_type('gt_testimonials', $args);
    
    
    // taxonomy for Testimonials
    $tax_labels = array(
            'name'              => _x( 'Testimonial Categories', 'taxonomy general name', 'gtpe' ),
            'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'gtpe' ),
            'search_items'      => __( 'Search Categories', 'gtpe' ),
            'all_items'         => __( 'All Categories', 'gtpe' ),
            'parent_item'       => __( 'Parent Category', 'gtpe' ),
            'parent_item_colon' => __( 'Parent Category:', 'gtpe' ),
            'edit_item'         => __( 'Edit Category', 'gtpe' ),
            'update_item'       => __( 'Update Category', 'gtpe' ),
            'add_new_item'      => __( 'Add New Category', 'gtpe' ),
            'new_item_name'     => __( 'New Category Name', 'gtpe' ),
            'menu_name'         => __( 'Testimonial Categories', 'gtpe' ),
    );

    $tax_args = array(
            'hierarchical'      => true,
            'labels'            => $tax_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'category' ),
    );

    register_taxonomy( 'testimonial_category', array( 'gt_testimonials' ), $tax_args );   
    
}



/**
 * Custom Post Type for Portfolio
 */
add_action('init', 'gopathemes_cpt_portfolio');
function gopathemes_cpt_portfolio() {
    
    $pt_labels = array (
            'name'                  => __('Portfolio', 'gtpe'),
            'singular_name'         => __('Portfolio', 'gtpe'),
            'menu_name'             => __('Portfolio', 'gtpe'),
            'add_new'               => __('Add Item', 'gtpe'),
            'add_new_item'          => __('Add New Item', 'gtpe'),
            'edit'                  => __('Edit', 'gtpe'),
            'edit_item'             => __('Edit Item', 'gtpe'),
            'new_item'              => __('New Item', 'gtpe'),
            'view'                  => __('View Item', 'gtpe'),
            'view_item'             => __('View Item', 'gtpe'),
            'search_items'          => __('Search Items', 'gtpe'),
            'not_found'             => __('No Portfolio Items Found', 'gtpe'),
            'not_found_in_trash'    => __('No Portfolio Items Found in Trash', 'gtpe'),
            'parent'                => __('Parent Items', 'gtpe'),
    );
    
    $pt_args = array(
            'label'                 => __('Portfolio', 'gtpe'),
            'description'           => '',
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => true,
            'rewrite'               => array('slug' => 'portfolio', 'with_front' => true),
            'query_var'             => true,
            'exclude_from_search'   => true,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'labels'                => $pt_labels
    );
    
    register_post_type('gopathemes_portfolio', $pt_args); 
    
    
    // taxonomy for portfolio
    $tax_labels = array(
            'name'              => _x( 'Item Categories', 'taxonomy general name', 'gtpe' ),
            'singular_name'     => _x( 'Item Category', 'taxonomy singular name', 'gtpe' ),
            'search_items'      => __( 'Search Categories', 'gtpe' ),
            'all_items'         => __( 'All Categories', 'gtpe' ),
            'parent_item'       => __( 'Parent Category', 'gtpe' ),
            'parent_item_colon' => __( 'Parent Category:', 'gtpe' ),
            'edit_item'         => __( 'Edit Category', 'gtpe' ),
            'update_item'       => __( 'Update Category', 'gtpe' ),
            'add_new_item'      => __( 'Add New Category', 'gtpe' ),
            'new_item_name'     => __( 'New Category Name', 'gtpe' ),
            'menu_name'         => __( 'Item Categories', 'gtpe' ),
    );

    $tax_args = array(
            'hierarchical'      => true,
            'labels'            => $tax_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'portfolio-category' ),
    );

    register_taxonomy( 'pitem_category', array( 'gopathemes_portfolio' ), $tax_args );  
    
    
    // Add new taxonomy, NOT hierarchical (like tags)
    $skill_labels = array(
            'name'                       => _x( 'Skills', 'taxonomy general name', 'gtpe' ),
            'singular_name'              => _x( 'Skill', 'taxonomy singular name', 'gtpe' ),
            'search_items'               => __( 'Search Skills', 'gtpe' ),
            'popular_items'              => __( 'Popular Skills', 'gtpe' ),
            'all_items'                  => __( 'All Skills', 'gtpe' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Skill', 'gtpe' ),
            'update_item'                => __( 'Update Skill', 'gtpe' ),
            'add_new_item'               => __( 'Add New Skill', 'gtpe' ),
            'new_item_name'              => __( 'New Skill Name', 'gtpe' ),
            'separate_items_with_commas' => __( 'Separate Skills with commas', 'gtpe' ),
            'add_or_remove_items'        => __( 'Add or remove Skills', 'gtpe' ),
            'choose_from_most_used'      => __( 'Choose from the most used Skills', 'gtpe' ),
            'not_found'                  => __( 'No Skills found.', 'gtpe' ),
            'menu_name'                  => __( 'Portfolio Skills', 'gtpe' ),
    );

    $skill_args = array(
            'hierarchical'          => false,
            'labels'                => $skill_labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'portfolio-skills' ),
    );

    register_taxonomy( 'portfolio_skills', 'gopathemes_portfolio', $skill_args );    
    
    
    
    // taxonomy / Group for portfolio
    $group_labels = array(
            'name'              => _x( 'Portfolio Group', 'taxonomy general name', 'gtpe' ),
            'singular_name'     => _x( 'Portfolio Group', 'taxonomy singular name', 'gtpe' ),
            'search_items'      => __( 'Search Group', 'gtpe' ),
            'all_items'         => __( 'All Groups', 'gtpe' ),
            'parent_item'       => __( 'Parent Group', 'gtpe' ),
            'parent_item_colon' => __( 'Parent Group:', 'gtpe' ),
            'edit_item'         => __( 'Edit Group', 'gtpe' ),
            'update_item'       => __( 'Update Group', 'gtpe' ),
            'add_new_item'      => __( 'Add New Group', 'gtpe' ),
            'new_item_name'     => __( 'New Group Name', 'gtpe' ),
            'menu_name'         => __( 'Portfolio Groups', 'gtpe' ),
    );

    $group_args = array(
            'hierarchical'      => true,
            'labels'            => $group_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'portfolio-group' ),
    );

    register_taxonomy( 'portfolio_group', array( 'gopathemes_portfolio' ), $group_args );     
    
    
}



/**
 * Custom Post Type for Clients
 */
add_action('init', 'gopathemes_cpt_clients');
function gopathemes_cpt_clients() {
    
    $pt_labels = array (
            'name'                  => __('Clients', 'gtpe'),
            'singular_name'         => __('Client', 'gtpe'),
            'menu_name'             => __('Clients', 'gtpe'),
            'add_new'               => __('Add Client', 'gtpe'),
            'add_new_item'          => __('Add New Client', 'gtpe'),
            'edit'                  => __('Edit', 'gtpe'),
            'edit_item'             => __('Edit Client', 'gtpe'),
            'new_item'              => __('New Client', 'gtpe'),
            'view'                  => __('View Client', 'gtpe'),
            'view_item'             => __('View Client', 'gtpe'),
            'search_items'          => __('Search Clients', 'gtpe'),
            'not_found'             => __('No Clients Found', 'gtpe'),
            'not_found_in_trash'    => __('No Clients Found in Trash', 'gtpe'),
            'parent'                => __('Parent Client', 'gtpe'),
    );
    
    $pt_args = array(
            'label'                 => __('Clients', 'gtpe'),
            'description'           => '',
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => true,
            'rewrite'               => array('slug' => 'clients', 'with_front' => true),
            'query_var'             => true,
            'exclude_from_search'   => true,
            'supports'              => array('title'),
            'labels'                => $pt_labels
    );
    
    register_post_type('gopathemes_clients', $pt_args); 
    
    
    // taxonomy for clients
    $tax_labels = array(
            'name'              => _x( 'Client Categories', 'taxonomy general name', 'gtpe' ),
            'singular_name'     => _x( 'Client Category', 'taxonomy singular name', 'gtpe' ),
            'search_items'      => __( 'Search Categories', 'gtpe' ),
            'all_items'         => __( 'All Categories', 'gtpe' ),
            'parent_item'       => __( 'Parent Category', 'gtpe' ),
            'parent_item_colon' => __( 'Parent Category:', 'gtpe' ),
            'edit_item'         => __( 'Edit Category', 'gtpe' ),
            'update_item'       => __( 'Update Category', 'gtpe' ),
            'add_new_item'      => __( 'Add New Category', 'gtpe' ),
            'new_item_name'     => __( 'New Category Name', 'gtpe' ),
            'menu_name'         => __( 'Client Categories', 'gtpe' ),
    );

    $tax_args = array(
            'hierarchical'      => true,
            'labels'            => $tax_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'client-category' ),
    );

    register_taxonomy( 'client_category', array( 'gopathemes_clients' ), $tax_args );     
    
    
}




function gopathemes_change_placeholder( $title ){
     $screen = get_current_screen();
 
     if  ( $screen->post_type == 'gopathemes_testimonials' ) {
          return 'Client name';
     }
     if  ( $screen->post_type == 'gopathemes_clients' ) {
          return 'Company name';
     }
}
 
add_filter( 'enter_title_here', 'gopathemes_change_placeholder' );