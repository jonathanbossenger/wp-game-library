# Implement IGDB search and fetch integration

## Summary
Integrate with IGDB to search for games and fetch detailed metadata.

## Labels
- `phase-1`
- `enhancement`
- `api`

## Dependencies
- Depends on #004

## Background
IGDB is the primary external data source for game discovery and enrichment.

## Acceptance Criteria
- [ ] IGDB requests authenticate via Twitch client-credentials flow using saved plugin credentials
- [ ] Search requests use `POST https://api.igdb.com/v4/games`
- [ ] Search supports title lookup and returns selectable game matches
- [ ] Selected game fetch maps core IGDB fields (name, cover, summary, release dates, platforms, genres, developers, publishers, screenshots)
- [ ] Fetched IGDB data is cached locally in post meta to reduce repeated API calls
- [ ] API calls enforce/respect the free-tier rate limit target of 4 requests/second

## Reference
- `planning.md` → **Section 5.2: IGDB API Integration**
- `planning.md` → **Section 6: Phase 1 (MVP)**
