---

# 📋 PRD: WP Game Library — A WordPress Plugin for Video Game Collection Management

## 1. Overview

### Problem Statement
Existing video game inventory services (Backloggd, Grouvee, Deku Deals, VGCollect, etc.) suffer from critical gaps in **data ownership and portability**. An audit of 14 major game-tracking platforms found that **not a single one offers a data importer**. Most lack export functionality entirely. Users are locked into platforms with no way to migrate their libraries in or out. Meanwhile, movie tracking (Letterboxd) and book tracking (Goodreads) both support imports — the video game space is far behind.

### Opportunity
Build an **open-source WordPress plugin** that allows users to import, manage, and showcase their video game libraries on their own WordPress sites — giving them full data ownership, portability, and extensibility through the WordPress ecosystem.

### Vision
*"Your game library, on your site, under your control."*

---

## 2. Market Research

### Competitive Landscape

An analysis of 14 web-based game-tracking services reveals a consistent pattern of poor data portability:

| Service | Import | Export | Steam Import | API |
|---------|--------|--------|--------------|-----|
| [Backloggd](https://backloggd.com) | ❌ ([roadmap](https://www.backloggd.com/roadmap/)) | ❌ ([roadmap](https://www.backloggd.com/roadmap/)) | ❌ ([roadmap](https://backloggd.com/roadmap/)) | ❌ |
| [Backloggery](https://backloggery.com) | Unknown | Unknown | ❌ | ❌ |
| [Deku Deals](https://www.dekudeals.com) | ❌ ([requested](https://dekudeals.nolt.io/87)) | ✅ (CSV / JSON) | ❌ ([requested](https://dekudeals.nolt.io/19)) | ❌ ([requested](https://dekudeals.nolt.io/44)) |
| [Gameye](https://www.gameye.app) | ❌ | ✅ | ❌ | ❌ |
| [GGApp.io](https://ggapp.io) | Planned ([requested](https://ggapp.nolt.io/46)) | Planned | Planned ([requested](https://ggapp.nolt.io/8)) | ❌ ([requested](https://ggapp.nolt.io/398)) |
| [Grouvee](https://www.grouvee.com) | ❌ | ✅ | ✅ | ✅ (via GiantBomb) |
| [HowLongToBeat](https://howlongtobeat.com) | ❌ | ✅ | ✅ | ❌ |
| [IsThereAnyDeal](https://isthereanydeal.com) | Unknown | Unknown | Unknown | ✅ |
| [IGN Playlist](https://playlist.ign.com) | Unknown | Unknown | ✅ | ❌ |
| [LaunchBox](https://gamesdb.launchbox-app.com) | Unknown | Unknown | ✅ | ❌ |
| [MobyGames](https://www.mobygames.com/) | ❌ | ✅ | ✅ | ✅ |
| [TheGamesDB](https://thegamesdb.net) | Unknown | Unknown | Unknown | ✅ |
| [PriceCharting](https://www.pricecharting.com) | ✅ | ✅ | n/a | ✅ |
| [VGCollect](https://vgcollect.com) | ❌ | ✅ | ✅ | ❌ |

**Key finding:** Zero services offer a universal data importer. A collector with 1,100+ games has no way to migrate between platforms without starting from scratch.

Also excluded from this audit (but worth noting) are mobile-only tools ([Sequel](https://www.getsequel.app), [CLZ Games](https://www.collectorz.com/game/clz-games), [GameTrack](https://gametrack.app), [Stash](https://stash.games)), local/offline programs ([Tap Forms](https://www.tapforms.com/), [FileMaker](https://www.claris.com/filemaker/), [Delicious Library](http://www.delicious-monster.com), [Playnite](https://playnite.link)), and non-gaming-specific tools ([Knack](https://www.knack.com/pricing), [Ninox](https://ninox.com/en/pricing), [Airtable](https://www.airtable.com), [Notion](https://www.notion.so)) — none of which are open source or offer the combination of social engagement, data portability, and extensibility we're targeting.

### Feature Gaps Across Existing Services

While these services collectively provide rich features — game metadata, ratings, reviews, wishlists, backlog tracking, social feeds, achievement tracking, playtime logging, and price alerts — **no single service combines all of these with robust import/export**. The WordPress ecosystem is uniquely positioned to fill this gap.

---

## 3. Goals & Success Metrics

### Goals
1. **Data Ownership** — Users own their game library data as WordPress content (custom post types + post meta)
2. **Portability** — Robust import from existing services and export in standard formats (CSV, JSON, WXR)
3. **Discoverability** — Rich game metadata pulled from the IGDB API with minimal manual entry
4. **Extensibility** — Built on WordPress primitives (CPTs, taxonomies, blocks) so it's easy to extend
5. **Social Features** — Leverage existing WordPress ecosystem (ActivityPub, RSS, Reader) for following and discovery

### Success Metrics
- Plugin installs on wordpress.org
- Number of games added across all installations (if telemetry opt-in)
- Community contributions (PRs, issues, translations)
- Import success rate from supported services

---

## 4. User Stories

| # | As a… | I want to… | So that… |
|---|-------|-----------|----------|
| 1 | Gamer with an existing collection | Import my library from Deku Deals, PriceCharting, or CSV | I don't have to re-enter 1,100+ games manually |
| 2 | Casual collector | Search for a game by title and add it to my library | I can quickly catalog games I own or want |
| 3 | Completionist | Track game status (Unplayed, Started, Finished, Abandoned, Evergreen) | I can manage my backlog |
| 4 | Retro gamer | Record which platform(s) I own a game on | I can track cross-platform collections |
| 5 | Blogger | Embed my game library or individual game cards in posts/pages | I can showcase my collection to readers |
| 6 | Data-conscious user | Export my full library as CSV/JSON | I can back up or migrate my data anytime |
| 7 | Social gamer | Share my library via RSS/ActivityPub | Friends can discover what I'm playing |

---

## 5. Technical Architecture

### 5.1 Data Model

**Custom Post Type: `game`**

Each game in the library is stored as a CPT entry with metadata sourced from the IGDB API:

| Post Meta Key | Description | Source |
|---------------|-------------|--------|
| `_igdb_id` | IGDB unique identifier | IGDB API |
| `_igdb_slug` | IGDB URL slug | IGDB API |
| `_game_cover_url` | Cover art URL | IGDB API |
| `_game_summary` | Game description/summary | IGDB API |
| `_game_release_date` | Original release date | IGDB API |
| `_game_rating` | IGDB community rating | IGDB API |
| `_game_developers` | Developer studio(s) | IGDB API |
| `_game_publishers` | Publisher(s) | IGDB API |
| `_game_genres` | Genre(s) | IGDB API |
| `_user_play_status` | Unplayed / Started / Finished / Abandoned / Evergreen | User |
| `_user_rating` | Personal rating (1–10 or 1–5 stars) | User |
| `_user_notes` | Personal notes / review | User |
| `_user_date_added` | Date added to library | Auto |
| `_user_date_completed` | Date completed (if applicable) | User |
| `_user_ownership` | Physical / Digital / Both | User |

**Custom Taxonomies:**

| Taxonomy | Description | Example Terms |
|----------|-------------|---------------|
| `game_platform` | Gaming platform | PS5, Nintendo Switch, Steam, SNES, Game Boy |
| `game_genre` | Genre | RPG, Action, Puzzle, Platformer |
| `game_status` | Play status | Unplayed, Started, Finished, Abandoned, Evergreen, Wishlist |
| `game_collection` | User-defined groupings | "Favorites", "Couch Co-op", "2024 Backlog" |

### 5.2 IGDB API Integration

The hardest part of building a game library — assembling a comprehensive video game database — has already been done. [IGDB](https://www.igdb.com) (operated by Twitch) provides a free, richly detailed game database with a [well-documented API](https://api-docs.igdb.com/#getting-started). This is the same database that powers Backloggd, one of the most popular game-tracking sites.

- **Authentication:** User provides Twitch Client ID + Client Secret via plugin settings (OAuth2 client credentials flow)
- **Search endpoint:** `POST https://api.igdb.com/v4/games` — search by title
- **Data fetched:** Name, cover art, summary, release dates, platforms, genres, developers, publishers, screenshots
- **Caching:** Store fetched data locally as post meta to minimize API calls; add a "Refresh from IGDB" option per game
- **Rate limiting:** Respect IGDB's rate limits (4 requests/second for free tier)

> **v1 simplification:** For v1, manually generate and store the Twitch Client ID and Client Secret in plugin settings. No need for a full OAuth flow — the plugin only reads from the public IGDB database.

### 5.3 Gutenberg Block: Game Card

A custom block (`wp-game-library/game-card`) that:

1. **Add flow:** User adds block → prompted to search by game title → results from IGDB displayed → user selects a game → game data fetched and stored as a `game` CPT → block renders the game card
2. **Display:** Shows cover art, title, platform(s), status, user rating, and summary
3. **Variations:** Compact card (for lists/grids), full card (for reviews/features)
4. **Inner blocks:** Optionally allow the user to add inner content (personal review text, screenshots)

### 5.4 Library Views

- **Archive page:** `/games/` — filterable/sortable grid of all games in the library
- **Single game page:** `/games/the-legend-of-zelda/` — full game detail page
- **Block patterns:** Pre-built patterns for "Now Playing", "Recently Completed", "Top 10" lists
- **Shortcodes (optional):** For classic editor users — `[game_library]`, `[game_card id="123"]`

---

## 6. Features by Phase

### Phase 1 (MVP) 🎯
- [ ] `game` custom post type registration
- [ ] `game_platform`, `game_genre`, `game_status` taxonomies
- [ ] IGDB API integration (search + fetch game data)
- [ ] Plugin settings page (Twitch API credentials)
- [ ] Game Card Gutenberg block (search → select → display)
- [ ] Basic library archive page (grid view)
- [ ] Single game detail template
- [ ] Manual "Add Game" via wp-admin (search IGDB + add to library)
- [ ] Play status tracking (Unplayed → Started → Finished → Abandoned → Evergreen)
- [ ] Personal rating per game
- [ ] CSV export of full library

### Phase 2 (Import/Export) 📦
- [ ] CSV importer (generic format + templates for Deku Deals, PriceCharting, HowLongToBeat)
- [ ] JSON export (full metadata)
- [ ] WordPress WXR export compatibility
- [ ] Bulk edit (status, platform, rating)
- [ ] Deku Deals JSON importer (direct format mapping)
- [ ] Steam library import via Steam Web API

### Phase 3 (Social & Discovery) 🌐
- [ ] ActivityPub integration — game library updates publish to the Fediverse
- [ ] RSS feed for library updates (`/games/feed/`)
- [ ] WordPress.com Reader compatibility
- [ ] Public profile page with stats (total games, completion rate, platform breakdown)
- [ ] "Currently Playing" widget/block for sidebar
- [ ] Game recommendations based on library

### Phase 4 (Advanced) 🚀
- [ ] Price tracking integration (IsThereAnyDeal API)
- [ ] "How Long to Beat" data enrichment
- [ ] Collection value estimation (PriceCharting API)
- [ ] Multi-user support (household/family libraries)
- [ ] Comparison views ("Games we both own")
- [ ] Achievement/trophy tracking

---

## 7. How WordPress Fills the Gap

| Capability | Existing Services | WP Game Library |
|-----------|------------------|-----------------|
| Data Import | ❌ (none offer it) | **✅** (CSV, JSON, service-specific) |
| Data Export | Partial (some offer CSV) | **✅** (CSV, JSON, WXR) |
| Steam Import | Partial | **✅** (Steam Web API) |
| API Access | Rare | **✅** (WP REST API — automatic) |
| Open Source | ❌ (all proprietary) | **✅** (GPL) |
| Data Ownership | ❌ (hosted on their servers) | **✅** (your WordPress database) |
| Social / Following | Platform-locked | **✅** (ActivityPub, RSS, Reader — open standards) |
| Extensibility | ❌ | **✅** (WordPress plugins, themes, hooks, filters) |
| Data Liberation | ❌ | **✅** (backed by the [Data Liberation Project](https://dataliberationproject.wordpress.com/) ethos) |

The existing ecosystem has already demonstrated that WordPress can serve as a product catalog. WooCommerce has been used in "catalog mode" to manage product databases with categories, tags, and rich metadata — without needing cart or checkout functionality. A purpose-built plugin using native WordPress primitives (CPTs, taxonomies, blocks) can do the same thing more cleanly and efficiently.

---

## 8. Technical Considerations

### Dependencies
- **IGDB API** (Twitch) — primary game database; requires free Twitch developer account
- **WordPress 6.4+** — for modern block editor APIs
- **PHP 8.0+**

### Risks & Mitigations
| Risk | Mitigation |
|------|-----------|
| IGDB API rate limits or changes | Cache aggressively locally; store all fetched data as post meta |
| IGDB API requires Twitch account | Clear onboarding docs; consider proxied search for WordPress.com hosted sites |
| Large libraries (1,000+ games) impact performance | Pagination, lazy loading, indexed custom queries |
| Cover art hotlinking/storage | Download and store in media library on import, with option for remote URLs |
| Plugin bloat | Keep core plugin lean; offer Phase 3+ features as extensions or feature flags |

### REST API Endpoints
The plugin should expose custom REST API endpoints for headless/decoupled use:

- `GET /wp-json/wp-game-library/v1/games` — list all games (filterable)
- `GET /wp-json/wp-game-library/v1/games/{id}` — single game details
- `POST /wp-json/wp-game-library/v1/games/search` — search IGDB
- `POST /wp-json/wp-game-library/v1/games/import` — bulk import
- `GET /wp-json/wp-game-library/v1/stats` — library statistics

---

## 9. Open Questions

1. **Plugin name:** "WP Game Library"? "Game Shelf"? "My Game Collection"? Something catchier?
2. **Scope of v1 block:** Should the block just display a single game card, or also support a "library grid" view as a block?
3. **Multi-site:** Should we consider WordPress.com multi-site compatibility from the start?
4. **Cover art storage:** Download to local media library, or reference IGDB CDN URLs? (Licensing implications)
5. **Data refresh:** How often should IGDB data be refreshed? Manual only? Weekly cron?
6. **Board games?** The focus is on video games, but should the architecture be generic enough for board games (BoardGameGeek API)?

---

## 10. References

- **IGDB API docs:** https://api-docs.igdb.com/
- **Data Liberation Project:** https://dataliberationproject.wordpress.com/
- **ActivityPub plugin:** https://wordpress.org/plugins/activitypub/
- **Letterboxd import** (inspiration): https://letterboxd.com/about/importing-data/
- **Comparable projects (movies):** Jereviews, Flavor (WordPress movie/book review plugins)

---

Want me to break Phase 1 into specific development tasks or tickets, or publish this as a post to one of your sites?
