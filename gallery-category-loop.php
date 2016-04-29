<?php
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
global $wp_query;
$category_value = single_cat_title( '', false );
query_posts( array_merge( $wp_query->query, array( 'posts_per_page' => $images_per_page ) ) );
?>	
<?php if ( !have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php echo theme_locals("not_found"); ?></h1>
		<div class="entry-content">
			<p><?php echo theme_locals("apologies"); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<ul id="portfolio-grid" class="gallery-grid zoom-gallery filterable-portfolio thumbnails portfolio-<?php echo $cols; ?>" data-cols="<?php echo $cols; ?>">
	<?php get_template_part('gallery-isotope-loop'); ?>
</ul>
<?php 

	get_template_part('includes/post-formats/post-nav');
	wp_reset_query();
?>