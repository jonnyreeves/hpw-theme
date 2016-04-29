<?php /* Wrapper Name: Header */ ?>
<?php
if (of_get_option('header_position')== 'stickyheader') {
global $hercules_add_animatedheader;
$hercules_add_animatedheader = true;
}
	?>

<div class="row-fluid">

    <div class="span12">
    	<?php get_template_part("static/static-logo"); ?>
    </div>
	</div>
	<div class="row-fluid post-header">
	<div class="span12">
    	<?php get_template_part("static/static-nav"); ?>
    </div>
	

</div>
<!--<div class="row"> -->
    
<!-- </div> -->