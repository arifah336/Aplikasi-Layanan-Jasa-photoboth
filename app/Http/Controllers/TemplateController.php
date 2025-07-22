<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('custome_layout', compact('templates'));
    }

    public function store(Request $request)
{
    $request->validate([
        'layout_name' => 'required|string',
        'type' => 'required|in:frame,sticker,shape',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
    ]);

    $data = $request->only(['layout_name', 'type']);

    if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('templates', 'public');
    }

    $data['is_active'] = 1;

    Template::create($data);

    return back()->with('success', 'Template berhasil ditambahkan.');
}


    public function userLayouts()
    {
        $frames = Template::where('type', 'frame')->where('is_active', 1)->get();
        return view('layout', compact('frames'));
    }

    public function edit($id)
    {
        $template = \App\Models\Template::findOrFail($id);
        return view('edit_template', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'layout_name' => 'required',
            'type' => 'required|in:frame,sticker,shape',
        ]);

        $template = \App\Models\Template::findOrFail($id);
        $template->update($request->only(['layout_name', 'type']));

        return redirect()->route('admin.custom_layout')->with('success', 'Template berhasil diupdate.');
    }

    public function destroy($id)
    {
        \App\Models\Template::destroy($id);
        return back()->with('success', 'Template berhasil dihapus.');
    }

}
