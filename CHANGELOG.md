# Changelog

All notable changes to `typeas` will be documented in this file.

## v2.5.0 - 2023-10-09

### What's Changed

- Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/smpita/typeas/pull/11
- Deprecate Carbon, doesn’t well fit with lib by @smpita in https://github.com/smpita/typeas/pull/12
- Features/helper methods by @smpita in https://github.com/smpita/typeas/pull/13

### New Contributors

- @dependabot made their first contribution in https://github.com/smpita/typeas/pull/11

**Full Changelog**: https://github.com/smpita/typeas/compare/v2.4.1...v2.5.0

## v.2.4.1 - 2023-10-09

Fixed documentation typos

## v2.4.0 - 2023-10-09

Added ability for consumers to create custom resolvers

## v2.3.0 - 2023-10-06

Added nullable methods

## v2.2.0 - 2023-10-05

Adds legacy support for Laravel 9

## v.2.1.0 - 2023-10-05

Added support for php 8.3

## v2.0.0 - 2023-09-30

Update the `class()` signature for a better developer experience.
Increased test coverage and quality.

### From

```php
$typed = Smpita\TypeAs::class($mixed, Target::class, $default);







```
### To

```php
$typed = Smpita\TypeAs::class(Target::class, $mixed, $default);







```
Which should make it easier and more readable for situations like this:

```php
$typed = Smpita\TypeAs::class(Target::class, function () {
  // Lots of code here
}, $default);







```
## v.1.0.1 - 2023-09-30

Added exception and default support to array()
