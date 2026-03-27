# GISBA App — Agent Context

## Project Overview

GISBA is a cybersecurity and NIS2 compliance company website with a public-facing frontend (blog, video resources, contact, policy pages), a Stripe payment success flow, and an authenticated admin panel for managing blog posts and videos.

## Technology Stack

- **PHP 8.3** / **Laravel 13** — core framework
- **Laravel Breeze v2** — authentication scaffolding
- **Tailwind CSS v3** + **Alpine.js v3** — frontend styling and interactivity
- **Vite** — asset bundling (`resources/css/app.css`, `resources/js/app.js`)
- **TinyMCE v6** — rich text editor for blog posts (admin only)
- **MySQL** (dev: `gisba_laravel`) / **SQLite in-memory** (tests)
- **Pest v4** — testing framework
- **Laravel Pint** — code style formatter
- **Laravel Herd** — local dev server (site at `https://gisba-app.test`)

## Directory Structure

```
app/
├── Enums/Category.php          # 18+ cybersecurity blog categories (TitleCase keys)
├── Http/
│   ├── Controllers/
│   │   ├── Admin/              # BlogController, VideoController, BlogAttachmentController
│   │   ├── Auth/               # Breeze auth controllers
│   │   ├── BlogController.php  # Public blog index + show
│   │   ├── ContactController.php
│   │   ├── PageController.php  # All static public pages
│   │   └── VideoController.php # Public video listing, streaming, view recording
│   └── Requests/               # Form Requests for all write operations
├── Mail/                       # ContactMail, PaymentNotificationMail
├── Models/                     # User, BlogPost, BlogPostAttachment, Video
├── Rules/BusinessEmail.php     # Custom validation rule
└── View/Components/            # AppLayout, GuestLayout

resources/views/
├── admin/blog/                 # index, create, edit, _form, _tinymce partials
├── admin/videos/               # index, create, edit
├── auth/                       # Breeze auth views
├── components/                 # Blade UI components (button, input, modal, nav, etc.)
├── emails/                     # enquiry.blade.php, payment-notification.blade.php
├── layouts/
│   ├── site.blade.php          # Public-facing layout
│   ├── app.blade.php           # Auth/dashboard layout
│   └── guest.blade.php         # Auth forms layout
├── pages/                      # All public page views
└── partials/nis2-kit-banner.blade.php

routes/web.php                  # All routes (public, admin under /admin prefix, Breeze)
database/
├── migrations/                 # users, cache, jobs, blog_posts, blog_post_attachments, videos
├── factories/                  # UserFactory, BlogPostFactory, VideoFactory
└── seeders/                    # DatabaseSeeder, BlogPostSeeder
tests/
├── Feature/Admin/              # BlogControllerTest, BlogAttachmentTest
├── Feature/                    # GisbaPageTest, ContactFormTest, VideoTest, BlogPublicTest, etc.
└── Unit/
```

## Coding Conventions

- **Form Requests** for all validation — no inline `$request->validate()` in controllers
- **Named routes** everywhere — `route('nis2.show', $post)` not `url('/nis2/'.$post->slug)`
- **Eloquent only** — `Model::query()` over `DB::`, eager load to prevent N+1
- **PHP 8 constructor promotion** — `public function __construct(public Foo $foo) {}`
- **Explicit return types** on all methods/functions
- **Enum keys in TitleCase** — `Category::GeneralTopics`, `Category::CybersecurityGovernance`
- **PHPDoc over inline comments** — add `@param`/`@return` shapes, not `// do this`
- **Curly braces always** — even single-line `if`, `foreach`, etc.
- Config values via `config()` only — never `env()` outside config files
- Admin routes: `auth` middleware + `/admin` prefix + `admin.` name prefix

## Key Commands

```bash
# Development
composer run dev          # Starts server, queue, pail logs, and Vite together

# Frontend
npm run dev               # Vite dev server
npm run build             # Production asset build

# Testing
php artisan test --compact                          # Run all tests
php artisan test --compact --filter=TestName        # Filtered run
php artisan test --compact tests/Feature/VideoTest.php  # Single file

# Code style (run after any PHP change)
vendor/bin/pint --dirty --format agent

# Artisan helpers
php artisan make:model Foo -mfs --pest --no-interaction  # Model + migration + factory + seeder + test
php artisan make:test --pest Feature/FooTest             # Feature test
php artisan route:list                                   # Inspect routes
php artisan tinker --execute "..."                       # Debug PHP
```

## Important Notes

- **`/setup/init` route** exists for server setup (storage:link + cache clear) — protected by `auth`, should be removed after use
- **Blog slug** is auto-generated on `BlogPost` — do not set manually unless overriding
- **Video streaming** uses `StreamedResponse` via `VideoController::stream()` — not a direct file URL
- **Views recorded** on video play via POST `/video-resources/{video}/view` (no auth required)
- **Mail enquiry recipient** is configured at `config('mail.enquiry_recipient')` (custom key in `config/mail.php`)
- **`BusinessEmail` rule** is available for contact/lead forms — validates against common personal email domains
- **TinyMCE** is included via `@include('admin.blog._tinymce')` partial inside admin blog form
- **Tests use SQLite in-memory** — no MySQL needed for test runs
- **`Category` enum** has a static `options()` method returning `[value => label]` for select inputs
- **Public blog route is `/nis2`** (not `/blog`) — matches the NIS2 compliance focus
