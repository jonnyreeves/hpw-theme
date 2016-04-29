<?php
/**
* Template Name: Fullwidth Page
*/

get_header(); ?>
<div class="content-holder clearfix">
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
				<div class="span12">
					<div id="title-header" class="span12">
            <div class="page-header">
          <?php get_template_part("static/static-customtitle"); ?>
            </div> 
                </div>
				</div>
				</div>
				<?php if ( is_active_sidebar( 'hs_main_slideshow' ) ) : ?>

				<div class="row">
				<div class="span12">
				<?php dynamic_sidebar("hs_main_slideshow"); ?>
				</div>
				</div>
				
				<?php endif; ?>
                <div class="row-fluid">
                    <div class="span12" id="content">
					<article class="post__holder">
                        <?php get_template_part("loop/loop-page"); ?>
						</article>
                    </div>
                </div>
            
        </div>
    </div>
</div>
</div>
<footer class="footer">
<?php get_template_part('wrapper/wrapper-footer'); ?>
</footer>
<?php get_footer(); ?>