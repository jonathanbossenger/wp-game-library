# Add play status tracking

## Summary
Implement play status tracking with the defined lifecycle values.

## Labels
- `phase-1`
- `enhancement`
- `backend`

## Dependencies
- Depends on #001
- Depends on #002

## Background
Backlog management is a core user need in the PRD.

## Acceptance Criteria
- [ ] Supported statuses include Unplayed, Started, Finished, Abandoned, Evergreen (and Wishlist where applicable)
- [ ] `game_status` taxonomy is the canonical model for status filtering and archives
- [ ] `_user_play_status` meta is stored/kept in sync where required by the data model
- [ ] Status can be set and updated via wp-admin and block-driven flows
- [ ] Status is visible in archive cards and single game views

## Reference
- `planning.md` → **Section 5.1: Data Model**
- `planning.md` → **Section 6: Phase 1 (MVP)**
