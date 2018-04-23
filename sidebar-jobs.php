<aside id="jobs-sidebar" class="sidebar col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right center-block-xs text-center-xs">
	<div>
		<p><strong>Overview</strong></p>
		<ul class="sidebar-box">
			<li>
				<p><strong><i class="glyphicon glyphicon-calendar"><!-- --></i> Data Posted</strong>
				<br/><span><?php the_date(); ?> @ <?php echo get_the_time('g').":".get_the_time('i'); ?></span></p>
			</li>
			<li>
				<p><strong><i class="glyphicon glyphicon-map-marker"><!-- --></i> Location</strong>
				<br/><span><?php echo get_post_meta($post->ID, 'company-location', true); ?></span></p>
			</li>
			<li>
				<p><strong><i class="glyphicon glyphicon-time"><!-- --></i> Position</strong><br/><span><?php echo get_the_excerpt(); ?></span></p>
			</li>
			<li>
				<p><strong><i class="glyphicon glyphicon-briefcase"><!-- --></i> Company Name</strong><br/><span><?php echo get_post_meta($post->ID, 'company-name', true); ?></span></p>
			</li>
		</ul>
	</div>
	<?php if(get_post_meta($post->ID, 'company-map', true)) : ?>
	<div>
		<p><strong>Job Location</strong></p>
		<div class="intrinsic-container">
			<iframe width="100%" src="<?php echo get_post_meta($post->ID, 'company-map', true); ?>" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
	<?php endif; ?>
</aside>