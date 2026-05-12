# Export full library to CSV

## Summary
Add CSV export for the full game library.

## Labels
- `phase-1`
- `enhancement`
- `import-export`

## Dependencies
- Depends on #001
- Depends on #002
- Depends on #003
- Depends on #009
- Depends on #010

## Background
Portability and data ownership are core project goals.

## Acceptance Criteria
- [ ] Users can export all library items to CSV from plugin/admin UI
- [ ] Export includes, at minimum, these columns: post ID, title, `_igdb_id`, `_igdb_slug`, release date, platforms, genres, developers, publishers, `_user_play_status`/status term, `_user_rating`, `_user_notes`, `_user_date_added`, `_user_date_completed`, `_user_ownership`
- [ ] CSV format is UTF-8 encoded with a header row and one game per row
- [ ] Export handles large libraries reliably (paged/chunked generation or equivalent)
- [ ] Generated file downloads successfully in wp-admin without exposing secrets

## Reference
- `readme.md` → **Section 3: Goals & Success Metrics (Portability)**
- `readme.md` → **Section 5.1: Data Model**
- `readme.md` → **Section 6: Phase 1 (MVP)**
