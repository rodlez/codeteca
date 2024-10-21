<?php

namespace App\Services;

// Models

use App\Models\CodeEntry;
use App\Models\CodeFile;

// Request
use Illuminate\Http\Request;
// Files
use Illuminate\Support\Facades\Storage;
use File;
// Collection
use Illuminate\Database\Eloquent\Collection;

class CodeFileService
{
    /**
     * Upload a file and return an array with the info to make the insertion in the DB table Images
     */

    public function uploadFile(mixed $request, CodeEntry $entry, string $disk, string $storagePath): array
    {
        // Info to store in the DB
        $original_filename = $request->getClientOriginalName();
        $media_type = $request->getMimeType();
        $size = $request->getSize();
        // Storage in filesystem file config, specify the storagePath
        $path = Storage::disk($disk)->putFile($storagePath, $request);
        $storage_filename = basename($path);

        return [
            'code_id' => $entry->id,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            'path' => $path,
            'media_type' => $media_type,
            'size' => $size,
        ];
    }

    /**
     * Download a file, disposition inline(browser) or attachment(download)
     */

    public function downloadFile(CodeFile $file, string $disposition)
    {
        // No need to specify the disposition to download the file.

        $dispositionHeader = [
            'Content-Disposition' => $disposition,
        ];

        if (Storage::disk('public')->exists($file->path)) {
            //return Storage::disk('public')->download($file->path, $file->original_filename, $dispositionHeader);
            return Storage::disk('public')->download($file->path, $file->original_filename);
        } else {
            return back()->with('message', 'Error: File ' . $file->original_filename . ' can not be downloaded.');
        }
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag
     */
    public function deleteFiles(Collection $files)
    {
        foreach ($files as $file) {
            $this->deleteOneFile($file);
        }
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag
     */
    public function deleteOneFile(CodeFile $file)
    {
        if (Storage::disk('public')->exists($file->path)) {
            /*  echo $file->path;
             dd('borradito'); */
            Storage::disk('public')->delete($file->path);
            $file->delete();
        }
    }

    /**
     * Upload a file and return an array with the info to make the insertion in the DB table Images
     */

    /*  public function downloadImagePhpOnly(CodeFile $image)
    {
        $disposition = 'attachment';
        $path = public_path('storage/' . $image->storage_filename);

        // To download we will change the name of the storage filename to his original
        // by default the browser send HTML files, we need to change the header to tell the browser that we will send a file
        header("Content-Disposition: {$disposition};filename={$image->original_filename}");
        header("Content-Type: {$image->media_type}");

        readfile($path);
    } */

    /* public function uploadImagePhpOnly(Request $request, Note $note): array
    {

        $original_filename = $request->file('image')->getClientOriginalName();
        $randomFilename = bin2hex(random_bytes(16));
        $fileExtension = $request->file('image')->getClientOriginalExtension();
        $storage_filename = $randomFilename . "." . $fileExtension;
        $media_type = $request->file('image')->getMimeType();
        $size = $request->file('image')->getSize();
        $path = env('UPLOAD_FILES') . '/' . $storage_filename;

        // using move method to upload in a specific path
        $request->file('image')->move(public_path('upload'), $storage_filename);

        return [
            'note_id' =>  $note->id,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            'path' => $path,
            'media_type' => $media_type,
            'size' =>  $size
        ];
    } */

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag
     */
    /*  public function deleteOneImagePhpOnly(CodeFile $image)
    {
        $path = public_path($image->path);

        if (File::exists($path)) {
            File::delete($path);
            $image->delete();
        }
    } */
}
