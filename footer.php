<?php
/**
 * The template for displaying the footer
 */
?>
    <div id="footer">
        <div class="footerWidth">
            <div class="footerLeft">
                <div class="footerAddress">
                    <?php echo get_field('footer_left','option') ?>
                </div>
                <div class="footerCopyright">
                    <?php echo get_field('footer_copyright','option') ?>
                </div>
            </div>
            <div class="footerRight">
                <div class="emailForm">
                    <div class="emailFormTitle">Sign Up for our Newsletter</div>
                    <div class="emailFormWrap2">
                    <?php gravity_form( 6, false, false, false, '', true ); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <!--<div class="socialTitle">Follow Us:</div>-->
                <div class="socialBox">
                    <?php if ( have_rows('social', 'options') ): ?>
                        <ul class="social">
                            <?php while ( have_rows('social', 'options') ) : the_row(); ?>
                                <li>
                                    <a href="<? the_sub_field('url')?>" target="_blank">
                                        <i class="fa fa-<? the_sub_field('network')?>"></i>
                                    </a>
                                </li>
                            <?php endwhile;?>
                        </ul>
                    <?php endif;?>
                </div>
                <div class="footerTermsNav">
                    <?php echo get_field('footer_right','option') ?>
                </div>
            </div>
        </div><!-- /footerWidth -->
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>