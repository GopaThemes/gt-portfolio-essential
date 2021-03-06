<?php
/*
 *      Common Shortcodes
 * --------------------------------------------------------
 *      @author      Gopathemes
 *      @link        http://themeforest.net/user/gopathemes
 *      @link        http://www.gopathemes.com
 *      @copyright   Copyright (c) Gopathemes
 * --------------------------------------------------------
 *      This file contains common Shortcode functions 
 * --------------------------------------------------------
 * 
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}





/**
 * -------------------------------------------------
 *      Pricing Tables
 * --------------------------------------------------
 */

function haira_pricing_table($atts){
    
    extract(shortcode_atts(array(
                'name'          => '',
                'price'         => '',
                'description'   => '',
                'features'      => '',
                'btn_label'      => '',
                'btn_link'      => '',
                'featured'      => ''
    ), $atts));
    
    $data = '';
    $featured = ( $featured != '' ) ? ' featured' : '';
    ob_start();
?>
    <ul class="pricing-table<?php echo $featured; ?>"> 
        
        <?php echo ( $name != '' ) ? '<li class="title">'.$name.'</li>' : ''; ?>
        
        <?php echo ( $price != '' ) ? '<li class="price">'.$price.'</li>' : ''; ?> 
        
        <?php echo ( $description != '' ) ? '<li class="description">'.$description.'</li>' : ''; ?> 
        
        <?php 
            $features = explode(",", $features);
            if( !empty($features) ) { 
                foreach ( $features as $feature ){
            ?>
                <li class="bullet-item"><?php echo $feature; ?></li> 
            <?php
                }
            }
            
            $link = ( $btn_link != '' ) ? vc_build_link($btn_link) : '#';
            $targ = '';
            if(isset($link['target'])){
                $targ = ( $link['target'] != '' ) ? ' target="'.$link['target'].'"' : '';
            }
            if ( $btn_label != '' ){
        ?>
        
            <li class="cta-button"><a class="button round" href="<?php echo $link['url']; ?>"<?php echo $targ; ?>><?php echo $btn_label; ?></a></li> 
        
        <?php } ?>
    </ul>
<?php
    
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
    
}


function register_gopathemes_pricing_table(){
    
    if( function_exists('vc_map') ){
        vc_map( 
            array(
                "name"          => __("Pricing Table", 'gtpe'),
                "base"          => "gt_pricing_table",
                "class"         => "",
                "icon"          => get_template_directory_uri() . "/img/vc_icons/pricing.png",
                "description"   => __( 'Will display a pricing table', 'gtpe' ),
                "category"      => __('One Page Elements', 'gtpe'),
                "params"        => array(

                        // Package Name
                        array(
                           "type" => "textfield",
                           "class" => "",
                           "heading" => __("Package name", 'gtpe'),
                           "param_name" => "name",
                           "value" => '',
                           "description" => __('Enter the name of your package. <b>e.g: Standard</b>', 'gtpe')
                        ),

                        // Package Price
                        array(
                           "type" => "textfield",
                           "class" => "",
                           "heading" => __("Package price", 'gtpe'),
                           "param_name" => "price",
                           "value" => '',
                           "description" => __('Enter the price of your package. <b>e.g: $199.00</b>', 'gtpe')
                        ),

                        // Package Description
                        array(
                           "type" => "textfield",
                           "class" => "",
                           "heading" => __("Short Description", 'gtpe'),
                           "param_name" => "description",
                           "value" => '',
                           "description" => __('Enter Short Description of your package.', 'gtpe')
                        ),

                        // Package Features
                        array(
                           "type" => "exploded_textarea",
                           "class" => "",
                           "heading" => __("Package Features ( one per line )", 'gtpe'),
                           "param_name" => "features",
                           "value" => 'Feature 1'."\n"
                                    . 'Feature 2'."\n"
                                    . 'Feature 3'."\n"
                                    . 'Feature 4',
                           "description" => __('Enter features, one per line.', 'gtpe')
                        ),
                    

                        // Button text
                        array(
                           "type" => "textfield",
                           "class" => "",
                           "heading" => __("Button text", 'gtpe'),
                           "param_name" => "btn_label",
                           "value" => '',
                           "description" => __("Enter button text. <b>e.g: Buy now</b>. Leave blank if you want to hide the button.", 'gtpe')
                        ),                    

                        // Button Link
                        array(
                           "type" => "vc_link",
                           "class" => "",
                           "heading" => __("Button Link", 'gtpe'),
                           "param_name" => "btn_link",
                           "value" => 'http://',
                           //"description" => __("Leave blank if you want to hide the button.", 'gtpe')
                        ),                    

                        // Featured
                        array(
                           "type" => "checkbox",
                           "class" => "",
                           "heading" => __("Featured Package?", 'gtpe'),
                           "param_name" => "featured",
                           "value" => array('Yes' => 'yes'),
                           //"description" => __("Leave blank if you want to hide the button.", 'gtpe')
                        ),                    
                    )
                )
        );
    }
    
    add_shortcode('gt_pricing_table', 'gopathemes_pricing_table');
}

add_action('init', 'register_gopathemes_pricing_table');