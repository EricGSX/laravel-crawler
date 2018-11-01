<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $notices = $user->notices;
        return view('notice.index',compact('notices'));
    }
}
