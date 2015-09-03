<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php the_post_thumbnail( 'large' , array( 'class' => 'product-image' ) ); ?>
			
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<div class="entry-content">

				<?php the_terms( get_the_id(), 'brand' ); ?>

				<?php 
				//show a list of all custom fields
				the_meta();  ?>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
				
		</article><!-- end post -->

		

		<?php endwhile; ?>

		<section class="pagination">
			<?php 			
			previous_post_link( '%link ', 'Older: %title' );	//older	
			next_post_link( '%link', 'Newer: %title' ); 		//newer post
			?>
		</section>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>