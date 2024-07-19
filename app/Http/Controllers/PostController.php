<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{
  
  
    public function index()
    {
      $allcategories= Category::all();
      $allposts = Post::paginate(5);
      $tags = Tag::get();
      return view('post.index',[
      'posts'=>$allposts,
      'category'=>$allcategories,
      'tags'=>$tags,
      ]);
    }

   
    public function create()
    {
      Gate::authorize('create-post');
       $categories = Category::all();
       $tags = Tag::select('id', 'name')->get();
       return view('post.create',['category'=>$categories, 'tags'=>$tags]);
    }


    public function store(Request $request)
    {
      $request->validate ([
      'title' => 'required',
      'description' => 'required',
      'photo' => 'required|mimes:jpg,png,jpeg'
       ]);
       
       $slug=Str::slug($request->title,'-');
       $newImage=time() . '-' . $slug . '.' . $request->photo->extension();
       $request->photo->move(public_path ('images'), $newImage);
       
      $post = new Post();
      $post->title=$request->title;
       $post->image_path=$newImage;
       $post->slug=$slug;
       $post->description=$request->description;
       $post->user_id=auth()->user()->id;
       $post->category_id=$request->cat;
       $post->save();
       $post->tags()->sync($request->tags);

        
      return to_route('post.index');
    }


    public function show(string $slug)
    {
       $allposts = Post::all();
       $post = Post::where('slug',$slug)->first();
       $comment= Comment::where('post_id',$post->id)->get();
       $tags_id = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id');
       $tags = Tag::whereIn('id', $tags_id)->get();
       return view('post.show',[
       'post'=>$post,
       'comments'=>$comment,
       'posts'=>$allposts,
       'tags'=>$tags,
       ]);
    }


    public function edit(string $slug)
    {
      Gate::authorize('update-post');
        $findPost =Post::where('slug',$slug)->first();
        return view('post.edit',['post'=>$findPost]);
    }


    public function update(Request $request, string $slug)
    {
       $update= Post::where('slug',$slug)->first();
       $update->title= $request->title;
       $update->description= $request->description;
       if($request->hasFile('photo')){
         $newImage=time() . '-' . $slug . '.' . $request->photo->extension();
       $request->photo->move(public_path ('images'), $newImage);
         $update->image_path = $newImage;
       }
       $update->save();
       return to_route('post.show',$slug)->with('message','updated successfully');
    }


    public function destroy(string $post)
    {
       $toDelete = Post::findOrFail($post);
       $toDelete->delete();
       return to_route('post.index');
    }


   public function search(Request $request)
    {
      $search = $request->input('search');
      $result = Post::where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->get();

      return view('post.search', ['results' => $result]);
    }
    
    
     public function author($id)
    {
     $users = User::findOrFail($id);
     $posts = Post::where('user_id',$id)->get();
     return view ('post.author',[
     'user'=>$users,
     'post'=>$posts,
     ]);
   }
}
