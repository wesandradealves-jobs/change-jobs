<?php get_header(); ?>
	<section id="hero" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/hero.jpg);" class="text-center">
		<div class="container">
			<h1><?php echo get_the_title(); ?></h1>
			<?php if(get_post_type()!="post") : ?>
			<p><i class="glyphicon glyphicon-briefcase"><!-- --></i> <?php echo get_post_meta($post->ID, 'company-name', true); ?></p>
			<p><i class=" glyphicon glyphicon-map-marker"><!-- --></i><?php echo get_post_meta($post->ID, 'company-location', true); ?></p>
			<p class="tag"><?php echo get_the_excerpt(); ?></p>
			<?php else : ?>
			<p><?php the_tags(); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<section>
		<div class="container">
			<?php if ( have_posts () ) : while (have_posts()):the_post(); ?>
			<article id="post_<?php echo $post->ID; ?>" class="blog-post blog-post__<?php echo $post->ID; ?>">
				<?php if(get_post_type()=="post") : ?>
				<?php get_sidebar(); ?>
				<?php endif; ?>
				<div class="content col-lg-8 col-md-8 col-sm-8 col-xs-12 text-center-xs center-block-xs">
				<?php if(get_post_type()!="post") : ?>
				<div class="v-center">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center-xs center-block-xs">
						<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>" alt="<?php echo get_the_title(); ?>" width="100%">
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 text-center-xs center-block-xs">
						<h3><?php echo get_the_title(); ?></h3>
						<?php if(get_post_meta($post->ID, 'company-phone', true)) : ?>
						<br/>
						<p>
							<i class="glyphicon glyphicon-phone-alt"><!-- --></i> <?php echo get_post_meta($post->ID, 'company-phone', true); ?>
						</p>
					<?php endif; ?>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr/>
				<?php endif; ?>
					<?php the_content(); ?>
					<?php if(get_post_type()!="post") : ?>
					<?php 
						//Get array of terms
						$terms = get_the_terms( $post->ID , 'jobs_categories', 'string');
						//Pluck out the IDs to get an array of IDS
						$term_ids = wp_list_pluck($terms,'term_id');
						//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
						//Chose 'AND' if you want to query for posts with all terms
						$q = new WP_Query( array(
						'post_type' => 'jobs',
						'tax_query' => array(
						array(
						'taxonomy' => 'jobs_categories',
						'field' => 'id',
						'terms' => $term_ids,
						'operator'=> 'IN' //Or 'AND' or 'NOT IN'
						)),
						'posts_per_page' => 2,
						'orderby' => 'rand',
						'post__not_in'=>array($post->ID)
						) );
						//Loop through posts and display...
						if($q->have_posts()) : ?>
						<div id="related-posts">
						<h3>Related Jobs</h3>
						<?php while ($q->have_posts() ) : $q->the_post(); ?>
							<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h3><a title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
								<p class="tag"><?php echo get_the_excerpt(); ?></p>
								<p><i class="glyphicon glyphicon-briefcase"><!-- --></i> <?php echo get_post_meta($post->ID, 'company-name', true); ?></p>
								<p><i class="glyphicon glyphicon-map-marker"><!-- --></i> <?php echo get_post_meta($post->ID, 'company-location', true); ?></p>
								<p><?php echo substr(get_the_content(), 0, 240); ?> (...)</p>
							</article>
						<?php endwhile; wp_reset_query(); ?>
						</div>
						<?php endif; ?>
					<?php else: ?>
						<?php 
						//Get array of terms
						$terms = get_the_terms( $post->ID , 'category');
						//Pluck out the IDs to get an array of IDS
						$term_ids = wp_list_pluck($terms,'term_id');
						//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
						//Chose 'AND' if you want to query for posts with all terms
						$q = new WP_Query( array(
						'post_type' => 'post',
						'tax_query' => array(
						array(
						'taxonomy' => 'category',
						'field' => 'id',
						'terms' => $term_ids,
						'operator'=> 'IN' //Or 'AND' or 'NOT IN'
						)),
						'posts_per_page' => 2,
						'orderby' => 'rand',
						'post__not_in'=>array($post->ID)
						) );
						//Loop through posts and display...
						if($q->have_posts()) : ?>
						<div id="related-posts">
						<h3>Related Posts</h3>
						<?php while ($q->have_posts() ) : $q->the_post(); ?>
							<?php $category=get_the_category(); ?>
							<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h3><a title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
								<p>Category: <?php echo $category[0]->name ?></p>
								<p><?php echo substr(get_the_content(), 0, 240); ?> (...)</p>
							</article>
						<?php endwhile; wp_reset_query(); ?>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<?php if(get_post_type()!="post") : ?>
				<?php get_sidebar( 'jobs' );	 ?>
				<?php endif; ?>
			</article>
			<?php endwhile; ?>
			<?php endif; ?>	
		</div>	
	</section>

<?php get_footer(); ?>