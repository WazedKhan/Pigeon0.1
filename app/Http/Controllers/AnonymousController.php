<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anonymous;
use App\Models\Post;
use App\Models\User;

class AnonymousController extends Controller
{
    public function index()
    {
        //$data = Anonymous::all();
        $data = Anonymous::all();
        return view('anonymous.index',compact('data'));
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

    public function search(Request $request)
    {
        $user = User::where('name', '=', $request->input('search'))
            ->orderBy('updated_at', 'desc')
            ->get();
        
        dd($user);
        // Return the search view with the resluts compacted
        return view('search', compact('user'));
    }
}
