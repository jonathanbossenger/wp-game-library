/* global wpGameLibraryIGDB */
( function ( $ ) {
	'use strict';

	var selectedIgdbId   = null;
	var selectedGameName = '';

	/**
	 * Convert a localized value into a positive integer, or 0 when invalid.
	 *
	 * @param {*} value Value to normalize.
	 * @return {number} Positive integer or 0.
	 */
	function getPositiveInt( value ) {
		var parsed = parseInt( value, 10 );

		return parsed > 0 ? parsed : 0;
	}

	/**
	 * Show an error message in the meta box.
	 *
	 * @param {string} msg Error message text.
	 */
	function showError( msg ) {
		$( '#wp-game-library-igdb-error' ).text( msg ).show();
	}

	/**
	 * Clear the error message area.
	 */
	function clearError() {
		$( '#wp-game-library-igdb-error' ).hide().text( '' );
	}

	/**
	 * Perform an IGDB import (search result or refresh) via the REST API.
	 *
	 * @param {number}  igdbId   IGDB game ID to import.
	 * @param {jQuery}  $btn     Button element to disable during the request.
	 * @param {jQuery}  $status  Status span element to update.
	 * @param {string}  doneMsg  Message to show on success.
	 */
	function importGame( igdbId, $btn, $status, doneMsg ) {
		var postId = getPositiveInt( wpGameLibraryIGDB.postId );
		var payload = {
			igdb_id: getPositiveInt( igdbId ),
		};

		if ( postId ) {
			payload.post_id = postId;
		}

		$btn.prop( 'disabled', true );
		$status.css( 'color', '' ).text( wpGameLibraryIGDB.i18n.importing );
		clearError();

		$.ajax( {
			url: wpGameLibraryIGDB.restUrl + '/games/import',
			method: 'POST',
			contentType: 'application/json',
			data: JSON.stringify( payload ),
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpGameLibraryIGDB.restNonce );
			},
			success: function ( response ) {
				$status.css( 'color', '#00a32a' ).text( doneMsg );

				if ( ! postId && response && response.post_id ) {
					window.location.href = wpGameLibraryIGDB.editPostUrl + response.post_id;
				}
			},
			error: function ( xhr ) {
				var msg = wpGameLibraryIGDB.i18n.errorGeneric;
				if ( xhr.responseJSON && xhr.responseJSON.message ) {
					msg = xhr.responseJSON.message;
				}
				$status.css( 'color', '#d63638' ).text( msg );
			},
			complete: function () {
				$btn.prop( 'disabled', false );
			},
		} );
	}

	// Search button click.
	$( document ).on( 'click', '#wp-game-library-igdb-search-btn', function () {
		var title = $( '#wp-game-library-igdb-title' ).val().trim();
		if ( ! title ) {
			return;
		}

		var $btn      = $( this );
		var $results  = $( '#wp-game-library-igdb-results' );
		var $list     = $( '#wp-game-library-igdb-results-list' );
		var $selected = $( '#wp-game-library-igdb-selected' );

		$btn.prop( 'disabled', true ).text( wpGameLibraryIGDB.i18n.searching );
		clearError();
		$results.hide();
		$selected.hide();
		selectedIgdbId = null;

		$.ajax( {
			url: wpGameLibraryIGDB.restUrl + '/games/search',
			method: 'GET',
			data: { title: title },
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpGameLibraryIGDB.restNonce );
			},
			success: function ( games ) {
				$list.empty();

				if ( ! games || ! games.length ) {
					showError( wpGameLibraryIGDB.i18n.noResults );
				} else {
					$.each( games, function ( i, game ) {
						var year  = game.release_year ? ' (' + game.release_year + ')' : '';
						var $item = $( '<li>' ).css( { borderBottom: '1px solid #eee' } );
						var $link = $( '<a>' )
							.attr( 'href', '#' )
							.attr( 'data-igdb-id', game.id )
							.attr( 'data-game-name', game.name )
							.css( { display: 'block', padding: '6px 8px' } )
							.text( game.name + year );

						$item.append( $link );
						$list.append( $item );
					} );

					$results.show();
				}
			},
			error: function ( xhr ) {
				var msg = wpGameLibraryIGDB.i18n.errorGeneric;
				if ( xhr.responseJSON && xhr.responseJSON.message ) {
					msg = xhr.responseJSON.message;
				}
				showError( msg );
			},
			complete: function () {
				$btn.prop( 'disabled', false ).text( wpGameLibraryIGDB.i18n.searchBtn );
			},
		} );
	} );

	// Select a game from the results list.
	$( document ).on( 'click', '#wp-game-library-igdb-results-list a', function ( e ) {
		e.preventDefault();

		selectedIgdbId   = $( this ).data( 'igdb-id' );
		selectedGameName = $( this ).data( 'game-name' );

		$( '#wp-game-library-igdb-results-list a' ).css( 'background', '' );
		$( this ).css( 'background', '#e7f3ff' );

		$( '#wp-game-library-igdb-selected-name' ).text( selectedGameName );
		$( '#wp-game-library-igdb-import-status' ).css( 'color', '' ).text( '' );
		$( '#wp-game-library-igdb-selected' ).show();
	} );

	// Import selected game.
	$( document ).on( 'click', '#wp-game-library-igdb-import-btn', function () {
		if ( ! selectedIgdbId ) {
			return;
		}
		importGame(
			selectedIgdbId,
			$( this ),
			$( '#wp-game-library-igdb-import-status' ),
			wpGameLibraryIGDB.postId ? wpGameLibraryIGDB.i18n.importDone : wpGameLibraryIGDB.i18n.addDone
		);
	} );

	// Refresh from IGDB (for games that already have an IGDB ID).
	$( document ).on( 'click', '#wp-game-library-igdb-refresh-btn', function () {
		var igdbId = getPositiveInt( wpGameLibraryIGDB.igdbId );
		if ( ! igdbId ) {
			return;
		}
		importGame(
			igdbId,
			$( this ),
			$( '#wp-game-library-igdb-refresh-status' ),
			wpGameLibraryIGDB.i18n.refreshDone
		);
	} );
} )( jQuery );
