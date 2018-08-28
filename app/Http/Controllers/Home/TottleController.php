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

    /**
     * TODO 展示添加页面
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function create()
    {
        return view('tottle.create');
    }

    /**
     * TODO 保存一些碎碎叨叨的话
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|string|min:2',
            'content' => 'required|string|min:3',
        ]);
        $params =request(['title','content']);
        $post = Tottle::create($params);
        return redirect("/tottles/show");
    }
}
