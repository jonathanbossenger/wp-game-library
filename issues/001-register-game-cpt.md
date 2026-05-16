# Register `game` custom post type

## Summary
Create and register a `game` custom post type for the plugin.

## Labels
- `phase-1`
- `enhancement`
- `backend`

## Background
The PRD defines `game` as the core content type used to store library entries.

## Acceptance Criteria
- [ ] A `game` custom post type is registered on `init`
- [ ] The CPT supports `title`, `editor`, `thumbnail`, `excerpt`, and `custom-fields`
- [ ] The CPT has `show_in_rest` enabled for block editor and REST compatibility
- [ ] Rewrite settings expose a public archive at `/games/`
- [ ] Core game metadata keys are defined for storage/registration: `_igdb_id`, `_igdb_slug`, `_game_cover_url`, `_game_summary`, `_game_release_date`, `_game_rating`, `_game_developers`, `_game_publishers`, `_game_genres`, `_user_play_status`, `_user_rating`, `_user_notes`, `_user_date_added`, `_user_date_completed`, `_user_ownership`
- [ ] CPT labels and capabilities support wp-admin management and public display

## Reference
- `planning.md` → **Section 5.1: Data Model**
- `planning.md` → **Section 6: Phase 1 (MVP)**
