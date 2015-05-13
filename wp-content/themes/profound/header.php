<?php
/*
 * Header Section of Profound Theme.
 * 
 * @package Profound
 */
?>
<!DOCTYPE html >
<!--[if IE 6]>
<html id="ie6" <?php language_attributes() ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes() ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes() ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="parent-wrapper" class="parent-wrapper grid-col-16">
        <div id="wrapper" class="wrapper grid-col-16">
            
            <?php global $profound_options; if(!$profound_options['disable_header']): ?>
            <div class="header-bg-section clearfix">
                <div id="header-section" class="header-section grid-col-16 clearfix">
                    <div id="logo-section" class="logo-section grid-col-7 grid-float-left clearfix"><?php profound_logo() ?></div>
                    <?php // profound_social_section_show() ?>
                </div><!-- header section ends -->
                
            </div><!-- header bg section ends -->
            <?php if (!$profound_options['disable_menu']): ?>
            <div id="nav-section" class="nav-section grid-col-16 grid-float-left clearfix ">
                <div id="primarymenu-resp" class="primarymenu-resp"><span><?php _e('Menu', 'profound') ?></span><i class="mdf mdf-bars"></i></div>
                <div id="primarymenu-section" class="primarymenu-section nav"><?php profound_nav() ?></div>
            </div>
            <?php endif; ?>

            <?php endif; ?>
                        
            <div id="main-section" class="main-section grid-col-16 clearfix">