<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
class PostController extends Controller
{
   use ApiResponse;

    public function index(){
    $posts= PostResource::collection(Post::get());

    return $this->ApiResponse($posts,"ok",200);
    }
    
    public function show($id){
       $post = (Post::find($id));
       if($post){
        return $this->ApiResponse (new PostResource($post),"ok",200);
       }
       return $this->ApiResponse(null,'this post not found ',401);
    }
    
    public function store(Request $request){
     $post = Post::create($request->all());
     if($post){
        return $this->ApiResponse (new PostResource($post),"post saved successfully",201);}
     return $this->ApiResponse(null,'post not save',400);
    }
    
    public function update(Request $request, $id){
    $post = Post::find($id);
    if(!$post){
      return $this->ApiResponse(null, 'post not found' , 404);
    }
    $post->update($request->all());
    if($post){
        return $this->ApiResponse (new PostResource($post),"post edited successfully",201);}
   return $this->ApiResponse(null,'post not edit',400);
    }
    
    public function destroy($id){
    $post = Post::find($id);
    if(!$post){
      return $this->ApiResponse(null ,"post not found",404);}
    $post->delete($id);
    return $this->ApiResponse(null,'post deleted successfully',200);
    }
}
