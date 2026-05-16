# WP Game Library

WP Game Library is a WordPress plugin for managing a personal video game library directly inside WordPress.

## Current status

This project is in active development.

Current foundations include:

- `game` custom post type
- Core taxonomies (`game_platform`, `game_genre`, `game_status`, `game_collection`)
- Seeded default status terms
- Archive and single templates for games

## Requirements

- WordPress 6.4+
- PHP 8.0+

## Installation

1. Copy this plugin into `wp-content/plugins/wp-game-library`.
2. Activate **WP Game Library** from the WordPress admin plugins screen.
3. Visit **Games** in wp-admin.

## Development

Quick local syntax checks used in this repository:

- PHP: `find . -name '*.php' -not -path './.git/*' -print0 | xargs -0 -n1 php -l`
- JS: `find assets/js -name '*.js' -print0 | xargs -0 -n1 node --check`

## Project planning

The detailed product requirements and roadmap were moved to:

- [`planning.md`](./planning.md)
- [`issues/`](./issues)
