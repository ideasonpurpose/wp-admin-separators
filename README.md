# wp-admin-separators

#### Version: 1.0.6

[![Coverage Status](https://coveralls.io/repos/github/ideasonpurpose/wp-admin-separators/badge.svg?branch=master)](https://coveralls.io/github/ideasonpurpose/wp-admin-separators?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/21c9b4cdd2e067692a17/maintainability)](https://codeclimate.com/github/ideasonpurpose/wp-admin-separators/maintainability)

A simple class for injecting separators into the WordPress admin dashboard menu

String values will be rejected. Float arguments will be passed without modification. Duplicate indexes will be merged.

## Usage

Add this repository to the project's **composer.json** file and require the library.

```json
{
  "require-dev": {
    "ideasonpurpose/wp-admin-separators": "^1.0.0"
  },
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/ideasonpurpose/wp-admin-separators"
    }
  ]
}
```

Then add separators to the admin like this:

```php
use IdeasOnPurpose\WP\Admin;

new Separators(25, 26);
```

Arguments can also be an array, a mix of integers and arrays or number-ish strings.
