<?php // Theme Options vars
if ( of_get_option('folio_filter') != 'none') {
?>
<div class="filter-wrapper clearfix">
<div style="text-align:center;">
				<div id="filters" class="filter nav nav-pills">
					<?php
						$count_posts = wp_count_posts('post');
					?>
					<?php echo theme_locals("categories"); ?> <span class="active"><a class="btn" href="#" data-count="<?php echo $count_posts->publish; ?>" data-filter><?php echo theme_locals("show_all"); ?></a></span>
					<?php
$filter_array = array();
						$portfolio_categories = get_categories(array('taxonomy'=>'category'));
						
						foreach($portfolio_categories as $category) {
							$filter_array[$category->slug] = $category->count;
						}
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
						$the_query = new WP_Query();
						if ($paged == 0)
							$paged = 1;

						$custom_count = ($paged - 1) * $items_count;

						$the_query->query('post_type=post&showposts='. $items_count .'&offset=' . $custom_count);
						
						
						while( $the_query->have_posts() ) :
							$the_query->the_post();
							$post_id = $the_query->post->ID;
							$terms = get_the_terms( $post_id, 'category');
							if ( $terms && ! is_wp_error( $terms ) ) {
								foreach ( $terms as $term )
									$filter_array[$term->slug] = $term;
									
							}
						endwhile;	
						foreach ($filter_array as $key => $value)
							if ( isset($value->count) ) {
							
								echo '<span><a class="btn" href="#" data-count="'. $value->count .'" data-filter=".'.$key.'">' . $value->name . '</a></span>';
							}	
						
						wp_reset_postdata();				
						
					?>
				</div>
				<div class="clear"></div>
			</div></div>

<?php }
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
	$wp_query->query("post_type=post&paged=".$paged.'&showposts='.$items_count ); 

?>
	
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title">not_found</h1>
		<div class="entry-content">
			
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php // Theme Options vars
	$layout_mode = of_get_option('layout_mode');
?>

<ul id="portfolio-grid" class="filterable-portfolio thumbnails portfolio-<?php echo $cols; ?>" data-cols="<?php echo $cols; ?>">
	<?php get_template_part('blog-isotope-loop'); ?>
</ul>

<?php 

	get_template_part('includes/post-formats/post-nav');
$wp_query = null;
	$wp_query = $temp;
	
?>