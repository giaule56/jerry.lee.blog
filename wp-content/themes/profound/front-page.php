<?php
/**
 * The frontpage file.
 * 
 * @package Profound
 */
?>

<?php 
    
    if(get_option('show_on_front') == 'page'):
    
        get_template_part('page');

    else :
        
        get_header();
    
        profound_cta_section_show();

        get_template_part('content', 'blog');
        
        get_footer();

    endif;
?>