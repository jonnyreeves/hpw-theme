<?php // Isotope Blog Init ?>
<?php 

	$i=1;
	if (have_posts()) : while (have_posts()) : the_post(); 

	global $more;
	$more = 0;

	// Get categories
	$portfolio_cats = wp_get_object_terms($post->ID, 'category');

	// Get tags
	$portfolio_tags = wp_get_object_terms($post->ID, 'post_tag');

	//mediaType init
	$format = get_post_format();
	
	?>
	
	<li class="portfolio_item <?php foreach( $portfolio_cats as $portfolio_cat ) { echo $portfolio_cat->slug.' ';} ?> <?php foreach( $portfolio_tags as $portfolio_tag ) { echo $portfolio_tag->slug.' ';} ?>">
<div class="hider-posts"></div>
		
		
			<?php
			get_template_part( 'includes/post-formats/'.$format );
		if ($format == '')
			get_template_part( 'includes/post-formats/standard' );
			?>		
			
		
	</li>	
	<?php $i++; endwhile; else: ?><?php endif; ?>