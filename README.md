# wp-admin-separators

#### Version: 1.0.0

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

new Separators([25, 26]);
```
