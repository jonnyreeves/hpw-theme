<?php /* Loop Name: Blog */ ?>
<!-- displays the tag's description from the Wordpress admin -->
<?php 

global $paged, $wp_query, $wp;
        if  ( empty($paged) ) {
                if ( !empty( $_GET['paged'] ) ) {
                        $paged = $_GET['paged'];
                } elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
                        if ( !empty( $args['paged'] ) ) {
                                $paged = $args['paged'];
                        }
                }
                if ( !empty($paged) )
                        $wp_query->set('paged', $paged);
        }
	
$temp = $wp_query;
	$wp_query= null;
		
	$wp_query = new WP_Query();
	$wp_query->query("post_type=post&paged=".$paged ); 


	if (is_tag()) 
		echo tag_description();

	if (have_posts()) : while (have_posts()) : the_post();
	global $more;
	$more = 0;
		// The following determines what the post format is and shows the correct file accordingly
		$format = get_post_format();
		get_template_part( 'includes/post-formats/'.$format );

		if ($format == '')
			get_template_part( 'includes/post-formats/standard' );
		endwhile; else: ?>

		<div class="no-results">
			<?php echo '<p><strong>' .theme_locals("there_has"). '</strong></p>'; ?>
			<p><?php echo theme_locals("we_apologize"); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php echo theme_locals("return_to"); ?></a> <?php echo theme_locals("search_form"); ?></p>
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
		</div><!--no-results-->
	<?php endif; ?>
<?php get_template_part('includes/post-formats/post-nav'); ?>