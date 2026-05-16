# Implement manual “Add Game” admin flow

## Summary
Support adding a game from wp-admin by searching IGDB and saving to library.

## Labels
- `phase-1`
- `enhancement`
- `admin-ui`

## Dependencies
- Depends on #001
- Depends on #003
- Depends on #004

## Background
MVP requires a non-block workflow for admins who manage entries directly.

## Acceptance Criteria
- [ ] Game management UI provides a manual "Add Game" flow in wp-admin
- [ ] Admins can search IGDB by title and preview/select a match
- [ ] Selecting a match creates/populates a `game` post with mapped metadata
- [ ] Duplicate prevention is handled using a stable key (for example `_igdb_id`)
- [ ] Flow includes failure handling for missing credentials, empty results, and API errors/rate limits

## Reference
- `planning.md` → **Section 5.2: IGDB API Integration**
- `planning.md` → **Section 6: Phase 1 (MVP)**
