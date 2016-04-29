<?php get_header(); ?>

<div class="content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span12">
					<div class="page-header" id="title-header">
                        <?php get_template_part("static/static-title"); ?>
                    </div>
					</div>
                </div>
                <div class="row">
                    <div class="span8 <?php echo of_get_option('blog_sidebar_pos'); ?>" id="content">
                        <?php get_template_part("loop/loop-blog-main"); ?>
                    </div>
                    <div class="span4 sidebar" id="sidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
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