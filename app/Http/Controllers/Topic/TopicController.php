<?php

namespace App\Http\Controllers\Topic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        return view('topic.show');
    }

    public function submit(Topic $topic)
    {
        return ;
    }
}
