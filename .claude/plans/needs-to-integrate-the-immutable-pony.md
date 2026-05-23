# PayPal Members-Only Integration

## Context
PMP training content at `/pmp` is public. A new **members-only section** (`/members`) needs a PayPal one-time $30 payment gate. Users pay first, receive a magic-link email, click it to register/login, and gain access. Sandbox credentials first; switch to live via env vars only.

---

## PayPal Setup Instructions (do first)

1. Log in to **developer.paypal.com** → **My Apps & Credentials** → **Sandbox** tab
2. Click **Create App** → name "GISBA Dev" → App Type: **Merchant**
3. Copy **Client ID** + **Secret** → add to `.env`:
   ```
   PAYPAL_CLIENT_ID=sb_client_id_here
   PAYPAL_CLIENT_SECRET=sb_secret_here
   PAYPAL_MODE=sandbox
   ```
4. Sandbox buyer accounts: **developer.paypal.com → Sandbox → Accounts** (use any Personal account)
5. For live: create Live app, swap credentials, set `PAYPAL_MODE=live` — no code changes needed

---

## Approach

**Direct HTTP client** (no package). Two PayPal REST v2 calls via Laravel's `Http` facade:
- `POST /v1/oauth2/token` → bearer token (cached 8h)
- `POST /v2/checkout/orders` → creates order, returns approval URL
- `POST /v2/checkout/orders/{id}/capture` → captures payment

Base URL: `https://api-m.sandbox.paypal.com` or `https://api-m.paypal.com` based on `config('services.paypal.mode')`.

---

## User Flow

```
/members (paywall) → enter email → POST /members/checkout
  → PayPalService::createOrder() → redirect to PayPal
  → user approves → GET /members/paypal/return?token=xxx
  → PayPalService::captureOrder() → create MemberAccessToken + send MagicLinkMail
  → /members/email-sent (check inbox)
  → click link → GET /members/access/{token}
  → validate token → login/register user → set is_member=true
  → redirect to /members/library (protected)
```

---

## Database Migrations (3)

### 1. `create_member_posts_table`
```
id, title, slug (unique), body (longText), featured_image (nullable),
meta_title (nullable), meta_description (nullable), author, timestamps
```

### 2. `add_member_access_to_users_table`
```
is_member (boolean, default false, indexed)
member_since (timestamp, nullable)
```

### 3. `create_member_access_tokens_table`
```
id, email (indexed), token (64, unique indexed), paypal_order_id (nullable),
amount_paid (decimal 8,2 default 30.00), used_at (nullable), expires_at, timestamps
```

---

## New Files

| File | How |
|---|---|
| `app/Services/PayPalService.php` | Manual |
| `app/Models/MemberPost.php` | `make:model MemberPost` |
| `app/Models/MemberAccessToken.php` | `make:model MemberAccessToken` |
| `app/Http/Middleware/EnsureMemberAccess.php` | `make:middleware EnsureMemberAccess` |
| `app/Http/Controllers/MembersController.php` | `make:controller MembersController` |
| `app/Http/Controllers/PayPalCheckoutController.php` | `make:controller PayPalCheckoutController` |
| `app/Http/Controllers/MemberAccessController.php` | `make:controller MemberAccessController` |
| `app/Http/Controllers/Admin/MemberPostController.php` | `make:controller Admin/MemberPostController --resource` |
| `app/Http/Requests/InitiatePayPalRequest.php` | `make:request InitiatePayPalRequest` |
| `app/Http/Requests/StoreMemberPostRequest.php` | `make:request StoreMemberPostRequest` |
| `app/Http/Requests/UpdateMemberPostRequest.php` | `make:request UpdateMemberPostRequest` |
| `app/Mail/MagicLinkMail.php` | `make:mail MagicLinkMail` |
| `database/factories/MemberPostFactory.php` | `make:factory MemberPostFactory --model=MemberPost` |
| `resources/views/emails/magic-link.blade.php` | Manual |
| `resources/views/pages/members.blade.php` | Manual — paywall |
| `resources/views/pages/members-email-sent.blade.php` | Manual |
| `resources/views/pages/members-library.blade.php` | Manual |
| `resources/views/pages/members-show.blade.php` | Manual |
| `resources/views/admin/member-posts/{index,create,edit,_form}.blade.php` | Manual — mirror `admin/pmp/` |
| `tests/Feature/MembersPaywallTest.php` | `make:test --pest` |
| `tests/Feature/PayPalCheckoutTest.php` | `make:test --pest` |
| `tests/Feature/MagicLinkRedemptionTest.php` | `make:test --pest` |
| `tests/Feature/Admin/MemberPostControllerTest.php` | `make:test --pest` |

---

## Modified Files

| File | Change |
|---|---|
| `app/Models/User.php` | Add `is_member`, `member_since` to fillable/casts; add `isMember(): bool` |
| `config/services.php` | Add `paypal` block (client_id, client_secret, mode) |
| `bootstrap/app.php` | Register `member` middleware alias → `EnsureMemberAccess::class` |
| `routes/web.php` | Add all members + paypal + admin member-posts routes |
| `resources/views/layouts/site.blade.php` | Add Members nav link |
| `resources/views/partials/pmp-banner.blade.php` | Change CTA href from `contact-us` → `members.paywall` |

---

## Routes (additions to web.php)

```php
// Paywall (public)
Route::get('/members', [MembersController::class, 'paywall'])->name('members.paywall');

// PayPal checkout
Route::post('/members/checkout', [PayPalCheckoutController::class, 'create'])->name('members.checkout');
Route::get('/members/paypal/return', [PayPalCheckoutController::class, 'capture'])->name('members.paypal.return');
Route::get('/members/paypal/cancel', [PayPalCheckoutController::class, 'cancel'])->name('members.paypal.cancel');
Route::get('/members/email-sent', fn() => view('pages.members-email-sent'))->name('members.email-sent');

// Magic link (must be BEFORE the member middleware group to avoid slug conflict)
Route::get('/members/access/{token}', [MemberAccessController::class, 'redeem'])->name('members.access.redeem');

// Protected content
Route::middleware('member')->prefix('members')->name('members.')->group(function () {
    Route::get('/library', [MembersController::class, 'index'])->name('index');
    Route::get('/library/{slug}', [MembersController::class, 'show'])->name('show');
});

// Admin (inside existing auth group)
Route::resource('member-posts', Admin\MemberPostController::class)->except('show');
```

---

## Key Implementation Notes

- **`PayPalService`**: cache access token with `Cache::remember('paypal_access_token', 28800, ...)`. Never call `env()` — only `config('services.paypal.*')`.
- **`MemberAccessToken::generate()`**: `token = Str::random(64)`, `expires_at = now()->addHours(48)`.
- **`MemberAccessToken::isValid()`**: `used_at === null && expires_at > now()`.
- **`EnsureMemberAccess`**: if guest → `redirect(route('members.paywall'))`; if auth + not member → same redirect.
- **Magic link redemption**: if email matches existing user → login that user; else → auto-create user with random password, login. Either way: `is_member = true`, `member_since = now()`, `token->used_at = now()`.
- **Admin CRUD**: exact mirror of `Admin\PmpController` — reference `app/Http/Controllers/Admin/PmpController.php`. No `category_id`. Include TinyMCE via `@include('admin.pmp._tinymce')` (reuse, don't duplicate).
- **PayPal return/cancel URLs** passed in `createOrder()` payload: `route('members.paypal.return')` + `route('members.paypal.cancel')`.

---

## Execution Order

1. Migrations (3) → `php artisan migrate`
2. Models: `MemberPost`, `MemberAccessToken`, update `User`
3. `PayPalService` + `config/services.php` paypal block
4. `EnsureMemberAccess` middleware + register alias in `bootstrap/app.php`
5. Routes (all)
6. Controllers: `MembersController`, `PayPalCheckoutController`, `MemberAccessController`
7. Form Requests: `InitiatePayPalRequest`
8. Mail: `MagicLinkMail` + `emails/magic-link.blade.php`
9. Views: paywall, email-sent, library, show
10. Admin: controller, requests, views, factory
11. Nav + pmp-banner updates
12. Pest tests
13. `vendor/bin/pint --dirty --format agent`

---

## Verification

**Automated (Pest):**
- `MembersPaywallTest`: guest sees paywall; guest/non-member redirected from `/members/library`; member accesses library
- `PayPalCheckoutTest`: `Http::fake()` mocks PayPal calls; invalid email → validation error; valid flow → `MemberAccessToken` created + mail sent
- `MagicLinkRedemptionTest`: valid token → login + `is_member=true`; expired → error; used → error; new email → auto-register
- `Admin/MemberPostControllerTest`: guest redirect; CRUD works; validation enforced

**Manual sandbox walkthrough:**
1. Visit `/members` → paywall visible
2. Enter email → PayPal sandbox checkout completes
3. Check mail log for magic link (`MAIL_MAILER=log`)
4. Click link → logged in, redirected to `/members/library`
5. Log out → `/members/library` redirects to paywall
6. Log back in via Breeze → `is_member` flag persists access
