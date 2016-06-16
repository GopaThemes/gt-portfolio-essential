<?php
/*
 *      haira - Service Options File
 * --------------------------------------------------------
 *      @author      hi5place
 *      @link        http://themeforest.net/user/hi5place
 *      @copyright   Copyright (c) hi5place
 * --------------------------------------------------------
 *      This file contains functions for Service section
 * --------------------------------------------------------
 * 
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function haira_content_box($atts) {


    extract(shortcode_atts(array(
                        'icon_name'     => 'ion-lightbulb',
                        'title'         => '',
                        'desc'          => '',
                        'box_style'     => 'service'
    ), $atts));


    $data = '';
    ob_start();
    ?>

        <div class="<?php echo $box_style; ?>">
                <div class="icon">
                        <i class="<?php echo $icon_name ?>"></i>
                </div>
                <h3><?php echo($title); ?></h3>
                <p><?php echo $desc; ?></p>
        </div><!-- end .content-box -->
    <?php


    $data = ob_get_contents();
    ob_end_clean();

    return $data;

}
add_shortcode('content_box', 'haira_content_box');



function register_content_box_shortcode(){

    if( function_exists('vc_map') ) {
    
        vc_map( 
            array(
                "name" => __("Content Box", "haira"),
                "base" => "content_box",
                "class" => "",
                "icon" => get_template_directory_uri() . "/img/vc_icons/content-box.png",
                "description" => __( 'Content Box / Icon Box', 'haira' ),
                "category" => __('One Page Elements', 'haira'),
                "params" => array(


                   // Services Title
                   array(
                      "type" => "textfield",
                      "class" => "",
                      "holder" => "div",
                      "heading" => __("Title", 'haira'),
                      "param_name" => "title",
                      "value" => '',
                      "description" => __("Enter a title for content. e.g: Web Design", "haira")
                   ), 

                   // Services Description
                   array(
                      "type" => "textarea_html",
                      "class" => "",
                      "holder" => "div",
                      "heading" => __("Description", 'haira'),
                      "param_name" => "desc",
                      "value" => 'Singulis vidisse eiusmod quorum domesticarum cillum cohaerescant cupidatat ullamco concursionibus ita ubi expetendis singulis.',
                      "description" => ''
                   ), 

                   // Service Icon
                   array(
                      "type" => "textfield",
                      "class" => "",
                      "heading" => __("Icon name", 'haira'),
                      "param_name" => "icon_name",
                      "value" => '',
                      "description" => __( 'Select an icon name from ionicons.com: <b>http://ionicons.com/</b>', 'haira' )
                   ),            

                   // Service Style
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Box Style", 'haira'),
                      "param_name" => "box_style",
                      "value" => array('Default' => 'service', 'Style 2' => 'content-box', 'Style 3' => 'content-box style2', 'Style 4' => 'content-box style3', 'Style 5' => 'content-box style4'),
                      "description" => ''
                   )          


                )
             ) 
        );    
    
    }
    
    
}

add_action('vc_before_init', 'register_content_box_shortcode');




function haira_services($atts) {


    extract(shortcode_atts(array(
                        'icon_name'     => 'lightbulb',
                        'title'         => '',
                        'desc'          => '',
                        'service_style' => 'service',
                        'link_to'       => ''
    ), $atts));


    $data = '';
    ob_start();
    ?>

        <div class="<?php echo $service_style; ?>">
                <div class="icon">
                        <i class="<?php echo $icon_name ?>"></i>
                </div>
                <h3><?php echo($title); ?></h3>
                <p><?php echo $desc; ?></p>
        </div><!-- end .content-box -->
    <?php


    $data = ob_get_contents();
    ob_end_clean();

    return $data;

}
add_shortcode('service', 'haira_services');
    
    