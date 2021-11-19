<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anonymous;

class AnonymousController extends Controller
{
    public function index()
    {
        //$data = Anonymous::all();
        $data = Anonymous::all();
        return view('anonymous.index',[
            'data'=>$data
        ]);
    }
    public function create()
    {
        return view('anonymous.create');
    }
    public function store(Request $data)
    {
        //dd($data->all());
        Anonymous::create([
            'title'=>$data->title,
            'details'=>$data->details
        ]);
        return redirect()->route('anonymous.index');
    }
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('body', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search', compact('posts'));
    }
}
