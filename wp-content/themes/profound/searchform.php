<?php
/*
 * Template for displaying Search Form.
 * 
 * @package Profound
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="search-box clearfix">
        <input type="text" value="" name="s" id="s" placeholder="<?php _e('Search...', 'profound') ?>" />
        <input type="submit" id="searchsubmit" value="<?php _e('Go', 'profound') ?>" />
    </div>
</form>