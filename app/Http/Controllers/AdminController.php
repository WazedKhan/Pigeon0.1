<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('admin.user.user', compact('data'));
    }
}
