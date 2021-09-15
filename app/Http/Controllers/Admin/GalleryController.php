<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RemoveGalleryImageRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function removeGalleryImage(RemoveGalleryImageRequest $request)
    {
        $galleryImage = Gallery::find($request->galleryId);

        if (!$galleryImage) {
            return response()->json([
                'message' => 'Gallery image not found'
            ], 404);
        }

        $tourId = $galleryImage->tour_id;
        $image  = $galleryImage->image;

        $galleryImage->delete();

        Storage::disk('public')->delete("uploads/gallery/{$tourId}/{$image}");

        return response()->json(['message' => 'Gallery image deleted']);
    }
}
