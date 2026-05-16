# Add personal rating per game

## Summary
Allow users to save a personal rating value on each game entry.

## Labels
- `phase-1`
- `enhancement`
- `backend`

## Dependencies
- Depends on #001

## Background
Personal ratings are part of the MVP feature set and game card display.

## Acceptance Criteria
- [ ] `_user_rating` is available/editable as part of game entry management
- [ ] Rating supports the PRD model (`1–10` or `1–5 stars`) with validation of allowed values
- [ ] Rating value is persisted as post meta and returned in REST/editor contexts
- [ ] Rating appears in game card and single game displays

## Reference
- `planning.md` → **Section 5.1: Data Model**
- `planning.md` → **Section 6: Phase 1 (MVP)**
