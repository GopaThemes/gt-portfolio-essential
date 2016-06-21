<?php
/*
 *      Testimonial Options File
 * --------------------------------------------------------
 *      @author      GopaThemes
 *      @link        http://www.gopathemes.com
 *      @link        http://themeforest.net/user/gopathemes
 *      @copyright   Copyright (c) GopaThemes
 * --------------------------------------------------------
 *      This file contains functions for Testimonial section
 * --------------------------------------------------------
 * 
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function gopathemes_testimonials($atts) {


    extract(shortcode_atts(array(
                        'show_from'         => '',
                        'testi_order'       => 'ASC',
                        'limit'             => -1,
                        'slidestoshow'      => '',
                        'slidestoscroll'    => '', 
                        'dots'              => '',
                        'arrows'            => ''
    ), $atts));

    $show_from = ( $show_from != 0 ) ? array(array( 'taxonomy' => 'testimonial_category', 'field' => 'term_id', 'terms' => $show_from)) : '';
    
    $args = array('post_type' => 'gt_testimonials', 'order' => $testi_order, 'tax_query' => $show_from,  'posts_per_page' => $limit);

    $testimonials = new WP_Query($args);

    $data = '';
    
    ob_start();
    
    
    if( $testimonials->have_posts() ) {
        ?>

        
            <div class="gopathemes-slider" data-slick='{
                                            "slidesToShow": <?php echo ($slidestoshow !== '') ? $slidestoshow : 1; ?>, 
                                            "slidesToScroll": <?php echo ($slidestoscroll !== '') ? $slidestoscroll : 1; ?>, 
                                            "arrows": <?php echo ( $arrows !== '' ) ? $arrows : 'false'; ?>, 
                                            "dots" : <?php echo ( $dots !== '' ) ? $dots : 'false'; ?>}'>
                
        <?php
            while ( $testimonials->have_posts() ) : $testimonials->the_post();
            
                $client_position = get_post_meta( get_the_ID(), 'gopathemes_client_position', true );
                $web_link = get_post_meta( get_the_ID(), 'gopathemes_testi_weblink', true );
                $client_name = ( $web_link != '' ) ? '<a href="'.$web_link.'" rel="nofollow">'.get_the_title().'</a>' : get_the_title();
         
        ?>

            <div class="testimonial"> 
                <div class="q-icon">
                    <i class="fa fa-quote-left"></i>
                </div>
                <p class="feedback">
                    <?php echo wp_strip_all_tags(get_the_content()); ?>
                </p>
                <p class="client-info">
                    <span class="client-name"><?php echo $client_name; ?></span> - <span class="client-position"><?php echo $client_position; ?></span>
                </p>

            </div>

        <?php endwhile; ?>
            
            </div>
        
        
        <?php

    } else {
        ?>
            <div class="large-12 columns">
                <p><?php echo __('No testimonials Found', 'gtpe'); ?></p>
            </div><!-- end .large-12 --> 
        <?php
    }
    
    $data = ob_get_contents();
    ob_end_clean();
    
    wp_reset_postdata();
    return $data;

}




function gopathemes_register_testimonials_shortcode(){

    if( function_exists('vc_map') ) {    
    
        $categories = get_categories( 'taxonomy=testimonial_category' );
        $cat_array = array('Select Group' => '0');
        foreach( $categories as $cat ){
            $cat_array[$cat->name] =  $cat->term_id;
        } 
        
        vc_map( 
            array(
                "name" => __("Testimonials", "gtpe"),
                "base" => "gt_testimonials",
                "class" => "",
                "icon" => get_template_directory_uri() . "/img/vc_icons/testimonial.png",
                "description" => __( 'Shows your clients feedback slider.', 'gtpe' ),
                "category" => __('One Page Elements', 'gtpe'),
                "params" => array(

                               

                   // Category
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Select Category", 'gtpe'),
                      "param_name" => "show_from",
                      "value" => $cat_array,
                   ),            

                   // Limit
                   array(
                      "type" => "textfield",
                      "class" => "",
                      "heading" => __("Number of Testimonials to show", 'gtpe'),
                      "param_name" => "limit",
                      "value" => '',
                      "description" => __('Leave blank for no limit', 'gtpe')
                   ),

                   // Order
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Order by", 'gtpe'),
                      "param_name" => "testi_order",
                      "value" => array(__('Ascending order', 'gtpe') => 'ASC', __('Descending order', 'gtpe') => 'DESC'),
                   ),
                    
                    // Slider Settings
                   array(
                      "type" => "textfield",
                      "class" => "",
                      "heading" => __("Slides To Show", 'gtpe'),
                      "param_name" => "slidestoshow",
                      "std" => '1',
                       "description" => __('# of slides to show', 'gtpe'),
                      'group' => __( 'Slider Settings', 'gtpe' ),
                   ),
                    
                   array(
                      "type" => "textfield",
                      "class" => "",
                      "heading" => __("Slides To Scroll", 'gtpe'),
                      "param_name" => "slidestoscroll",
                      "std" => '1',
                      "description" => __('# of slides to scroll', 'gtpe'),
                      'group' => __( 'Slider Settings', 'gtpe' ),
                   ),
                    
                   array(
                      "type" => "checkbox",
                      "class" => "",
                      "heading" => __("Dots", 'gtpe'),
                      "param_name" => "dots",
                      "value" => array(__('Yes', 'gtpe') => 'true'),
                      'std' => 'true',
                      "description" => __('Show dot indicators', 'gtpe'),
                      'group' => __( 'Slider Settings', 'gtpe' ),
                   ),
                    
                   array(
                      "type" => "checkbox",
                      "class" => "",
                      "heading" => __("Arrows", 'gtpe'),
                      "param_name" => "arrows",
                      "value" => array(__('Yes', 'gtpe') => 'true'),
                      "description" => __('Show Prev/Next Arrows', 'gtpe'),
                      'group' => __( 'Slider Settings', 'gtpe' ),
                   ),

                )
             ) 
        );
    
    }
    
    add_shortcode('gt_testimonials', 'gopathemes_testimonials');
}

add_action('init', 'gopathemes_register_testimonials_shortcode', 9999);
    
if (class_exists('WPBakeryShortCode')) {
    
    class WPBakeryShortCode_Testimonials extends WPBakeryShortCode {
    } 
    
}
   