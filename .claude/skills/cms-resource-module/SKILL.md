---
name: cms-resource-module
description: "Scaffolds a complete CMS + frontend resource module for Laravel projects. The pattern: admin manages entities (CRUD with image upload), each entity has polymorphic file resources (videos, PDFs, docs grouped by type), frontend displays entities in a grid then shows per-entity resource pages. Use when user asks to add the process module, add a cms module with resources, scaffold entity with file resources, or implement the resource module pattern in a Laravel project."
---

# CMS Resource Module

Scaffold a complete entity + polymorphic resources module. Interview first, then generate.

## Step 1: Interview

Use AskUserQuestion to collect requirements. Ask all questions in one call.

```
AskUserQuestion([
  {
    question: "What is the entity name? (singular, PascalCase — e.g. Process, Course, Policy, Domain)",
    header: "Entity name",
    options: [] // free text via Other
  },
  {
    question: "Which resource types does this module need?",
    header: "Resource types",
    multiSelect: true,
    options: [
      { label: "Videos", description: "MP4 video files, streamed securely" },
      { label: "Documents/Templates", description: "PDF or Word files, viewable/downloadable" },
      { label: "Checklists", description: "PDF or Word checklists" },
      { label: "Glossary", description: "PDF or Word glossary files" }
    ]
  },
  {
    question: "Which optional fields does this entity need?",
    header: "Optional fields",
    multiSelect: true,
    options: [
      { label: "Arabic title (title_ar)", description: "Bilingual support" },
      { label: "Slug", description: "URL-friendly identifier separate from ID" },
      { label: "Description/body text", description: "Long text field" },
      { label: "Image/thumbnail", description: "Cover image with storage upload" }
    ]
  },
  {
    question: "Does the index page need pagination?",
    header: "Pagination",
    options: [
      { label: "Yes — paginate()", description: "Use Laravel paginator with links" },
      { label: "No — all()", description: "Load all records (small datasets)" }
    ]
  }
])
```

Follow up if needed:
- URL prefix? (e.g. `/ciso`, `/admin`, `/portal`)
- Auth middleware group name?
- Admin layout blade name? (e.g. `layouts.user`, `layouts.admin`)
- Frontend layout blade name?
- FilePond available? Or different uploader?
- Does project already have a `resources` polymorphic table, or create fresh?

## Step 2: Explore Target Project

Before generating, read the target project to match conventions:

1. Check existing routes: `routes/web.php` — find auth middleware groups, URL prefixes
2. Check existing controllers — naming, namespace, constructor style
3. Check existing models — cast style (`casts()` method vs `$casts`), relationships
4. Check existing migrations — column naming conventions
5. Check existing views — layout names, component names (`x-table.table` vs `<table>`, etc.)
6. Find existing Form Request classes — array vs string validation rules

## Step 3: Generate

Generate all artifacts in this order. Read `references/module-blueprint.md` for full templates and patterns.

### 3.1 Migration — entity table

```
php artisan make:migration create_{entity_plural}_table --no-interaction
```

Columns (always): `id` (PK), entity-specific identifier column, `title`
Conditional: `title_ar`, `slug`, `description`, `image_path`
No timestamps on entity table unless project convention differs.

### 3.2 Migration — resources table (skip if already exists)

```
php artisan make:migration create_resources_table --no-interaction
```

Columns: `id`, `file_name`, `file_path`, `file_type`, `resource_type`, `resourceable_type`, `resourceable_id`, timestamps.
Add composite index on `resourceable_type` + `resourceable_id`.

### 3.3 Model

```
php artisan make:model {Entity} --no-interaction
```

- Set `$table`, `$guarded = []`, `public $timestamps = false`
- Add `resources()` morphMany relationship
- Use `casts()` method if project convention uses it

### 3.4 Resource Model (skip if exists)

```
php artisan make:model Resource --no-interaction
```

- Add `resourceable()` morphTo relationship

### 3.5 Admin Controllers

```
php artisan make:controller {Entity}CMSController --no-interaction
php artisan make:controller {Entity}ResourceUploadController --no-interaction
```

See `references/module-blueprint.md` → "Admin Controllers" for full implementation.

Key behaviors:
- CMSController: full CRUD, image stored on `public` disk at `{entity}/images/`, delete blocked if resources exist
- ResourceUploadController: FilePond-compatible JSON response, stores files on `public` disk at `resources/`
- **Bug fix from original**: always use `Storage::disk('public')->delete()` not `Storage::delete()`

### 3.6 Frontend Controllers

```
php artisan make:controller {Entity}Controller --no-interaction
php artisan make:controller {Entity}ResourceController --no-interaction
```

See `references/module-blueprint.md` → "Frontend Controllers".

EntityController: `index()` + `show()` only.
EntityResourceController: one method per resource type selected in interview + `stream()` for video + `download()` + `destroy()`.

### 3.7 Routes

Add to `routes/web.php` inside the correct middleware group:

```php
// Admin
Route::resource('{entity_plural_lower}', {Entity}CMSController::class);
Route::get('/cms/create-resource/{{entity_lower}}', [{Entity}ResourceUploadController::class, 'create'])->name('{entity_lower}.resource.create');
Route::post('/upload-{entity_lower}-resource', [{Entity}ResourceUploadController::class, 'store'])->name('{entity_lower}.resource.store');

// Frontend
Route::get('/{prefix}/{entity_plural_lower}', [{Entity}Controller::class, 'index'])->name('{entity_lower}.index');
Route::get('/{prefix}/{entity_plural_lower}/{{entity_lower}:{identifier_col}}', [{Entity}Controller::class, 'show'])->name('{entity_lower}.show');
// Resource type routes per selected types
Route::get('/{prefix}/resource/{{entity_lower}:{identifier_col}}/videos/', [{Entity}ResourceController::class, 'videos'])->name('{entity_lower}.resource.videos');
// ... etc per type
Route::get('/{prefix}/video/stream/{resource}', [{Entity}ResourceController::class, 'stream'])->name('{entity_lower}.video.stream');
Route::get('/{prefix}/resource/download/{resource}', [{Entity}ResourceController::class, 'download'])->name('{entity_lower}.resource.download');
Route::delete('/{prefix}/resources/{resource}', [{Entity}ResourceController::class, 'destroy'])->name('{entity_lower}.resource.destroy');
```

### 3.8 Views — Admin

Create in `resources/views/{entity_lower}/cms/`:
- `index.blade.php` — paginated table: identifier | title | [media] [view] [edit] [delete]
- `create.blade.php` — form (create + edit shared), show current image on edit
- `show.blade.php` — info display + resources table with delete action
- `resources/create.blade.php` — FilePond upload form, 4 uploaders (per selected types)

Match existing admin view component names exactly (check sibling views first).

### 3.9 Views — Frontend

Create in `resources/views/{prefix}/{entity_plural_lower}/`:
- `index.blade.php` — grid of entity cards linking to show
- `show.blade.php` — image + resource type sidebar links
- `resources/checklist.blade.php` (if selected)
- `resources/videos.blade.php` (if selected)
- `resources/template.blade.php` (if selected)
- `resources/glossary.blade.php` (if selected)
- `resources/resource-table.blade.php` — shared partial for doc/PDF listing

See `references/module-blueprint.md` → "View Patterns" for layouts.

### 3.10 Form Requests (if project uses them)

```
php artisan make:request Store{Entity}Request --no-interaction
php artisan make:request Update{Entity}Request --no-interaction
```

### 3.11 Run Migration

```
php artisan migrate --no-interaction
```

### 3.12 Format

```
vendor/bin/pint --dirty
```

## Step 4: Verify

Run tests if they exist:
```
php artisan test --filter={Entity}
```

Check routes registered:
```
php artisan route:list --path={entity_lower}
```
