<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index(){
        // dd(request('search'));
        $posts=Post::when(request('search'),function($p){
            $search=request('search');
            $p->orWhere('title','like','%'.$search.'%')
              ->orWhere('description','like','%'.$search.'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(3);
        // $posts=Post::where('title','like','%u%')->get();
        // $posts=Post::get()->map(function($d){
        //      $d->title=strtoupper($d->title);
        //      $d->description=strtoupper($d->description);
        //      return $d;
        // });
        //map==each=>contain data /not contain paganate
        //through=>contain data and paganate
        // dd($posts);


        // $post=Post::find(2);
        // $posts=Post::all();
        // $posts=Post::orderBy('created_at','desc')->get();
        // dd($post);
        return view('create',compact('posts'));
    }
    public function create(Request $request){
        // dd(request('title'));
        $validate=$request->validate([
            'title'=>'required |unique:posts,title',
            'desc'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg',
        ]);

        $data=[
         "title"=>$request->title,
         "description"=>$request->desc,
        ];
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=uniqid().$file->getClientOriginalName();
            $file->storeAs('images',$fileName,'public');
            $data['image']=$fileName;
        }
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
            'image'=>'required| mimes:jpg,png,jpeg'
        ]);
        if($request->hasFile('image')){
            $oldPhoto=$post->image;
            // dd($oldPhoto != null);
            if($oldPhoto != null ){
                Storage::disk('public')->delete('images/' . $oldPhoto);
            }
            $file=$request->file('image');
            $fileName=uniqid().$file->getClientOriginalName();
            $file->storeAs('images',$fileName,'public');
            $data=[
                "title"=>$request->title,
                "description"=>$request->desc,
                "image"=>$fileName,
            ];
            $post->update($data);
        }

        return back()->with('success','data update successfully');
    }
}
