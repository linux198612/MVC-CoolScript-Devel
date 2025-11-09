# Changelog

## [0.02] - development

### Added
- SQL injection protection: All database queries now use prepared statements via the new `Database::query($sql, $params)` method.
- Session fixation protection: Added session ID regeneration in `Session.php` to prevent fixation attacks.
- Validation: Added `Validator` class for basic data validation.
- Flash messages: Added `Flash` helper class for session-based notifications.
- View cache: Added toggleable view caching for faster rendering.
- Route cache: Added toggleable route caching for faster route loading.
- Changelog tracking: This file records all notable changes for each version.

### Changed
- Database layer refactored for security and maintainability.

---

## [0.01] - initial release

### Added
- Initial version of Coolscript MVC Framework.
- Basic routing, controller, view, and configuration structure.
