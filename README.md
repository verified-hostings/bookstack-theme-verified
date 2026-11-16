# bookstack-theme-verified

Verified Hostings theme for **BookStack 26.x**, built on BookStack's native
theme system (`APP_THEME` + `themes/<name>/` view overrides + the
`/theme/{theme}/{path}` public-file route).

Deep-forest header stage, brand-purple links/accents, warm paper surfaces,
Fraunces display headings + Inter body — matching verifiedhostings.com.

## Package contents

| Path in repo | Install to | Purpose |
|---|---|---|
| `themes/verified/layouts/parts/custom-head.blade.php` | same path under the app's `themes/` dir | Extends the stock `custom-head` include (keeps admin "Custom HTML Head" content) and links the theme stylesheet |
| `themes/verified/public/css/verified.css` | same path under the app's `themes/` dir | Theme CSS — served by BookStack at `/theme/verified/css/verified.css` |

## Install

1. Copy `themes/verified/` into the BookStack `themes/` directory (next to
   `.gitignore`), e.g. `themes/verified/...`.
2. Set the theme in `.env`:

   ```
   APP_THEME=verified
   ```

3. Clear caches so Laravel picks up the env + view changes:

   ```
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

   (On shared hosting without shell access, hit a one-shot script that boots
   the app and calls `Artisan::call('config:clear')` etc., then delete it.)

## Notes

- Only the `custom-head` include is overridden — every other view stays
  stock, so upgrades are low-risk.
- Dark mode is supported: matching dark variants of all brand variables are
  defined under `:root.dark-mode`.
- Admin-set "Custom HTML Head" content still renders — the override extends
  the stock include rather than replacing it.
