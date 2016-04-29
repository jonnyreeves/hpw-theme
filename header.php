<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>
	<title><?php if ( is_category() ) {
		echo __('Category Archive for &quot;', HS_CURRENT_THEME); single_cat_title(); echo __('&quot; | ', HS_CURRENT_THEME); bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo __('Tag Archive for &quot;', HS_CURRENT_THEME); single_tag_title(); echo __('&quot; | ', HS_CURRENT_THEME); bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo __(' Archive | ', HS_CURRENT_THEME); bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo __('Search for &quot;', HS_CURRENT_THEME).esc_html($s).__('&quot; | ', HS_CURRENT_THEME); bloginfo( 'name' );
	} elseif ( is_home() || is_front_page()) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo __('Error 404 Not Found | ', HS_CURRENT_THEME); bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		wp_title( ' | ', true, 'right' ); bloginfo( 'name' ); 
	} ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if(of_get_option('favicon') != ''){ ?>
	<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
	<?php } ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<script type='text/javascript'>
	(function() {
if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
var msViewportStyle = document.createElement("style");
msViewportStyle.appendChild(
document.createTextNode("@-ms-viewport{width:auto!important}")
);
document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
}
})();
</script>
<?php		
wp_head();
?>	
<!--[if IE 8 ]>
<link rel="stylesheet" id="stylesheet-ie8" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/ie8.css" />
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/respond.js"></script>
<![endif]-->
</head>

<body <?php body_class(); ?>>
	
	<?php $hercules_header_position = of_get_option('header_position'); 
	$hercules_holder = '';
	$issticky = '';
			if($hercules_header_position == 'stickyheader') {
			$hercules_header_position = "header";
			$issticky = "main-holdercon";
			}elseif ($hercules_header_position == 'normalheader') {
			$hercules_header_position = "normal_header";
			$hercules_holder = 'margin-top:0px;';
			$issticky = "stickynot";
			}else {
			$hercules_header_position = "header";
            $issticky = "main-holdercon";
			}
		?>
		<div id="<?php echo $issticky; ?>" class="main-holder" style="<?php echo $hercules_holder; ?>">
<header id="headerfix" class="headerstyler headerphoto <?php echo $hercules_header_position; ?>" style="<?php if (is_admin_bar_showing() && $hercules_header_position == 'header') {echo ("margin-top:32px;");} ?>">
<div class="header-overlay"></div>
<?php if ( of_get_option('g_search_box_id')=='yes') { ?>
<div class="top-panel22 hidden-phone"> 
    <div class="top-panel-button">
	<a class="popup-with-zoom-anim toggle-button md-trigger" href="#small-dialog"><i class="icon-search-2 icon-2x"></i></a>
    </div>
	<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
	<?php get_template_part("static/static-search"); ?>
	</div> 
</div>
<?php } ?>
<?php if ( of_get_option('g_search_box_id')=='') { ?>
<div class="top-panel22 hidden-phone"> 
    <div class="top-panel-button">
	<a class="popup-with-zoom-anim toggle-button md-trigger" href="#small-dialog"><i class="icon-search-2 icon-2x"></i></a>
    </div>
	<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
	<?php get_template_part("static/static-search"); ?>
	</div> 
</div>
<?php } ?>
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<?php 	
				get_template_part('wrapper/wrapper-header'); ?>
			</div>
		</div>
	</div>

</header>