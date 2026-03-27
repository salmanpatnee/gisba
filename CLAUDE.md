# GISBA App — Claude Instructions

> See [AGENTS.md](AGENTS.md) for full project context (stack, structure, conventions, commands).

## Project-Specific Rules

- **Public blog = `/nis2`** — use `nis2` naming in routes/views, not `blog`
- **Admin blog = `/admin/blog`** — `Admin\BlogController`, resource routes minus `show`
- **Category enum** — use `Category::options()` for selects; never hardcode category strings
- **Layouts** — `layouts/site.blade.php` for public pages; `layouts/app.blade.php` for auth/admin
- **TinyMCE** — already configured via `admin/blog/_tinymce.blade.php`; include it, don't duplicate
- **`BusinessEmail` rule** — apply to any user-facing form collecting professional emails
- **Video streaming** — always use `VideoController::stream()`; never expose raw file paths

## Do / Don't

- **Do** run `vendor/bin/pint --dirty --format agent` after every PHP change
- **Do** use `php artisan make:` for all new files; pass `--no-interaction`
- **Do** write/update a Pest feature test for every change; run with `--compact --filter`
- **Don't** validate inline in controllers — always use a Form Request class
- **Don't** use `DB::` — use `Model::query()` with eager loading
- **Don't** call `env()` outside config files — use `config('key')`
- **Don't** hardcode URLs — use named routes with `route()`
- **Don't** add Livewire — not installed; use Alpine.js for interactivity

## Ask Before Acting

- Adding/removing Composer or npm packages
- Destructive schema changes (column drops, renames with data impact)
- New middleware or changes to auth flow
- New top-level directories or architectural patterns not already present

## Common Task Patterns

**New public page:** method in `PageController` → named route in `web.php` → view in `resources/views/pages/`

**New blog category:** TitleCase case in `app/Enums/Category.php` with value + label in `options()`

**New admin CRUD resource:**
1. `php artisan make:model Foo -mfs --pest --no-interaction`
2. `php artisan make:controller Admin/FooController --resource --no-interaction`
3. Form Request(s) in `app/Http/Requests/`, route in `admin.` group, views in `resources/views/admin/foo/`

<laravel-boost-guidelines>
</laravel-boost-guidelines>
