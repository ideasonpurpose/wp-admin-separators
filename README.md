# wp-admin-separators

#### Version: 1.0.7

[![Packagist](https://badgen.net/packagist/v/ideasonpurpose/wp-admin-separators)](https://packagist.org/packages/ideasonpurpose/wp-admin-separators)
[![codecov](https://codecov.io/gh/ideasonpurpose/wp-admin-separators/branch/master/graph/badge.svg)](https://codecov.io/gh/ideasonpurpose/wp-admin-separators)
[![Coverage Status](https://coveralls.io/repos/github/ideasonpurpose/wp-admin-separators/badge.svg)](https://coveralls.io/github/ideasonpurpose/wp-admin-separators)
[![Maintainability](https://api.codeclimate.com/v1/badges/21c9b4cdd2e067692a17/maintainability)](https://codeclimate.com/github/ideasonpurpose/wp-admin-separators/maintainability)
[![styled with prettier](https://img.shields.io/badge/styled_with-prettier-ff69b4.svg)](https://github.com/prettier/prettier)

A simple class for injecting separators into the WordPress admin dashboard menu

String values will be rejected. Float arguments will be passed without modification. Duplicate indexes will be merged.

## Usage

This library is available on [Packagist](https://packagist.org/packages/ideasonpurpose/wp-admin-separators), to use it, require it in **composer.json** or tell Composer to load the package:

```bash
$ composer require ideasonpurpose/wp-admin-separators
```

Then add separators to the admin like this:

```php
use IdeasOnPurpose\WP\Admin;

new Separators(25, 26);
```

Arguments can also be an array, a mix of integers and arrays, or number-ish strings.
