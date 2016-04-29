<?php /* Static Name: Footer text */ ?>
<div id="footer-text" class="footer-text">
	<?php $hs_footer_text = of_get_option('footer_text'); ?>
	
	<?php if($hs_footer_text){?>
		<?php echo of_get_option('footer_text'); ?>
	<?php } else { ?>
		<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <?php _e('is proudly powered by', HS_CURRENT_THEME); ?> <a href="http://wordpress.org">WordPress</a> <a href="<?php if ( of_get_option('feed_url') != '' ) { echo of_get_option('feed_url'); } else bloginfo('rss2_url'); ?>" rel="nofollow" title="<?php _e('Entries (RSS)', HS_CURRENT_THEME); ?>"><?php _e('Entries (RSS)', HS_CURRENT_THEME); ?></a> and <a href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow"><?php _e('Comments (RSS)', HS_CURRENT_THEME); ?></a>
		<a href="<?php echo home_url(); ?>/privacy-policy/" title="Privacy Policy"><?php _e('Privacy Policy', HS_CURRENT_THEME); ?></a>
	<?php } ?>
	<?php if( is_front_page() ) { ?>
		<!-- {%FOOTER_LINK} -->
	<?php } ?>
</div>