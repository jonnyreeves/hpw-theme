</div><!--#main-->	
	
	<div id="back-top-wrapper" class="visible-desktop">
	    <p id="back-top">
	        <a href="#top"><span></span></a>
	    </p>
	</div>
<?php if(of_get_option('ga_code')) { ?>
	<script type="text/javascript">
		<?php echo stripslashes(of_get_option('ga_code')); ?>
	</script>
  <!-- Show Google Analytics -->	
<?php } ?>
<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->


</body>
</html>