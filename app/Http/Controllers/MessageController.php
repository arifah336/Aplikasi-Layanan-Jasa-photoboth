<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function form()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Message::create($request->only(['name', 'email', 'message']));

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }
}
