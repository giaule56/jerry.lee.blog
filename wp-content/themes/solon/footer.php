<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Solon
 */
?>

	</div><!-- #content -->
	<?php get_sidebar('footer'); ?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="container">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'solon' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'solon' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %2$s by %1$s', 'solon' ), 'aThemes', '<a href="http://athemes.com/theme/solon">Solon</a>' ); ?>
				<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
