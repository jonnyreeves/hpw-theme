<?php /* Loop Name: Loop single */ ?>
<?php if (have_posts()) : while (have_posts()) : the_post();         
      
	// The following determines what the post format is and shows the correct file accordingly
	$format = get_post_format();
	get_template_part( 'includes/post-formats/'.$format );  
	
	if($format == '')
		get_template_part( 'includes/post-formats/standard' );
?>
					<!--BEGIN .pager .single-pager -->
				<ul class="paging">
	<li style="float:left;">
		<?php previous_post_link('%link', theme_locals("prev_post")) ?>
		</li><!--.previous-->
	<li style="float:right;">
		<?php next_post_link('%link', theme_locals("next_post")) ?>
	</li><!--.next-->
	<div class="clear"></div>
</ul><!--.pager-->

<?php $related_post = of_get_option('related_post');		
		if ($related_post !='no') { get_template_part( 'includes/post-formats/related-posts' ); } ?>
			<?php comments_template('', true); ?>
<?php
	endwhile; endif; 
?>