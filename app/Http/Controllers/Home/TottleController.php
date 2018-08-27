<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Tottle;

class TottleController extends Controller
{
    /**
     * TODO 碎碎念的一些话
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('tottle.tottle');
    }
}
