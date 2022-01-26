<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {

        $notice = Auth::user()->notifications;
        Auth::user()->notifications->markAsRead();
        return view('auth.notification',compact('notice'));
    }
}
