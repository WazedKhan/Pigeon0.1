<?php

namespace App\Http\View\Composers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SidebarComposer
{
    public function compose(View $view)
    {
        $users = Follow::where('profile_id',Auth::user()->id)->get();
        $view->with('user_info',Follow::where('profile_id',Auth::user()->id)->get());
    }
}