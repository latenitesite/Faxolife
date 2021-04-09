<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package c9-music
 */

get_header();
?>

<div class="wrapper" id="index-wrapper">

	<main class="site-main" id="main">

		<div class="container-fluid container-posts c9" id="content">

			<div class="row no-gutter">

				<div class="col-12 content-area" id="primary">

					<div class="c9-blog-releases" id="index-content-container">
						<div class="c9-blog-header p-5" id="index-container-fixed">
							<div class="c9-blog-info p-5">
								<h1 class="text-center"><?php esc_html(bloginfo('name')); ?></h1>
								<p class="text-center"><?php esc_html(bloginfo('description')); ?></p>
							</div>
						</div>
						<div class="c9-blog-posts" id="index-container-content">
							<?php if (have_posts()) : ?>
								<?php
								while (have_posts()) :
									the_post();

									/*
                                * Include the Post-Format-specific template for the content.
                                * If you want to override this in a child theme, then include a file
                                * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                */
									get_template_part('loop-templates/content', get_post_format());
								endwhile;
								?>
							<?php else : ?>

								<?php get_template_part('loop-templates/content', 'none'); ?>

							<?php endif; ?>
						</div>
					</div>
				</div>
				<!--end .row-->
			</div><!-- .container-->

	</main><!-- #main -->

	<!-- The pagination component -->
	<?php c9_pagination(); ?>

</div><!-- Wrapper end -->

<?php get_footer(); ?>
