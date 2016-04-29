<?php /* Static Name: Logo */ ?>
<!-- BEGIN LOGO -->                     
<div class="logo">                            
		<?php if(of_get_option('logo_type') == 'text_logo'){ ?>
				<h1 class="logo_h logo_h__txt"><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo( 'name' ); ?></a></h1>
				<!-- Site Tagline -->
				<?php if(of_get_option('logo_tagline') == 'yes'){ ?>
				<p class="logo_tagline"><?php bloginfo('description'); ?></p>
				<?php } ?>	
		<?php } else { ?>
				<?php if(of_get_option('logo_url') == ''){ ?>
						<h1 class="logo_h logo_h__txt"><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo( 'name' ); ?></a></h1>
				<!-- Site Tagline -->
				<p class="logo_tagline"><?php bloginfo('description'); ?></p>
				<?php } else  { ?>
						<h1 class="logo_h logo_h__txt"><a href="<?php echo home_url(); ?>/" class="logo_h logo_h__img"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a></h1>
				<?php if(of_get_option('logo_tagline') == 'yes'){ ?>		
				<p class="logo_tagline"><?php bloginfo('description'); ?></p>
				<?php } ?>
				<?php } ?>
		<?php } ?>		
</div>
<!-- END LOGO -->