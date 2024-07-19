<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
class TagController extends Controller
{
  
  
    public function index()
    {
       $tags = Tag::paginate();
       return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $data = $request->validate([
          'name'=>'required|string'
          ]);
        if(empty($request->input('name'))){
          return redirect()->back()->witErrors(['error'=>'Tag Name Feild Is Required']);
        }
        
          Tag::create($data);
          return to_route('tags.index')->with('success','Tag Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::findOrFail($id);
        $posts_id = DB::table('post_tag')->where('tag_id', $id)->pluck('post_id');
        $posts = Post::whereIn('id', $posts_id)->get();
        return view('tag.show', compact('posts', 'tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $request->validate([
        'name'=>'required|string'
        ]);
        $tag = Tag::findOrFail($id);
        $tag->update([
          'name'=>$request->name
          ]);
      return back()->with('success','Tag edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::findOrFail($id)->delete();
        return back()->with('success','Tag Deleted Successfully');
    }
}
