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
		

	// The Query
	$args = array(
		'post_type'          => 'gallery',
		'paged'              => $paged,
		'meta_key' => '_thumbnail_id',
		'posts_per_page'          => $images_per_page
		);
$wp_query = new WP_Query($args);
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



<ul id="portfolio-grid" class="zoom-gallery gallery-grid filterable-portfolio thumbnails portfolio-<?php echo $cols; ?>" data-cols="<?php echo $cols; ?>">
	<?php get_template_part('gallery-isotope-loop'); ?>
</ul>

<?php 

get_template_part('includes/post-formats/post-nav');
$wp_query = null;
$wp_query = $temp;
	
?>