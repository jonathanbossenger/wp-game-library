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
		'menu_icon'          => 'dashicons-gamepad',
	);

	register_post_type( 'game', $args );
}
add_action( 'init', 'wp_game_library_register_game_post_type' );

/**
 * Register core game taxonomies.
 *
 * @return void
 */
function wp_game_library_register_game_taxonomies() {
	$taxonomies = array(
		'game_platform'   => array(
			'hierarchical' => false,
			'labels'       => array(
				'name'                       => __( 'Platforms', 'wp-game-library' ),
				'singular_name'              => __( 'Platform', 'wp-game-library' ),
				'search_items'               => __( 'Search Platforms', 'wp-game-library' ),
				'popular_items'              => __( 'Popular Platforms', 'wp-game-library' ),
				'all_items'                  => __( 'All Platforms', 'wp-game-library' ),
				'edit_item'                  => __( 'Edit Platform', 'wp-game-library' ),
				'update_item'                => __( 'Update Platform', 'wp-game-library' ),
				'add_new_item'               => __( 'Add New Platform', 'wp-game-library' ),
				'new_item_name'              => __( 'New Platform Name', 'wp-game-library' ),
				'separate_items_with_commas' => __( 'Separate platforms with commas', 'wp-game-library' ),
				'add_or_remove_items'        => __( 'Add or remove platforms', 'wp-game-library' ),
				'choose_from_most_used'      => __( 'Choose from the most used platforms', 'wp-game-library' ),
				'menu_name'                  => __( 'Platforms', 'wp-game-library' ),
			),
			'rewrite'      => array(
				'slug'       => 'game-platform',
				'with_front' => false,
			),
		),
		'game_genre'      => array(
			'hierarchical' => true,
			'labels'       => array(
				'name'              => __( 'Genres', 'wp-game-library' ),
				'singular_name'     => __( 'Genre', 'wp-game-library' ),
				'search_items'      => __( 'Search Genres', 'wp-game-library' ),
				'all_items'         => __( 'All Genres', 'wp-game-library' ),
				'parent_item'       => __( 'Parent Genre', 'wp-game-library' ),
				'parent_item_colon' => __( 'Parent Genre:', 'wp-game-library' ),
				'edit_item'         => __( 'Edit Genre', 'wp-game-library' ),
				'update_item'       => __( 'Update Genre', 'wp-game-library' ),
				'add_new_item'      => __( 'Add New Genre', 'wp-game-library' ),
				'new_item_name'     => __( 'New Genre Name', 'wp-game-library' ),
				'menu_name'         => __( 'Genres', 'wp-game-library' ),
			),
			'rewrite'      => array(
				'slug'       => 'game-genre',
				'with_front' => false,
			),
		),
		'game_status'     => array(
			'hierarchical' => false,
			'labels'       => array(
				'name'                       => __( 'Statuses', 'wp-game-library' ),
				'singular_name'              => __( 'Status', 'wp-game-library' ),
				'search_items'               => __( 'Search Statuses', 'wp-game-library' ),
				'popular_items'              => __( 'Popular Statuses', 'wp-game-library' ),
				'all_items'                  => __( 'All Statuses', 'wp-game-library' ),
				'edit_item'                  => __( 'Edit Status', 'wp-game-library' ),
				'update_item'                => __( 'Update Status', 'wp-game-library' ),
				'add_new_item'               => __( 'Add New Status', 'wp-game-library' ),
				'new_item_name'              => __( 'New Status Name', 'wp-game-library' ),
				'separate_items_with_commas' => __( 'Separate statuses with commas', 'wp-game-library' ),
				'add_or_remove_items'        => __( 'Add or remove statuses', 'wp-game-library' ),
				'choose_from_most_used'      => __( 'Choose from the most used statuses', 'wp-game-library' ),
				'menu_name'                  => __( 'Statuses', 'wp-game-library' ),
			),
			'rewrite'      => array(
				'slug'       => 'game-status',
				'with_front' => false,
			),
		),
		'game_collection' => array(
			'hierarchical' => false,
			'labels'       => array(
				'name'                       => __( 'Collections', 'wp-game-library' ),
				'singular_name'              => __( 'Collection', 'wp-game-library' ),
				'search_items'               => __( 'Search Collections', 'wp-game-library' ),
				'popular_items'              => __( 'Popular Collections', 'wp-game-library' ),
				'all_items'                  => __( 'All Collections', 'wp-game-library' ),
				'edit_item'                  => __( 'Edit Collection', 'wp-game-library' ),
				'update_item'                => __( 'Update Collection', 'wp-game-library' ),
				'add_new_item'               => __( 'Add New Collection', 'wp-game-library' ),
				'new_item_name'              => __( 'New Collection Name', 'wp-game-library' ),
				'separate_items_with_commas' => __( 'Separate collections with commas', 'wp-game-library' ),
				'add_or_remove_items'        => __( 'Add or remove collections', 'wp-game-library' ),
				'choose_from_most_used'      => __( 'Choose from the most used collections', 'wp-game-library' ),
				'menu_name'                  => __( 'Collections', 'wp-game-library' ),
			),
			'rewrite'      => array(
				'slug'       => 'game-collection',
				'with_front' => false,
			),
		),
	);

	foreach ( $taxonomies as $taxonomy => $taxonomy_args ) {
		register_taxonomy(
			$taxonomy,
			array( 'game' ),
			array(
				'labels'            => $taxonomy_args['labels'],
				'public'            => true,
				'hierarchical'      => $taxonomy_args['hierarchical'],
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_quick_edit' => true,
				'show_in_rest'      => true,
				'rewrite'           => $taxonomy_args['rewrite'],
			)
		);
	}
}
add_action( 'init', 'wp_game_library_register_game_taxonomies', 11 );

/**
 * Ensure core game status terms exist.
 *
 * @return void
 */
function wp_game_library_seed_game_status_terms() {
	$statuses = array(
		'Unplayed',
		'Started',
		'Finished',
		'Abandoned',
		'Evergreen',
		'Wishlist',
	);

	foreach ( $statuses as $status ) {
		if ( ! term_exists( $status, 'game_status' ) ) {
			wp_insert_term( $status, 'game_status' );
		}
	}
}
add_action( 'init', 'wp_game_library_seed_game_status_terms', 12 );

/**
 * Sanitize game meta values before storage.
 *
 * @param mixed  $value    Meta value.
 * @param string $meta_key        Meta key.
 * @param string $object_type    Object type.
 * @param string $object_subtype Object subtype.
 *
 * @return mixed
 */
function wp_game_library_sanitize_game_meta( $value, $meta_key = '', $object_type = '', $object_subtype = '' ) {
	switch ( $meta_key ) {
		case '_igdb_id':
			return is_numeric( $value ) ? absint( $value ) : 0;

		case '_game_rating':
		case '_user_rating':
			return is_numeric( $value ) ? (float) $value : 0.0;

		case '_game_cover_url':
			return esc_url_raw( $value );

		case '_game_release_date':
		case '_user_date_added':
		case '_user_date_completed':
			$raw_date = trim( (string) $value );

			if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $raw_date ) ) {
				$parts = explode( '-', $raw_date );
				$year  = (int) $parts[0];

				if ( checkdate( (int) $parts[1], (int) $parts[2], $year ) && $year >= 1950 && $year <= 2100 ) {
					return $raw_date;
				}
			}

			$date_formats = array(
				'Y-m-d\TH:i:sP',
				'Y-m-d H:i:s',
			);

			foreach ( $date_formats as $date_format ) {
				$date_time = DateTimeImmutable::createFromFormat( $date_format, $raw_date );

				if ( false === $date_time ) {
					continue;
				}

				$year = (int) $date_time->format( 'Y' );

				if ( $year >= 1950 && $year <= 2100 ) {
					return $date_time->format( 'Y-m-d' );
				}
			}

			return '';

		case '_game_summary':
		case '_user_notes':
			return sanitize_textarea_field( (string) $value );

		case '_igdb_slug':
		case '_game_developers':
		case '_game_publishers':
		case '_game_genres':
		case '_user_play_status':
		case '_user_ownership':
			return sanitize_text_field( (string) $value );

		default:
			return sanitize_text_field( (string) $value );
	}
}

/**
 * Authorize updates to game meta values.
 *
 * @param bool   $allowed  Whether the user can add the meta.
 * @param string $meta_key The meta key.
 * @param int    $post_id  Post ID.
 * @param int    $user_id  User ID.
 *
 * @return bool
 */
function wp_game_library_auth_game_meta( $allowed, $meta_key, $post_id, $user_id ) {
	if ( empty( $post_id ) ) {
		$post_type = get_post_type_object( 'game' );

		if ( ! $post_type || empty( $post_type->cap->create_posts ) ) {
			return false;
		}

		return user_can( $user_id, $post_type->cap->create_posts );
	}

	if ( 'game' !== get_post_type( $post_id ) ) {
		return false;
	}

	return user_can( $user_id, 'edit_post', $post_id );
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
				'sanitize_callback' => static function( $value ) use ( $meta_key ) {
					return wp_game_library_sanitize_game_meta( $value, $meta_key );
				},
				'auth_callback'     => 'wp_game_library_auth_game_meta',
			)
		);
	}
}
add_action( 'init', 'wp_game_library_register_game_meta' );
