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

define( 'WP_GAME_LIBRARY_VERSION', '0.1.0' );

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
	if ( get_option( 'wp_game_library_seeded_game_status_terms', false ) ) {
		return;
	}

	if ( ! taxonomy_exists( 'game_status' ) ) {
		return;
	}

	$statuses = array(
		'Unplayed',
		'Started',
		'Finished',
		'Abandoned',
		'Evergreen',
		'Wishlist',
	);
	$all_terms_seeded = true;

	foreach ( $statuses as $status ) {
		if ( ! term_exists( $status, 'game_status' ) ) {
			$term = wp_insert_term( $status, 'game_status' );

			if ( is_wp_error( $term ) ) {
				$all_terms_seeded = false;
			}
		}
	}

	if ( $all_terms_seeded ) {
		update_option( 'wp_game_library_seeded_game_status_terms', true );
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

		case '_game_screenshots':
			// Accept either a PHP array (from map_game_data) or a JSON-encoded string (from REST/direct calls).
			$decoded = is_array( $value ) ? $value : json_decode( (string) $value, true );
			if ( ! is_array( $decoded ) ) {
				return '';
			}
			$sanitized = array_values(
				array_filter(
					array_map( 'esc_url_raw', $decoded )
				)
			);
			return wp_json_encode( $sanitized );

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
		'_game_screenshots'    => array( 'type' => 'string' ),
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

// ============================================================
// Play Status: Admin Meta Box & Bidirectional Sync
// ============================================================

/**
 * Canonical play status values.
 *
 * @return string[]
 */
function wp_game_library_play_status_options() {
	return array(
		'Unplayed',
		'Started',
		'Finished',
		'Abandoned',
		'Evergreen',
		'Wishlist',
	);
}

/**
 * Register the Play Status meta box on the game edit screen.
 *
 * The default non-hierarchical tag-style metabox for game_status is removed
 * and replaced by this dedicated dropdown so that only canonical values can
 * be selected and the UI stays consistent with the block editor sidebar.
 *
 * @return void
 */
function wp_game_library_add_play_status_meta_box() {
	remove_meta_box( 'tagsdiv-game_status', 'game', 'side' );

	add_meta_box(
		'wp-game-library-play-status',
		__( 'Play Status', 'wp-game-library' ),
		'wp_game_library_render_play_status_meta_box',
		'game',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wp_game_library_add_play_status_meta_box' );

/**
 * Render the Play Status meta box dropdown.
 *
 * The dropdown is pre-populated from the game_status taxonomy (canonical source).
 *
 * @param WP_Post $post Current post object.
 *
 * @return void
 */
function wp_game_library_render_play_status_meta_box( $post ) {
	wp_nonce_field( 'wp_game_library_save_play_status', 'wp_game_library_play_status_nonce' );

	$status_terms   = wp_get_post_terms( $post->ID, 'game_status', array( 'fields' => 'names' ) );
	$current_status = ( ! is_wp_error( $status_terms ) && ! empty( $status_terms ) ) ? $status_terms[0] : '';

	if ( '' === $current_status ) {
		$current_status = (string) get_post_meta( $post->ID, '_user_play_status', true );
	}

	echo '<select id="wp-game-library-play-status" name="wp_game_library_play_status" style="width:100%;">';
	printf(
		'<option value="">%s</option>',
		esc_html__( '— Not Set —', 'wp-game-library' )
	);
	foreach ( wp_game_library_play_status_options() as $status ) {
		printf(
			'<option value="%s"%s>%s</option>',
			esc_attr( $status ),
			selected( $current_status, $status, false ),
			esc_html( $status )
		);
	}
	echo '</select>';
}

/**
 * Save the Play Status meta box value.
 *
 * Updates the game_status taxonomy term; the sync hook keeps
 * _user_play_status meta in step automatically.
 *
 * @param int $post_id Post ID.
 *
 * @return void
 */
function wp_game_library_save_play_status_meta_box( $post_id ) {
	if ( ! isset( $_POST['wp_game_library_play_status_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_key( $_POST['wp_game_library_play_status_nonce'] ), 'wp_game_library_save_play_status' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$new_status = isset( $_POST['wp_game_library_play_status'] )
		? sanitize_text_field( wp_unslash( $_POST['wp_game_library_play_status'] ) )
		: '';

	$allowed = wp_game_library_play_status_options();

	if ( '' === $new_status ) {
		wp_set_object_terms( $post_id, array(), 'game_status' );
		return;
	}

	if ( ! in_array( $new_status, $allowed, true ) ) {
		return;
	}

	$term = get_term_by( 'name', $new_status, 'game_status' );
	if ( $term && ! is_wp_error( $term ) ) {
		wp_set_object_terms( $post_id, array( $term->term_id ), 'game_status' );
	}
}
add_action( 'save_post_game', 'wp_game_library_save_play_status_meta_box' );

/**
 * Sync game_status taxonomy changes to the _user_play_status post meta.
 *
 * Fires after set_object_terms. When the game_status taxonomy term changes
 * (e.g. via the block editor taxonomy panel), this keeps the meta value in sync.
 *
 * @param int    $object_id Object ID.
 * @param array  $terms     Array of object terms (IDs or names).
 * @param array  $tt_ids    Array of term taxonomy IDs.
 * @param string $taxonomy  Taxonomy slug.
 * @param bool   $append    Whether terms were appended or replaced.
 * @param array  $old_tt_ids Old array of term taxonomy IDs.
 *
 * @return void
 */
function wp_game_library_sync_game_status_to_meta( $object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids ) {
	if ( 'game_status' !== $taxonomy || 'game' !== get_post_type( $object_id ) ) {
		return;
	}

	$status_terms = wp_get_object_terms( $object_id, 'game_status', array( 'fields' => 'names' ) );
	$new_status   = ( ! is_wp_error( $status_terms ) && ! empty( $status_terms ) ) ? (string) $status_terms[0] : '';
	$current_meta = (string) get_post_meta( $object_id, '_user_play_status', true );

	if ( $current_meta === $new_status ) {
		return;
	}

	// Detach the reverse sync temporarily to avoid triggering it while updating meta.
	remove_action( 'updated_post_meta', 'wp_game_library_sync_meta_to_game_status', 10 );
	remove_action( 'added_post_meta', 'wp_game_library_sync_meta_to_game_status', 10 );

	update_post_meta( $object_id, '_user_play_status', $new_status );

	add_action( 'updated_post_meta', 'wp_game_library_sync_meta_to_game_status', 10, 4 );
	add_action( 'added_post_meta', 'wp_game_library_sync_meta_to_game_status', 10, 4 );
}
add_action( 'set_object_terms', 'wp_game_library_sync_game_status_to_meta', 10, 6 );

/**
 * Sync _user_play_status meta changes to the game_status taxonomy.
 *
 * Fires after updated_post_meta / added_post_meta. When the meta value is
 * updated directly (e.g. via the REST API in a block-driven flow), this keeps
 * the canonical game_status taxonomy term in step.
 *
 * @param int    $meta_id    ID of the meta entry.
 * @param int    $object_id  Post ID.
 * @param string $meta_key   Meta key.
 * @param mixed  $meta_value New meta value.
 *
 * @return void
 */
function wp_game_library_sync_meta_to_game_status( $meta_id, $object_id, $meta_key, $meta_value ) {
	if ( '_user_play_status' !== $meta_key || 'game' !== get_post_type( $object_id ) ) {
		return;
	}

	$status_terms      = wp_get_object_terms( $object_id, 'game_status', array( 'fields' => 'names' ) );
	$current_term_name = ( ! is_wp_error( $status_terms ) && ! empty( $status_terms ) ) ? (string) $status_terms[0] : '';

	if ( $current_term_name === (string) $meta_value ) {
		return;
	}

	// Detach the reverse sync temporarily to avoid triggering it while updating terms.
	remove_action( 'set_object_terms', 'wp_game_library_sync_game_status_to_meta', 10 );

	if ( '' === (string) $meta_value ) {
		wp_set_object_terms( $object_id, array(), 'game_status' );
	} else {
		$term = get_term_by( 'name', (string) $meta_value, 'game_status' );
		if ( $term && ! is_wp_error( $term ) ) {
			wp_set_object_terms( $object_id, array( $term->term_id ), 'game_status' );
		}
	}

	add_action( 'set_object_terms', 'wp_game_library_sync_game_status_to_meta', 10, 6 );
}
add_action( 'updated_post_meta', 'wp_game_library_sync_meta_to_game_status', 10, 4 );
add_action( 'added_post_meta', 'wp_game_library_sync_meta_to_game_status', 10, 4 );

// ============================================================
// Settings Page
// ============================================================

/**
 * Register the plugin settings page under the Games menu.
 *
 * @return void
 */
function wp_game_library_add_settings_page() {
	add_submenu_page(
		'edit.php?post_type=game',
		__( 'WP Game Library Settings', 'wp-game-library' ),
		__( 'Settings', 'wp-game-library' ),
		'manage_options',
		'wp-game-library-settings',
		'wp_game_library_render_settings_page'
	);
}
add_action( 'admin_menu', 'wp_game_library_add_settings_page' );

/**
 * Register the manual Add Game page under the Games menu.
 *
 * @return void
 */
function wp_game_library_add_manual_add_game_page() {
	$post_type = get_post_type_object( 'game' );

	if ( ! $post_type || empty( $post_type->cap->create_posts ) ) {
		return;
	}

	add_submenu_page(
		'edit.php?post_type=game',
		__( 'Add Game from IGDB', 'wp-game-library' ),
		__( 'Add from IGDB', 'wp-game-library' ),
		$post_type->cap->create_posts,
		'wp-game-library-add-game',
		'wp_game_library_render_manual_add_game_page'
	);
}
add_action( 'admin_menu', 'wp_game_library_add_manual_add_game_page' );

/**
 * Render the manual Add Game admin page.
 *
 * @return void
 */
function wp_game_library_render_manual_add_game_page() {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Add Game from IGDB', 'wp-game-library' ); ?></h1>
		<p><?php esc_html_e( 'Search IGDB by title and import a game into your library.', 'wp-game-library' ); ?></p>
		<?php wp_game_library_render_igdb_search_ui(); ?>
	</div>
	<?php
}

/**
 * Register plugin settings and settings fields.
 *
 * @return void
 */
function wp_game_library_register_settings() {
	register_setting(
		'wp_game_library_settings',
		'wp_game_library_twitch_client_id',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		)
	);

	register_setting(
		'wp_game_library_settings',
		'wp_game_library_twitch_client_secret',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		)
	);

	add_settings_section(
		'wp_game_library_igdb_section',
		__( 'IGDB / Twitch API Credentials', 'wp-game-library' ),
		'wp_game_library_render_igdb_section',
		'wp-game-library-settings'
	);

	add_settings_field(
		'wp_game_library_twitch_client_id',
		__( 'Twitch Client ID', 'wp-game-library' ),
		'wp_game_library_render_client_id_field',
		'wp-game-library-settings',
		'wp_game_library_igdb_section'
	);

	add_settings_field(
		'wp_game_library_twitch_client_secret',
		__( 'Twitch Client Secret', 'wp-game-library' ),
		'wp_game_library_render_client_secret_field',
		'wp-game-library-settings',
		'wp_game_library_igdb_section'
	);
}
add_action( 'admin_init', 'wp_game_library_register_settings' );

/**
 * Render the IGDB settings section description.
 *
 * @return void
 */
function wp_game_library_render_igdb_section() {
	echo '<p>' . esc_html__( 'Enter your Twitch Developer credentials to enable IGDB game search and import. You can obtain these from the Twitch Developer Console at https://dev.twitch.tv/console/apps.', 'wp-game-library' ) . '</p>';
	echo '<p><strong>' . esc_html__( 'Security notice:', 'wp-game-library' ) . '</strong> ' . esc_html__( 'Credentials are stored as plain text in the WordPress options table. Restrict database access and wp-admin access to trusted administrators only.', 'wp-game-library' ) . '</p>';
}

/**
 * Render the Twitch Client ID settings field.
 *
 * @return void
 */
function wp_game_library_render_client_id_field() {
	$value = get_option( 'wp_game_library_twitch_client_id', '' );
	printf(
		'<input type="text" id="wp_game_library_twitch_client_id" name="wp_game_library_twitch_client_id" value="%s" class="regular-text" autocomplete="off" />',
		esc_attr( $value )
	);
}

/**
 * Render the Twitch Client Secret settings field.
 *
 * @return void
 */
function wp_game_library_render_client_secret_field() {
	$value = get_option( 'wp_game_library_twitch_client_secret', '' );
	printf(
		'<input type="password" id="wp_game_library_twitch_client_secret" name="wp_game_library_twitch_client_secret" value="%s" class="regular-text" autocomplete="off" />',
		esc_attr( $value )
	);
}

/**
 * Render the plugin settings page.
 *
 * @return void
 */
function wp_game_library_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'wp_game_library_settings' );
			do_settings_sections( 'wp-game-library-settings' );
			submit_button( __( 'Save Settings', 'wp-game-library' ) );
			?>
		</form>
	</div>
	<?php
}

// ============================================================
// IGDB API Integration
// ============================================================

/**
 * Retrieve a valid Twitch OAuth access token for IGDB requests.
 *
 * The token is cached in a transient until close to expiry.
 *
 * @return string|WP_Error Access token string or WP_Error on failure.
 */
function wp_game_library_igdb_get_access_token() {
	$cached = get_transient( 'wp_game_library_igdb_access_token' );
	if ( ! empty( $cached ) ) {
		return $cached;
	}

	$client_id     = get_option( 'wp_game_library_twitch_client_id', '' );
	$client_secret = get_option( 'wp_game_library_twitch_client_secret', '' );

	if ( empty( $client_id ) || empty( $client_secret ) ) {
		return new WP_Error(
			'missing_credentials',
			__( 'Twitch Client ID and Client Secret must be configured in WP Game Library settings.', 'wp-game-library' )
		);
	}

	$response = wp_remote_post(
		'https://id.twitch.tv/oauth2/token',
		array(
			'body'    => array(
				'client_id'     => $client_id,
				'client_secret' => $client_secret,
				'grant_type'    => 'client_credentials',
			),
			'timeout' => 15,
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$status_code = wp_remote_retrieve_response_code( $response );
	$body        = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( 200 !== $status_code || empty( $body['access_token'] ) ) {
		return new WP_Error(
			'token_request_failed',
			sprintf(
				/* translators: %d: HTTP status code */
				__( 'Failed to retrieve IGDB access token (HTTP %d).', 'wp-game-library' ),
				$status_code
			)
		);
	}

	// Cache for the token lifetime minus a 60-second buffer.
	$expires_in = isset( $body['expires_in'] ) ? max( 0, (int) $body['expires_in'] - 60 ) : 3600;
	set_transient( 'wp_game_library_igdb_access_token', $body['access_token'], $expires_in );

	return $body['access_token'];
}

/**
 * Enforce a rate limit of 4 requests/second for IGDB API calls.
 *
 * Tracks the timestamp of the last request via a transient and sleeps
 * for the remainder of the minimum 250 ms interval when needed.
 *
 * Note: Transient-based timing is best-effort. Under persistent object
 * caching (Redis/Memcached) the read/write latency may reduce precision,
 * and concurrent admin requests can still burst beyond the limit. This
 * implementation is sufficient for single-admin, interactive use.
 *
 * @return void
 */
function wp_game_library_igdb_rate_limit() {
	$min_interval_us = 250000; // 250 ms → max 4 req/s.
	$last_time       = get_transient( 'wp_game_library_igdb_last_request' );

	if ( false !== $last_time ) {
		$elapsed_us = (int) ( ( microtime( true ) - (float) $last_time ) * 1000000 );
		if ( $elapsed_us < $min_interval_us ) {
			usleep( $min_interval_us - $elapsed_us );
		}
	}

	set_transient( 'wp_game_library_igdb_last_request', microtime( true ), 10 );
}

/**
 * Send an authenticated, rate-limited request to the IGDB API.
 *
 * @param string $endpoint IGDB endpoint path (e.g. 'games').
 * @param string $body     Apicalypse query body.
 *
 * @return array|WP_Error Decoded JSON array or WP_Error on failure.
 */
function wp_game_library_igdb_request( $endpoint, $body ) {
	$access_token = wp_game_library_igdb_get_access_token();
	if ( is_wp_error( $access_token ) ) {
		return $access_token;
	}

	$client_id = get_option( 'wp_game_library_twitch_client_id', '' );

	wp_game_library_igdb_rate_limit();

	$response = wp_remote_post(
		'https://api.igdb.com/v4/' . $endpoint,
		array(
			'headers' => array(
				'Client-ID'     => $client_id,
				'Authorization' => 'Bearer ' . $access_token,
				'Content-Type'  => 'text/plain',
			),
			'body'    => $body,
			'timeout' => 15,
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$status_code = wp_remote_retrieve_response_code( $response );

	if ( $status_code < 200 || $status_code >= 300 ) {
		return new WP_Error(
			'igdb_request_failed',
			sprintf(
				/* translators: %d: HTTP status code */
				__( 'IGDB API request failed (HTTP %d).', 'wp-game-library' ),
				$status_code
			)
		);
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( ! is_array( $data ) ) {
		return new WP_Error(
			'igdb_invalid_response',
			__( 'IGDB API returned an unexpected response.', 'wp-game-library' )
		);
	}

	return $data;
}

/**
 * Search IGDB for games matching a title.
 *
 * @param string $title Game title to search for.
 * @param int    $limit Maximum number of results (1–50).
 *
 * @return array[]|WP_Error Array of game data arrays or WP_Error on failure.
 */
function wp_game_library_igdb_search_games( $title, $limit = 10 ) {
	$limit = max( 1, min( 50, (int) $limit ) );

	// Whitelist-sanitize the title to characters safe inside an Apicalypse quoted string.
	// Single and double quotes are excluded to prevent query injection; most game titles
	// are still matched via IGDB's fuzzy search without them.
	$safe_title = preg_replace( '/[^a-zA-Z0-9\s:!&,.-]/', '', $title );

	$body = sprintf(
		'fields id, name, slug, cover.url, summary, first_release_date, platforms.name, genres.name, involved_companies.company.name, involved_companies.developer, involved_companies.publisher, screenshots.url; search "%s"; limit %d;',
		$safe_title,
		$limit
	);

	return wp_game_library_igdb_request( 'games', $body );
}

/**
 * Fetch a single game from IGDB by its numeric ID.
 *
 * @param int $igdb_id IGDB game ID.
 *
 * @return array|WP_Error Single game data array or WP_Error on failure.
 */
function wp_game_library_igdb_fetch_game( $igdb_id ) {
	$igdb_id = absint( $igdb_id );
	$body    = sprintf(
		'fields id, name, slug, cover.url, summary, first_release_date, platforms.name, genres.name, involved_companies.company.name, involved_companies.developer, involved_companies.publisher, screenshots.url; where id = %d; limit 1;',
		$igdb_id
	);

	$results = wp_game_library_igdb_request( 'games', $body );

	if ( is_wp_error( $results ) ) {
		return $results;
	}

	if ( empty( $results[0] ) ) {
		return new WP_Error(
			'igdb_game_not_found',
			sprintf(
				/* translators: %d: IGDB game ID */
				__( 'No IGDB game found with ID %d.', 'wp-game-library' ),
				$igdb_id
			)
		);
	}

	return $results[0];
}

/**
 * Map raw IGDB game data to plugin post-meta key/value pairs.
 *
 * @param array $igdb_data Raw game data from the IGDB API.
 *
 * @return array Associative array of post meta key => sanitized value.
 */
function wp_game_library_igdb_map_game_data( array $igdb_data ) {
	$meta = array();

	if ( ! empty( $igdb_data['id'] ) ) {
		$meta['_igdb_id'] = absint( $igdb_data['id'] );
	}

	if ( ! empty( $igdb_data['slug'] ) ) {
		$meta['_igdb_slug'] = sanitize_text_field( $igdb_data['slug'] );
	}

	if ( ! empty( $igdb_data['summary'] ) ) {
		$meta['_game_summary'] = sanitize_textarea_field( $igdb_data['summary'] );
	}

	// Cover URL: IGDB returns protocol-relative URLs; upgrade to https and use cover_big size.
	if ( ! empty( $igdb_data['cover']['url'] ) ) {
		$cover_url = str_replace( 't_thumb', 't_cover_big', $igdb_data['cover']['url'] );
		if ( str_starts_with( $cover_url, '//' ) ) {
			$cover_url = 'https:' . $cover_url;
		}
		$meta['_game_cover_url'] = esc_url_raw( $cover_url );
	}

	// Release date: IGDB returns a Unix timestamp.
	if ( ! empty( $igdb_data['first_release_date'] ) ) {
		$meta['_game_release_date'] = gmdate( 'Y-m-d', (int) $igdb_data['first_release_date'] );
	}

	// Genres: array of {name} objects → comma-separated string.
	if ( ! empty( $igdb_data['genres'] ) && is_array( $igdb_data['genres'] ) ) {
		$names = array_filter( array_column( $igdb_data['genres'], 'name' ) );
		if ( ! empty( $names ) ) {
			$meta['_game_genres'] = sanitize_text_field( implode( ', ', $names ) );
		}
	}

	// Developers and publishers via involved_companies.
	if ( ! empty( $igdb_data['involved_companies'] ) && is_array( $igdb_data['involved_companies'] ) ) {
		$developers = array();
		$publishers = array();

		foreach ( $igdb_data['involved_companies'] as $entry ) {
			$company_name = isset( $entry['company']['name'] ) ? $entry['company']['name'] : '';
			if ( empty( $company_name ) ) {
				continue;
			}
			if ( ! empty( $entry['developer'] ) ) {
				$developers[] = $company_name;
			}
			if ( ! empty( $entry['publisher'] ) ) {
				$publishers[] = $company_name;
			}
		}

		if ( ! empty( $developers ) ) {
			$meta['_game_developers'] = sanitize_text_field( implode( ', ', $developers ) );
		}
		if ( ! empty( $publishers ) ) {
			$meta['_game_publishers'] = sanitize_text_field( implode( ', ', $publishers ) );
		}
	}

	// Screenshots: array of {url} objects → raw URL array stored so the sanitize_callback handles
	// esc_url_raw() and JSON encoding, avoiding redundant double-processing.
	if ( ! empty( $igdb_data['screenshots'] ) && is_array( $igdb_data['screenshots'] ) ) {
		$urls = array();
		foreach ( $igdb_data['screenshots'] as $screenshot ) {
			if ( empty( $screenshot['url'] ) ) {
				continue;
			}
			$url = str_replace( 't_thumb', 't_screenshot_big', $screenshot['url'] );
			if ( str_starts_with( $url, '//' ) ) {
				$url = 'https:' . $url;
			}
			// Apply esc_url_raw() here as defense-in-depth; the sanitize_callback will also run it.
			$urls[] = esc_url_raw( $url );
		}
		if ( ! empty( $urls ) ) {
			$meta['_game_screenshots'] = $urls;
		}
	}

	return $meta;
}

/**
 * Persist IGDB game data as post meta and taxonomy terms for a game post.
 *
 * @param int   $post_id   Post ID of the game CPT entry.
 * @param array $igdb_data Raw game data from the IGDB API.
 *
 * @return void
 */
function wp_game_library_igdb_cache_game_data( $post_id, array $igdb_data ) {
	$meta = wp_game_library_igdb_map_game_data( $igdb_data );
	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	// Assign platform names as game_platform taxonomy terms.
	if ( ! empty( $igdb_data['platforms'] ) && is_array( $igdb_data['platforms'] ) ) {
		$platform_names = array_values( array_filter( array_column( $igdb_data['platforms'], 'name' ) ) );
		if ( ! empty( $platform_names ) ) {
			wp_set_object_terms( $post_id, $platform_names, 'game_platform' );
		}
	}
}

// ============================================================
// REST API Endpoints
// ============================================================

/**
 * Register WP Game Library REST API routes.
 *
 * @return void
 */
function wp_game_library_register_rest_routes() {
	register_rest_route(
		'wp-game-library/v1',
		'/games/search',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'wp_game_library_rest_search_games',
			'permission_callback' => static function () {
				return current_user_can( 'edit_posts' );
			},
			'args'                => array(
				'title' => array(
					'required'          => true,
					'type'              => 'string',
					'sanitize_callback' => 'sanitize_text_field',
				),
				'limit' => array(
					'required' => false,
					'type'     => 'integer',
					'default'  => 10,
					'minimum'  => 1,
					'maximum'  => 50,
				),
			),
		)
	);

	register_rest_route(
		'wp-game-library/v1',
		'/games/import',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'wp_game_library_rest_import_game',
			'permission_callback' => static function () {
				$post_type = get_post_type_object( 'game' );

				if ( ! $post_type || empty( $post_type->cap->create_posts ) ) {
					return false;
				}

				return current_user_can( $post_type->cap->create_posts );
			},
			'args'                => array(
				'igdb_id' => array(
					'required' => true,
					'type'     => 'integer',
					'minimum'  => 1,
				),
				'post_id' => array(
					'required' => false,
					'type'     => 'integer',
					'minimum'  => 1,
				),
			),
		)
	);
}
add_action( 'rest_api_init', 'wp_game_library_register_rest_routes' );

/**
 * REST callback: search IGDB for games by title.
 *
 * @param WP_REST_Request $request Incoming REST request.
 *
 * @return WP_REST_Response|WP_Error
 */
function wp_game_library_rest_search_games( WP_REST_Request $request ) {
	$title   = $request->get_param( 'title' );
	$limit   = $request->get_param( 'limit' );
	$results = wp_game_library_igdb_search_games( $title, $limit );

	if ( is_wp_error( $results ) ) {
		return $results;
	}

	$games = array();
	foreach ( $results as $game ) {
		$cover_url = '';
		if ( ! empty( $game['cover']['url'] ) ) {
			$cover_url = str_replace( 't_thumb', 't_cover_small', $game['cover']['url'] );
			if ( str_starts_with( $cover_url, '//' ) ) {
				$cover_url = 'https:' . $cover_url;
			}
		}

		$games[] = array(
			'id'           => (int) $game['id'],
			'name'         => isset( $game['name'] ) ? $game['name'] : '',
			'cover_url'    => $cover_url,
			'release_year' => ! empty( $game['first_release_date'] )
				? (int) gmdate( 'Y', (int) $game['first_release_date'] )
				: null,
			'platforms'    => ! empty( $game['platforms'] )
				? array_values( array_filter( array_column( $game['platforms'], 'name' ) ) )
				: array(),
		);
	}

	return rest_ensure_response( $games );
}

/**
 * REST callback: fetch a game from IGDB and optionally cache it to a post.
 *
 * @param WP_REST_Request $request Incoming REST request.
 *
 * @return WP_REST_Response|WP_Error
 */
function wp_game_library_rest_import_game( WP_REST_Request $request ) {
	$igdb_id   = (int) $request->get_param( 'igdb_id' );
	$post_id   = $request->get_param( 'post_id' );
	$igdb_data = wp_game_library_igdb_fetch_game( $igdb_id );

	if ( is_wp_error( $igdb_data ) ) {
		return $igdb_data;
	}

	$mapped = wp_game_library_igdb_map_game_data( $igdb_data );
	$existing_post_id = wp_game_library_find_game_post_by_igdb_id( $igdb_id );

	if ( ! empty( $existing_post_id ) ) {
		$post_id = (int) $existing_post_id;
	}

	if ( ! empty( $post_id ) ) {
		$post_id = absint( $post_id );

		if ( 'game' !== get_post_type( $post_id ) ) {
			return new WP_Error(
				'invalid_post',
				__( 'The supplied post ID does not correspond to a game.', 'wp-game-library' ),
				array( 'status' => 400 )
			);
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return new WP_Error(
				'rest_forbidden',
				__( 'You do not have permission to edit this game.', 'wp-game-library' ),
				array( 'status' => 403 )
			);
		}
	} else {
		$post_title = ! empty( $igdb_data['name'] )
			? sanitize_text_field( $igdb_data['name'] )
			: sprintf(
				/* translators: %d: IGDB game ID */
				__( 'IGDB Game %d', 'wp-game-library' ),
				$igdb_id
			);

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'game',
				'post_status' => 'draft',
				'post_title'  => $post_title,
				'post_name'   => sanitize_title( $post_title ),
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			return $post_id;
		}
	}

	wp_game_library_igdb_cache_game_data( $post_id, $igdb_data );

	// Update the post title when the post is still a draft.
	$post = get_post( $post_id );
	if ( $post && 'auto-draft' === $post->post_status && ! empty( $igdb_data['name'] ) ) {
		wp_update_post(
			array(
				'ID'         => $post_id,
				'post_title' => sanitize_text_field( $igdb_data['name'] ),
				'post_name'  => sanitize_title( $igdb_data['name'] ),
			)
		);
	}

	return rest_ensure_response(
		array_merge(
			$mapped,
			array(
				'post_id' => (int) $post_id,
				'name'    => isset( $igdb_data['name'] ) ? $igdb_data['name'] : '',
			)
		)
	);
}

/**
 * Find a game post ID by IGDB ID.
 *
 * @param int $igdb_id IGDB game ID.
 *
 * @return int Matching game post ID or 0 when not found.
 */
function wp_game_library_find_game_post_by_igdb_id( $igdb_id ) {
	$query = new WP_Query(
		array(
			'post_type'      => 'game',
			'post_status'    => array( 'publish', 'future', 'draft', 'pending', 'private' ),
			'fields'         => 'ids',
			'posts_per_page' => 1,
			'meta_query'     => array(
				array(
					'key'   => '_igdb_id',
					'value' => absint( $igdb_id ),
				),
			),
			'no_found_rows'  => true,
		)
	);

	if ( empty( $query->posts[0] ) ) {
		return 0;
	}

	return (int) $query->posts[0];
}

// ============================================================
// Admin Meta Box: IGDB Search
// ============================================================

/**
 * Register the IGDB search meta box on the game post edit screen.
 *
 * @return void
 */
function wp_game_library_add_igdb_meta_box() {
	add_meta_box(
		'wp-game-library-igdb-search',
		__( 'Search IGDB', 'wp-game-library' ),
		'wp_game_library_render_igdb_meta_box',
		'game',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wp_game_library_add_igdb_meta_box' );

/**
 * Render the shared IGDB search UI.
 *
 * @param int $igdb_id Existing IGDB ID for refresh actions.
 *
 * @return void
 */
function wp_game_library_render_igdb_search_ui( $igdb_id = 0 ) {
	?>
	<div id="wp-game-library-igdb-search-wrap">
		<?php if ( ! empty( $igdb_id ) ) : ?>
		<p>
			<?php
			printf(
				/* translators: %d: IGDB game ID */
				esc_html__( 'IGDB ID: %d', 'wp-game-library' ),
				(int) $igdb_id
			);
			?>
			&nbsp;
			<button type="button" id="wp-game-library-igdb-refresh-btn" class="button button-small">
				<?php esc_html_e( 'Refresh from IGDB', 'wp-game-library' ); ?>
			</button>
			<span id="wp-game-library-igdb-refresh-status" style="display:block;margin-top:4px;"></span>
		</p>
		<hr />
		<?php endif; ?>
		<p>
			<label for="wp-game-library-igdb-title"><?php esc_html_e( 'Game Title:', 'wp-game-library' ); ?></label>
			<input type="text" id="wp-game-library-igdb-title" class="widefat" placeholder="<?php esc_attr_e( 'Search IGDB…', 'wp-game-library' ); ?>" />
		</p>
		<p>
			<button type="button" id="wp-game-library-igdb-search-btn" class="button">
				<?php esc_html_e( 'Search IGDB', 'wp-game-library' ); ?>
			</button>
		</p>
		<div id="wp-game-library-igdb-results" style="display:none;">
			<p><strong><?php esc_html_e( 'Select a game:', 'wp-game-library' ); ?></strong></p>
			<ul id="wp-game-library-igdb-results-list" style="max-height:200px;overflow-y:auto;margin:0;padding:0;list-style:none;border:1px solid #ddd;background:#fff;"></ul>
		</div>
		<div id="wp-game-library-igdb-selected" style="display:none;">
			<hr />
			<p id="wp-game-library-igdb-selected-name" style="font-weight:bold;margin-bottom:8px;"></p>
			<button type="button" id="wp-game-library-igdb-import-btn" class="button button-primary">
				<?php esc_html_e( 'Import from IGDB', 'wp-game-library' ); ?>
			</button>
			<span id="wp-game-library-igdb-import-status" style="display:block;margin-top:4px;"></span>
		</div>
		<div id="wp-game-library-igdb-error" style="display:none;color:#d63638;margin-top:8px;"></div>
	</div>
	<?php
}

/**
 * Render the IGDB search meta box content.
 *
 * @param WP_Post $post Current post object.
 *
 * @return void
 */
function wp_game_library_render_igdb_meta_box( $post ) {
	wp_nonce_field( 'wp_game_library_igdb_meta_box', 'wp_game_library_igdb_nonce' );
	$igdb_id = get_post_meta( $post->ID, '_igdb_id', true );
	wp_game_library_render_igdb_search_ui( $igdb_id );
}

/**
 * Enqueue admin JavaScript for the IGDB search meta box.
 *
 * @param string $hook Current admin page hook.
 *
 * @return void
 */
function wp_game_library_enqueue_igdb_admin_script( $hook ) {
	global $post;

	$is_manual_add_page = ( 'game_page_wp-game-library-add-game' === $hook );

	if ( 'post.php' !== $hook && 'post-new.php' !== $hook && ! $is_manual_add_page ) {
		return;
	}

	$post_id = 0;
	$igdb_id = null;

	if ( ! $is_manual_add_page ) {
		if ( ! isset( $post ) || 'game' !== $post->post_type ) {
			return;
		}

		$post_id = (int) $post->ID;
		$igdb_id = get_post_meta( $post->ID, '_igdb_id', true );
	}

	wp_enqueue_script(
		'wp-game-library-igdb-admin',
		plugin_dir_url( __FILE__ ) . 'assets/js/igdb-admin.js',
		array( 'jquery' ),
		WP_GAME_LIBRARY_VERSION,
		true
	);

	wp_localize_script(
		'wp-game-library-igdb-admin',
		'wpGameLibraryIGDB',
		array(
			'restUrl'   => rest_url( 'wp-game-library/v1' ),
			'restNonce' => wp_create_nonce( 'wp_rest' ),
			'postId'    => $post_id,
			'igdbId'    => ! empty( $igdb_id ) ? (int) $igdb_id : null,
			'editPostUrl' => admin_url( 'post.php?action=edit&post=' ),
			'i18n'      => array(
				'searching'    => __( 'Searching…', 'wp-game-library' ),
				'importing'    => __( 'Importing…', 'wp-game-library' ),
				'refreshing'   => __( 'Refreshing…', 'wp-game-library' ),
				'addDone'      => __( 'Game added! Opening editor…', 'wp-game-library' ),
				'importDone'   => __( 'Imported! Reload the page to see the updated fields.', 'wp-game-library' ),
				'refreshDone'  => __( 'Refreshed! Reload the page to see the updated fields.', 'wp-game-library' ),
				'noResults'    => __( 'No results found.', 'wp-game-library' ),
				'errorGeneric' => __( 'An error occurred. Please check your IGDB settings.', 'wp-game-library' ),
				'searchBtn'    => __( 'Search IGDB', 'wp-game-library' ),
			),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'wp_game_library_enqueue_igdb_admin_script' );

/**
 * Register the Game Card Gutenberg block.
 *
 * @return void
 */
function wp_game_library_register_game_card_block() {
	wp_register_script(
		'wp-game-library-game-card-block',
		plugin_dir_url( __FILE__ ) . 'assets/js/game-card-block.js',
		array( 'wp-api-fetch', 'wp-block-editor', 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-server-side-render' ),
		WP_GAME_LIBRARY_VERSION,
		true
	);

	register_block_type(
		'wp-game-library/game-card',
		array(
			'editor_script'   => 'wp-game-library-game-card-block',
			'render_callback' => 'wp_game_library_render_game_card_block',
			'attributes'      => array(
				'gamePostId' => array(
					'type'    => 'integer',
					'default' => 0,
				),
				'gameTitle'  => array(
					'type'    => 'string',
					'default' => '',
				),
				'variation'  => array(
					'type'    => 'string',
					'default' => 'full',
				),
			),
			'supports'        => array(
				'html' => false,
			),
		)
	);
}
add_action( 'init', 'wp_game_library_register_game_card_block', 20 );

/**
 * Render callback for the Game Card block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Serialized inner blocks content.
 *
 * @return string
 */
function wp_game_library_render_game_card_block( $attributes, $content ) {
	$post_id = isset( $attributes['gamePostId'] ) ? absint( $attributes['gamePostId'] ) : 0;

	if ( ! $post_id || 'game' !== get_post_type( $post_id ) ) {
		return '<div class="wp-game-library-game-card-placeholder">' . esc_html__( 'Select a game to display a game card.', 'wp-game-library' ) . '</div>';
	}

	$variation = ( isset( $attributes['variation'] ) && 'compact' === $attributes['variation'] ) ? 'compact' : 'full';
	$title     = get_the_title( $post_id );
	$cover_url = get_post_meta( $post_id, '_game_cover_url', true );
	$summary   = get_post_meta( $post_id, '_game_summary', true );
	$status    = get_post_meta( $post_id, '_user_play_status', true );
	$rating    = get_post_meta( $post_id, '_user_rating', true );

	$platform_names = wp_get_post_terms( $post_id, 'game_platform', array( 'fields' => 'names' ) );
	$platforms      = ! is_wp_error( $platform_names ) ? implode( ', ', $platform_names ) : '';

	if ( empty( $status ) ) {
		$status_names = wp_get_post_terms( $post_id, 'game_status', array( 'fields' => 'names' ) );
		if ( ! is_wp_error( $status_names ) && ! empty( $status_names[0] ) ) {
			$status = $status_names[0];
		}
	}

	$inner_content = '';
	if ( ! empty( $content ) ) {
		$inner_content = $content;
	}

	ob_start();
	?>
	<article class="wp-block-wp-game-library-game-card wp-game-library-game-card is-variation-<?php echo esc_attr( $variation ); ?>">
		<?php if ( ! empty( $cover_url ) ) : ?>
		<div class="wp-game-library-game-card__cover">
			<img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Cover art for %s', 'wp-game-library' ), $title ) ); ?>" loading="lazy" />
		</div>
		<?php endif; ?>
		<div class="wp-game-library-game-card__content">
			<h3 class="wp-game-library-game-card__title"><?php echo esc_html( $title ); ?></h3>
			<?php if ( ! empty( $platforms ) ) : ?>
			<p class="wp-game-library-game-card__platforms"><?php echo esc_html( $platforms ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $status ) ) : ?>
			<p class="wp-game-library-game-card__status"><?php echo esc_html( $status ); ?></p>
			<?php endif; ?>
			<?php if ( '' !== $rating && null !== $rating ) : ?>
			<p class="wp-game-library-game-card__rating">
				<?php
				printf(
					/* translators: %s: User rating */
					esc_html__( 'User rating: %s', 'wp-game-library' ),
					esc_html( number_format_i18n( (float) $rating, 1 ) )
				);
				?>
			</p>
			<?php endif; ?>
			<?php if ( 'full' === $variation && ! empty( $summary ) ) : ?>
			<p class="wp-game-library-game-card__summary"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $inner_content ) ) : ?>
			<div class="wp-game-library-game-card__inner-content"><?php echo wp_kses_post( $inner_content ); ?></div>
			<?php endif; ?>
		</div>
	</article>
	<?php
	return (string) ob_get_clean();
}

/**
 * Get sanitized archive filters from the request.
 *
 * @return array<string, string> Sanitized filter and sort values.
 */
function wp_game_library_get_archive_filters() {
	return array(
		'status'     => isset( $_GET['status'] ) ? sanitize_title( wp_unslash( $_GET['status'] ) ) : '',
		'platform'   => isset( $_GET['platform'] ) ? sanitize_title( wp_unslash( $_GET['platform'] ) ) : '',
		'genre'      => isset( $_GET['genre'] ) ? sanitize_title( wp_unslash( $_GET['genre'] ) ) : '',
		'collection' => isset( $_GET['collection'] ) ? sanitize_title( wp_unslash( $_GET['collection'] ) ) : '',
		'sort'       => isset( $_GET['sort'] ) ? sanitize_key( wp_unslash( $_GET['sort'] ) ) : 'date_desc',
	);
}

/**
 * Determine whether a cover image host is allowed.
 *
 * @param string $host          Hostname parsed from the cover URL.
 * @param array  $allowed_hosts Allowed hostnames.
 *
 * @return bool
 */
function wp_game_library_is_allowed_cover_host( $host, $allowed_hosts ) {
	$host = strtolower( (string) $host );

	foreach ( $allowed_hosts as $allowed_host ) {
		$allowed_host = strtolower( (string) $allowed_host );

		if ( '' === $allowed_host ) {
			continue;
		}

		if ( $host === $allowed_host ) {
			return true;
		}

		$suffix = '.' . $allowed_host;
		if ( strlen( $host ) > strlen( $allowed_host ) && substr( $host, -strlen( $suffix ) ) === $suffix ) {
			return true;
		}
	}

	return false;
}

/**
 * Get a placeholder image data URI for game covers.
 *
 * @return string
 */
function wp_game_library_get_cover_placeholder_image() {
	return 'data:image/svg+xml;utf8,' . rawurlencode( '<svg xmlns="http://www.w3.org/2000/svg" width="480" height="640" viewBox="0 0 480 640"><rect width="480" height="640" fill="#f1f1f1"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#6b7280" font-family="Arial,sans-serif" font-size="24">No Cover</text></svg>' );
}

/**
 * Get a safe cover image URL for archive cards.
 *
 * @param string $cover_url Raw cover URL stored in post meta.
 *
 * @return string
 */
function wp_game_library_get_archive_cover_image_url( $cover_url ) {
	$placeholder = wp_game_library_get_cover_placeholder_image();
	$cover_url   = is_string( $cover_url ) ? trim( $cover_url ) : '';

	if ( '' === $cover_url ) {
		return $placeholder;
	}

	$cover_url = esc_url_raw( $cover_url, array( 'http', 'https' ) );

	if ( '' === $cover_url ) {
		return $placeholder;
	}

	$host = wp_parse_url( $cover_url, PHP_URL_HOST );

	if ( empty( $host ) ) {
		return $placeholder;
	}

	$site_host = wp_parse_url( home_url(), PHP_URL_HOST );

	/**
	 * Filters allowed hosts for archive cover image URLs.
	 *
	 * @param array $allowed_hosts Allowed cover image hosts.
	 */
	$allowed_hosts = apply_filters(
		'wp_game_library_archive_allowed_cover_hosts',
		array_filter(
			array(
				'images.igdb.com',
				'cdn.igdb.com',
				$site_host,
			)
		)
	);

	if ( wp_game_library_is_allowed_cover_host( $host, $allowed_hosts ) ) {
		return $cover_url;
	}

	return $placeholder;
}

/**
 * Apply filtering, sorting, and pagination defaults to the game archive.
 *
 * @param WP_Query $query Query object.
 *
 * @return void
 */
function wp_game_library_filter_game_archive_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'game' ) ) {
		return;
	}

	$archive_filters = wp_game_library_get_archive_filters();

	$query->set( 'post_status', 'publish' );
	$query->set( 'posts_per_page', 12 );

	$tax_map   = array(
		'game_status'     => 'status',
		'game_platform'   => 'platform',
		'game_genre'      => 'genre',
		'game_collection' => 'collection',
	);
	$tax_query = array();

	foreach ( $tax_map as $taxonomy => $query_key ) {
		$term_slug = $archive_filters[ $query_key ];

		if ( '' === $term_slug || ! taxonomy_exists( $taxonomy ) ) {
			continue;
		}

		$tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_slug,
		);
	}

	if ( ! empty( $tax_query ) ) {
		$query->set( 'tax_query', $tax_query );
	}

	$sort = $archive_filters['sort'];

	switch ( $sort ) {
		case 'title_asc':
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
			break;

		case 'title_desc':
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'DESC' );
			break;

		case 'date_asc':
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'ASC' );
			break;

		case 'rating_desc':
			$query->set(
				'meta_query',
				array(
					'relation'       => 'OR',
					'rating_clause'  => array(
						'key'     => '_user_rating',
						'compare' => 'EXISTS',
						'type'    => 'NUMERIC',
					),
					'rating_missing' => array(
						'key'     => '_user_rating',
						'compare' => 'NOT EXISTS',
					),
				)
			);
			$query->set(
				'orderby',
				array(
					'rating_clause' => 'DESC',
					'date'          => 'DESC',
				)
			);
			break;

		case 'rating_asc':
			$query->set(
				'meta_query',
				array(
					'relation'       => 'OR',
					'rating_clause'  => array(
						'key'     => '_user_rating',
						'compare' => 'EXISTS',
						'type'    => 'NUMERIC',
					),
					'rating_missing' => array(
						'key'     => '_user_rating',
						'compare' => 'NOT EXISTS',
					),
				)
			);
			$query->set(
				'orderby',
				array(
					'rating_clause' => 'ASC',
					'date'          => 'DESC',
				)
			);
			break;

		case 'date_desc':
		default:
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'DESC' );
			break;
	}
}
add_action( 'pre_get_posts', 'wp_game_library_filter_game_archive_query' );

/**
 * Enqueue front-end assets for the game archive.
 *
 * @return void
 */
function wp_game_library_enqueue_archive_assets() {
	if ( ! is_post_type_archive( 'game' ) ) {
		return;
	}

	wp_enqueue_style(
		'wp-game-library-archive',
		plugin_dir_url( __FILE__ ) . 'assets/css/game-archive.css',
		array(),
		WP_GAME_LIBRARY_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'wp_game_library_enqueue_archive_assets' );

/**
 * Enqueue front-end assets for single game views.
 *
 * @return void
 */
function wp_game_library_enqueue_single_assets() {
	if ( ! is_singular( 'game' ) ) {
		return;
	}

	wp_enqueue_style(
		'wp-game-library-single',
		plugin_dir_url( __FILE__ ) . 'assets/css/single-game.css',
		array(),
		WP_GAME_LIBRARY_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'wp_game_library_enqueue_single_assets' );

/**
 * Use plugin template for the game archive.
 *
 * @param string $template Resolved template path.
 *
 * @return string
 */
function wp_game_library_game_archive_template( $template ) {
	if ( ! is_post_type_archive( 'game' ) ) {
		return $template;
	}

	$theme_archive_template = locate_template( 'archive-game.php' );

	if ( ! empty( $theme_archive_template ) ) {
		return $theme_archive_template;
	}

	$archive_template = plugin_dir_path( __FILE__ ) . 'templates/archive-game.php';

	if ( file_exists( $archive_template ) ) {
		return $archive_template;
	}

	return $template;
}
add_filter( 'template_include', 'wp_game_library_game_archive_template' );

/**
 * Use plugin template for single game views.
 *
 * @param string $template Resolved template path.
 *
 * @return string
 */
function wp_game_library_single_game_template( $template ) {
	if ( ! is_singular( 'game' ) ) {
		return $template;
	}

	$theme_single_template = locate_template( 'single-game.php' );

	if ( ! empty( $theme_single_template ) ) {
		return $theme_single_template;
	}

	$single_template = plugin_dir_path( __FILE__ ) . 'templates/single-game.php';

	if ( file_exists( $single_template ) ) {
		return $single_template;
	}

	return $template;
}
add_filter( 'template_include', 'wp_game_library_single_game_template' );
