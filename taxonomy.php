<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>

		<h2 class="archive-title">All products by: <?php single_cat_title(); ?></h2>

		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<a href="<?php the_permalink(); ?>">
			<?php 
			//display an <img> with the featured image
			the_post_thumbnail( 'thumbnail' );  ?>
			</a>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>
			
			<div class="entry-content">
				<?php the_excerpt();  //short version of the_content() ?>

				<?php 
				//show the price tag if this product has a price custom field
				//						post id 	   field   single value?
				$price = get_post_meta( get_the_id(), 'price', true );
				if( $price ){
					echo '<span class="product-price">' . $price . '</span>';
				}
				?>
			</div>

					
		</article><!-- end post -->

		<?php endwhile; ?>

		<section class="pagination">
			<?php 
			//The safe way to run plugin functions
			//Check to see if the plugin is active before calling its functions
			//fallback to the default WP pagination
			if( function_exists('wp_pagenavi')  AND ! wp_is_mobile() ){
				wp_pagenavi();
			}else{
				previous_posts_link( '&larr; Newer Posts' ); 	//10 newer posts
				next_posts_link( 'Older Posts &rarr;' );  		//10 older posts
			}
			?>
		</section>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>