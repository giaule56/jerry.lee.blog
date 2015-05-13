<?php
/**
 * mudThemes Options Panel
 */

if(!class_exists('Mudthemes_Options_Panel')):

class Mudthemes_Options_Panel {
    
    /**
     * This must be the name of the theme.
     * 
     * @internal Used to interact with database.
     * @var string
     */
    public $options_name;

    /**
     * Theme Name
     * 
     * @internal For display purpose only.
     * @var string
     */
    private $_theme_name;
    
    /**
     * Theme Version
     * 
     * @var string
     */
    private $_theme_version;
    
    /**
     * Theme (pro version) URL
     * 
     * @var string
     */
    private $_theme_pro_url;

    /**
     * Theme documentation URL
     * 
     * @var string
     */
    private $_theme_docs_url;

    /**
     * Theme support URL
     * 
     * @var string
     */
    private $_theme_support_url;

    /**
     * Theme contact URL
     * 
     * @var string
     */
    private $_theme_contact_url;

    /**
     * Hook suffix for options page.
     * 
     * @var string
     */
    private $_hook_suffix;
    
    /**
     * Assets/admin URL
     * 
     * @var string
     */
    public $assets_url;
    
    /**
     * Default theme options as specified in
     * options.php file
     * 
     * @internal Contains the default options
     * @var array
     */
    public $theme_default_options;

    /**
     * Theme options saved in DB or false.
     * 
     * @internal Contains options fetched from database.
     * @var mixed
     */
    public $theme_saved_options;

    /**
     * Constructor functions initializes most
     * variables used in the Class.
     */
    public function __construct() {
        $this->_set_class_vars();
    }

    /**
     * Builds the Options panel and saves settings
     * in the database.
     * 
     * If user cannot 'edit_theme_options' then this
     * method performs nothings.
     */
    public function init(){
        if( current_user_can( 'edit_theme_options' )):
            add_action( 'admin_menu', array($this, 'setup_page'));
            add_action( 'admin_init', array($this, 'setup_settings'));
        endif;
    }
    
    /**
     * Initializes class variables.
     */
    private function _set_class_vars() {
        $this->_set_theme_vars();
        $this->_get_options_file();
        $this->_set_default_options();
        $this->_set_saved_options();
    }
    
    /**
     * Setter method for many class variabls.
     */
    private function _set_theme_vars(){
        $this->_theme_name = profound_get_theme_defaults('theme_name');
        $this->_theme_version = profound_get_theme_defaults('theme_version');
        $this->_theme_pro_url = profound_get_theme_defaults('pro_url');
        $this->_theme_docs_url = profound_get_theme_defaults('docs_url');
        $this->_theme_support_url = profound_get_theme_defaults('support_url');
        $this->_theme_contact_url = profound_get_theme_defaults('contact_url');
        $this->options_name = strtolower(profound_get_theme_defaults('option_name'));
        $this->assets_url = profound_get_theme_defaults('assets_url');
    }    

    /**
     * Gets options file.
     */
    private function _get_options_file(){
        require_once dirname( __FILE__ ) . '/theme-options.php';
    }

    /**
     * Sets variable theme_default_options.
     * 
     * @internal this method can only be called after calling _get_options_file()
     */
    private function _set_default_options(){
        $this->theme_default_options = mudthemes_options_panel_options();
    }
    
    /**
     * Sets variable theme_saved_options to either
     * the value stored in database or false.
     */
    private function _set_saved_options(){
        $options = get_option($this->options_name);

        if($options){
            $this->theme_saved_options = $options;
        } else {
            $this->theme_saved_options = false;
        }
    }
    
    /**
     * Performs the following tasks:-
     * 
     * Adds theme options page to menu.
     * Enqueues styles and scripts.
     */
    public function setup_page() {
        $this->do_setup_add_menu();
        add_action( 'admin_enqueue_scripts', array($this, 'do_setup_enqueue') );
    }

    /**
     * Adds the options page to menu.
     * Hook suffix is added to the class variable.
     */
    public function do_setup_add_menu() {
        $page = add_theme_page(__('Profound Theme - Settings', 'profound'), __('Theme Options', 'profound'), 'edit_theme_options', 'profound-options', array($this,'the_view'));
        $this->_set_hook_suffix($page);
    }

    /**
     * Setter for variable hook_suffix.
     * 
     * @param string $hook
     */
    private function _set_hook_suffix($hook){
        $this->_hook_suffix = $hook;
    }

    /**
     * Registers setting in the database.
     */
    public function setup_settings() {
        register_setting( 'mudthemes_panel', $this->options_name, array($this, 'validate_settings'));
    }

    /**
     * Saves data into database after sanitization.
     * 
     * @param array $input Data from the submited form
     * @return array Data to be stored in database
     */
    public function validate_settings($input){
        $this->_get_sanitize_file();

        if(isset($_POST['reset'])){
            add_settings_error( 'mudthemes-panel-options', 'restore_defaults', __( '<i class="mdf mdf-undo"></i> Options reset', 'profound' ), 'updated fade' );
            return $this->_get_default_options();
        } else {
            add_settings_error( 'mudthemes-panel-options', 'save_options', __( '<i class="mdf mdf-check"></i> Options saved', 'profound' ), 'updated fade' );
            return $this->_get_new_options($input);
        }
    }

    /**
     * Gets sanitazation file;
     */
    private function _get_sanitize_file(){
        require_once dirname( __FILE__ ) . '/options-sanitize.php';
    }

    /**
     * Sanitizes default data from theme-options.php and
     * returns array to be stored in database.
     * 
     * @return array
     */
    public function _get_default_options() {
        $output = '';
        foreach($this->theme_default_options as $option):
            if ( ! isset( $option['id'] ) ) { continue; }
            if ( ! isset( $option['std'] ) ) { continue; }
            if ( ! isset( $option['type'] ) ) { continue; }
            
            if ( has_filter( 'mudthemes_panel_sanitize_' . $option['type'] ) ) {
                $output[$option['id']] = apply_filters( 'mudthemes_panel_sanitize_' . $option['type'], $option['std'], $option );
            }
        endforeach;
        return $output;
    }

    /**
     * Sanitizes data received from form input and returns
     * array to be stored in database.
     * 
     * @param array $input Data from submitted form
     * @return array
     */
    public function _get_new_options($input) {
        $ouput = array();
        foreach($this->theme_default_options as $option):
            if ( ! isset( $option['id'] ) ) { continue; }
            if ( ! isset( $option['type'] ) ) { continue; }
            $id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );            
            if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) { $input[$id] = false; } // Set checkbox to false if it wasn't sent in the $_POST

            if ( has_filter( 'mudthemes_panel_sanitize_' . $option['type'] ) ) {
                $ouput[$id] = apply_filters( 'mudthemes_panel_sanitize_' . $option['type'], $input[$id], $option );
            }
        endforeach;
        return $ouput;
    }

    /**
     * Enqueues scripts and styles for options only
     * for theme options page, otherwise exits.
     * 
     * @param type $hook
     * @return type
     */
    public function do_setup_enqueue($hook) {
        if($hook != $this->_hook_suffix) {
            return;
        }

        wp_enqueue_style($hook . '_options-panel', $this->assets_url . 'css/mudthemes-panel.css', false);
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script($hook . '_color-picker', $this->assets_url . 'js/colorpicker.js', array('jquery'));
        wp_enqueue_script($hook . '_mudpanel', $this->assets_url . 'js/mudpanel.js', array('jquery', 'jquery-color'));
        wp_enqueue_script($hook . '_smooth-scroll', $this->assets_url . 'js/smooth-scroll.js', array(), 2.14, TRUE);
        
        if ( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

        wp_register_script( $hook . '_media-uploader', $this->assets_url .'js/medialibrary-uploader.js', array( 'jquery' ) );
        wp_enqueue_script( $hook . '_media-uploader' );
        wp_localize_script( $hook . '_media-uploader', 'mtop_medialib_localize', array(
            'upload' => __( 'Upload', 'profound' ),
            'remove' => __( 'Remove', 'profound' )
        ));
    }

    /**
     * The form view.
     */
    public function the_view() {
        $output = '';

        $output .= '<div id="mudsettings-main-wrapper" class="wrap mudwrap">';
            $output .= '<div id="mudsettings-box-wrapper">';

                $output .= '<div id="mudsettings-header">';
                    $output .= $this->_the_view_header();
                $output .= '</div>';
                
                $output .= '<div id="mudsettings-panel">';
                    $output .= '<form action="options.php" method="post">';
                        $output .= '<div id="mudsettings-nav-wrapper">';
                            $output .= $this->_the_view_tabs();
                        $output .= '</div>';
                        $output .= '<div id="mudsettings-content-wrapper">';
                            $output .= '<div id="mudsettings-content">';
                                $output .= $this->_the_view_error();
                                echo $output; $output = '';
                                settings_fields('mudthemes_panel');
                                $output .= $this->_the_view_form();
                                $output .= $this->_the_view_submit_buttons();
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</form>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
        
        echo $output;
    }

    /**
     * The form header.
     * 
     * @return string
     */
    private function _the_view_header() {
        $output = '';
        
        $output .= '<div class="mud-header-menu">';
            $output .= '<a href="'.esc_url($this->_theme_docs_url).'" target="_blank" title="'.__('Documentation', 'profound').'"><i class="mdf mdf-edit"></i><span>'.__('Documentation', 'profound').'</span></a>';
            $output .= '<a href="'.esc_url($this->_theme_support_url).'" target="_blank" title="'.__('Support', 'profound').'"><i class="mdf mdf-user"></i><span>'.__('Support', 'profound').'</span></a>';
            $output .= '<a href="'.esc_url($this->_theme_contact_url).'" target="_blank" title="'.__('Contact us', 'profound').'"><i class="mdf mdf-envelope"></i><span>'.__('Contact us', 'profound').'</span></a>';
        $output .= '</div>';
        
        $output .= '<div class="mud-admin-logo">';
            $output .= '<span class="mud-admin-logo-text-section"><i class="mdf mdf-check-square-o"></i><span class="mud-admin-logo-text">'.esc_html(ucfirst($this->_theme_name)).'</span></span>';
            $output .= '<span class="mud-admin-version"> '.__('by', 'profound').' <a href="http://www.mudthemes.com/" target="_blank" title="mudThemes | '.__('Premium WordPress Themes', 'profound').'">mudThemes</a> | version ' . esc_html($this->_theme_version) .'</span>';
        $output .= '</div>';

        $output .= '<div class="upgrade-box">';
            $output .= '<p>';
                $output .= '<i class="mdf mdf-quote-left"></i> '. __('Upgrade to Profound Premium.', 'profound') .'<i class="mdf mdf-quote-right"></i> '. __('and get Colorful skins with 500+ Google Fonts, Full-width Layout, Multiple slides and much more. ', 'profound');
                $output .= '<a href="'.esc_url($this->_theme_pro_url).'" target="_blank" title="'.__('Download Profound Premium', 'profound').'"><span>'.__('Download Profound Premium', 'profound').'</span></a> <span class="span-header-download"> <i class="mdf mdf-check"></i></span>';
            $output .= '</p>';
        $output .= '</div>';

        return $output;
    }

    /**
     * The form menu tabs.
     * 
     * @return string
     */
    private function _the_view_tabs() {
        $output = '';

        foreach($this->theme_default_options as $value):
            if($value['type'] == 'heading'):
                $name_stripped = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['name']) );
                $jquery_click_hook = "mtop-" . $name_stripped;

                $output .= '<div class="mud-nav-tab">';
                    $output .= '<a id="'.  esc_attr( $jquery_click_hook ) . '-tab" class="mudthemes-nav" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '">';
                    $output .= '<i class="mdf mud-fa-' . esc_attr( $name_stripped ) . '"></i>';
                    $output .= '<span>' . esc_html( $value['name'] ) . '</span></a>';
                $output .= '</div>';

            endif;
        endforeach;
        
        return $output;
    }

    /**
     * The form submit buttons.
     * 
     * @return string
     */
    private function _the_view_submit_buttons() {
        $jstext = __('Click OK to reset. Any theme settings will be lost!', 'profound');
        
        $output = '';
        $output .= '</div>'; //@todo find this missing </div>
        $output .= '<div id="mtop-submit">';
        $output .= '<input type="submit" class="button-primary" name="update" value="' . __("Save Options", "profound") . '" />';
        $output .= '<input type="submit" class="reset-button button-secondary" name="reset" value="' . __("Restore Defaults", "profound") . '" onclick="return confirm( \'' . esc_js($jstext) . '\' );" />';
        
        $output .= '<div class="clear"></div>';
        $output .= '</div><!-- #mtop-submit -->';

        return $output;
    }

    /**
     * The form errors (submit/reset).
     * 
     * @internal Only displays data nothing else
     * @return string
     */
    private function _the_view_error() {
        global $allowedposttags;
        $status =  get_settings_errors('mudthemes-panel-options');
            if(!empty($status)):
                $output = '';
            
                foreach ($status as $key => $value) {
                    $output .= '<div class="mud-admin-status '. esc_attr($value['code']) .'">';
                    $output .= wp_kses($value['message'],$allowedposttags);
                    $output .= '</div>';
                    break;
                }
                return $output;
            endif;
    }

    /**
     * The form interfaces.
     * 
     * @global type $allowedposttags
     * @return string
     */
    private function _the_view_form() {
        global $allowedposttags;
        $option_name = $this->options_name;
        $entire_output = '';
        $counter = '';
        $output = '';
        
        foreach ($this->theme_default_options as $value):
         
            $counter++;

            if ( ( $value['type'] != "heading" ) && ( $value['type'] != "info" ) && ( $value['type'] != "divstart" ) && ( $value['type'] != "divend" )  ):
                $val = '';
                $explain_value = '';

                $value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );

                $id = 'section-' . $value['id'];

                $class = 'section ';

                if ( isset( $value['type'] ) ) { $class .= ' section-' . $value['type']; }

                if ( isset( $value['class'] ) ) { $class .= ' ' . $value['class']; }

                $output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '">'."\n";

                if ( isset( $value['name'] ) ) { $output .= '<h4 class="heading">' . wp_kses( $value['name'], $allowedposttags) . '</h4>' . "\n"; }

                if ( ( $value['type'] != 'editor') && ($value['type'] != 'menu_upgrade')) {
                    $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
                } else {
                    if( $value['type'] == 'menu_upgrade'){
                        $output .= '<div><div>';
                    }else {
                        $output .= '<div class="option">' . "\n" . '<div>' . "\n";
                    }
                }
            endif;

                if ( isset( $value['std'] ) ) { $val = $value['std']; }

                if ( ( $value['type'] != 'heading' ) && ( $value['type'] != 'info') ) {
                    if ( isset( $this->theme_saved_options[($value['id'])]) ) {
                        $val = $this->theme_saved_options[($value['id'])];
                        if ( !is_array($val) ) { $val = stripslashes( $val ); }
                    }
                }

                if ( isset( $value['desc'] ) ) { $explain_value = $value['desc']; }


                switch ($value['type']):
                    
                    case 'heading':
                        if ($counter >= 2) {
                            $output .= '</div>'."\n";
                        }
                        $heading_name = 'mtop-' . preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['name']) );
                        $output .= '<div class="mudthemes-resp-nav"><a href="#' . esc_attr( $heading_name ) . '">' . esc_html( $value['name'] ) . '</a></div>';
                        $output .= '<div class="group" id="' . esc_attr( $heading_name ) . '">';
                        $output .= "\n";
                        break;

                    case 'text':
                        $output .= '<input id="' . esc_attr( $value['id'] ) . '" class="mtop-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
                        break;

                    case 'textarea':
                        $rows = '8';
                        $val = stripslashes( $val );
                        $output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="mtop-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '">' . esc_textarea( $val ) . '</textarea>';
                        break;
                    
                    case 'select':
                        $output .= '<select class="mtop-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';
                        foreach ($value['options'] as $key => $option ):
                            $selected = '';
                            if ( ($val != '') && ($val == $key)) {
                                $selected = ' selected="selected"';  
                            }
                            $output .= '<option'. esc_attr($selected) .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
                        endforeach;
                        $output .= '</select>';
                        break;
                        
                    case 'radio':
                        $name = $option_name .'['. $value['id'] .']';
                        foreach ($value['options'] as $key => $option) {
                            $id = $option_name . '-' . $value['id'] .'-'. $key;
                            $output .= '<input class="mtop-input mtop-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' /><label for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label>';
                        }
                        break;
                        
                    case 'images':
                        $name = $option_name .'['. $value['id'] .']';
                        foreach ( $value['options'] as $key => $option ) {
                            $selected = '';
                            $checked = '';
                            if ( ($val != '') && ($val == $key)) {
                                $selected = ' mtop-radio-img-selected';
                                $checked = ' checked="checked"';
                            }
                            $output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="mtop-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. esc_attr($checked) .' />';
                            $output .= '<div class="mtop-radio-img-label">' . esc_html( $key ) . '</div>';
                            $output .= '<img src="' . esc_url( $option ) . '" alt="' . esc_url($option) .'" class="mtop-radio-img-img' . esc_attr($selected) .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;" />';
                        }
                        break;
                        
                    case 'checkbox':
                        $output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox mtop-input" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, 1, false) .' />';
                        $output .= '<label class="explain" for="' . esc_attr( $value['id'] ) . '">' . wp_kses( $explain_value, $allowedposttags) . '</label>';
                        break;
                    
                    case 'color':
                        $output .= '<div id="' . esc_attr( $value['id'] . '_picker' ) . '" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $val ) . '"></div></div>';
                        $output .= '<input class="mtop-color" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" type="text" value="' . esc_attr( $val ) . '" />';
                        break;
                    
                    case 'upload':
                        $class_upload = '';
                        if($val) {$class_upload = ' has-file';}
                        $output .= '<input id="' . esc_attr( $value['id'] ) . '" class="upload' . esc_attr( $class_upload ) . '" type="text" name="'. esc_attr( $option_name . '[' . $value['id'] . ']' ) .'" value="' . esc_attr( $val ) . '" placeholder="' . __('No file chosen', 'profound') .'" />' . "\n";
                        if ( function_exists( 'wp_enqueue_media' ) ) {
                            if($val == ''){
                                $output .= '<input id="upload-' . esc_attr( $value['id'] ) . '" class="upload-button button" type="button" value="' . __( 'Upload', 'profound' ) . '" />' . "\n";
                            } else {
                                $output .= '<input id="remove-' . esc_attr( $value['id'] ) . '" class="remove-file button" type="button" value="' . __( 'Remove', 'profound' ) . '" />' . "\n";
                            }
                        }
                        $output .= '<div class="screenshot" id="' . esc_attr($id) . '-image">' . "\n";
                            if ( $val != '' ) {
                                $remove = '<a class="remove-image">'.__('Remove', 'profound').'</a>';
                                $image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $val );
                                if ( $image ) {
                                    $output .= '<img src="' . esc_url($val) . '" alt="" />' . $remove;
                                }
                            }
                        $output .= '</div>' . "\n";
                        break;

                    case 'divstart':
                        $id = 'id="' . esc_attr( $value['id'] ) . '" ';
                        $output .= '<div class="subsection" ' . esc_attr($id) . '>';
                        break;

                    case 'divend':
                        $output .= '</div><!-- sub section ends -->';
                        break;

                    case 'menu_upgrade':
                        $output .= '<div class="mud-options-upgrade-box menu-upgrade-box">';
                        $output .= '<span><i class="mdf mdf-check-square-o"></i> '.__('Menu Styler is only available in Profound Premium Version', 'profound').'. <a href="'. esc_url($this->_theme_pro_url) .'" target="_blank">'.__('Upgrade now','profound').'</a> '.__('to get more menu styling options','profound').'.</span>';
                        $output .= '</div>';
                        break;

                    case 'font_upgrade':
                        $output .= '<div class="mud-options-upgrade-box font-upgrade-box">';
                        $output .= '<span><i class="mdf mdf-check-square-o"></i> '.__('Get access to 500+ Google Fonts','profound').'. <a href="'. esc_url($this->_theme_pro_url) .'" target="_blank">'.__('Upgrade Now','profound').'</a> '.__('to Profound Premium version','profound').'.</span>';
                        $output .= '</div>';
                        break;

                    case 'color_upgrade':
                        $output .= '<div class="mud-options-upgrade-box color-upgrade-box">';
                        $output .= '<span><i class="mdf mdf-check-square-o"></i> '.__('Now get more Coloring ability with', 'profound').' <a href="'. esc_url($this->_theme_pro_url) .'" target="_blank">'.__('Profound Premium version', 'profound').'</a>.</span>';
                        $output .= '</div>';
                        break;

                    case 'carousel_upgrade':
                        $output .= '<div class="mud-options-upgrade-box carousel-upgrade-box">';
                        $output .= '<span><i class="mdf mdf-check-square-o"></i> '.__('Use upto 10 different slides in a slideshow','profound').'. <a href="'. esc_url($this->_theme_pro_url) .'" target="_blank">'.__('Upgrade Now','profound').'</a> '.__('to Profound Premium version','profound').'.</span>';
                        $output .= '</div>';
                        break;

                    case 'social_upgrade':
                        $output .= '<div class="mud-options-upgrade-box social-upgrade-box">';
                        $output .= '<span><i class="mdf mdf-check-square-o"></i> '.__('For more Social Profiles','profound').'. <a href="'. esc_url($this->_theme_pro_url) .'" target="_blank">'.__('Upgrade Now','profound').'</a> '.__('to Profound Premium version','profound').'.</span>';
                        $output .= '</div>';
                        break;
                endswitch;
                
                if ( ( $value['type'] != "heading" ) && ( $value['type'] != "info" ) && ( $value['type'] != "divstart" ) && ( $value['type'] != "divend" ) ) :
                    $output .= '</div>';
                    if ( ( $value['type'] != "checkbox" ) && ( $value['type'] != "editor" ) ) {
                        $output .= '<div class="explain">' . wp_kses( $explain_value, $allowedposttags) . '</div>'."\n";
                    }
                    $output .= '</div></div>'."\n";
                endif;
        endforeach;
        
        return $output;
    }
    
    /**
     * Build default options array using the default
     * options provided in options file.
     * 
     * @return array
     */
    private function _build_default_options_array(){
        $output = array();
        
        foreach($this->theme_default_options as $options):
            if(array_key_exists('id', $options) && array_key_exists('std', $options)){
                $output[$options['id']] = $options['std'];
            }
        endforeach;
        return $output;
    }

    /**
     * Gets the options array.
     * 
     * If options exist in database then returns it,
     * otherwise returns the default options.
     * 
     * @internal Only used outside the class
     * @return array
     */
    public function get_options_array() {
        $options = get_option($this->options_name);

        if($options){
            return $this->theme_saved_options;
        } else {
            return $this->_build_default_options_array();
        }
    }
    
    /**
     * Returns google fonts.
     * 
     * @internal Only used outside the class
     * @todo See if this method can be written in a better way.
     * @static
     * @return array
     */
    public static function get_google_fonts() {
        return unserialize('a:12:{i:0;a:6:{s:4:"name";s:34:"Arial, Helvetica, "Helvetica Neue"";s:6:"family";s:10:"sans-serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:5:"Arial";s:11:"displayname";s:5:"Arial";}i:1;a:6:{s:4:"name";s:21:""Arial Black", Gadget";s:6:"family";s:10:"sans-serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:11:"Arial-Black";s:11:"displayname";s:11:"Arial Black";}i:2;a:6:{s:4:"name";s:22:""Courier New", Courier";s:6:"family";s:9:"monospace";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:11:"Courier-New";s:11:"displayname";s:11:"Courier New";}i:3;a:6:{s:4:"name";s:38:"Georgia, "Palatino Linotype", Palatino";s:6:"family";s:5:"serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:7:"Georgia";s:11:"displayname";s:7:"Georgia";}i:4;a:6:{s:4:"name";s:4:"Lato";s:6:"family";s:10:"sans-serif";s:7:"variant";s:70:"100,100italic,300,300italic,regular,italic,700,700italic,900,900italic";s:4:"type";s:15:"google-webfonts";s:9:"shortname";s:4:"lato";s:11:"displayname";s:4:"Lato";}i:5;a:6:{s:4:"name";s:38:""Lucida Sans Unicode", "Lucida Grande"";s:6:"family";s:10:"sans-serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:6:"Lucida";s:11:"displayname";s:13:"Lucida Grande";}i:6;a:6:{s:4:"name";s:9:"Open Sans";s:6:"family";s:10:"sans-serif";s:7:"variant";s:70:"300,300italic,regular,italic,600,600italic,700,700italic,800,800italic";s:4:"type";s:15:"google-webfonts";s:9:"shortname";s:8:"opensans";s:11:"displayname";s:9:"Open Sans";}i:7;a:6:{s:4:"name";s:29:""Palatino Linotype", Palatino";s:6:"family";s:5:"serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:8:"Palatino";s:11:"displayname";s:8:"Palatino";}i:8;a:6:{s:4:"name";s:14:"Tahoma, Geneva";s:6:"family";s:10:"sans-serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:6:"Tahoma";s:11:"displayname";s:6:"Tahoma";}i:9;a:6:{s:4:"name";s:24:""Times New Roman", Times";s:6:"family";s:5:"serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:5:"Times";s:11:"displayname";s:15:"Times New Roman";}i:10;a:6:{s:4:"name";s:25:""Trebuchet MS", Helvetica";s:6:"family";s:10:"sans-serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:12:"Trebuchet-MS";s:11:"displayname";s:12:"Trebuchet MS";}i:11;a:6:{s:4:"name";s:15:"Verdana, Geneva";s:6:"family";s:10:"sans-serif";s:7:"variant";b:0;s:4:"type";s:4:"open";s:9:"shortname";s:7:"Verdana";s:11:"displayname";s:7:"Verdana";}}');
    }
    
}

/**
 * Gets theme defaults
 * 
 * @param string $value
 * @return mixed (string|boolean)
 */
function profound_get_theme_defaults($value){

    $theme_obj = wp_get_theme();

    $defaults = array(
        'option_name' => 'profound',
        'theme_name' => preg_replace( "/\W/", "_", strtolower( $theme_obj ) ),
        'theme_version' => $theme_obj->get('Version'),
        'pro_url' => 'http://www.mudthemes.com/showcase/profound-theme/',
        'docs_url' => 'http://www.mudthemes.com/support/docs/profound-guide/',
        'support_url' => 'http://www.mudthemes.com/support/',
        'contact_url' => 'http://www.mudthemes.com/contact/',
        'assets_url' => get_template_directory_uri() . '/assets/admin/',
    );

    if(array_key_exists($value, $defaults)) {
        return $defaults[$value];
    } else {
        return false;
    }
}

if(!isset($Mudthemes_Options_Panel_obj)):

if(!isset($mdf_google_fonts)) {
    $mdf_google_fonts = Mudthemes_Options_Panel::get_google_fonts();
}

$Mudthemes_Options_Panel_obj = new Mudthemes_Options_Panel;

if(!isset($profound_options)) {
    $profound_options = $Mudthemes_Options_Panel_obj->get_options_array();
}

add_action('init', array($Mudthemes_Options_Panel_obj, 'init'));

endif;
endif;