<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoAnswer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VideoAnswerController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info('🎥 Video upload request received', [
                'ip' => $request->ip(),
                'inputs' => $request->except(['q1','q2','q3','q4','q5']) // don’t log big files
            ]);

            // Validate (ensure videos are present)
            $request->validate([
                'q1' => 'required|file|mimetypes:video/webm,video/mp4|max:51200', // 50MB max
                'q2' => 'required|file|mimetypes:video/webm,video/mp4|max:51200',
                'q3' => 'required|file|mimetypes:video/webm,video/mp4|max:51200',
                'q4' => 'required|file|mimetypes:video/webm,video/mp4|max:51200',
                'q5' => 'required|file|mimetypes:video/webm,video/mp4|max:51200',
            ]);
            Log::info('✅ Validation passed for video upload');

            // Store files in storage/app/public/videos
            $paths = [];
            foreach (['q1','q2','q3','q4','q5'] as $q) {
                if ($request->hasFile($q)) {
                    $paths[$q] = $request->file($q)->store('videos', 'public');
                    Log::info("📂 Stored video file", [
                        'question' => $q,
                        'path' => $paths[$q]
                    ]);
                }
            }

            // Save into DB
            $answer = VideoAnswer::create([
                'name' => $request->input('name'),
                'q1' => $paths['q1'] ?? null,
                'q2' => $paths['q2'] ?? null,
                'q3' => $paths['q3'] ?? null,
                'q4' => $paths['q4'] ?? null,
                'q5' => $paths['q5'] ?? null,
            ]);

            Log::info('💾 Video answers saved into DB', [
                'id' => $answer->id,
                'name' => $answer->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Video answers saved successfully!',
                'data' => $answer
            ]);

        } catch (\Exception $e) {
            Log::error('❌ Error while saving video answers', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save video answers. Please try again later.'
            ], 500);
        }
    }
}
