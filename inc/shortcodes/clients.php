<?php
/*
 *      Client Slider Shortcode
 * --------------------------------------------------------
 *      @author      GopaThemes
 *      @link        http://www.gopathemes.com
 *      @link        http://themeforest.net/user/gopathemes
 *      @copyright   Copyright (c) GopaThemes
 * --------------------------------------------------------
 *      This file contains functions for Clients Slider
 * --------------------------------------------------------
 * 
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function gopathemes_clients($atts) {


    extract(shortcode_atts(array(
                        'show_from'         => '',
                        'clients_order'     => 'ASC',
                        'limit'             => -1,
                        'slidestoshow'      => '',
                        'slidestoscroll'    => '', 
                        'dots'              => '',
                        'arrows'            => ''
    ), $atts));

    $show_from = ( $show_from != 0 ) ? array(array( 'taxonomy' => 'client_category', 'field' => 'term_id', 'terms' => $show_from)) : '';
    
    $args = array('post_type' => 'gopathemes_clients', 'order' => $clients_order, 'tax_query' => $show_from,  'posts_per_page' => $limit);

    $clients = new WP_Query($args);

    $data = '';
    
    if( $clients->have_posts() ):  

        ob_start();
    
        ?>
        <div class="gopathemes-slider" data-slick='{
                                            "slidesToShow": <?php echo ($slidestoshow !== '') ? $slidestoshow : 1; ?>, 
                                            "slidesToScroll": <?php echo ($slidestoscroll !== '') ? $slidestoscroll : 1; ?>, 
                                            "arrows": <?php echo ( $arrows !== '' ) ? $arrows : 'false'; ?>, 
                                            "dots" : <?php echo ( $dots !== '' ) ? $dots : 'false'; ?>}'>
        <?php
        while ( $clients->have_posts() ) : $clients->the_post();

            

            $img_src = get_post_meta( get_the_ID(), 'gopathemes_client_logo', true );
            $img = ( !empty($img_src) ) ? '<img src="'.$img_src.'" alt="'.get_the_title().'">' : '';

            ?>
                <div><?php echo $img; ?></div>        
            <?php
        
        endwhile;
        ?>
        </div>
        <?php
        $data = ob_get_contents();
        ob_end_clean();
    endif;
    wp_reset_postdata();
    return $data;

}




function gopathemes_register_clients_shortcode(){

    if( function_exists('vc_map') ) {
    
        $categories = get_categories( 'taxonomy=client_category' );
        $cat_array = array('Select Category' => '0');
        foreach( $categories as $cat ){
            $cat_array[$cat->name] =  $cat->term_id;
        }   
        
        vc_map( 
            array(
                "name" => __("Clients Slider", "gtpe"),
                "base" => "gt_clients",
                "class" => "",
                "icon" => get_template_directory_uri() . "/img/vc_icons/clients.png",
                "description" => __( 'Shows your Clients / Partners logos.', 'gtpe' ),
                "category" => __( 'One Page Elements', 'gtpe' ),
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
                      "heading" => __("Number of Clients to show", 'gtpe'),
                      "param_name" => "limit",
                      "value" => '',
                      "description" => __('Leave blank for no limit', 'gtpe')
                   ),

                   // Order
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Order by", 'gtpe'),
                      "param_name" => "clients_order",
                      "value" => array(__('Ascending order', 'gtpe') => 'ASC', __('Descending order', 'gtpe') => 'DESC'),
                      //"description" => __('Leave blank for no limit', 'gtpe')
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

    add_shortcode('gt_clients', 'gopathemes_clients');
}

add_action('init', 'gopathemes_register_clients_shortcode', 9999);
    
    