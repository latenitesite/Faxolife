<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package c9
 */

$the_theme = wp_get_theme();
?>
<?php
if ( file_exists( locate_template( 'client/inc/footer.php' ) ) ) {

	include( locate_template( 'client/inc/footer.php' ) );

} else {
		require_once( get_template_directory() . '/inc/class-footer.php' );
		$c9_social_links = c9FooterHelpers::build_social();

		if (empty(get_option( 'cortex_footer' )['show_search'])) {
			$c9_footer_search = 'hide';
		} else {
			$c9_footer_search = get_option( 'cortex_footer' )['show_search'];
		}

	if ( is_active_sidebar( 'footerfull' ) || !empty(get_option( 'cortex_footer' )['copyright_content']) || 'show' === $c9_footer_search  || $c9_social_links ) {
	?>
		<div class="footer-entirety">
			<?php
			get_sidebar( 'footerfull' );
			?>
			<div class="footer-wrapper" id="wrapper-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<footer class="site-footer" id="colophon">
								<div class="site-info">
									<div class="container">
										<div class="row text-center d-flex justify-content-between align-items-center">
											<?php
											if ( $c9_social_links ) :
											?>
											<div class="col-xs-6 col-sm-3 col-lg-2 p-0 footer-social-wrapper">
												<div class="footer-social text-center">
												<?php
												foreach ( $c9_social_links as $link_key => $link_value ) {
													echo $link_value;
													}
												?>
												</div>
											</div>
											<?php endif; ?>
												<?php
												if ( get_option( 'cortex_footer' ) ) :
													if ( get_option( 'cortex_footer' )['copyright_content'] ) :
														echo '<div class="col-xs-12 col-sm-6 col-md-5 p-0 footer-copyright-wrapper"><p class="text-center copyright">' . get_option( 'cortex_footer' )['copyright_content'] . '</p></div>';
														endif;

													if ( 'show' === get_option( 'cortex_footer' )['show_search'] ) :
													?>
													<div class="col-xs-12 col-sm-12 col-md-2 text-left footer-search-wrapper">
														<div class="footer-search">
															<?php get_search_form(); ?>
														</div>
													</div>
													<?php
													endif;
												endif;
												?>
										</div><!-- .row-->
									</div><!-- .container-->
								</div><!-- .site-info -->
							</footer><!-- #colophon -->
						</div> <!--col end -->
					</div><!-- row end -->
				</div><!-- container end -->
			</div><!-- wrapper end -->
		</div><!--end .footer-entirety-->
	<?php
		}
	?>
	<?php
	}; // end of checking for client footer.php
	?>
	</div><!--end smoothwrapper-->
	<div id="fullscreensearch">
		<button type="button" class="search-close"><i class="fa fa-close"></i><span class="sr-only"><?php _e( 'Close', 'c9' ); ?></span></button>
		<form role="search" method="get" id="fullscreen" action="/">
			<div>
				<span class="sr-only"><?php _e( 'Search for:', 'c9' ); ?></span>
				<input type="search" class="search-field" name="s" value="" placeholder="<?php _e( 'Search...', 'c9' ); ?>" />
				<button type="submit" class="btn"><?php _e( 'Search', 'c9' ); ?></button>
			</div>
		</form>
	</div>
</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>

</body>

</html>
