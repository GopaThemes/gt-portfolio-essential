<?php
include_once plugin_dir_path(__FILE__) . 'scssphp/scss.inc.php';
use Leafo\ScssPhp\Compiler;

/**
*---------------------------------------------------- 
*       Generate and Save Custom Styling /Sking
*---------------------------------------------------- 
*/

function gopathemes_save_custom_css(){
        
        if (!function_exists('ot_get_option')) {
                return;
        }
        
        /* CUSTOM COLOR STYLING */
        if (ot_get_option('haira_custom_styling', 'off') == 'on') {

                $primary_color      = ot_get_option('haira_primary_color','#FFBA00');
                $secondary_color    = ot_get_option( 'haira_secondary_color', '#333333' );
                $body_bg            = ot_get_option( 'haira_body_background', '#f6f6f6' );
                
                $body_font = ot_get_option('haira_body_font', 
                        array(
                                'font-family' => "source-sans-pro, sans-serif", 
                                'font-color' => '#8a8a8a', 
                                'font-size' => '14px',
                                'line-height' => '24px',
                                'font-weight' => '400'
                        ));
                
                $heading_font = ot_get_option('haira_heading_font', 
                        array(
                                'font-family' => "source-sans-pro, sans-serif", 
                                'font-color' => '#333333', 
                                'font-weight' => '700'
                        ));
                

                $variables = array(
                    'primary-color' => $primary_color,
                    'second-color' => $secondary_color,
                    'bg-color' => $body_bg,
                    
                    'heading-color' => $heading_font['font-color'],
                    'heading-font' => $heading_font['font-family'],
                    'hweight' => $heading_font['font-weight'],
                    
                    'text-color' => $body_font['font-color'],
                    'body-font' => $body_font['font-family'],
                    'fsize' => $body_font['font-size'],
                    'lheight' => $body_font['line-height'],
                    'bweight' => $body_font['font-weight']
                );


                $default_vars = file( get_template_directory().'/scss/_vars.scss' );
                
                gopathemes_compile_css( haira_setup_scss_vars($default_vars, $variables) );
        }
    
}
add_action('ot_after_theme_options_save', 'gopathemes_save_custom_css');




function gopathemes_compile_css( $variables ) {
    
    try {
        $scss       = new Compiler();
        $scss->setImportPaths( get_template_directory().'/scss/' );
        
        $scss_code  = str_replace('@import "vars";', $variables, file_get_contents(get_template_directory().'/scss/master.scss'));
        $css        = $scss->compile($scss_code);
        
        file_put_contents(get_template_directory().'/css/custom_style.css', $css);
        
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
        
        
        
        
        
        
        // will search for 'assets/stylesheets/mixins.scss'
        
        
//        $less = new Less_Parser();
//        
//        $url = '';
//        $file = get_template_directory().'/css/custom_styling.css';
//        
//        if ( is_child_theme() ) {
//                $file = get_stylesheet_directory().'/custom_styling.css';
//                $url = get_template_directory_uri().'/haira/';
//        }
//        
//        $less->parseFile(get_template_directory().'/css/master.less', $url );
//        
//        $less->ModifyVars($variables);
//        
//        $css = $less->getCss();
//
//        file_put_contents($file, $css, LOCK_EX);
        
        
}



function haira_setup_scss_vars ($contents, $custom_vars) {
    
     //array with lines from file
    $linenum = 0;
    foreach($contents as $key=>$line)
    {
      if (preg_match('/[ ]*([\/]{2})?[ ]*(.*?):(.*?);/is', $line, $matches))
      {  
        $varName = trim(substr($matches[2], 1));
        $varValue = $matches[3];
        
        if ( isset ( $custom_vars[$varName] ) ) {
            $contents[ $key ] = '$' . $varName . ': ' . $custom_vars[ $varName ] . ";\n";
        }
        
      }
    }

    return implode($contents);

}