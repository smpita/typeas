# Changelog

All notable changes to `typeas` will be documented in this file.

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
