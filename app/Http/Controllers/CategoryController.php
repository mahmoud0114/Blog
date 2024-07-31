<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
   
    public function index()
    {
      $categories = Category::get();
       return view('category.index', compact('categories'));
    }

    public function create()
    {
      return view('category.create');
    }


    public function store(Request $request)
    {
      $request->validate([
        'name'=>'required'
        ]);
      $slug = Str::slug($request->name, '-');
      Category::create([
        'name'=>$request->name,
        'slug'=>$slug,
        ]);
      if(empty($request->input('name'))){
        return redirect()->back()->withErrors(['error'=>'Category Name Is Required']);
      }
        return to_route('category.index')->with('success', 'Data Added Successfully');
    }


    public function show(string $slug)
    {
       $category = Category::where('slug',$slug)->first();
       $post = Post::where('category_id',$category->id)->get();
      return view('category.show',[
         'category'=>$category,
         'posts'=>$post
      ]);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
      $upd = Category::findOrFail($id);
      $slug = Str::slug($request->name, '-');
      $upd->update([
        'name'=>$request->name,
        'slug'=>$slug,
        ]);
       return back()->with('success', 'Data Updated Successfully');
    }


    public function destroy(string $id)
    {
      Category::findOrFail($id)->delete();
      return back()->with('success', 'Data Deleted Successfully');
    }
}
