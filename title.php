<section class="title-section">
        <!--
	<h1>
		<?php 
		$shop_page = false;
			if(function_exists( 'is_shop' )){
				if(is_shop()){
					$shop_page = true;
				}
			}
		if(is_home()){ ?>
			<?php $hercules_blog_text = of_get_option('blog_text'); ?>
				<?php if($hercules_blog_text){?>
					<?php echo of_get_option('blog_text'); 
 ?>
				<?php } else { } ?>
			
		<?php } elseif ( is_category() && of_get_option('category_name') =='yes' && of_get_option('category_word') !='no' || is_category() && of_get_option('category_name') =='' && of_get_option('category_word') !='no' ) { ?>
			<?php printf( theme_locals("category_archives")." %s", '<i class="icon-angle-right"></i> <span class="subtitle">' . single_cat_title( '', false ) . '' ); ?>
            <small><?php echo category_description(); /* displays the category's description from the Wordpress admin */ ?></small></span>
			
		<?php } elseif ( is_category() && of_get_option('category_name') =='no' ) { ?>
		
		<?php } elseif ( is_category() && of_get_option('category_word') =='no' ) { ?>
			<?php printf( " %s", '<span class="subtitle">' . single_cat_title( '', false ) . '' ); ?>
            <small><?php echo category_description(); /* displays the category's description from the Wordpress admin */ ?></small></span>	
			
		<?php } elseif ( is_tax()  ) { ?>
			<?php echo theme_locals("posts_by_type"); ?>
			<i class="icon-angle-right"></i> <span class="subtitle"><?php echo single_cat_title( '', false ); ?> </span>
		
		<?php } elseif ( is_search() ) { ?>
			<?php echo theme_locals("fearch_for"); ?>
			<i class="icon-angle-right"></i> <span class="subtitle"><?php the_search_query(); ?></span>
		
		<?php } elseif ( is_day() ) { ?>
			<?php printf( theme_locals("daily_archives")." %s", '<i class="icon-angle-right"></i> <span class="subtitle">' . get_the_date() ); ?></span>
			
		<?php } elseif ( is_month() ) { ?>	
			<?php printf( theme_locals("monthly_archives")." %s", '<i class="icon-angle-right"></i> <span class="subtitle">' . get_the_date('F Y') ); ?></span>
			
		<?php } elseif ( is_year() ) { ?>	
			<?php printf( theme_locals("yearly_archives")." %s", '<i class="icon-angle-right"></i> <span class="subtitle">' . get_the_date('Y') ); ?></span>
		
		<?php } elseif ( is_author() ) { ?>
			<?php 
				global $author;
				$userdata = get_userdata($author);
			?>
				<?php echo theme_locals("by");?><?php echo $userdata->display_name; ?>
				
		<?php } elseif ( is_tag() ) { ?>
			<?php printf( theme_locals("tag_archives"), '<i class="icon-angle-right"></i> <span class="subtitle">' . single_tag_title( '', false ) . '</span>' ); ?>
			
		<?php } elseif ( is_tag('gallery_tag') ) { ?>
			<?php echo theme_locals("gallery_categories").": "; ?>
			<small><?php echo single_cat_title( '', false ); ?> </small>
			<!--Begin shop-->
		<?php } elseif ($shop_page) {
				if (class_exists( 'Woocommerce' ) && !is_single()){
					$page_id = woocommerce_get_page_id('shop');
				} elseif (function_exists( 'jigoshop_init' ) && !is_singular()){
					$page_id = jigoshop_get_page_id('shop');
				}
				echo get_page($page_id)->post_title;
		?>
<!--End shop-->
		<?php } else { ?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$hercules_pagetitle = get_post_custom_values("page-title");
				$hercules_pagedesc = get_post_custom_values("title-desc");
				
					if($hercules_pagetitle == ""){
						the_title();
						
					} else {
						echo $pagetitle[0];
					
					}
					if($hercules_pagedesc != ""){ ?>
						<span class="title-desc"><?php echo $hercules_pagedesc[0];?></span>
					<?php }
				endwhile; endif;
			wp_reset_query();			
		} ?>
	</h1>
        -->
		<?php if(is_home()){ ?>
		
	<?php $hercules_blog_sub = of_get_option('blog_sub'); ?>
				<?php if($hercules_blog_sub){?>
					<?php echo "<h2>". of_get_option('blog_sub') . "</h2>"; 	?>
				<?php } ?>
				<?php } ?>
	<?php
		if (of_get_option('g_breadcrumbs_id')=="yes") { ?>
			<!-- BEGIN BREADCRUMBS-->
			<?php
/* Begin shop */	
				if (function_exists( 'is_shop' ) && is_shop() || function_exists( 'is_product' ) && is_product()){
					if(class_exists( 'Woocommerce' )){
						woocommerce_breadcrumb(array('delimiter' => ' / ', 'wrap_before' => '<ul class="breadcrumb breadcrumb__t">', 'wrap_after' => '</ul>'));
					} elseif(function_exists( 'jigoshop_init' )){
						jigoshop_breadcrumb('/ ', '<ul class="breadcrumb breadcrumb__t">', '</ul>');
					}
/* End shop */
			 } elseif (function_exists('hs_breadcrumbs')) { hs_breadcrumbs(); }; ?>
			<!-- END BREADCRUMBS -->
	<?php }	?>
	
</section><!-- .title-section -->
