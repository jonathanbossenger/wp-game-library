<?php
/**
 * Single game template.
 *
 * @package WP_Game_Library
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$format_date_for_display = static function ( $date_value ) {
	if ( ! is_string( $date_value ) || '' === trim( $date_value ) ) {
		return '';
	}

	$timestamp = strtotime( $date_value );

	if ( false === $timestamp ) {
		return '';
	}

	return date_i18n( get_option( 'date_format' ), $timestamp );
};
?>

<main id="primary" class="site-main wp-game-library-single-game">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();

			$post_id             = get_the_ID();
			$title               = get_the_title();
			$raw_cover_url       = get_post_meta( $post_id, '_game_cover_url', true );
			$summary             = get_post_meta( $post_id, '_game_summary', true );
			$release_date        = get_post_meta( $post_id, '_game_release_date', true );
			$developers          = get_post_meta( $post_id, '_game_developers', true );
			$publishers          = get_post_meta( $post_id, '_game_publishers', true );
			$stored_genres       = get_post_meta( $post_id, '_game_genres', true );
			$play_status         = get_post_meta( $post_id, '_user_play_status', true );
			$user_rating         = get_post_meta( $post_id, '_user_rating', true );
			$user_notes          = get_post_meta( $post_id, '_user_notes', true );
			$user_ownership      = get_post_meta( $post_id, '_user_ownership', true );
			$user_date_added     = get_post_meta( $post_id, '_user_date_added', true );
			$user_date_completed = get_post_meta( $post_id, '_user_date_completed', true );

			if ( function_exists( 'wp_game_library_get_archive_cover_image_url' ) ) {
				$cover_url = wp_game_library_get_archive_cover_image_url( $raw_cover_url );
			} else {
				$cover_url = esc_url_raw( $raw_cover_url, array( 'http', 'https' ) );

				if ( empty( $cover_url ) && function_exists( 'wp_game_library_get_cover_placeholder_image' ) ) {
					$cover_url = wp_game_library_get_cover_placeholder_image();
				}
			}

			if ( empty( $summary ) ) {
				$summary = get_the_excerpt();
			}

			$platform_names = wp_get_post_terms( $post_id, 'game_platform', array( 'fields' => 'names' ) );
			$genre_names    = wp_get_post_terms( $post_id, 'game_genre', array( 'fields' => 'names' ) );
			$platforms      = ! is_wp_error( $platform_names ) ? implode( ', ', $platform_names ) : '';
			$genres         = ! is_wp_error( $genre_names ) ? implode( ', ', $genre_names ) : '';

			if ( empty( $genres ) ) {
				$genres = $stored_genres;
			}

			if ( empty( $play_status ) ) {
				$status_names = wp_get_post_terms( $post_id, 'game_status', array( 'fields' => 'names' ) );
				if ( ! is_wp_error( $status_names ) && ! empty( $status_names[0] ) ) {
					$play_status = $status_names[0];
				}
			}

			$release_date_display        = $format_date_for_display( $release_date );
			$user_date_added_display     = $format_date_for_display( $user_date_added );
			$user_date_completed_display = $format_date_for_display( $user_date_completed );
			$user_rating_display         = function_exists( 'wp_game_library_format_user_rating' ) ? wp_game_library_format_user_rating( $user_rating ) : '';
			?>
			<article <?php post_class( 'wp-game-library-single-game__article' ); ?>>
				<header class="wp-game-library-single-game__header">
					<h1 class="wp-game-library-single-game__title"><?php echo esc_html( $title ); ?></h1>
				</header>

				<div class="wp-game-library-single-game__layout">
					<?php if ( ! empty( $cover_url ) ) : ?>
						<div class="wp-game-library-single-game__cover">
							<img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Cover art for %s', 'wp-game-library' ), $title ) ); ?>" loading="lazy" />
						</div>
					<?php endif; ?>

					<div class="wp-game-library-single-game__details">
						<?php if ( ! empty( $summary ) ) : ?>
							<section class="wp-game-library-single-game__section">
								<h2><?php esc_html_e( 'Summary', 'wp-game-library' ); ?></h2>
								<p><?php echo esc_html( $summary ); ?></p>
							</section>
						<?php endif; ?>

						<section class="wp-game-library-single-game__section">
							<h2><?php esc_html_e( 'Game Details', 'wp-game-library' ); ?></h2>
							<dl>
								<?php if ( ! empty( $release_date_display ) ) : ?>
									<dt><?php esc_html_e( 'Release date', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $release_date_display ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $platforms ) ) : ?>
									<dt><?php esc_html_e( 'Platforms', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $platforms ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $genres ) ) : ?>
									<dt><?php esc_html_e( 'Genres', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $genres ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $developers ) ) : ?>
									<dt><?php esc_html_e( 'Developers', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $developers ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $publishers ) ) : ?>
									<dt><?php esc_html_e( 'Publishers', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $publishers ); ?></dd>
								<?php endif; ?>
							</dl>
						</section>

						<section class="wp-game-library-single-game__section">
							<h2><?php esc_html_e( 'Your Library Data', 'wp-game-library' ); ?></h2>
							<dl>
								<?php if ( ! empty( $play_status ) ) : ?>
									<dt><?php esc_html_e( 'Play status', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $play_status ); ?></dd>
								<?php endif; ?>
								<?php if ( '' !== $user_rating_display ) : ?>
									<dt><?php esc_html_e( 'Personal rating', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $user_rating_display ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $user_ownership ) ) : ?>
									<dt><?php esc_html_e( 'Ownership', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $user_ownership ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $user_date_added_display ) ) : ?>
									<dt><?php esc_html_e( 'Date added', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $user_date_added_display ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $user_date_completed_display ) ) : ?>
									<dt><?php esc_html_e( 'Date completed', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $user_date_completed_display ); ?></dd>
								<?php endif; ?>
								<?php if ( ! empty( $user_notes ) ) : ?>
									<dt><?php esc_html_e( 'Notes', 'wp-game-library' ); ?></dt>
									<dd><?php echo esc_html( $user_notes ); ?></dd>
								<?php endif; ?>
							</dl>
						</section>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Game not found.', 'wp-game-library' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
