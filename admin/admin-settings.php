<?php

/**
 *
 * Add fields and configure admin settings API.
 *
 * @since   1.0.0
 * @package c9
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Sets up meta for post header size.
 */
function c9_post_header_size()
{
	add_meta_box(
		'post_header_size',           // Unique ID
		'Header Size',  // Box title
		'c9_post_header_size_html',  // Content callback, must be of type callable
		'post',               // Post type
		'side'
	);
}
add_action('add_meta_boxes', 'c9_post_header_size');

/**
 * Content callback for post header size.
 */
function c9_post_header_size_html($post)
{
	$value = isset(get_post_meta($post->ID, 'c9_post_header_size', true)['c9_post_header_size']) ? get_post_meta($post->ID, 'c9_post_header_size', true)['c9_post_header_size'] : 'small';
?>
	<label for="c9_post_header_size"><?php _escape_html_e('Header Size', 'c9'); ?></label>
	<div>
		<input type="radio" id="large" name="c9_post_header_size" value="large" <?php echo 'large' === $value ? 'checked' : ''; ?>>
		<label for="large"><?php _escape_html_e('Large', 'c9'); ?></label>
	</div>
	<div>
		<input type="radio" id="small" name="c9_post_header_size" value="small" <?php echo 'small' === $value ? 'checked' : ''; ?>>
		<label for="small"><?php _escape_html_e('Small', 'c9'); ?></label>
	</div>
<?php
}

/**
 * Update post meta.
 */
function c9_save_header_size($post_id)
{
	if (array_key_exists('c9_post_header_size', $_POST)) {
		$unslashed = wp_unslash($_POST);
		update_post_meta(
			$post_id,
			'c9_post_header_size',
			$unslashed
		);
	}
}
add_action('save_post', 'c9_save_header_size');
