<?php 
/**
* Template Name: 404
*/ 
get_header(); ?>

<div class="content-holder clearfix">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="row-fluid error404-holder">
                    <div class="span7 error404-holder_num">
                    	<?php get_template_part("static/static-404"); ?>
                    </div>
                    <div class="span5">
                    	<?php get_template_part("static/static-not-found"); ?>
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