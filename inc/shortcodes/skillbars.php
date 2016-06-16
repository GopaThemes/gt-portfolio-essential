<?php
/*
 *      Skillbars Options File
 * --------------------------------------------------------
 *      @author      GopaThemes
 *      @link        http://themeforest.net/user/gopathemes
 *      @link        http://www.gopathemes
 *      @copyright   Copyright (c) GopaThemes
 * --------------------------------------------------------
 *      This file contains functions for Skillbars
 * --------------------------------------------------------
 * 
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
function gopathemes_skillbars($atts) {


    extract(shortcode_atts(array(
                        'skill_values'      => ''
    ), $atts));


    $data = '';
    ob_start();
    $skills = explode(",", $skill_values);
    if( !empty( $skills ) ){
        
        foreach ( $skills as $skill ){
            $skill_raw = explode("|", $skill);
        ?>
            <p class="skill-name" title="<?php echo $skill_raw[0]; ?>%"><?php echo $skill_raw[1]; ?></p>
            <!--<div class="progress"> 
                <span class="meter" style="width: <?php echo $skill_raw[0]; ?>%;"></span> 
            </div>-->
            
            <div class="progress progress-bar-default">
                <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="<?php echo $skill_raw[0]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $skill_raw[0]; ?>%;">
                    <span class="sr-only"><?php echo $skill_raw[0]; ?>%</span>
                </div>
            </div>
            
        <?php
        }
            
    }
    
    $data = ob_get_contents();
    ob_end_clean();
    return $data;

}


function gopathemes_register_skillbars_shortcode(){
    

    if( function_exists('vc_map') ) {
    
        vc_map( 
            array(
                "name" => __("Skill bars", "gtpe"),
                "base" => "gt_skillbars",
                "class" => "",
                "icon" => get_template_directory_uri() . "/img/vc_icons/skills_bar.png",
                "description" => __( 'This will display skill bars.', 'gtpe' ),
                "category" => __('One Page Elements', 'gtpe'),
                "params" => array(

                   array(
                      "type" => "exploded_textarea",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __("Skill Values", 'gtpe'),
                      "param_name" => "skill_values",
                      "value" => '90|WordPress'."\n"
                                  . '80|PHP'."\n"
                                  . '100|HTML5',
                   ),



                )
             ) 
        );    
    
    }
    
    add_shortcode('gt_skillbars', 'gopathemes_skillbars');
}

add_action('init', 'gopathemes_register_skillbars_shortcode');
    
    