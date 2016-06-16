<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
// [bartag foo="foo-value"]
function gt_button_shortcode( $atts, $content=null ) {
    extract(shortcode_atts( array(
        'type'          => 'link',
        'class'         => 'btn-primary',
        'style'         => '',
        'border'        => '',
        'size'          => '',
        'make_block'    => '',
        'link'          => '',
        'rel'           => '',
        'new_window'    => '',
        'extra_class'   => ''
    ), $atts ));

    $tag = ( $type == 'link' ) ? 'a' : 'button';
    
    $make_block = ( $make_block != '' ) ? 'btn-block' : '';
    
    $href_attr = ( $type == 'link' && $link != '' ) ? ' href="'.$link.'"' : '';
    $rel_attr = ( $type == 'link' && $rel != '' ) ? ' rel="'.$rel.'"' : '';
    $target = ( $type == 'link' && $new_window != '' ) ? ' target="_blank"' : '';
    
    $class_content = trim(preg_replace('/\s+/', ' ', ($class .' '. $size.' '.$make_block.' '.$style.' '.$border.' '.$extra_class)));
    
    ob_start();
    
    ?>
        <<?php echo $tag ?> class="btn <?php echo $class_content; ?>"<?php echo $href_attr.$rel_attr.$target; ?>><?php echo $content; ?></<?php echo $tag ?>>
    <?php
    
    return ob_get_clean();
}
add_shortcode( 'gt_button', 'gt_button_shortcode' );