<?php 
	include("header.php"); 
	$post_type = $_GET['post_type'];
?>
<main>
<section id="hero" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/hero.jpg);" class="no-padding">
	<div class="container">
		<?php if(isset($_GET['post_type'])!="post") : ?>
		<h1>Search for Jobs</h1>
		<?php else : ?>
		<h1>Blog</h1>
		<?php endif; ?>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<?php if(isset($_GET['post_type'])!="post") : ?>
			<?php include('search-sidebar.php'); ?>
			<?php else : ?>
			<?php include('blog-sidebar.php'); ?>
			<?php endif; ?>
			<div class="content col-lg-8 col-md-8 col-sm-8 col-xs-12 text-center-xs center-block-xs">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>
						<?php if(isset($_GET['post_type'])!="post") : ?>
						<article id="post_<?php echo $post->ID; ?>" class="blog-post blog-post__<?php echo $post->ID; ?> row col-lg-12 col-md-12 col-sm-12 col-xs-12 center-text-xs">
							<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
								<a title="<?php echo get_the_title(); ?>"  href="<?php echo get_the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>" alt="<?php echo get_the_title(); ?>" width="100%" /></a>
							</div>
							<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
								<h3 class="pull-left center-block-xs"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a> 
								</h3>
								<p class="tag pull-right center-block-xs"><?php echo get_the_excerpt(); ?></p>
								<div class="clearfix"></div>
								<p>
									<i class="glyphicon glyphicon-briefcase"><!-- --></i> 
									<?php echo substr(get_post_meta($post->ID, 'company-name', true), 0, 18); ?>... 
									<span class="pull-right center-block-xs"> 
										<i class=" glyphicon glyphicon-map-marker"><!-- --></i> 
										<?php echo substr(get_post_meta($post->ID, 'company-location', true), 0, 18); ?> ...
									</span>
								</p>
								<div class="clearfix"></div>
								<p><?php echo substr(get_the_content(), 0, 240); ?> (...)</p>
							</div>
						</article>
						<?php else: ?>
							<?php $category = get_the_category(); ?>
						<article class="blog-post blog-post__<?php echo $post->ID; ?> row col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block-xs text-center-xs">
							<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
								<a title="<?php echo get_the_title(); ?>"  href="<?php echo get_the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>" alt="<?php echo get_the_title(); ?>" width="100%" /></a>
							</div>
							<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
								<h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
								<p><small>Posted in <?php the_date(); ?></small></p>
								<p>
									Category: <?php echo $category[0]->name ?>
								</p>
								<p><?php echo substr(get_the_content(), 0, 140); ?> ...</p>
								<p><?php the_tags(); ?></p>
								<p><a href="<?php echo get_the_permalink(); ?>" class="btn btn-default btn-default__style-2">Read More</a></p>
							</div>
						</article>
						<?php endif; ?>
					<?php endwhile; ?>
					<?php else: ?>
						<?php if(isset($_GET['post_type'])!="post") : ?>
						<p class="text-center"><strong>Sorry, but we don't have any jobs right now that fit your selected criteria. Try another search or check back in next month.</strong></p>
						<?php else: ?>
						<p class="text-center"><strong>Sorry, but we don't have any posts right now that fit your selected criteria.</strong></p>
						<?php endif; ?>
					<?php endif; ?>
			</div>

		</div>
	</div>
</div>
</section>
</main>
<?php include("footer.php"); ?>