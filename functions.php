<?php
//Use this file to activate 'sleeping' features or create your own re-usable functionality

//activate "featured images" for posts
add_theme_support( 'post-thumbnails' );

//add a special image size just for the front page banner
//				   name 	width  height  crop?
add_image_size( 'big-banner', 1065, 250, true );

//no close php