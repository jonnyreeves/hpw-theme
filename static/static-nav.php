<?php /* Static Name: Navigation */ 
	if (has_nav_menu('header_menu')) { ?>
		<!-- BEGIN MAIN NAVIGATION  -->
		<div class="menu-button"><i class="icon-menu"></i>
		<?php if ( of_get_option('g_search_box_id')=='yes') { ?>
			<a style="position:relative;z-index:100;color:#222222; margin-left:12px;display:inline-block;" class="popup-with-zoom-anim toggle-button md-trigger" href="#small-dialog"><i class="icon-search-1"></i></a>
	<div id="small-dialogs" class="zoom-anim-dialog mfp-hide">
	<?php get_template_part("static/static-search"); ?>
	</div> 
	<?php } ?>
		</div>
		<nav class="nav nav__primary clearfix"> 
			<?php wp_nav_menu( array(
				'container'		=> false,
				'menu_id'       => '',
				'depth'         => 0,
				'menu_class' => 'flexnav',
				'items_wrap'    => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
				'theme_location'=> 'header_menu',
				'walker'		=> new hs_description_walker()
			)); ?>
			
		 </nav>
		<!-- END MAIN NAVIGATION -->
<?php } ?>


