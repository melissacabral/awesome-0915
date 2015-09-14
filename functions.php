<?php
//required: define max-width of auto-embeds
if ( ! isset( $content_width ) ) $content_width = 700;

//Use this file to activate 'sleeping' features or create your own re-usable functionality

//activate "featured images" for posts
add_theme_support( 'post-thumbnails' );

//background color and image color
add_theme_support( 'custom-background' );

//use HTML5 instead of XHTML 1 on wordpress-generated code
add_theme_support( 'html5', array( 'search-form', 'comment-list', 'comment-form', 
									'gallery', 'caption' ) );

//makes the <title> more accurate, SEO friendly, and customizable
//don't forget wp_title() in the header file
add_theme_support( 'title-tag' );

//add RSS <link> tags to every screen
add_theme_support( 'automatic-feed-links' );

add_theme_support( 'post-formats', array('image', 'gallery', 'audio', 'quote', 
											'video', 'chat') );

//add a special image size just for the front page banner
//				   name 	width  height  crop?
add_image_size( 'big-banner', 1065, 250, true );

//adds the ability to have editor-style.css to make the editor easier to use
add_editor_style();

/**
 * Make excerpts better by changing the length and [...]
 * @since  0.1
 */
function awesome_excerpt_length(){
	//short excerpts on the search results, longer excerpts everywhere else
	if( is_search() ){
		return 20; //words
	}else{
		return 70; //words
	}
}
add_filter( 'excerpt_length', 'awesome_excerpt_length' );

function awesome_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );


/**
 * Activate two menu locations
 * They will be displayed in header.php
 * @since  0.1
 */
function awesome_menu_areas(){
	register_nav_menus( array(
		//code name => 	 human-readable name
		'main_nav'	=>	'Main Navigation Area',
		'utilities'	=> 	'Utility Bar in the top corner',
	) );
}
add_action( 'init', 'awesome_menu_areas' );

/**
 * Add four Widget Areas (dynamic sidebars)
 * @since  0.1
 */
function awesome_widget_areas(){
	register_sidebar( array(
		'name'			=> 'Blog Sidebar',		//human-readable
		'id'			=> 'blog-sidebar',		//code-friendly slug
		'description'	=> 'Appears next to blog posts and archives',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Footer Area',		//human-readable
		'id'			=> 'footer-area',		//code-friendly slug
		'description'	=> 'Appears at the bottom of all templates',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Home Area',		//human-readable
		'id'			=> 'home-area',		//code-friendly slug
		'description'	=> 'Appears on the Front page of the site',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Page Sidebar',		//human-readable
		'id'			=> 'page-sidebar',		//code-friendly slug
		'description'	=> 'Appears next to the pages',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );

}
add_action( 'widgets_init', 'awesome_widget_areas' );


//Attach JS files
function awesome_scripts(){
	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action( 'wp_enqueue_scripts', 'awesome_scripts' );

add_action('admin_enqueue_scripts', 'chrome_fix');
function chrome_fix() {
	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false )
		wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}


/**
 * Display a list of product thumbnails
 * @param int $number the number of products to show. Defaults to 5.
 */
function awesome_products_list( $number = 5 ){
	$product_query = new WP_Query( array(
			'post_type'			=>  'product',
			'posts_per_page'	=> $number,	//LIMIT
		) ); 

		//custom loop
		if( $product_query->have_posts() ){
		?>
		<ul class="product-list">
			<?php while( $product_query->have_posts() ){ 
					 $product_query->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
				</a>
				<div class="product-info">
					<h3><?php the_title(); ?></h3>
					<p><?php the_excerpt(); ?></p>
				</div>
			</li>
			<?php } //end while ?>
		</ul>
		<?php } //end if 
		//done with custom query. clean up!
		wp_reset_postdata();
}

/**
 * Example use of pre_get_posts
 * Use this to modify normal behavior of any main query and loop
 * @param  $query - the default query object
 */
function awesome_altered_blog( $query ){
	//make sure we are viewing the blog's main query
	if( $query->is_home() AND $query->is_main_query() ){
		//exclude posts that are in category 31 (Markup)
		$query->set( 'cat', '-31' );
		//set a different LIMIT
		$query->set( 'posts_per_page', '5' );
	}
}
add_action( 'pre_get_posts', 'awesome_altered_blog' );

//no close php