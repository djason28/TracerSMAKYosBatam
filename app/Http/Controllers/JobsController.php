<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JobsController extends Controller
{
    public function status($jobId)
    {
        $cacheKey = "import-status:{$jobId}";
        $data = Cache::get($cacheKey);

        // Jika belum ada entry di cache, kembalikan still pending
        if (! $data) {
            return response()->json([
                'status'     => 'pending',
                'duplicates' => [],
                'imported'   => [],
            ]);
        }

        // Pastikan semua key ada: status, duplicates, imported
        return response()->json([
            'status'     => $data['status']     ?? 'pending',
            'duplicates' => $data['duplicates'] ?? [],
            'imported'   => $data['imported']   ?? [],
        ]);
    }
}
