<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
<?php formaticons(); ?>
	<?php $hercules_post_meta = of_get_option('post_meta'); ?>
<?php if ($hercules_post_meta=='true' || $hercules_post_meta=='') { ?>
	<?php get_template_part('includes/post-formats/post-meta');
	} ?>
	<div class="row-fluid">
	<div class="span12">
    <!-- Post Content -->
    <div class="post_content">
        <?php the_content('<div class="readmore-button">'.theme_locals("continue_reading").'</div>'); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
    	<!--// Post Content -->
    	<div class="clear"></div>
    </div>
    
   </div></div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->