<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PmpPostAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PmpAttachmentController extends Controller
{
    public function destroy(PmpPostAttachment $attachment): RedirectResponse
    {
        $pmpPostId = $attachment->pmp_post_id;

        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return redirect()->route('admin.pmp.edit', $pmpPostId)
            ->with('success', 'Attachment deleted.');
    }
}
