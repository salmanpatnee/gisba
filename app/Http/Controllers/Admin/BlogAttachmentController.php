<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPostAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BlogAttachmentController extends Controller
{
    public function destroy(BlogPostAttachment $attachment): RedirectResponse
    {
        $blogPostId = $attachment->blog_post_id;

        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return redirect()->route('admin.blog.edit', $blogPostId)
            ->with('success', 'Attachment deleted.');
    }
}
