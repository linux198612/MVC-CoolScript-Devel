# Changelog

## [0.02] - development

### Added
- SQL injection protection: All database queries now use prepared statements via the new `Database::query($sql, $params)` method.
- Session fixation protection: Added session ID regeneration in `Session.php` to prevent fixation attacks.
- Validation: Added `Validator` class for basic data validation.
- Flash messages: Added `Flash` helper class for session-based notifications.
- View cache: Added toggleable view caching for faster rendering.
- Route cache: Added toggleable route caching for faster route loading.
- Logging: Added log levels (`error`, `warning`, `info`, `debug`) to `ErrorLogger`.
- Changelog tracking: This file records all notable changes for each version.
- XSS protection: Added `Xss` helper for safe HTML escaping.
- Database connection pooling: `Database` now uses a singleton pattern to reuse connections for better performance.
- View cache clearing: Added `Render::clearViewCache()` to remove all cached view files.

### Changed
- Database layer refactored for security and maintainability.
- CSRF token automatic injection: CSRF tokens are now injected into all `<form>` elements during view rendering if enabled in settings.

---

## [0.01] - initial release

### Added
- Initial version of Coolscript MVC Framework.
- Basic routing, controller, view, and configuration structure.
