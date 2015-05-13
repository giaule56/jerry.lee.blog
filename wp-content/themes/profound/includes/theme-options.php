<?php
/**
 * This file loads all the options related to Theme Options settings page.
 * 
 * @package Profound
 * @subpackage Core-Options
 * @category Options
 * @since Profound 1.0 
 */

/**
 * Defines an array of options that will be used to generate
 * the settings page and be saved in the database.
 * 
 * @internal When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * @since 1.0.0
 */
if(!function_exists('mudthemes_options_panel_options')):
function mudthemes_options_panel_options() {

        $fonts = mudthemes_options_panel_font_scut();
        $icons = array('glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper-square', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'rebel', 'ge', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb');
        $num_by_hundred = array('100'=>'100', '200'=>'200', '300'=>'300', '400'=>'400', '500'=>'500', '600'=>'600', '700'=>'700', '800'=>'800', '900'=>'900', '1000'=>'1000', '1100'=>'1100', '1200'=>'1200', '1300'=>'1300', '1400'=>'1400', '1500'=>'1500', '1600'=>'1600', '1700'=>'1700', '1800'=>'1800', '1900'=>'1900', '2000'=>'2000', '2100'=>'2100', '2200'=>'2200', '2300'=>'2300', '2400'=>'2400', '2500'=>'2500', '2600'=>'2600', '2700'=>'2700', '2800'=>'2800', '2900'=>'2900', '3000'=>'3000', '3100'=>'3100', '3200'=>'3200', '3300'=>'3300', '3400'=>'3400', '3500'=>'3500', '3600'=>'3600', '3700'=>'3700', '3800'=>'3800', '3900'=>'3900', '4000'=>'4000', '4100'=>'4100', '4200'=>'4200', '4300'=>'4300', '4400'=>'4400', '4500'=>'4500', '4600'=>'4600', '4700'=>'4700', '4800'=>'4800', '4900'=>'4900', '5000'=>'5000', '5100'=>'5100', '5200'=>'5200', '5300'=>'5300', '5400'=>'5400', '5500'=>'5500', '5600'=>'5600', '5700'=>'5700', '5800'=>'5800', '5900'=>'5900', '6000'=>'6000', '6100'=>'6100', '6200'=>'6200', '6300'=>'6300', '6400'=>'6400', '6500'=>'6500', '6600'=>'6600', '6700'=>'6700', '6800'=>'6800', '6900'=>'6900', '7000'=>'7000', '7100'=>'7100', '7200'=>'7200', '7300'=>'7300', '7400'=>'7400', '7500'=>'7500', '7600'=>'7600', '7700'=>'7700', '7800'=>'7800', '7900'=>'7900', '8000'=>'8000', '8100'=>'8100', '8200'=>'8200', '8300'=>'8300', '8400'=>'8400', '8500'=>'8500', '8600'=>'8600', '8700'=>'8700', '8800'=>'8800', '8900'=>'8900', '9000'=>'9000', '9100'=>'9100', '9200'=>'9200', '9300'=>'9300', '9400'=>'9400', '9500'=>'9500', '9600'=>'9600', '9700'=>'9700', '9800'=>'9800', '9900'=>'9900', '10000'=>'10000');
        $font_size = array('0px' => '0px', '1px' => '1px', '2px' => '2px', '3px' => '3px', '4px' => '4px', '5px' => '5px', '6px' => '6px', '7px' => '7px', '8px' => '8px', '9px' => '9px', '10px' => '10px', '11px' => '11px', '12px' => '12px', '13px' => '13px', '14px' => '14px', '15px' => '15px', '16px' => '16px', '17px' => '17px', '18px' => '18px', '19px' => '19px', '20px' => '20px', '21px' => '21px', '22px' => '22px', '23px' => '23px', '24px' => '24px', '25px' => '25px', '26px' => '26px', '27px' => '27px', '28px' => '28px', '29px' => '29px', '30px' => '30px', '31px' => '31px', '32px' => '32px', '33px' => '33px', '34px' => '34px', '35px' => '35px', '36px' => '36px', '37px' => '37px', '38px' => '38px', '39px' => '39px', '40px' => '40px', '41px' => '41px', '42px' => '42px', '43px' => '43px', '44px' => '44px', '45px' => '45px', '46px' => '46px', '47px' => '47px', '48px' => '48px', '49px' => '49px', '50px' => '50px', '51px' => '51px', '52px' => '52px', '53px' => '53px', '54px' => '54px', '55px' => '55px', '56px' => '56px', '57px' => '57px', '58px' => '58px', '59px' => '59px', '60px' => '60px', '61px' => '61px', '62px' => '62px', '63px' => '63px', '64px' => '64px', '65px' => '65px', '66px' => '66px', '67px' => '67px', '68px' => '68px', '69px' => '69px', '70px' => '70px', '71px' => '71px', '72px' => '72px', '73px' => '73px', '74px' => '74px', '75px' => '75px', '76px' => '76px', '77px' => '77px', '78px' => '78px', '79px' => '79px', '80px' => '80px', '81px' => '81px', '82px' => '82px', '83px' => '83px', '84px' => '84px', '85px' => '85px', '86px' => '86px', '87px' => '87px', '88px' => '88px', '89px' => '89px', '90px' => '90px', '91px' => '91px', '92px' => '92px', '93px' => '93px', '94px' => '94px', '95px' => '95px', '96px' => '96px', '97px' => '97px', '98px' => '98px', '99px' => '99px', '100px' => '100px');
        
        $default_colors = array('color_site_title' => '#555555', 'color_site_desc' => '#555555', 'color_blog_p_title' => '#444444', 'color_blog_p_meta' => '#000000', 'color_blog_p_content' => '#000000', 'color_bg_blog_style_date' => '#ec6a00', 'color_bg_readmore' => '#ec6a00', 'color_readmore' => '#FFFFFF', 'color_p_title' => '#000000', 'color_p_meta' => '#000000', 'color_p_content' => '#000000', 'color_p_link' => '#0000ff', 'color_p_link_v' => '#5757ff', 'color_p_link_h' => '#0000a8');
        
        $options = array();
        
        $options[] = array(
            'name' => __('Basic Settings', 'profound'),
            'type' => 'heading');
        
        $options[] = array(
            'name' => __('Select Skin', 'profound'),
            'desc' => __('Select skin for your theme. (Note: Premium skins are only available with Pround Premium Version)', 'profound'),
            'id' => 'skin',
            'std' => 'white',
            'type' => 'select',
            'options' => array(
                'white' => __('Classic White', 'profound'))
        );

        $options[] = array(
            'name' => __('Layout Mode', 'profound'),
            'desc' => __('Select the layout type for your theme. Full width layout works only with Premium Version.', 'profound'),
            'id' => 'viewport',
            'std' => 'boxed',
            'type' => 'select',
            'options' => array(
                'boxed' => __('Boxed Mode', 'profound'))
        );

        $options[] = array(
            'name' => __('Logo Image:', 'profound'),
            'desc' => __('Here you can upload the logo of your site.', 'profound'),
            'std' => '',
            'id' => 'logo_img',
            'type' => 'upload');

        $options[] = array(
            'name' => __('Favicon Image:', 'profound'),
            'desc' => sprintf(__('Favicon Image of your site. See reference %1$sWhat is a Favicon?%2$s & %3$sWhere are Favicons displayed?%2$s', 'profound'), '<a href="http://webdesign.about.com/od/favicon/f/blfaqfavicon1.htm" target="_blank">', '</a>', '<a href="http://webdesign.about.com/od/favicon/f/blfaqfavicon2.htm" target="_blank">'),
            'std' => '',
            'id' => 'favicon',
            'type' => 'upload');
        
        $options[] = array(
            'name' => __('Organization Name:', 'profound'),
            'desc' => __('This will be shown in the Theme\'s footer.', 'profound'),
            'id' => 'footer_name',
            'std' => '',
            'type' => 'text');
        
        $options[] = array(
            'name' => __('Show Copyright:', 'profound'),
            'desc' => __('Check this to show the Copyright information in the Theme\'s footer', 'profound'),
            'id' => 'show_copyright',
            'std' => '1',
            'type' => 'checkbox');
        
        /* Theme layout (starts) */

        $options[] = array(
            'name' => __('Theme Layout', 'profound'),
            'type' => 'heading');

        $options[] = array(
            'name' => __('Hide Footer:', 'profound'),
            'desc' => __('Checking this will hide Theme\'s Footer.', 'profound'),
            'id' => 'disable_footer',
            'std' => '0',
            'type' => 'checkbox');
        
        $options[] = array(
            'name' => __('Hide Menu:', 'profound'),
            'desc' => __('Checking this will hide Primary Menu.', 'profound'),
            'id' => 'disable_menu',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Blog Heading:<br />(Homepage)', 'profound'),
            'desc' => __('This will hide the blog heading on the homepage of your site.', 'profound'),
            'id' => 'disable_blog_heading',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Thumbnail:<br />(Blog)', 'profound'),
            'desc' => __('Checking this will hide post thumbnail from the blog page.', 'profound'),
            'id' => 'disable_thumb',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Post meta:<br />(Blog)', 'profound'),
            'desc' => __('Checking this will hide post meta information from the blog. Post meta is the information about a post, visible below the title.', 'profound'),
            'id' => 'disable_blog_p_meta',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Post meta comments:<br />(Blog):', 'profound'),
            'desc' => __('Checking this will hide comments information from the post meta on blog page.', 'profound'),
            'id' => 'disable_blog_p_meta_comments',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Bottom Navigation:<br />(Blog)', 'profound'),
            'desc' => __('Checking this will hide navigation links provided below all posts on the blog page.', 'profound'),
            'id' => 'disable_blog_nav',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Meta:<br />(Single Post)', 'profound'),
            'desc' => __('Checking this will hide post meta information from single posts.', 'profound'),
            'id' => 'disable_post_meta',
            'std' => '0',
            'type' => 'checkbox');

        /* Theme layout (ends) */

        /* Header Settings (starts) */
        
        $options[] = array(
            'name' => __('Header Settings', 'profound'),
            'type' => 'heading');
        
        $options[] = array(
            'name' => __('Hide Header:', 'profound'),
            'desc' => __('Checking this will hide Theme\'s Header.', 'profound'),
            'id' => 'disable_header',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Hide Site Description:', 'profound'),
            'desc' => __('Checking this will hide site description from the header.', 'profound'),
            'id' => 'disable_site_desc',
            'std' => '1',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Site Title Font:', 'profound'),
            'desc' => __('This font applies to the site title text.', 'profound'),
            'id' => 'font_site_title',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Site Description Font:', 'profound'),
            'desc' => __('This font applies to the site description text.', 'profound'),
            'id' => 'font_site_desc',
            'std' => 'opensans',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Site Title Color:', 'profound'),
            'desc' => __('Changes the color of the site title.', 'profound'),
            'id' => 'color_site_title',
            'std' => $default_colors['color_site_title'],
            'type' => 'color');

	$options[] = array(
            'name' => __('Site Description Color:', 'profound'),
            'desc' => __('Changes the color of site description.', 'profound'),
            'id' => 'color_site_desc',
            'std' => $default_colors['color_site_desc'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Site Title Size:', 'profound'),
            'desc' => __('Change the font size of site title.', 'profound'),
            'id' => 'fsize_site_title',
            'std' => '40px',
            'type' => 'select',
            'options' => $font_size);

        $options[] = array(
            'name' => __('Site Description Size:', 'profound'),
            'desc' => __('Chane the font size of site description.', 'profound'),
            'id' => 'fsize_site_desc',
            'std' => '12px',
            'type' => 'select',
            'options' => $font_size);


        /* Header Settings (ends) */

        /* Typography (starts) */
        
        $options[] = array(
            'name' => __('Font Settings', 'profound'),
            'type' => 'heading');

        $options[] = array(
            'name' => __('Body Font:', 'profound'),
            'desc' => __('This is the primary font of the theme. It changes the font style of text which is not specified in Theme Options. (means: if any text has no font associated with it, then this will come into play.)', 'profound'),
            'id' => 'font_body',
            'std' => 'opensans',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Featured Section Font:', 'profound'),
            'desc' => __('This font applies to the text overlay in the Featured section (means: the text that appear on the top of slideshow).', 'profound'),
            'id' => 'font_featured',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Menu Font:', 'profound'),
            'desc' => __('This font applies to the Primary menu.', 'profound'),
            'id' => 'font_menu',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Post Title Font:<br />(Blog)', 'profound'),
            'desc' => __('This font applies to the Post title only on blog page.', 'profound'),
            'id' => 'font_blog_p_title',
            'std' => 'opensans',
            'type' => 'select',
            'options' => $fonts,
        );
        
        $options[] = array(
            'name' => __('Post Meta Font:<br />(Blog)', 'profound'),
            'desc' => __('This font applies to the Post meta only on blog page. (means: information about date/comments/author etc.)', 'profound'),
            'id' => 'font_blog_p_meta',
            'std' => 'opensans',
            'type' => 'select',
            'options' => $fonts,
        );
        
        $options[] = array(
            'name' => __('Post Content Font:<br />(Blog)', 'profound'),
            'desc' => __('This font applies to the Post content only on blog page.', 'profound'),
            'id' => 'font_blog_p_content',
            'std' => 'opensans',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Post Title Font:<br />(Post/Page)', 'profound'),
            'desc' => __('This font applies to the Post title only on post/page.', 'profound'),
            'id' => 'font_p_title',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );
        
        $options[] = array(
            'name' => __('Post Meta Font:<br />(Single Post)', 'profound'),
            'desc' => __('This font applies to the Post meta only on single posts. (means: information about date/comments/author etc.)', 'profound'),
            'id' => 'font_p_meta',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );
        
        $options[] = array(
            'name' => __('Post Content Font:<br />(Post/Page)', 'profound'),
            'desc' => __('This font applies to the Post content only on post/page.', 'profound'),
            'id' => 'font_p_content',
            'std' => 'opensans',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'name' => __('Widget Title Font:<br />(Footerbox)', 'profound'),
            'desc' => __('This font applies to widget title of the footerbox.', 'profound'),
            'id' => 'font_sidebar_f_title',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );
        
        $options[] = array(
            'name' => __('Widget Body Font:<br />(Footerbox)', 'profound'),
            'desc' => __('This font applies to widget body of the footerbox.', 'profound'),
            'id' => 'font_sidebar_f_body',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );
        
        $options[] = array(
            'name' => __('Footer Font:', 'profound'),
            'desc' => __('This font applies to footer of the site.', 'profound'),
            'id' => 'font_footer',
            'std' => 'lato',
            'type' => 'select',
            'options' => $fonts,
        );

        $options[] = array(
            'id' => "mud_font_upgrade",
            'type' => 'font_upgrade');
        
        /* Typography (ends) */

        /* Color options (starts) */

        $options[] = array(
            'name' => __('Color Options', 'profound'),
            'type' => 'heading');

        $options[] = array(
            'name' => __('Post Title Color:<br />(blog)', 'profound'),
            'desc' => __('Changes the post title color only on blog page.', 'profound'),
            'id' => 'color_blog_p_title',
            'std' => $default_colors['color_blog_p_title'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Post Meta Color:<br />(blog)', 'profound'),
            'desc' => __('Changes the post meta color only on blog page. (means: information about date/comments/author etc.)', 'profound'),
            'id' => 'color_blog_p_meta',
            'std' => $default_colors['color_blog_p_meta'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Post Content Color:<br />(blog)', 'profound'),
            'desc' => __('Changes the post content color only on blog page.', 'profound'),
            'id' => 'color_blog_p_content',
            'std' => $default_colors['color_blog_p_content'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Date Background Color:<br />(blog)', 'profound'),
            'desc' => __('Changes the background color of stylish date only on blog page.', 'profound'),
            'id' => 'color_bg_blog_style_date',
            'std' => $default_colors['color_bg_blog_style_date'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Post Title Color:<br />(post/page)', 'profound'),
            'desc' => __('Changes the post title color on posts/page.', 'profound'),
            'id' => 'color_p_title',
            'std' => $default_colors['color_p_title'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Post Meta Color:<br />(posts)', 'profound'),
            'desc' => __('Changes the post meta color on single posts.', 'profound'),
            'id' => 'color_p_meta',
            'std' => $default_colors['color_p_meta'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Post Content Color:<br />(page/posts)', 'profound'),
            'desc' => __('Changes the post content color on single posts.(means: color for &#60;p&#62; tag.)', 'profound'),
            'id' => 'color_p_content',
            'std' => $default_colors['color_p_content'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Link Color:<br />(post/page)', 'profound'),
            'desc' => __('Changes the unvisited link color on posts/page.(means: color for &#60;a&#62; tag.)', 'profound'),
            'id' => 'color_p_link',
            'std' => $default_colors['color_p_link'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Link Visited Color:<br />(post/page)', 'profound'),
            'desc' => __('Changes the visited link color on posts/page.(means: color for visited links.)', 'profound'),
            'id' => 'color_p_link_v',
            'std' => $default_colors['color_p_link_v'],
            'type' => 'color');

        $options[] = array(
            'name' => __('Link Hover Color:<br />(post/page)', 'profound'),
            'desc' => __('Changes the link hover color on posts/page. (means: when mouse hovers over a link.)', 'profound'),
            'id' => 'color_p_link_h',
            'std' => $default_colors['color_p_link_h'],
            'type' => 'color');

        /* Color options (ends) */

        /* CTA (starts) */

        $options[] = array(
            'name' => __('Featured Section', 'profound'),
            'type' => 'heading');

        $options[] = array(
            'name' => __('Hide Featured Section:', 'profound'),
            'desc' => __('Checking this will hide Featured Section.', 'profound'),
            'id' => 'disable_featured_section',
            'std' => '0',
            'type' => 'checkbox');
        
        $options[] = array(
            'name' => __('Slideshow Image #1:', 'profound'),
            'desc' => '',
            'std' => PROFOUND_GLOBAL_IMAGES_URL . 'photographer.jpg',
            'id' => 'featured_slide_img_1',
            'type' => 'upload');

        $options[] = array(
            'name' => __('Slideshow Heading #1:', 'profound'),
            'desc' => __('The heading for slide #1', 'profound'),
            'id' => 'featured_slide_head_1',
            'std' => 'Enjoy your life',
            'type' => 'textarea');

        $options[] = array(
            'name' => __('Slideshow Image #2:', 'profound'),
            'desc' => '',
            'std' => '',
            'id' => 'featured_slide_img_2',
            'type' => 'upload');

        $options[] = array(
            'name' => __('Slideshow Heading #2:', 'profound'),
            'desc' => __('The heading for slide #2', 'profound'),
            'id' => 'featured_slide_head_2',
            'std' => '',
            'type' => 'textarea');

        $options[] = array(
            'name' => __('Slideshow Speed', 'profound'),
            'desc' => __('Speed of slideshow', 'profound'),
            'id' => 'slide_speed',
            'std' => '5000',
            'type' => 'select',
            'options' => $num_by_hundred);

        $options[] = array(
            'name' => __('Slideshow Animation Speed', 'profound'),
            'desc' => __('Speed of slideshow animation', 'profound'),
            'id' => 'slide_ani_speed',
            'std' => '700',
            'type' => 'select',
            'options' => $num_by_hundred);

        $options[] = array(
            'name' => __('Hide Navigation:', 'profound'),
            'desc' => __('Hide left and right navigation', 'profound'),
            'id' => 'disable_slide_nav',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Smooth Height:', 'profound'),
            'desc' => __('Disable Smooth Height.', 'profound'),
            'id' => 'disable_smooth_height',
            'std' => '1',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Animation Type', 'profound'),
            'desc' => __('Slideshow animation type.', 'profound'),
            'id' => 'slide_animation_type',
            'std' => 'fade',
            'type' => 'select',
            'options' => array('fade' => 'fade', 'slide' => 'slide'));

        $options[] = array(
            'name' => __('Slideshow Direction', 'profound'),
            'desc' => __('Slideshow Direction.', 'profound'),
            'id' => 'slide_dir',
            'std' => 'horizontal',
            'type' => 'select',
            'options' => array('horizontal' => 'horizontal', 'vertical' => 'vertical'));

          $options[] = array(
            'id' => "mud_carousel_upgrade",
            'type' => 'carousel_upgrade');
          
        /* CTA (ends) */

        /*Social Options (starts)*/
        $options[] = array(
            'name' => __('Social Options', 'profound'),
            'type' => 'heading');
        
        $options[] = array(
            'name' => __('Hide Social Section:', 'profound'),
            'desc' => __('Checking this will hide Social Section.', 'profound'),
            'id' => 'disable_social_section',
            'std' => '0',
            'type' => 'checkbox');
        
        $options[] = array(
            'name' => __('Facebook Profile:', 'profound'),
            'desc' => __('Include http:// or https:// with the URL.', 'profound'),
            'id' => 'facebook',
            'std' => '',
            'type' => 'text');
        
        $options[] = array(
            'name' => __('Twitter Profile:', 'profound'),
            'desc' => __('Include http:// or https:// with the URL.', 'profound'),
            'id' => 'twitter',
            'std' => '',
            'type' => 'text');
        
        $options[] = array(
            'name' => __('RSS Feed:', 'profound'),
            'desc' => __('Include http:// or https:// with the URL.', 'profound'),
            'id' => 'rss',
            'std' => '',
            'type' => 'text');

        $options[] = array(
            'id' => "mud_social_upgrade",
            'type' => 'social_upgrade');

        /*Social Options (ends)*/
		
        /*Custom CSS (starts)*/
        $options[] = array(
            'name' => __('Custom CSS', 'profound'),
            'type' => 'heading');

        $options[] = array(
            'id' => "mudcss_section",
            'type' => 'divstart');

        $options[] = array(
            'name' => __('Custom CSS Styles:', 'profound'),
            'desc' => __('<strong>Important:</strong> Use this section only if you are well versed with CSS styling. Any bad input here can ruin the entire look of your theme. You can put your custom CSS styles here. It is recommended that you use this section rather than editing <i>style.css</i> directly.', 'profound'),
            'id' => 'custom_css',
            'std' => '',
            'type' => 'textarea');

        $options[] = array(
            'id' => "mudcss_section",
            'type' => 'divend');
        
        /*Custom CSS (ends)*/
        
	return $options;
}
endif;

/**
 * Fetches fonts array from $mdf_google_fonts to be used in options.
 * 
 * @global type $mdf_google_fonts
 * @return type
 */
if(!function_exists('mudthemes_options_panel_font_scut')):
function mudthemes_options_panel_font_scut(){
    global $mdf_google_fonts;

    foreach ($mdf_google_fonts as $value):
        if(($value) && is_array($value)):

            $return_array_key = $value['shortname'];
            $return_array_value = $value['displayname'];
            $return_array[$return_array_key] = $return_array_value;
            
        endif;
    endforeach;

    return $return_array;
}
endif;