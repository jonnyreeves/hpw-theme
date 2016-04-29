<?php get_header(); ?>

<div class="content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
				<div class="row">
                    <div class="span12" id="title-header">
					<div class="page-header">
                        <?php get_template_part("static/static-title"); ?>
                    </div>
					</div>
                </div>
                    <div class="span8 <?php if (of_get_option('blog_sidebar_pos')==''){echo 'right';}else{echo of_get_option('blog_sidebar_pos'); } ?>" id="content">
                        <?php get_template_part("loop/loop-author"); ?>
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