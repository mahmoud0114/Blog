<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

     
     
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }



    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update([
          'type'=>$request->type,
          ]);
        return back()->with('success', 'Permission Edited successfully');
    }


}
