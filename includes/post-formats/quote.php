<article id="post-<?php the_ID(); ?>" <?php post_class('format-quote'); ?>>
<?php formaticons(); ?>
	<div class="row-fluid">

	<div class="span12">

	<?php $author =  get_post_meta(get_the_ID(), 'tz_author_quote', true); ?>

	<div class="quote-wrap clearfix">
			<div class="quote"> <?php the_content(theme_locals("continue_reading")); ?></div>
		<?php if($author) { ?>
		<span>
		<?php echo '&mdash; ' . $author; ?>
			</span>
		<?php } else { ?>
		<span>&mdash; 
		<?php the_author_meta('display_name',get_the_ID()); ?>
		</span>
		<?php } ?>
	</div>
	
	</div></div>
</article><!--//.post-holder-->