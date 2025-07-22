<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Photo;
use App\Models\Custom;

class CustomController extends Controller
{
    public function form()
    {
        $frames = Template::where('type', 'frame')->get();
        $stickers = Template::where('type', 'sticker')->get();
        $shapes = Template::where('type', 'shape')->get();
        return view('custom', compact('frames', 'stickers', 'shapes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'sticker_used' => 'nullable',
            'shape_used' => 'nullable',
            'color_frame' => 'nullable',
        ]);

        Custom::create($request->all());

        return redirect()->route('user.preview', ['photo' => $request->photo_id]);
    }

    public function preview($photo_id)
    {
        $photo = Photo::findOrFail($photo_id);
        return view('preview', compact('photo'));
    }

    public function customPage()
    {
        $frames = Template::where('type', 'frame')->whereNotNull('image_path')->get();
        $stickers = Template::where('type', 'sticker')->get();
        $shapes = Template::where('type', 'shape')->get();

        return view('custom', compact('frames', 'stickers', 'shapes'));
    }
}
