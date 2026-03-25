<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::query()->latest()->get();

        return view('pages.videos', compact('videos'));
    }

    public function recordView(Video $video): JsonResponse
    {
        $video->increment('views');

        return response()->json(['views' => $video->views]);
    }

    public function stream(Video $video): StreamedResponse|Response
    {
        $disk = Storage::disk('public');

        abort_unless($disk->exists($video->path), 404);

        $size = $disk->size($video->path);
        $start = 0;
        $end = $size - 1;
        $status = 200;
        $headers = [
            'Content-Type' => $video->mime_type,
            'Content-Disposition' => 'inline',
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'public, max-age=3600',
        ];

        if (request()->hasHeader('Range')) {
            preg_match('/bytes=(\d+)-(\d*)/', request()->header('Range'), $matches);
            $start = (int) $matches[1];
            $end = isset($matches[2]) && $matches[2] !== '' ? (int) $matches[2] : $size - 1;
            $status = 206;
            $headers['Content-Range'] = "bytes {$start}-{$end}/{$size}";
        }

        $headers['Content-Length'] = $end - $start + 1;

        $filePath = $disk->path($video->path);

        return response()->stream(function () use ($filePath, $start, $end) {
            $fp = fopen($filePath, 'rb');
            fseek($fp, $start);
            $remaining = $end - $start + 1;
            $chunkSize = 8192;

            while ($remaining > 0 && ! feof($fp)) {
                $read = min($chunkSize, $remaining);
                echo fread($fp, $read);
                $remaining -= $read;
                flush();
            }

            fclose($fp);
        }, $status, $headers);
    }
}
