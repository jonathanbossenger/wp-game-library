<?php
/**
 * Plugin Name: WP Game Library
 * Description: Manage your personal video game library in WordPress.
 * Version: 0.1.0
 * Author: WP Game Library Contributors
 * Text Domain: wp-game-library
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the game custom post type.
 *
 * @return void
 */
function wp_game_library_register_game_post_type() {
	$labels = array(
		'name'                  => __( 'Games', 'wp-game-library' ),
		'singular_name'         => __( 'Game', 'wp-game-library' ),
		'menu_name'             => __( 'Games', 'wp-game-library' ),
		'name_admin_bar'        => __( 'Game', 'wp-game-library' ),
		'add_new'               => __( 'Add New', 'wp-game-library' ),
		'add_new_item'          => __( 'Add New Game', 'wp-game-library' ),
		'new_item'              => __( 'New Game', 'wp-game-library' ),
		'edit_item'             => __( 'Edit Game', 'wp-game-library' ),
		'view_item'             => __( 'View Game', 'wp-game-library' ),
		'all_items'             => __( 'All Games', 'wp-game-library' ),
		'search_items'          => __( 'Search Games', 'wp-game-library' ),
		'parent_item_colon'     => __( 'Parent Games:', 'wp-game-library' ),
		'not_found'             => __( 'No games found.', 'wp-game-library' ),
		'not_found_in_trash'    => __( 'No games found in Trash.', 'wp-game-library' ),
		'featured_image'        => __( 'Game Cover', 'wp-game-library' ),
		'set_featured_image'    => __( 'Set game cover', 'wp-game-library' ),
		'remove_featured_image' => __( 'Remove game cover', 'wp-game-library' ),
		'use_featured_image'    => __( 'Use as game cover', 'wp-game-library' ),
		'archives'              => __( 'Game archives', 'wp-game-library' ),
		'insert_into_item'      => __( 'Insert into game', 'wp-game-library' ),
		'uploaded_to_this_item' => __( 'Uploaded to this game', 'wp-game-library' ),
		'filter_items_list'     => __( 'Filter games list', 'wp-game-library' ),
		'items_list_navigation' => __( 'Games list navigation', 'wp-game-library' ),
		'items_list'            => __( 'Games list', 'wp-game-library' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'show_in_rest'       => true,
		'has_archive'        => true,
		'rewrite'            => array(
			'slug'       => 'games',
			'with_front' => false,
		),
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'capability_type'    => 'post',
		'map_meta_cap'       => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-games',
	);

	register_post_type( 'game', $args );
}
add_action( 'init', 'wp_game_library_register_game_post_type' );

/**
 * Sanitize game meta values before storage.
 *
 * @param mixed  $value    Meta value.
 * @param string $meta_key Meta key.
 *
 * @return mixed
 */
function wp_game_library_sanitize_game_meta( $value, $meta_key ) {
	if ( in_array( $meta_key, array( '_igdb_id' ), true ) ) {
		return absint( $value );
	}

	if ( in_array( $meta_key, array( '_game_rating', '_user_rating' ), true ) ) {
		return (float) $value;
	}

	if ( '_game_cover_url' === $meta_key ) {
		return esc_url_raw( $value );
	}

	return sanitize_text_field( (string) $value );
}

/**
 * Register game metadata keys.
 *
 * @return void
 */
function wp_game_library_register_game_meta() {
	$meta_keys = array(
		'_igdb_id'             => array( 'type' => 'integer' ),
		'_igdb_slug'           => array( 'type' => 'string' ),
		'_game_cover_url'      => array( 'type' => 'string' ),
		'_game_summary'        => array( 'type' => 'string' ),
		'_game_release_date'   => array( 'type' => 'string' ),
		'_game_rating'         => array( 'type' => 'number' ),
		'_game_developers'     => array( 'type' => 'string' ),
		'_game_publishers'     => array( 'type' => 'string' ),
		'_game_genres'         => array( 'type' => 'string' ),
		'_user_play_status'    => array( 'type' => 'string' ),
		'_user_rating'         => array( 'type' => 'number' ),
		'_user_notes'          => array( 'type' => 'string' ),
		'_user_date_added'     => array( 'type' => 'string' ),
		'_user_date_completed' => array( 'type' => 'string' ),
		'_user_ownership'      => array( 'type' => 'string' ),
	);

	foreach ( $meta_keys as $meta_key => $meta_args ) {
		register_post_meta(
			'game',
			$meta_key,
			array(
				'type'              => $meta_args['type'],
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'wp_game_library_sanitize_game_meta',
				'auth_callback'     => static function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'wp_game_library_register_game_meta' );
