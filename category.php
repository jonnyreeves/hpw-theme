<?php get_header(); 
$masonrycategory = of_get_option('masonry_category');?>
<div class="content-holder clearfix">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="row">
					<div id="title-header" class="span12">
            <div class="page-header">
          <?php get_template_part("static/static-title"); ?>
            </div> 
                </div>
                <div class="row">
				<?php if ($masonrycategory=='false') { ?>
                    <div class="span8 <?php if (of_get_option('blog_sidebar_pos')==''){echo 'right';}else{echo of_get_option('blog_sidebar_pos'); } ?>" id="content">
                        <?php get_template_part("loop/loop-blog-main"); ?>
                    </div>
                    <div class="span4 sidebar" id="sidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div>
					<?php }else{ ?>
					<div class="span12 id="content">
						<?php get_template_part("loop/loop-blog-masonry"); ?>
                    </div>
					<?php } ?>
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