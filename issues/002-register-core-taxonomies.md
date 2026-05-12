# Register core game taxonomies

## Summary
Add taxonomy registration for `game_platform`, `game_genre`, `game_status`, and `game_collection`.

## Labels
- `phase-1`
- `enhancement`
- `backend`

## Dependencies
- Depends on #001

## Background
The PRD data model requires first-class taxonomy support for filtering, status tracking, and user-defined collections.

## Acceptance Criteria
- [ ] `game_platform`, `game_genre`, `game_status`, and `game_collection` are registered and attached to `game`
- [ ] All four taxonomies have `show_in_rest` enabled for block editor compatibility
- [ ] Taxonomy structure is explicitly defined and implemented (hierarchical vs non-hierarchical)
- [ ] `game_status` includes terms for Unplayed, Started, Finished, Abandoned, Evergreen, and Wishlist
- [ ] `game_collection` supports user-defined grouping terms (for example: Favorites, Couch Co-op, 2024 Backlog)
- [ ] Taxonomies are manageable in wp-admin and usable for archive/single filtering

## Reference
- `readme.md` → **Section 5.1: Data Model**
- `readme.md` → **Section 6: Phase 1 (MVP)**
