<?php
/**
 * Game archive template.
 *
 * @package WP_Game_Library
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$taxonomies = array(
	'game_status'     => array(
		'query_key' => 'status',
		'label'     => __( 'Status', 'wp-game-library' ),
	),
	'game_platform'   => array(
		'query_key' => 'platform',
		'label'     => __( 'Platform', 'wp-game-library' ),
	),
	'game_genre'      => array(
		'query_key' => 'genre',
		'label'     => __( 'Genre', 'wp-game-library' ),
	),
	'game_collection' => array(
		'query_key' => 'collection',
		'label'     => __( 'Collection', 'wp-game-library' ),
	),
);

$sort_options = array(
	'date_desc'   => __( 'Newest first', 'wp-game-library' ),
	'date_asc'    => __( 'Oldest first', 'wp-game-library' ),
	'title_asc'   => __( 'Title (A-Z)', 'wp-game-library' ),
	'title_desc'  => __( 'Title (Z-A)', 'wp-game-library' ),
	'rating_desc' => __( 'Rating (high to low)', 'wp-game-library' ),
	'rating_asc'  => __( 'Rating (low to high)', 'wp-game-library' ),
);

$active_filters = array();

foreach ( $taxonomies as $taxonomy => $taxonomy_args ) {
	$query_key                   = $taxonomy_args['query_key'];
	$active_filters[ $query_key ] = isset( $_GET[ $query_key ] ) ? sanitize_title( wp_unslash( $_GET[ $query_key ] ) ) : '';
}

$active_sort = isset( $_GET['sort'] ) ? sanitize_key( wp_unslash( $_GET['sort'] ) ) : 'date_desc';

if ( ! isset( $sort_options[ $active_sort ] ) ) {
	$active_sort = 'date_desc';
}
?>

<main id="primary" class="site-main wp-game-library-archive">
	<header class="wp-game-library-archive__header">
		<h1 class="wp-game-library-archive__title"><?php post_type_archive_title(); ?></h1>
	</header>

	<form class="wp-game-library-archive__filters" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'game' ) ); ?>">
		<?php foreach ( $taxonomies as $taxonomy => $taxonomy_args ) : ?>
			<?php
			$query_key = $taxonomy_args['query_key'];
			$terms     = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			?>
			<label for="wp-game-library-filter-<?php echo esc_attr( $query_key ); ?>">
				<?php echo esc_html( $taxonomy_args['label'] ); ?>
			</label>
			<select id="wp-game-library-filter-<?php echo esc_attr( $query_key ); ?>" name="<?php echo esc_attr( $query_key ); ?>">
				<option value=""><?php esc_html_e( 'All', 'wp-game-library' ); ?></option>
				<?php if ( ! is_wp_error( $terms ) ) : ?>
					<?php foreach ( $terms as $term ) : ?>
						<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $active_filters[ $query_key ], $term->slug ); ?>>
							<?php echo esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		<?php endforeach; ?>

		<label for="wp-game-library-filter-sort"><?php esc_html_e( 'Sort by', 'wp-game-library' ); ?></label>
		<select id="wp-game-library-filter-sort" name="sort">
			<?php foreach ( $sort_options as $sort_key => $sort_label ) : ?>
				<option value="<?php echo esc_attr( $sort_key ); ?>" <?php selected( $active_sort, $sort_key ); ?>>
					<?php echo esc_html( $sort_label ); ?>
				</option>
			<?php endforeach; ?>
		</select>

		<button type="submit"><?php esc_html_e( 'Apply', 'wp-game-library' ); ?></button>
		<a class="wp-game-library-archive__reset" href="<?php echo esc_url( get_post_type_archive_link( 'game' ) ); ?>">
			<?php esc_html_e( 'Reset', 'wp-game-library' ); ?>
		</a>
	</form>

	<?php if ( have_posts() ) : ?>
		<div class="wp-game-library-archive__grid">
			<?php
			while ( have_posts() ) :
				the_post();

				$post_id    = get_the_ID();
				$title      = get_the_title();
				$cover_url  = get_post_meta( $post_id, '_game_cover_url', true );
				$summary    = get_post_meta( $post_id, '_game_summary', true );
				$user_rating = get_post_meta( $post_id, '_user_rating', true );
				$status     = get_post_meta( $post_id, '_user_play_status', true );

				$platform_names = wp_get_post_terms( $post_id, 'game_platform', array( 'fields' => 'names' ) );
				$platforms      = ! is_wp_error( $platform_names ) ? implode( ', ', $platform_names ) : '';

				if ( empty( $status ) ) {
					$status_terms = wp_get_post_terms( $post_id, 'game_status', array( 'fields' => 'names' ) );
					if ( ! is_wp_error( $status_terms ) && ! empty( $status_terms[0] ) ) {
						$status = $status_terms[0];
					}
				}

				if ( empty( $summary ) ) {
					$summary = get_the_excerpt();
				}
				?>
				<article <?php post_class( 'wp-game-library-game-card is-variation-compact' ); ?>>
					<?php if ( ! empty( $cover_url ) ) : ?>
						<a class="wp-game-library-game-card__cover" href="<?php the_permalink(); ?>">
							<img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Cover art for %s', 'wp-game-library' ), $title ) ); ?>" loading="lazy" />
						</a>
					<?php endif; ?>
					<div class="wp-game-library-game-card__content">
						<h2 class="wp-game-library-game-card__title">
							<a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a>
						</h2>
						<?php if ( ! empty( $platforms ) ) : ?>
							<p class="wp-game-library-game-card__platforms"><?php echo esc_html( $platforms ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $status ) ) : ?>
							<p class="wp-game-library-game-card__status"><?php echo esc_html( $status ); ?></p>
						<?php endif; ?>
						<?php if ( '' !== $user_rating && null !== $user_rating ) : ?>
							<p class="wp-game-library-game-card__rating">
								<?php
								printf(
									/* translators: %s: User rating value. */
									esc_html__( 'User rating: %s', 'wp-game-library' ),
									esc_html( number_format_i18n( (float) $user_rating, 1 ) )
								);
								?>
							</p>
						<?php endif; ?>
						<?php if ( ! empty( $summary ) ) : ?>
							<p class="wp-game-library-game-card__summary"><?php echo esc_html( wp_trim_words( $summary, 24 ) ); ?></p>
						<?php endif; ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php
		$pagination_args = array_filter(
			array(
				'status'     => $active_filters['status'],
				'platform'   => $active_filters['platform'],
				'genre'      => $active_filters['genre'],
				'collection' => $active_filters['collection'],
				'sort'       => $active_sort,
			)
		);

		echo wp_kses_post(
			paginate_links(
				array(
					'type'      => 'list',
					'mid_size'  => 1,
					'prev_text' => esc_html__( 'Previous', 'wp-game-library' ),
					'next_text' => esc_html__( 'Next', 'wp-game-library' ),
					'add_args'  => $pagination_args,
				)
			)
		);
		?>
	<?php else : ?>
		<div class="wp-game-library-archive__empty-state">
			<p><?php esc_html_e( 'No games found. Add games to your library to see them here.', 'wp-game-library' ); ?></p>
		</div>
	<?php endif; ?>
</main>

<?php
get_footer();
