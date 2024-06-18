<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PhotoController extends Controller
{
    public function getPhotoId($transaction_id)
    {
        $photoIds = Photo::where('transaction_id', $transaction_id)->pluck('photoid');
        return response()->json(['photoids' => $photoIds]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/photos', $filename); // Menyimpan file ke 'storage/app/public/photos'

            $photo = new Photo();
            $photo->transaction_id = $request->transaction_id;
            $photo->photo_path = $filename; // Simpan hanya nama file
            $photo->save();

            return response()->json(['photoid' => $photo->id], 201);
        }

        return response()->json(['message' => 'Photo not provided'], 400);
    }
}

