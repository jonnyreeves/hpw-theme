<section class="title-section">
<?php 
$hs_title = get_post_meta( get_the_ID(), 'hs_page_tit', true );
$hs_subtitle = get_post_meta( get_the_ID(), 'hs_page_sub', true );
// check if the custom field has a value
if( ! empty( $hs_title ) ) {
  echo "<h1>".$hs_title."</h1>";
}
if( ! empty( $hs_subtitle ) ) {
  echo "<h2>".$hs_subtitle."</h2>";
} 
?>

	<?php
		if (of_get_option('g_breadcrumbs_id')=='yes') { ?>
			<!-- BEGIN BREADCRUMBS-->
			<?php if (function_exists('hs_breadcrumbs')) hs_breadcrumbs(); ?>
			<!-- END BREADCRUMBS -->
	<?php }
	?>
</section><!-- .title-section -->