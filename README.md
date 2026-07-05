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

## Releasing an update

1. Bump the `Version` header in `custom-update-check.php`.
2. Commit and tag with semver (must match the header version):

   ```bash
   git add custom-update-check.php
   git commit -m "Release 0.1.0"
   git tag 0.1.0
   git push origin main
   git push origin 0.1.0
   ```

3. GitHub Actions builds `custom-update-check.zip` via `git archive` and attaches it to the Release.

## Zip layout

The release zip always extracts to `wp-content/plugins/custom-update-check/` regardless of tag name, thanks to the fixed `--prefix=custom-update-check/` in the workflow.

## Transitioning to WordPress.org

When ready to publish on WordPress.org:

1. Remove the `Update URI` header and the PUC block from `custom-update-check.php`.
2. Bump `Version` to a number higher than the last self-hosted release.
3. Publish via WordPress.org SVN; wp.org will take over updates from that point.

See the inline comment in `custom-update-check.php` for the same steps.

## Verify locally

```bash
# Lint all PHP files
find . -name '*.php' -print0 | xargs -0 -n1 php -l

# Simulate release zip
git archive --format=zip \
  --prefix=custom-update-check/ \
  --output=/tmp/custom-update-check.zip \
  HEAD

unzip -l /tmp/custom-update-check.zip | head -20
```
