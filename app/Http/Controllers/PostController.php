<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts=Post::paginate(3);
        // $posts=Post::all();
        // $posts=Post::orderBy('created_at','desc')->get();
        return view('create',compact('posts'));
    }
    public function create(Request $request){
        $validate=$request->validate([
            'title'=>'required |unique:posts,title',
            'desc'=>'required',
        ]);
        $data=[
         "title"=>$request->title,
         "description"=>$request->desc,
        ];
        Post::create($data);
        return back()->with('success','create data successfully');
    }

    public function delete($id){
        Post::find($id)->delete();
        return back()->with('success','deleted successfully');
    }
    public function edit($id){
        $post=Post::find($id);
        return view('edit',compact('post'));
    }

    public function update(Request $request, $id){
        $post=Post::find($id);
        $validate=$request->validate([
            'title'=>'required |min:1|unique:posts,title,'.$id,
            'desc'=>'required | min:1',
        ]);
        $data=[
            "title"=>$request->title,
            "description"=>$request->desc,
        ];
        $post->update($data);
        return back()->with('success','data update successfully');
    }
}
