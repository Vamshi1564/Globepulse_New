<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocDownloadController extends Controller
{
    public function download($file)
    {
        $url = base64_decode($file);

        // Fetch file
        $content = @file_get_contents($url);
        if ($content === false) {
            abort(404, 'File not found.');
        }

        return response($content)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . basename($url) . '"');
    }
}
