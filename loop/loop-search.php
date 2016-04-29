<?php /* Loop Name: Loop search */ ?>
<!-- displays the tag's description from the Wordpress admin -->
<?php 
	if (is_tag()) 
		echo tag_description();

	if (have_posts()) : while (have_posts()) : the_post();
		// The following determines what the post format is and shows the correct file accordingly
		$format = get_post_format();
		get_template_part( 'includes/post-formats/'.$format );

		if ($format == '')
			get_template_part( 'includes/post-formats/standard' );
		endwhile; else: ?>

		<div class="no-results">
			<?php echo '<p><strong>' . __('There has been an error.', HS_CURRENT_THEME) . '</strong></p>'; ?>
			<p><?php _e('We apologize for any inconvenience, please', HS_CURRENT_THEME); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', HS_CURRENT_THEME); ?></a> <?php _e('or use the search form below.', HS_CURRENT_THEME); ?></p>
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
		</div><!--no-results-->
	<?php endif; ?>
<?php get_template_part('includes/post-formats/post-nav'); ?>