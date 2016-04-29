<?php
get_header(); 
?>
<div class="content-holder clearfix">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <div class="span12" id="title-header">
					<section class="title-section">
	<h1>
                        <?php echo theme_locals("gallery_categorie"); ?> <i class="icon-angle-right"></i> <span style="color:#ddd;"><?php echo single_cat_title( '', false ); ?> </span>
						</h1>
						<?php if (of_get_option('g_breadcrumbs_id')=="yes") {
						if (function_exists('hs_breadcrumbs')) { hs_breadcrumbs(); }; 
						 }	?>
</section>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-holder clearfix">
    <div class="container">
        <div class="row">
             <div class="span12">
<div class="galleryview">
<?php get_template_part("loop/loop-gallery-category"); ?>
</div>
                    </div>
                </div>
            </div>
        </div>
<footer class="footer">
<?php get_template_part('wrapper/wrapper-footer'); ?>
</footer>
<?php get_footer(); ?>

					