<?php
/*
 *      Meta Boxes Registeration File
 * --------------------------------------------------------
 *      @author      GopaThemes
 *      @link        http://www.gopathemes.com
 *      @link        http://themeforest.net/user/gopathemes
 *      @copyright   Copyright (c) GopaThemes
 * --------------------------------------------------------
 *      This file contains functions for Meta Boxes.
 * --------------------------------------------------------
 * 
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * Initialize the custom Meta Boxes. 
 */
add_action( 'admin_init', 'gopathemes_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in demo-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function gopathemes_custom_meta_boxes() {
  
  /**
   * Meta Boxes for Services
   */
  $services_meta_boxes = array(
    'id'          => 'service_icon',
    'title'       => __( 'Service Icon', 'gtpe' ),
    'desc'        => '',
    'pages'       => array( 'gopathemes_services' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
        
      array(
        'label'       => __( 'Icon name', 'gtpe' ),
        'id'          => 'gopathemes_icon_name',
        'type'        => 'text',
        'desc'        => __( 'Select an icon name from <a href="http://zurb.com/playground/foundation-icon-fonts-3" target="_blank">http://zurb.com/playground/foundation-icon-fonts-3</a>', 'haira' )
      ),
        
    )
  );
  
  
  /**
   * Meta Boxes for Testimonials
   * 
   */
  $testi_meta_boxes = array(
    'id'          => 'testimonisls_meta_boxes',
    'title'       => __( 'Client Info', 'gtpe' ),
    'desc'        => '',
    'pages'       => array( 'gt_testimonials' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
        
      array(
        'label'       => __( 'Client Position', 'gtpe' ),
        'id'          => 'gopathemes_client_position',
        'type'        => 'text',
        'desc'        => __( 'e.g: Founder', 'gtpe' )
      ),
        
      array(
        'label'       => __( 'Website Link ( optional )', 'gtpe' ),
        'id'          => 'gopathemes_testi_weblink',
        'type'        => 'text',
        'desc'        => __( 'e.g: http://www.example.com/', 'gtpe' )
      ),
        
    )
  );
  
  
  /**
   * Meta Boxes for Portfolio
   * 
   */
  $portfolio_meta_boxes = array(
    'id'          => 'portfolio_meta_boxes',
    'title'       => __( 'Additional Info', 'gtpe' ),
    'desc'        => '',
    'pages'       => array( 'gopathemes_portfolio' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
        
      array(
        'label'       => __( 'Company / Client name', 'gtpe' ),
        'id'          => 'gopathemes_project_company_name',
        'type'        => 'text',
        'desc'        => __( 'Enter Company or client name.', 'gtpe' )
      ),
        
      array(
        'label'       => __( 'Company Website ( optional )', 'gtpe' ),
        'id'          => 'gopathemes_project_company_web',
        'type'        => 'text',
        'desc'        => __( 'Enter Company Website URL. e.g: http://www.example.com/', 'gtpe' )
      ),
        
      array(
        'label'       => __( 'Project URL', 'gtpe' ),
        'id'          => 'gopathemes_project_url',
        'type'        => 'text',
        'desc'        => __( 'Enter live or demo link/URL of the Project. e.g: http://www.example.com/project', 'gtpe' )
      ),
        
      array(
        'label'       => __( 'Show Slider', 'gtpe' ),
        'id'          => 'show_portfolio_slider',
        'type'        => 'on-off',
        'desc'        => sprintf( __( 'Shows the Image Slider when set to %s.', 'gtpe' ), '<code>on</code>' ),
        'std'         => 'off'
      ),        
        
      array(
        'label'       => __( 'Project Images', 'gtpe' ),
        'id'          => 'gopathemes_project_images',
        'type'        => 'gallery',
        'desc'        => __( 'Upload your project images for slider.', 'gtpe' ),
        'condition'   => 'show_portfolio_slider:is(on)'
      ),
        
    )
  );

  
  /**
   * Meta Boxes for Clients
   */
    $clients_meta_boxes = array(
    'id'          => 'client_info',
    'title'       => __( 'Client info', 'gtpe' ),
    'desc'        => '',
    'pages'       => array( 'gopathemes_clients' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(

                array(
                  'label'       => __( 'Upload Client logo', 'gtpe' ),
                  'id'          => 'gopathemes_client_logo',
                  'type'        => 'upload',
                  'desc'        => __( 'Please upload the client logo image. Only one image is allowed.<br><b>RECOMENDED SIZE: 200x50 pixels.</b>', 'gtpe' )
                ),

            )
    );  
    
    
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
    if ( function_exists( 'ot_register_meta_box' ) ) {
        
        
        //ot_register_meta_box( $services_meta_boxes );
        ot_register_meta_box( $testi_meta_boxes );
        ot_register_meta_box( $portfolio_meta_boxes );
        ot_register_meta_box( $clients_meta_boxes );
        
        
    }

}

