<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ExtraFeature extends Controller
{
    public function search(Request $request)
    {
        $user = User::where('name', 'LIKE', '%'.$request->input('search').'%')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('search.search_res', compact('user'));
    }

    public function suggest()
    {
        $hello = ' world';
        $command = escapeshellcmd('python '.getcwd().'/python/main.py '.$hello);
        $output = shell_exec($command);
        dd($output);
        dd('python '.getcwd().'/python/main.py'.$hello);
        $people = User::paginate(5);
        return view('profiles.find_firend', compact('people'));
    }

    public function sidebar()
    {
        $user = User::all();
        return view('layout.sidebar', compact('user'));
    }
}
