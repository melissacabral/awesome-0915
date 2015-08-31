<?php
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

//no close php