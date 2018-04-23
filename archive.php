<?php include("header.php"); ?>
<main>
<section id="hero" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/hero.jpg);" class="no-padding">
	<div class="container">
		<?php if(is_archive()) : ?>
		<h1>Blog</h1>
	<?php else: ?>
		<h1>Search for Jobs</h1>
	<?php endif; ?>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<?php if(is_search()) : ?>
			<?php get_sidebar( 'filter' );	 ?>
			<?php endif; ?>
			<?php if(is_archive()) : ?>
			<?php get_sidebar();	 ?>
			<?php endif; ?>
			<div class="content blog-post col-lg-8 col-md-8 col-sm-8 col-xs-12 text-center-xs center-block-xs">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<article class="blog-post blog-post__<?php echo $post->ID; ?> row col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block-xs text-center-xs">
					<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
						<a title="<?php echo get_the_title(); ?>"  href="<?php echo get_the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>" alt="<?php echo get_the_title(); ?>" width="100%" /></a>
					</div>
					<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
						<h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
						<p><small>Posted in <?php the_date(); ?></small></p>
						<p><?php echo substr(get_the_content(), 0, 140); ?> ...</p>
						<p><?php the_tags(); ?></p>
						<p><a href="<?php echo get_the_permalink(); ?>" class="btn btn-default btn-default__style-2">Read More</a></p>
					</div>
				</article>
				<?php endwhile; ?>
			</div>
			<?php else: ?>
			<p class="text-center"><strong>It's too bad :( We couldn't find any results. Please try again. <i><?php the_search_query(); ?></i></strong></p>
			<?php endif;?>
		</div>
	</div>
</div>
</section>
</main>
<?php include("footer.php"); ?>