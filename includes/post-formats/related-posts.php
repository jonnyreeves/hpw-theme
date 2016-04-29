<?php
// Reference : http://codex.wordpress.org/Function_Reference/wp_get_post_tags
// we are using this function to get an array of tags assigned to current post
$tags = wp_get_post_tags($post->ID);

if ($tags) {

	$tag_ids = array();
			
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'showposts' => 6, // these are the number of related posts we want to display
			'ignore_sticky_posts' => 1 // to exclude the sticky post
		);

	// WP_Query takes the same arguments as query_posts
	$related_query = new WP_Query($args);

	if ($related_query->have_posts()) {	?>
	<div class="related-posts">
		<?php $blog_related = of_get_option('blog_related'); ?>
		<?php if($blog_related){?>
			<h5 class="related-posts_h"><?php echo of_get_option('blog_related'); ?></h5>
		<?php } else { ?>
		<?php } ?>

			<ul class="related-posts_list clearfix">

				<?php
				while ($related_query->have_posts()) : $related_query->the_post();
				?>
					<li class="related-posts_item">
						<?php if(has_post_thumbnail()) { ?>

							<figure class="featured-thumbnail thumbnail large">
							<div class="hider-page"></div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'medium-thumb' ); ?><span class="zoom-icon"></span></a>
							</figure>
						<?php } else { ?>
							<figure class="thumbnail featured-thumbnail">
							<div class="hider-page"></div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/empty_thumb.gif" alt="<?php the_title(); ?>" /></a>
							</figure>
						<?php } ?>
						<h6><a href="<?php the_permalink() ?>" > <?php the_title();?> </a></h6>
					</li>
				<?php
				endwhile;
				?>
			</ul>
	</div><!-- .related-posts -->
	<?php }
	wp_reset_query(); // to reset the loop : http://codex.wordpress.org/Function_Reference/wp_reset_query
} ?>