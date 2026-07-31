<?php

namespace App\Http\Controllers;

use App\Models\NotificationDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $notifications = NotificationDocument::where('person',Auth::user()->name)->orderBy('id', 'desc')->paginate(15);
        return view('dashboard',compact('notifications'));
       
    }
}
