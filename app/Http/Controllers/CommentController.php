<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
    
    }


    public function store(Request $request)
    {
       $newComment = Comment::create([
        'comment' => $request->comment,
        'user_id' => auth()->user()->id,
        'post_id' => $request->id,
         ]);

       return to_route('post.show',$request->slug);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
      $todelete=Comment::findOrFail($id);
      $todelete->delete();
      return redirect()->back();
    }
}
