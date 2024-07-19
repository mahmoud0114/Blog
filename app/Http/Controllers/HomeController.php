<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller


{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    

    public function uploadPhoto(Request $request)
        {
    $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('image')) {
        $path = uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('users'),$path);
     Auth()->user()->update(['image'=>$path]);
     }
    return redirect()->back()->with('success', 'Photo uploaded successfully!');
    }
}
