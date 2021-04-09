<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package C9
 */

get_header();
?>
<div class="wrapper" id="archive-wrapper">
	<div class="container c9" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<div class="container">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
						</div>
					</header><!-- .page-header -->
					<div class="container">
						<div class="row">
							<?php
							while ( have_posts() ) :
								the_post();

								/*
								* Include the Post-Format-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Format name) and that will be used instead.
								*/
								get_template_part( 'loop-templates/content', get_post_format() );
							endwhile;
								?>
						</div><!--.row-->
					</div><!--.container-->
				<?php
				else :
						get_template_part( 'loop-templates/content', 'none' );
				endif;
				?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php c9_pagination(); ?>

		</div> <!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
