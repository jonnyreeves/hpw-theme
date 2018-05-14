<?php /* Static Name: Footer text */ ?>
<div id="footer-text" class="footer-text">
	<?php $hs_footer_text = of_get_option('footer_text'); ?>
	<a href="https://hotpinkwellingtons.co.uk/privacy-policy/">Privacy Policy</a> | Header design by <a href="http://www.freepik.com">Freepik</a>. Content copyright <?php echo date("Y") ?>.</a>

	<?php if( is_front_page() ) { ?>
		<!-- {%FOOTER_LINK} -->
	<?php } ?>
</div>
