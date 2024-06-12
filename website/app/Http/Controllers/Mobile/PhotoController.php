<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $photo = new Photo();
        $photo->transaction_id = $request->transaction_id;
        $photo->photo_path = $request->path; // Path seharusnya diisi dengan path foto
        $photo->save();
    
        return response()->json(['photo_id' => $photo->id], 201);
    }
    
}

