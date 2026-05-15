/* global wp */
( function () {
	'use strict';

	var registerBlockType      = wp.blocks.registerBlockType;
	var registerBlockVariation = wp.blocks.registerBlockVariation;
	var __                     = wp.i18n.__;
	var el                     = wp.element.createElement;
	var useState               = wp.element.useState;
	var apiFetch               = wp.apiFetch;
	var ServerSideRender       = wp.serverSideRender;
	var Button                 = wp.components.Button;
	var Notice                 = wp.components.Notice;
	var PanelBody              = wp.components.PanelBody;
	var SelectControl          = wp.components.SelectControl;
	var Spinner                = wp.components.Spinner;
	var TextControl            = wp.components.TextControl;
	var InspectorControls      = wp.blockEditor.InspectorControls;
	var InnerBlocks            = wp.blockEditor.InnerBlocks;

	function Edit( props ) {
		var attributes    = props.attributes;
		var setAttributes = props.setAttributes;
		var gamePostId    = attributes.gamePostId || 0;
		var variation     = attributes.variation || 'full';
		var gameTitle     = attributes.gameTitle || '';

		var searchState = useState( '' );
		var query       = searchState[0];
		var setQuery    = searchState[1];

		var resultsState = useState( [] );
		var results      = resultsState[0];
		var setResults   = resultsState[1];

		var loadingState = useState( false );
		var isLoading    = loadingState[0];
		var setIsLoading = loadingState[1];

		var importState = useState( false );
		var isImporting = importState[0];
		var setIsImport = importState[1];

		var errorState = useState( '' );
		var error      = errorState[0];
		var setError   = errorState[1];

		var selectedState = useState( null );
		var selected      = selectedState[0];
		var setSelected   = selectedState[1];

		var onSearch = function () {
			if ( ! query.trim() ) {
				return;
			}

			setIsLoading( true );
			setError( '' );
			setResults( [] );
			setSelected( null );

			apiFetch( {
				path: '/wp-game-library/v1/games/search?title=' + encodeURIComponent( query.trim() ) + '&limit=10',
			} ).then( function ( foundGames ) {
				setResults( Array.isArray( foundGames ) ? foundGames : [] );
			} ).catch( function ( searchError ) {
				setError( searchError && searchError.message ? searchError.message : __( 'Search failed.', 'wp-game-library' ) );
			} ).finally( function () {
				setIsLoading( false );
			} );
		};

		var onImport = function () {
			if ( ! selected || ! selected.id ) {
				return;
			}

			setIsImport( true );
			setError( '' );

			apiFetch( {
				path: '/wp-game-library/v1/games/import',
				method: 'POST',
				data: {
					igdb_id: selected.id,
				},
			} ).then( function ( response ) {
				setAttributes( {
					gamePostId: response.post_id || 0,
					gameTitle: response.name || selected.name || '',
				} );
			} ).catch( function ( importError ) {
				setError( importError && importError.message ? importError.message : __( 'Import failed.', 'wp-game-library' ) );
			} ).finally( function () {
				setIsImport( false );
			} );
		};

		var clearSelection = function () {
			setAttributes( {
				gamePostId: 0,
				gameTitle: '',
			} );
			setResults( [] );
			setSelected( null );
			setError( '' );
		};

		var controls = el(
			InspectorControls,
			null,
			el(
				PanelBody,
				{ title: __( 'Card Settings', 'wp-game-library' ), initialOpen: true },
				el( SelectControl, {
					label: __( 'Variation', 'wp-game-library' ),
					value: variation,
					options: [
						{ label: __( 'Full card', 'wp-game-library' ), value: 'full' },
						{ label: __( 'Compact card', 'wp-game-library' ), value: 'compact' },
					],
					onChange: function ( newValue ) {
						setAttributes( { variation: newValue } );
					},
				} )
			)
		);

		if ( gamePostId ) {
			return el(
				'div',
				null,
				controls,
				el( 'p', null, gameTitle ? gameTitle : __( 'Game selected', 'wp-game-library' ) ),
				el(
					Button,
					{ variant: 'secondary', onClick: clearSelection },
					__( 'Choose Different Game', 'wp-game-library' )
				),
				el( ServerSideRender, {
					block: 'wp-game-library/game-card',
					attributes: attributes,
				} ),
				el(
					'div',
					{ className: 'wp-game-library-game-card-inner-blocks' },
					el( InnerBlocks )
				)
			);
		}

		return el(
			'div',
			null,
			controls,
			el( TextControl, {
				label: __( 'Search for a game by title', 'wp-game-library' ),
				value: query,
				onChange: setQuery,
			} ),
			el(
				Button,
				{
					variant: 'primary',
					onClick: onSearch,
					disabled: isLoading || ! query.trim(),
				},
				isLoading ? __( 'Searching…', 'wp-game-library' ) : __( 'Search IGDB', 'wp-game-library' )
			),
			error ? el( Notice, { status: 'error', isDismissible: false }, error ) : null,
			isLoading ? el( Spinner ) : null,
			results.length
				? el(
					'ul',
					{ className: 'wp-game-library-game-card-results' },
					results.map( function ( game ) {
						var selectedClass = selected && selected.id === game.id ? ' is-selected' : '';
						return el(
							'li',
							{ key: game.id },
							el(
								Button,
								{
									variant: 'tertiary',
									className: 'wp-game-library-game-card-result' + selectedClass,
									onClick: function () {
										setSelected( game );
									},
								},
								game.name
							)
						);
					} )
				)
				: null,
			selected
				? el(
					'div',
					{ className: 'wp-game-library-game-card-selected' },
					el( 'p', null, selected.name ),
					el(
						Button,
						{ variant: 'primary', onClick: onImport, disabled: isImporting },
						isImporting ? __( 'Importing…', 'wp-game-library' ) : __( 'Add game card', 'wp-game-library' )
					)
				)
				: null
		);
	}

	registerBlockType( 'wp-game-library/game-card', {
		apiVersion: 2,
		title: __( 'Game Card', 'wp-game-library' ),
		description: __( 'Search IGDB, import a game, and render a game card.', 'wp-game-library' ),
		icon: 'gamepad',
		category: 'widgets',
		attributes: {
			gamePostId: {
				type: 'integer',
				default: 0,
			},
			gameTitle: {
				type: 'string',
				default: '',
			},
			variation: {
				type: 'string',
				default: 'full',
			},
		},
		edit: Edit,
		save: function () {
			return el( InnerBlocks.Content );
		},
	} );

	registerBlockVariation( 'wp-game-library/game-card', {
		name: 'wp-game-library-game-card-full',
		title: __( 'Game Card (Full)', 'wp-game-library' ),
		attributes: { variation: 'full' },
		isDefault: true,
	} );

	registerBlockVariation( 'wp-game-library/game-card', {
		name: 'wp-game-library-game-card-compact',
		title: __( 'Game Card (Compact)', 'wp-game-library' ),
		attributes: { variation: 'compact' },
	} );
}() );
