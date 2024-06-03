<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <input type="search" class="searchField" placeholder="Search..." value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <input type="submit" class="searchSubmit" value="" />
    <input type="hidden" value="post" name="post_type" id="post_type" />
    <!--<input type="hidden" value="4" name="cat">-->
    <div class="clear"></div>
</form>
