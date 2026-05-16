# Build Game Card Gutenberg block

## Summary
Create a `wp-game-library/game-card` block with search, select, and render flow.

## Labels
- `phase-1`
- `enhancement`
- `block-editor`

## Dependencies
- Depends on #001
- Depends on #003

## Background
The block is the primary editor UX for adding and displaying games.

## Acceptance Criteria
- [ ] Block is registered as `wp-game-library/game-card`
- [ ] Add flow supports search by game title, selection from IGDB results, and persistence as a `game` post
- [ ] Rendered card includes cover art, title, platform(s), play status, user rating, and summary
- [ ] Block includes both compact and full-card variations
- [ ] Block supports optional inner blocks for additional user-authored content (for example review text/screenshots)
- [ ] Block works in both editor preview and frontend rendering

## Reference
- `planning.md` → **Section 5.3: Gutenberg Block: Game Card**
- `planning.md` → **Section 6: Phase 1 (MVP)**
