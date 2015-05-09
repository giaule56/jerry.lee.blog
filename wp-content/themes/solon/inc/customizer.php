<?php
/**
 * Solon Theme Customizer
 *
 * @package Solon
 */
 
function solon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//Extends the customizer with a categories dropdown control.
	class Categories_Dropdown extends WP_Customize_Control {
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'solon' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }

	//___General___//
    $wp_customize->add_section(
        'solon_general',
        array(
            'title' => __('General', 'solon'),
            'priority' => 9,
        )
    );
	//Logo Upload
	$wp_customize->add_setting(
		'site_logo',
		array(
			'default-image' => '',
		)
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
               'label'          => __( 'Upload your logo', 'solon' ),
			   'type' 			=> 'image',
               'section'        => 'solon_general',
               'settings'       => 'site_logo',
            )
        )
    );
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default-image' => '',
		)
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon', 'solon' ),
			   'type' 			=> 'image',
               'section'        => 'solon_general',
               'settings'       => 'site_favicon',
            )
        )
    );
	$wp_customize->add_setting(
		'solon_scroller',
		array(
			'sanitize_callback' => 'solon_sanitize_checkbox',
			'default' => 0,			
		)		
	);
	$wp_customize->add_control(
		'solon_scroller',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box if you want to disable the custom scroller.', 'solon'),
			'section' => 'solon_general',
            'priority' => 9,			
		)
	);    
	//Layout
	$wp_customize->add_setting(
		'solon_layout',
		array(
			'default' => 'content-sidebar',
		)
	);
	 
	$wp_customize->add_control(
		'solon_layout',
		array(
			'type' => 'radio',
			'label' => __('Layout', 'solon'),
			'section' => 'solon_general',
			'choices' => array(
				'content-sidebar' => 'Content-Sidebar',
				'sidebar-content' => 'Sidebar-Content',
			),
		)
	);
	//Full content posts
	$wp_customize->add_setting(
		'solon_full_content',
		array(
			'sanitize_callback' => 'solon_sanitize_checkbox',
			'default' => 0,			
		)		
	);
	$wp_customize->add_control(
		'solon_full_content',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to display the full content of the posts on the home page.', 'solon'),
			'section' => 'solon_general',
            'priority' => 11,			
		)
	);	
	//___Fonts___//
    $wp_customize->add_section(
        'solon_typography',
        array(
            'title' => __('Fonts', 'solon' ),
            'priority' => 11,
        )
    );
	$font_choices = 
		array(
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',		
			'Droid Sans:400,700' => 'Droid Sans',
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Arvo:400,700,400italic,700italic' => 'Arvo',
			'Lora:400,700,400italic,700italic' => 'Lora',
			'PT Sans:400,700,400italic,700italic' => 'PT Sans',
			'PT+Sans+Narrow:400,700' => 'PT Sans Narrow',
			'Arimo:400,700,400italic,700italic' => 'Arimo',
			'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
			'Bitter:400,700,400italic' => 'Bitter',
			'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Open+Sans:400italic,700italic,400,700' => 'Open Sans',
			'Roboto:400,400italic,700,700italic' => 'Roboto',
			'Oswald:400,700' => 'Oswald',
			'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
			'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
			'Raleway:400,700' => 'Raleway',
			'Roboto Slab:400,700' => 'Roboto Slab',
			'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
			'Rokkitt:400' => 'Rokkitt',
		);
	
	$wp_customize->add_setting(
		'headings_fonts',
		array(
			'sanitize_callback' => 'solon_sanitize_fonts',
		)
	);
	
	$wp_customize->add_control(
		'headings_fonts',
		array(
			'type' => 'select',
			'label' => __('Select your desired font for the headings.', 'solon'),
			'section' => 'solon_typography',
			'choices' => $font_choices
		)
	);
	
	$wp_customize->add_setting(
		'body_fonts',
		array(
			'sanitize_callback' => 'solon_sanitize_fonts',
		)
	);
	
	$wp_customize->add_control(
		'body_fonts',
		array(
			'type' => 'select',
			'label' => __('Select your desired font for the body.', 'solon'),
			'section' => 'solon_typography',
			'choices' => $font_choices
		)
	);
	//___Slider___//
    $wp_customize->add_section(
        'solon_slider',
        array(
            'title' => __('Slider', 'solon'),
            'priority' => 12,
        )
    );
	//Display
	$wp_customize->add_setting(
		'slider_display',
		array(
			'sanitize_callback' => 'solon_sanitize_checkbox',
		)		
	);
	$wp_customize->add_control(
		'slider_display',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to display the slider.', 'solon'),
			'section' => 'solon_slider',
		)
	);
	
	//Category
	$wp_customize->add_setting( 'slider_cat', array(
		'default'        => '',
		'sanitize_callback' => 'solon_sanitize_int',
	) );
	
	$wp_customize->add_control( new Categories_Dropdown( $wp_customize, 'slider_cat', array(
		'label'   => __('Select which category to show in the slider', 'solon'),
		'section' => 'solon_slider',
		'settings'   => 'slider_cat',
	) ) );
	
	//Number of posts
	$wp_customize->add_setting(
		'slider_number',
		array(
			'default' => '6',
			'sanitize_callback' => 'solon_sanitize_int',
		)
	);
		
	$wp_customize->add_control(
		'slider_number',
		array(
			'label' => __('Enter the number of posts you want to show in the slider.', 'solon'),
			'section' => 'solon_slider',
			'type' => 'text',
		)
	);
	//Slideshow speed
	$wp_customize->add_setting(
		'slideshowspeed',
		array(
			'default' => '4000',
			'sanitize_callback' => 'solon_sanitize_int',
		)
	);
		
	$wp_customize->add_control(
		'slideshowspeed',
		array(
			'label' => __('Enter your desired slideshow speed, in miliseconds.', 'solon'),
			'section' => 'solon_slider',
			'type' => 'text',
		)
	);
	//Animation speed
	$wp_customize->add_setting(
		'animationspeed',
		array(
			'default' => '400',
			'sanitize_callback' => 'solon_sanitize_int',
		)
	);
		
	$wp_customize->add_control(
		'animationspeed',
		array(
			'label' => __('Enter your desired animation speed, in miliseconds.', 'solon'),
			'section' => 'solon_slider',
			'type' => 'text',
		)
	);	
	
	//___Single posts___//
    $wp_customize->add_section(
        'solon_singles',
        array(
            'title' => __('Single posts/pages', 'solon'),
            'priority' => 13,
        )
    );
	//Single posts
	$wp_customize->add_setting(
		'solon_post_img',
		array(
			'sanitize_callback' => 'solon_sanitize_checkbox',
		)		
	);
	$wp_customize->add_control(
		'solon_post_img',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to show featured images on single posts', 'solon'),
			'section' => 'solon_singles',
		)
	);
	//Pages
	$wp_customize->add_setting(
		'solon_page_img',
		array(
			'sanitize_callback' => 'solon_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'solon_page_img',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to show featured images on pages', 'solon'),
			'section' => 'solon_singles',
		)
	);
	//Author bio
	$wp_customize->add_setting(
		'author_bio',
		array(
			'sanitize_callback' => 'solon_sanitize_checkbox',
		)		
	);
	$wp_customize->add_control(
		'author_bio',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to display the author bio on single posts. You can add your author bio and social links on the Users screen in the Your Profile section.', 'solon'),
			'section' => 'solon_singles',
		)
	);
	//___Colors___//
	//Primary color
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'			=> '#e86f67',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label' => __('Primary color', 'solon'),
				'section' => 'colors',
				'settings' => 'primary_color',
				'priority' => 12
			)
		)
	);	
	//Secondary color
	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'			=> '#2A363B',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color',
			array(
				'label' => __('Secondary color', 'solon'),
				'section' => 'colors',
				'settings' => 'secondary_color',
				'priority' => 12
			)
		)
	);
	//Site title
	$wp_customize->add_setting(
		'site_title_color',
		array(
			'default'			=> '#2A363B',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_color',
			array(
				'label' => __('Site title', 'solon'),
				'section' => 'colors',
				'settings' => 'site_title_color',
				'priority' => 12
			)
		)
	);
	//Site description
	$wp_customize->add_setting(
		'site_desc_color',
		array(
			'default'			=> '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_desc_color',
			array(
				'label' => __('Site description', 'solon'),
				'section' => 'colors',
				'settings' => 'site_desc_color',
				'priority' => 12
			)
		)
	);
	//Entry title
	$wp_customize->add_setting(
		'entry_title_color',
		array(
			'default'			=> '#2A363B',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_title_color',
			array(
				'label' => __('Entry title', 'solon'),
				'section' => 'colors',
				'settings' => 'entry_title_color',
				'priority' => 12
			)
		)
	);	
	//Body
	$wp_customize->add_setting(
		'body_text_color',
		array(
			'default'			=> '#7B848F',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'			=> 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_text_color',
			array(
				'label' => __('Text', 'solon'),
				'section' => 'colors',
				'settings' => 'body_text_color',
				'priority' => 12
			)
		)
	);	
}
add_action( 'customize_register', 'solon_customize_register' );

/**
 * Sanitization
 */
//Checkboxes
function solon_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}
//Integers
function solon_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
//Fonts
function solon_sanitize_fonts( $input ) {
    $valid = array(
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',		
			'Droid Sans:400,700' => 'Droid Sans',
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Arvo:400,700,400italic,700italic' => 'Arvo',
			'Lora:400,700,400italic,700italic' => 'Lora',
			'PT Sans:400,700,400italic,700italic' => 'PT Sans',
			'PT+Sans+Narrow:400,700' => 'PT Sans Narrow',
			'Arimo:400,700,400italic,700italic' => 'Arimo',
			'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
			'Bitter:400,700,400italic' => 'Bitter',
			'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Open+Sans:400italic,700italic,400,700' => 'Open Sans',
			'Roboto:400,400italic,700,700italic' => 'Roboto',
			'Oswald:400,700' => 'Oswald',
			'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
			'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
			'Raleway:400,700' => 'Raleway',
			'Roboto Slab:400,700' => 'Roboto Slab',
			'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
			'Rokkitt:400' => 'Rokkitt',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function solon_customize_preview_js() {
	wp_enqueue_script( 'solon_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'solon_customize_preview_js' );
