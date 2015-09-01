	<footer class="clearfix" id="colophon" role="contentinfo">
		
		<?php 
		//footer widget area registered in functions.php
		dynamic_sidebar('Footer Area'); ?>
		
	</footer><!-- end footer -->
</div><!-- closes #wrapper opened in header.php -->
<?php 
//must call wp_footer right before </body> for JS and plugins to run!
wp_footer();  ?>
</body>
</html>