# Add plugin settings page for Twitch API credentials

## Summary
Create an admin settings page to store Twitch Client ID and Client Secret.

## Labels
- `phase-1`
- `enhancement`
- `admin-ui`

## Background
IGDB access requires Twitch credentials configured by site admins.

## Acceptance Criteria
- [ ] A plugin settings screen is available in wp-admin for IGDB/Twitch configuration
- [ ] Twitch Client ID and Client Secret fields can be created, edited, and saved
- [ ] Credentials are stored securely using WordPress options/settings APIs with sanitization
- [ ] Secrets are not exposed on public/front-end routes
- [ ] Saved credentials are consumed by the IGDB integration layer

## Reference
- `readme.md` → **Section 5.2: IGDB API Integration**
- `readme.md` → **Section 6: Phase 1 (MVP)**
