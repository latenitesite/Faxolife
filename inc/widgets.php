<?php
/**
 * Declaring widgets
 *
 * @package cortextoo
 */

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
if ( ! function_exists( 'cortextoo_slbd_count_widgets' ) ) {
	function cortextoo_slbd_count_widgets( $sidebar_id ) {
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		global $_wp_sidebars_widgets;
		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
			if ( $widget_count % 4 == 0 || $widget_count > 6 || $widget_count % 5 == 0 ) :
				// Four widgets per row if there are exactly four or more than six
				$widget_classes .= ' col-sm-6 col-md-3';
			elseif ( 6 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-2';
			elseif ( $widget_count >= 3 ) :
				// Three widgets per row if there's three or more widgets
				$widget_classes .= ' col-md-4';
			elseif ( 2 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-6';
			elseif ( 1 == $widget_count ) :
				// If just on widget is active
				$widget_classes .= ' col-md-12';
			endif;
			return $widget_classes;
		endif;
	}
}

add_action( 'widgets_init', 'cortextoo_widgets_init' );

if ( ! function_exists( 'cortextoo_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function cortextoo_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Search Results Sidebar', 'cortextoo' ),
			'id'            => 'search-results-sidebar',
			'description'   => 'Search results sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer', 'cortextoo' ),
			'id'            => 'footerfull',
			'description'   => 'Full bottom widget with dynmic grid',
		    'before_widget'  => '<div id="%1$s" class="footer-widget %2$s '. cortextoo_slbd_count_widgets( 'footerfull' ) .'">',
		    'after_widget'   => '</div><!-- .footer-widget -->',
		    'before_title'   => '<h3 class="widget-title">',
		    'after_title'    => '</h3>',
		) );

		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'cortextoo' ),
				'id'            => 'right-sidebar',
				'description'   => __( 'Right sidebar widget area', 'cortextoo' ),
				'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Left Sidebar', 'cortextoo' ),
				'id'            => 'left-sidebar',
				'description'   => __( 'Left sidebar widget area', 'cortextoo' ),
				'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

	}
} // endif function_exists( 'cortextoo_widgets_init' ).