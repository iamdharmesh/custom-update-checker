# Custom Update Check

Demo WordPress plugin for self-hosted updates via [Plugin Update Checker](https://github.com/YahnisElsts/plugin-update-checker) (PUC v5.7) and GitHub Releases.

## Requirements

- PHP 7.4+
- WordPress 6.0+
- Composer (development only)

## Local setup

1. Clone the repo into `wp-content/plugins/custom-update-check/` (folder name must match the plugin slug):

   ```bash
   git clone git@github.com:iamdharmesh/custom-update-checker.git wp-content/plugins/custom-update-check
   ```

2. Install dependencies:

   ```bash
   composer install --no-dev
   ```

3. Activate **Custom Update Check** in the WordPress admin.
