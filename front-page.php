<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php 
			//display an <img> with the featured image
			//big-banner is defined in functions.php
			the_post_thumbnail( 'big-banner' );  ?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>
			
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
					
		</article><!-- end post -->

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

	
	<section id="featured-content" class="clearfix">
		
		<?php awesome_products_list(6); ?>	

	</section>

</main><!-- end #content -->

<?php get_sidebar('frontpage'); //include sidebar-frontpage.php ?>
<?php get_footer(); //include footer.php ?>