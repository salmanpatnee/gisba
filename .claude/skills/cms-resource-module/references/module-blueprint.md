# Module Blueprint — CMS Resource Module

## Table of Contents
1. [Database Pattern](#database-pattern)
2. [Admin Controllers](#admin-controllers)
3. [Frontend Controllers](#frontend-controllers)
4. [Route Pattern](#route-pattern)
5. [View Patterns](#view-patterns)
6. [Known Issues Fixed](#known-issues-fixed)

---

## Database Pattern

### Entity table (`cms_{entity_plural}`)
```php
Schema::create('cms_{entity_plural}', function (Blueprint $table) {
    $table->id();
    $table->string('{entity_lower}_id')->unique(); // route key, e.g. "process_id"
    $table->string('title');
    // $table->string('title_ar')->nullable();   // if Arabic needed
    // $table->string('slug')->nullable();       // if slug needed
    // $table->text('description')->nullable();  // if description needed
    // $table->string('image_path')->nullable(); // if image needed
});
```
No timestamps unless project uses them.

### Resources table (polymorphic — skip if exists)
```php
Schema::create('resources', function (Blueprint $table) {
    $table->id();
    $table->string('file_name');
    $table->string('file_path');
    $table->string('file_type');
    $table->string('resource_type'); // 'checklist', 'template', 'glossary', 'guide'
    $table->morphs('resourceable');  // resourceable_type + resourceable_id + index
    $table->timestamps();
});
```

---

## Admin Controllers

### EntityCMSController (full CRUD)
```php
class {Entity}CMSController extends Controller
{
    public function index(): View
    {
        ${entity_plural} = {Entity}::select('id', '{entity_lower}_id', 'title')->paginate(20);
        return view('{entity_lower}/cms/index', compact('{entity_plural}'));
    }

    public function show({Entity} ${entity_lower}): View
    {
        ${entity_lower}->load('resources');
        return view('{entity_lower}/cms/show', compact('{entity_lower}'));
    }

    public function create(): View
    {
        ${entity_lower} = null;
        return view('{entity_lower}/cms/create', compact('{entity_lower}'));
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            '{entity_lower}_id' => ['required', 'unique:cms_{entity_plural}'],
            'title' => 'required',
            // 'title_ar' => 'nullable',
            // 'description' => 'nullable',
            // 'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $attributes['image_path'] = $request->file('image')->store('{entity_lower}/images', 'public');
        }
        unset($attributes['image']);

        {Entity}::create($attributes);
        return redirect(route('cms.{entity_lower}.index'))->with('success', '{Entity} saved successfully.');
    }

    public function edit(Request $request, {Entity} ${entity_lower}): View
    {
        return view('{entity_lower}/cms/create', compact('{entity_lower}'));
    }

    public function update(Request $request, {Entity} ${entity_lower}): RedirectResponse
    {
        $attributes = $request->validate([
            '{entity_lower}_id' => ['required', 'unique:cms_{entity_plural},{entity_lower}_id,' . ${entity_lower}->id],
            'title' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if (${entity_lower}->image_path) {
                Storage::disk('public')->delete(${entity_lower}->image_path);
            }
            $attributes['image_path'] = $request->file('image')->store('{entity_lower}/images', 'public');
        }
        unset($attributes['image']);

        ${entity_lower}->update($attributes);
        return redirect(route('cms.{entity_lower}.index'))->with('success', '{Entity} saved successfully.');
    }

    public function destroy({Entity} ${entity_lower}): RedirectResponse
    {
        if (${entity_lower}->resources()->count() > 0) {
            return redirect(route('cms.{entity_lower}.index'))
                ->with('error', '{Entity} cannot be deleted as it has resources attached.');
        }
        ${entity_lower}->delete();
        return redirect(route('cms.{entity_lower}.index'))->with('success', '{Entity} deleted successfully.');
    }
}
```

### EntityResourceUploadController (FilePond AJAX)
```php
class {Entity}ResourceUploadController extends Controller
{
    public function create({Entity} ${entity_lower}): View
    {
        return view('{entity_lower}/cms/resources/create', compact('{entity_lower}'));
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'videoUploadEle'     => 'nullable|file|max:20480',
                'checklistUploadEle' => 'nullable|file|max:20480',
                'templateUploadEle'  => 'nullable|file|max:20480',
                'glossaryUploadEle'  => 'nullable|file|max:20480',
                'resource_type'      => 'required|in:guide,template,checklist,glossary',
                'resourceable_id'    => 'required|string',
                'resourceable_type'  => 'required|string',
            ]);

            $uploadMap = [
                'videoUploadEle'     => 'guide',
                'checklistUploadEle' => 'checklist',
                'templateUploadEle'  => 'template',
                'glossaryUploadEle'  => 'glossary',
            ];

            $resources = collect($uploadMap)
                ->mapWithKeys(function ($resourceType, $inputName) use ($request) {
                    if ($request->hasFile($inputName)) {
                        $file = $request->file($inputName);
                        $path = $file->store('resources', 'public');
                        return [$resourceType => Resource::create([
                            'file_name'        => $file->getClientOriginalName(),
                            'file_path'        => $path,
                            'file_type'        => $file->getClientMimeType(),
                            'resource_type'    => $resourceType,
                            'resourceable_id'  => $request->resourceable_id,
                            'resourceable_type' => $request->resourceable_type,
                        ])];
                    }
                    return [];
                });

            return response()->json(['message' => 'Uploaded successfully', 'resources' => $resources]);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'Upload failed', 'error' => $e->getMessage()], 500);
        }
    }
}
```

---

## Frontend Controllers

### EntityController
```php
class {Entity}Controller extends Controller
{
    public function index(): View
    {
        // Use paginate() if pagination selected, all() otherwise
        $all{Entity_plural} = {Entity}::paginate(20);
        // OR: $all{Entity_plural} = {Entity}::all();
        return view('{prefix}/{entity_plural}/index', compact('all{Entity_plural}'));
    }

    public function show({Entity} ${entity_lower}): View
    {
        return view('{prefix}/{entity_plural}/show', compact('{entity_lower}'));
    }
}
```

### EntityResourceController
```php
class {Entity}ResourceController extends Controller
{
    public function checklist({Entity} ${entity_lower}): View
    {
        ${entity_lower}WithChecklist = ${entity_lower}->load(['resources' => fn($q) => $q->where('resource_type', 'checklist')]);
        return view('{prefix}/{entity_plural}/resources/checklist', compact('{entity_lower}WithChecklist'));
    }

    public function videos({Entity} ${entity_lower}): View
    {
        ${entity_lower}WithVideos = ${entity_lower}->load(['resources' => fn($q) => $q->where('file_type', 'video/mp4')]);
        return view('{prefix}/{entity_plural}/resources/videos', compact('{entity_lower}WithVideos'));
    }

    public function template({Entity} ${entity_lower}): View
    {
        ${entity_lower}WithTemplates = ${entity_lower}->load(['resources' => fn($q) => $q->where('resource_type', 'template')]);
        return view('{prefix}/{entity_plural}/resources/template', compact('{entity_lower}WithTemplates'));
    }

    public function glossary({Entity} ${entity_lower}): View
    {
        ${entity_lower}WithGlossary = ${entity_lower}->load(['resources' => fn($q) => $q->where('resource_type', 'glossary')]);
        return view('{prefix}/{entity_plural}/resources/glossary', compact('{entity_lower}WithGlossary'));
    }

    public function stream(Resource $resource): Response
    {
        if ($resource->file_type !== 'video/mp4') {
            abort(403, 'Unauthorized');
        }
        $path = storage_path('app/public/' . $resource->file_path);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path, [
            'Content-Type'        => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . $resource->file_name . '"',
        ]);
    }

    public function pdfTemplate(Resource $resource): View
    {
        $resource->load('resourceable');
        return view('{prefix}/{entity_plural}/resources/template-pdf', compact('resource'));
    }

    public function download(Resource $resource): BinaryFileResponse
    {
        if (!Storage::disk('public')->exists($resource->file_path)) {
            abort(404, 'File not found');
        }
        return Storage::disk('public')->download($resource->file_path, $resource->file_name);
    }

    public function destroy(Resource $resource): RedirectResponse
    {
        // FIXED: use public disk, not default disk
        Storage::disk('public')->delete($resource->file_path);
        $resource->delete();
        return redirect()->back()->with('success', 'Resource deleted successfully.');
    }
}
```

---

## Route Pattern

```php
// === ADMIN (inside auth middleware group) ===
Route::resource('{entity_plural_lower}', {Entity}CMSController::class)->names('cms.{entity_lower}');
Route::get('/cms/create-resource/{{entity_lower}}', [{Entity}ResourceUploadController::class, 'create'])
    ->name('{entity_lower}.resource.create');
Route::post('/upload-{entity_lower}-resource', [{Entity}ResourceUploadController::class, 'store'])
    ->name('{entity_lower}.resource.store');

// === FRONTEND (inside auth + prefix middleware group) ===
Route::get('/{entity_plural_lower}', [{Entity}Controller::class, 'index'])
    ->name('{entity_lower}.index');
Route::get('/{entity_plural_lower}/{{entity_lower}:{entity_lower}_id}', [{Entity}Controller::class, 'show'])
    ->name('{entity_lower}.show');

// Resource type routes (add only for selected types):
Route::get('/resource/{{entity_lower}:{entity_lower}_id}/checklist/', [{Entity}ResourceController::class, 'checklist'])
    ->name('{entity_lower}.resource.checklist');
Route::get('/resource/{{entity_lower}:{entity_lower}_id}/videos/', [{Entity}ResourceController::class, 'videos'])
    ->name('{entity_lower}.resource.videos');
Route::get('/video/stream/{resource}', [{Entity}ResourceController::class, 'stream'])
    ->name('{entity_lower}.video.stream');
Route::get('/resource/{{entity_lower}:{entity_lower}_id}/documents/', [{Entity}ResourceController::class, 'template'])
    ->name('{entity_lower}.resource.template');
Route::get('/resource/template/{resource}', [{Entity}ResourceController::class, 'pdfTemplate'])
    ->name('{entity_lower}.resource.template.pdf');
Route::get('/resource/{{entity_lower}:{entity_lower}_id}/glossary/', [{Entity}ResourceController::class, 'glossary'])
    ->name('{entity_lower}.resource.glossary');
Route::get('/resource/download/{resource}', [{Entity}ResourceController::class, 'download'])
    ->name('{entity_lower}.resource.download');
Route::delete('/resources/{resource}', [{Entity}ResourceController::class, 'destroy'])
    ->name('{entity_lower}.resource.destroy');
```

---

## View Patterns

### Admin index (`{entity_lower}/cms/index.blade.php`)
```blade
@extends('layouts.{admin_layout}')
@section('content')
<div>
    {{-- action wrapper with Add button + table --}}
    {{-- columns: S.No | {entity_lower}_id | title | Actions (media, view, edit, delete) --}}
    {{-- pagination links if using paginate() --}}
</div>
@endsection
```

### Admin create/edit (`{entity_lower}/cms/create.blade.php`)
- Single view handles both create and edit (detect via `${entity_lower}?->id`)
- `process_id` field: readonly on edit (already set, unique)
- Show current image thumbnail on edit if `image_path` exists
- Form action switches between `store` and `update` route

### Admin show (`{entity_lower}/cms/show.blade.php`)
- Display all entity fields
- Table of attached resources: file_name | resource_type | delete action

### Admin resource upload (`{entity_lower}/cms/resources/create.blade.php`)
- FilePond inputs per resource type
- Hidden inputs: `resourceable_id`, `resourceable_type`
- JS: one `initFilePondUploader()` call per type with correct MIME restrictions
  - Videos: `['video/*']`
  - Docs: `['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']`
- FilePond POSTs to resource store route with `X-CSRF-TOKEN` header

### Frontend index (`{prefix}/{entity_plural}/index.blade.php`)
- Extend frontend layout
- Grid of entity cards (image, title, link to show)
- If paginate: include pagination links

### Frontend show (`{prefix}/{entity_plural}/show.blade.php`)
- Two-column: image left, resource type links right (only show links for selected types)

### Frontend resource pages (checklist/videos/template/glossary)
- Top: entity title + description
- Bottom (`additional_content` section if layout uses it): resource listing
  - **Videos**: `<video controls controlsList="nodownload">` with stream URL; 1-col if 1 video, 2-col if multiple
  - **Docs**: shared `resource-table` partial — table with filename, type (PDF/DOC), view/download

### Shared resource-table partial
```blade
<table>
    <thead><tr><th>Document Name</th><th>Type</th><th>View</th></tr></thead>
    <tbody>
        @foreach ($resources as $resource)
        <tr>
            <td>{{ $resource->file_name }}</td>
            <td>{{ $resource->file_type === 'application/pdf' ? 'PDF' : 'DOC' }}</td>
            <td>
                @if ($resource->file_type === 'application/pdf')
                    <a href="{{ route('{entity_lower}.resource.template.pdf', $resource->id) }}">View</a>
                @else
                    <a href="{{ route('{entity_lower}.resource.download', $resource->id) }}" download>Download</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

## Known Issues Fixed

These bugs exist in the original saudivirtualciso implementation — the skill fixes them:

1. **Storage disk mismatch**: Original `destroy()` uses `Storage::delete($resource->file_path)` (default disk) but files are stored on `public` disk. Fixed to `Storage::disk('public')->delete()`.

2. **Video resource_type inconsistency**: Videos stored as `resource_type = 'guide'` but frontend filters by `file_type = 'video/mp4'`. If creating fresh, store videos as `resource_type = 'video'` and filter consistently by `resource_type`.

3. **`cms_process.id` not primary key**: Original has unique index but not PK — Eloquent expects `id` as PK. Ensure new migrations use `$table->id()` which creates proper auto-increment PK.

4. **No ordering on index**: `Process::all()` returns unordered. Use `{Entity}::orderBy('title')->get()` or `paginate()`.

5. **`slug` column unused**: Don't add if not using — dead schema weight.
