<?php
/*
 *      haira - Masonry Blog Options File
 * --------------------------------------------------------
 *      @author      hi5place
 *      @link        http://themeforest.net/user/hi5place
 *      @copyright   Copyright (c) hi5place
 * --------------------------------------------------------
 *      This file contains functions for Masonry Blog section
 * --------------------------------------------------------
 * 
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function haira_blog_masonry($atts) {


    extract(shortcode_atts(array(
                        'show_filter_menu'  => '',
                        'show_more_button'  => '',
                        'show_from'         => '',
                        'order'             => 'DESC',
                        'ignore_sticky'     => 1,
                        'limit'             => 10
    ), $atts));

    $args = array(
                'post_type'             => 'post', 
                'order'                 => $order, 
                'cat'                   => $show_from,  
                'posts_per_page'        => $limit,
                'ignore_sticky_posts'   => $ignore_sticky 
            );

    query_posts($args);

    $data = '';
    
    ob_start();
    
    if($show_filter_menu != 'no'){
        ?>
            <div class="large-12 columns">                
                <!-- filterable menu -->
                <div class="text-center">
                    <ul id="icategories" class="clearfix">
                        <li><a href="#" class="active" data-filter="*"><?php echo __('Show All', 'haira'); ?></a></li>
                        <?php
                            $filters = get_categories();
                            foreach( $filters as $filter ){
                                                     
                        ?>
                            <li><a href="#" data-filter=".<?php echo $filter->slug; ?>"><?php echo $filter->name; ?></a></li>
                        <?php } ?>
                    </ul>                        
                </div>             
                
            </div><!-- end .large-12 --> 
            <div class="clearfix"></div>
        <?php
    }
    
    if( have_posts() ) { ?> 
        <div class="row blog-masonry-archive">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <div class="medium-6 large-4 columns isotope-item <?php print_post_cats( get_the_ID() ); ?>">
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-entry clearfix'); ?>>
                    <?php
                        if(has_post_thumbnail()){
                            the_post_thumbnail('masonry-blog-thumb', array( 'class'	=> "featured"));
                        }
                    ?>
                    <header>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                    <footer>
                        <a href="<?php the_permalink(); ?>" class="right read_more">Read More <i class="fi-arrow-right"></i></a>
                    </footer>
                </article>
            </div>  
        
        <?php endwhile; ?>
        </div>
            
        <?php if( $show_more_button != 'no' ) { ?>    
            <div class="row blog-load-ctn">
                <div class="large-12 columns text-center">
                    <a href="#" class="button" id="load-more-posts" 
                       data-nomore-text="<?php echo __('No more posts', 'haira'); ?>"
                       data-url="<?php echo get_template_directory_uri(); ?>"
                       data-loaded="<?php echo $limit; ?>" 
                       data-order="<?php echo $order; ?>" 
                       data-cat="<?php echo $show_from; ?>"><?php echo __('More', 'haira'); ?></a>
                </div>                    
            </div>   
        <?php } ?>
            
    <?php } else { ?>
            
            <div class="large-12 columns">
                <p><?php echo __('No Posts Found', 'haira'); ?></p>
            </div><!-- end .large-12 --> 
            
        <?php
    }
    
    $data = ob_get_contents();
    ob_end_clean();
    
    wp_reset_query();
    return $data;

}

function print_post_cats($id){
    
    $post_categories = wp_get_post_categories( $id );
    if( !empty( $post_categories ) ){
        foreach($post_categories as $c){
                $cat = get_category( $c );
                echo $cat->slug . " ";
        }
    }
    
}


function register_blog_masonry_shortcode(){
    
    if( function_exists('vc_map') ) {
    
    
        $categories = get_categories( 'taxonomy=category' );
        $cat_array = array('Select Category' => '0');
        foreach( $categories as $cat ){
            $cat_array[$cat->name] =  $cat->term_id;
        }    

        vc_map( 
            array(
                "name" => __("Masonry Blog", "haira"),
                "base" => "blog_masonry",
                "class" => "",
                "icon" => get_template_directory_uri() . "/img/vc_icons/blog.png",
                "description" => __( 'Shows the Blog posts in masonry style.', 'haira' ),
                "category" => __('One Page Elements', 'haira'),
                "params" => array(

                   // Category
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Select Category", 'haira'),
                      "param_name" => "show_from",
                      "value" => $cat_array,
                      //"description" => __("Description for foo param.")
                   ), 

                   // Filterable menu
                   array(
                      "type" => "checkbox",
                      "class" => "",
                      "heading" => __("Show Advance Filterable menu", 'haira'),
                      "param_name" => "show_filter_menu",
                      "value" => array(__('No', 'haira') => 'no'),
                      "description" => __("Check this box if you don't want to show filterable menu above posts.")
                   ),                 

                   // Limit
                   array(
                      "type" => "textfield",
                      "class" => "",
                      "heading" => __("Number of Posts to show", 'haira'),
                      "param_name" => "limit",
                      "value" => '',
                      "description" => __('Leave blank for no limit', 'haira')
                   ),


                   // Show more button
                   array(
                      "type" => "checkbox",
                      "class" => "",
                      "heading" => __("Show More button", 'haira'),
                      "param_name" => "show_more_button",
                      "value" => array(__('No', 'haira') => 'no'),
                      "description" => __("Check this box if you don't want to show More button to load more posts.")
                   ),                

                   // Order
                   array(
                      "type" => "dropdown",
                      "class" => "",
                      "heading" => __("Order by", 'haira'),
                      "param_name" => "order",
                      "value" => array('Default' => '', __('Ascending order', 'haira') => 'ASC', __('Descending order', 'haira') => 'DESC'),
                      //"description" => __('Leave blank for no limit', 'haira')
                   ),


                   // Ignore sticky
                   array(
                      "type" => "checkbox",
                      "class" => "",
                      "heading" => __("Ignore Sticky posts", 'haira'),
                      "param_name" => "ignore_sticky",
                      "value" => array(__('No', 'haira') => '0'),
                      "description" => __("Check this box if you don't want to remove sticky posts from the beginning.")
                   ),                 

                )
             ) 
        );    
    
    }
    
    
    add_shortcode('blog_masonry', 'haira_blog_masonry');
}

add_action('init', 'register_blog_masonry_shortcode');
    
    