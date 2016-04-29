<?php /* Wrapper Name: Footer */ ?>
<?php if ( is_active_sidebar( 'hs_bottom_1' ) ) : ?>
<div class="bottom1">
<div class="container">
        
<div class="row-fluid bottom1-widgets">
 
    <div class="span12">
        <?php dynamic_sidebar("hs_bottom_1"); ?>
    </div>
    
</div>

</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'hs_bottom_2' ) ) : ?>
<div class="bottom2">
<div class="container">
<div class="row-fluid bottom2-widgets">
    <div class="span12">
        <?php dynamic_sidebar("hs_bottom_2"); ?>
    </div>
</div>
</div>

</div>
<?php endif; ?>

<?php if ( of_get_option('footer_logo') == 'true') { ?>  
<div class="footer-logo">
<div class="container">
<div class="row-fluid">
<div class="span12">
    	<?php get_template_part("static/static-logo"); ?>
    </div>
</div>
</div>
</div>
<?php } ?>
<?php if ( of_get_option('footer_logo') == '') { ?>  
<div class="footer-logo">
<div class="container">
<div class="row-fluid">
<div class="span12">
    	<?php get_template_part("static/static-logo"); ?>
    </div>
</div>
</div>
</div>
<?php } ?>
<?php if ( of_get_option('footer_lowest') == 'true') { ?>
<div class="lowestfooter">
	<div class="container">
<div class="row-fluid copyright">
    <div class="span6">
	<?php get_template_part("static/static-footer-nav"); ?>
    </div>
    <div class="span6">
    	<?php get_template_part("static/static-footer-text"); ?>
    </div>
</div>
</div>
</div>
<?php } ?>