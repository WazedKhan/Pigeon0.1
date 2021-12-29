<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ExtraFeature extends Controller
{
    public function search(Request $request)
    {
        $data = $request->search;
        $user = User::where('name', 'LIKE', '%'.$request->input('search').'%')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('search.search_res', compact('user'));
        return view('layout.nevbar', compact('data'));
    }
}
