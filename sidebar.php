<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package cortextoo
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="widget-area" id="secondary" role="complementary">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div><!-- #secondary -->
