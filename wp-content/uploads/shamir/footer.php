<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shamir
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<section id="social_icon_footer">
<!-- Include Font Awesome Stylesheet in Header -->
			<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
			<div class="container">
			 <div class="text-center center-block">
							 <a href="#"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
						 <a href="#"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
						 <a href="#"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
						 <a href="mailto:#"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
	 			 </div>
			 </div>
		 </section>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="/wp-content/themes/shamir/js/sha512.min.js"></script>

</body>
</html>
