<?php

namespace App;

use Illuminate\Support\Facades\Storage;

trait DocDownloadTrait
{
    public function download($filePath)
    {
        // Check if the file exists in the storage path
        if ($filePath && Storage::exists('public/' . $filePath)) {
            // Return the file as a download response
            return response()->download(storage_path('app/public/' . $filePath));
        }
        // return redirect()->to(request()->header('Referer'));
    }
}
