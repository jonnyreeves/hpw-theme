<?php
/**
* Template Name: Gallery Page
*/
get_header(); 
?>
<div class="content-holder clearfix">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <div class="span12" id="title-header">
                        <?php get_template_part("static/static-customtitle"); ?>
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
				<?php 
 get_template_part("loop/loop-gallery"); 
 ?>
                    </div>
                </div>
            </div>
        </div>
<footer class="footer">
<?php get_template_part('wrapper/wrapper-footer'); ?>
</footer>
<?php get_footer(); ?>