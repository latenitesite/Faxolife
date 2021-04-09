<?php

/**
 * The template for displaying search results pages.
 *
 * @package cortextoo
 */

get_header();

?>

<div class="wrapper" id="search-wrapper">

	<div class="page-search-results cortextoo" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php if (have_posts()) : ?>


			<div class="c9-grid mar20B">
				<div class="container header-container-search">
					<div class="row no-gutter">
						<div class="container">
							<h1 class="entry-title text-center">
								<?php printf(
										/* translators:*/
										esc_html__('Results for: %s', 'cortextoo'),
										'<span>' . get_search_query() . '</span>'
									); ?></h1>

							<?php echo do_shortcode("[search]"); ?>

						</div>

					</div><!-- .row-->
				</div><!-- .container-fluid-->
			</div><!-- .c9 block column container -->


			<div class="container">

				<div class="row no-gutter">

					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<?php while (have_posts()) : the_post(); ?>

						<?php
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part('loop-templates/content', 'search');
								?>

						<?php endwhile; ?>

						<?php else : ?>

						<?php get_template_part('loop-templates/content', 'none'); ?>

						<?php endif; ?>

					</div><!-- .col-->
				</div><!-- .row-->
			</div><!-- .container-->

		</main><!-- #main -->

		<!-- The pagination component -->
		<?php cortextoo_pagination(); ?>


	</div><!-- .cortextoo end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>