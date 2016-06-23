<?php
/*
 *      Portfolio Shortcode File
 * --------------------------------------------------------
 *      @author      GopaThemes
 *      @link        http://www.gopathemes.com
 *      @link        http://themeforest.net/user/GopaThemes
 *      @copyright   Copyright (c) GopaThemes
 * --------------------------------------------------------
 *      This file contains functions for Portfolio section
 * --------------------------------------------------------
 * 
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
function gopathemes_portfolio($atts) {


    extract(shortcode_atts(array(
                        'cols'                          => 5,
                        'bandw'                         => 'enable', 
                        'show_filter_menu'              => '',
                        'filter_menu_position'          => 'center',
                        'show_from'                     => '',
                        'order'                         => 'ASC',
                        'style'                         => 'default',
                        'limit'                         => -1
    ), $atts));

    $show_from = ( $show_from != 0 ) ? array(array( 'taxonomy' => 'portfolio_group', 'field' => 'term_id', 'terms' => $show_from)) : '';
    
    
    
    $args = array('post_type'       => 'gopathemes_portfolio', 
                  'order'           => $order, 
                  'tax_query'       => $show_from,  
                  'posts_per_page'  => $limit);

    $portfolio = new WP_Query($args);
    
    $unique_id = gopathemes_RandomString();

    $data = '';
    
    ob_start();
    
    if($show_filter_menu != 'no'){
        ?>

        <!-- filterable menu -->
        <ul class="portfolio-filters <?php echo $style.' '.$filter_menu_position; ?> clearfix" data-portfolio-filters="<?php echo $unique_id; ?>">
            <li><a href="#" class="active" data-filter="*"><?php echo __('Show All', 'gtpe'); ?></a></li>
            <?php
            if ( $portfolio->have_posts() ) {
                $filter_array = array();
                while ( $portfolio->have_posts() ){ $portfolio->the_post();

                    $terms = get_the_terms( get_the_ID(), 'pitem_category' );

                    if ( $terms && ! is_wp_error( $terms ) ) :
                            foreach ( $terms as $term ) {
                                    $filter_array[] = array('slug'=>$term->slug, 'name' => $term->name);
                            }
                    endif; 

                }
                                   // exit();
                $filters = arrayUnique($filter_array);
                if( !empty( $filters ) ) {
                    foreach( $filters as $filter ){

            ?>
                <li><a href="#" data-filter=".<?php echo $filter['slug']; ?>"><?php echo $filter['name']; ?></a></li>
            <?php   

                    }     
                }
            }
            ?>
        </ul>                                       

            <div class="clearfix"></div>
        <?php
    }

    if( $portfolio->have_posts() ) { ?> 
        <div class="portfolio-isotope <?php echo $style ?>" data-portfolio-cols="<?php echo $cols; ?>" data-portfolio="<?php echo $unique_id; ?>">
        <?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
            
                <?php 
                if ( get_option('permalink_structure') ) {
                    $ajax_url = get_the_permalink().'?op_item=1';
                } else {
                    $ajax_url = get_the_permalink().'&op_item=1';
                }
                ?>
                <figure class="work-item <?php print_pitem_cats(get_the_ID()); ?>">
                        <a href="<?php the_permalink(); ?>"
                                <?php echo ($bandw == 'enable') ? ' data-black-and-white="true"' : ''; ?>>
                                <?php 
                                    if ( has_post_thumbnail(get_the_ID())) {
                                        the_post_thumbnail( 'haira-portfolio-thumb' ); 
                                    } else {
                                        $show_slider = get_post_meta( get_the_ID(), 'show_portfolio_slider', TRUE);
                                        $images = get_post_meta( get_the_ID(), 'gopathemes_project_images', TRUE );
                                        $images_ids = explode(',', $images);
                                        
                                        $thumb_id = ( $show_slider == 'on' && !empty( $images_ids ) ) ? $images_ids[0] : '';
                                        $img = wp_get_attachment_image( $thumb_id, 'haira-portfolio-thumb');
                                        echo $img;
                                    }
                                
                                
                                ?>
                                <span class="hover"></span>
                        </a>
                        <figcaption>
                                <a href="<?php the_permalink(); ?>">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo substr(wp_strip_all_tags(get_the_content(), true), 0, 60).'...'; ?></p>
                                </a>
                        </figcaption>
                </figure> 
                
        <?php endwhile; ?>
        </div>
        <?php
    } else {
        ?>
            
        <p><?php echo __('No Portfolio Items Found', 'gtpe'); ?></p>
            
        <?php
    }
    
    $data = ob_get_contents();
    ob_end_clean();
    
    wp_reset_postdata();
    return $data;

}



function print_pitem_cats($id){
    $cats = get_the_terms($id, 'pitem_category');
    if(!empty($cats)){
        foreach($cats as $c) {
            echo $c->slug. " ";
        }
    }
}



function gopathemes_register_portfolio_shortcode(){
    
    
    if( function_exists('vc_map') ) {      
    
        $categories = get_categories( 'taxonomy=portfolio_group' );
        $cat_array = array('Select Group' => '0');
        foreach( $categories as $cat ){
            $cat_array[$cat->name] =  $cat->term_id;
        }    

        vc_map( 
            array(
                "name" => __("Portfolio", "gtpe"),
                "base" => "gt_portfolio",
                "class" => "",
                "icon" => get_template_directory_uri() . "/img/vc_icons/portfolio.png",
                "description" => __("Will display portfolio items in masonry style", "gtpe"),
                "category" => __('One Page Elements', 'gtpe'),
                "params" => array(

                   // Category
                   array(
                      "type" => "dropdown",
                      //"holder" => "div",
                      "class" => "",
                      "heading" => __("Select Category", 'gtpe'),
                      "param_name" => "show_from",
                      "value" => $cat_array,
                      //"description" => __("Description for foo param.")
                   ),  
                    
                   // Portfolio Style
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Portfolio Style", 'gtpe'),
                      "param_name" => "style",
                      "value" => array('Default' => 'default', 'Style 1' => 'style1'),
                      "description" => ''
                   ), 
                    
                   // Portfolio Columns
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Portfolio Layout", 'gtpe'),
                      "param_name" => "cols",
                      "value" => array('5 Columns' => '5', '4 Columns' => '4', '3 Columns' => '3', '2 Columns' => '2', '1 Column' => '1'),
                      "description" => ''
                   ), 

                   // Filterable menu
                   array(
                      "type" => "checkbox",
                      "class" => "",
                      "heading" => __("Show Filterable menu", 'gtpe'),
                      "param_name" => "show_filter_menu",
                      "value" => array(__('No', 'gtpe') => 'no'),
                      "description" => __("Check this box if you don't want to show filterable menu above portfolio.", "gtpe")
                   ),            

                   // Black and White Effect.
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Black and White Effect", 'gtpe'),
                      "param_name" => "bandw",
                      "value" => array(__('Enable', 'gtpe') => 'enable', __('Disable', 'gtpe') => 'disable'),
                      "description" => __("Select Disable if you want to disable black and white effect on portfolio.", "gtpe")
                   ),                     

                   // Black and White Effect.
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Filterable Menu Position", 'gtpe'),
                      "param_name" => "filter_menu_position",
                      "value" => array(__('Left', 'gtpe') => 'left', __('Right', 'gtpe') => 'right', __('Center', 'gtpe') => 'center'),
                      "description" => __("Select position of Filterable menu where you want to display the menu.", "gtpe")
                   ),                     

                   // Limit
                   array(
                      "type" => "textfield",
                      //"holder" => "div",
                      "class" => "",
                      "heading" => __("Number of Items to show", 'gtpe'),
                      "param_name" => "limit",
                      "value" => '',
                      "description" => __('Leave blank for no limit', 'gtpe')
                   ),

                   // Order
                   array(
                      "type" => "dropdown",
                      //"holder" => "div",
                      "class" => "",
                      "heading" => __("Order by", 'gtpe'),
                      "param_name" => "order",
                      "value" => array(__('Ascending order', 'gtpe') => 'ASC', __('Descending order', 'gtpe') => 'DESC'),
                      //"description" => __('Leave blank for no limit', 'gtpe')
                   ),              

                )
             ) 
        );  
    
    }
    
    
    add_shortcode('gt_portfolio', 'gopathemes_portfolio');
}

add_action('init', 'gopathemes_register_portfolio_shortcode', 9999);
    

function arrayUnique($array, $preserveKeys = false)
{
    // Unique Array for return
    $arrayRewrite = array();
    // Array with the md5 hashes
    $arrayHashes = array();
    foreach($array as $key => $item) {
        // Serialize the current element and create a md5 hash
        $hash = md5(serialize($item));
        // If the md5 didn't come up yet, add the element to
        // to arrayRewrite, otherwise drop it
        if (!isset($arrayHashes[$hash])) {
            // Save the current element hash
            $arrayHashes[$hash] = $hash;
            // Add element to the unique Array
            if ($preserveKeys) {
                $arrayRewrite[$key] = $item;
            } else {
                $arrayRewrite[] = $item;
            }
        }
    }
    return $arrayRewrite;
}



function gopathemes_RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}