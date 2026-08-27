<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CriscPostAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CriscAttachmentController extends Controller
{
    public function destroy(CriscPostAttachment $attachment): RedirectResponse
    {
        $criscPostId = $attachment->crisc_post_id;

        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return redirect()->route('admin.crisc.edit', $criscPostId)
            ->with('success', 'Attachment deleted.');
    }
}
