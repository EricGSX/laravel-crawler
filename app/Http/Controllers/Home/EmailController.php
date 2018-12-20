<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\FeedbackEmail;

class EmailController extends Controller
{
    /**
     * TODO 保存用户的邮件反馈
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function feedback(Request $request)
    {
        //$id = \Auth::id();   //可用于验证用户是否登陆
        $this->validate(request(),[
            'email_user' => 'required|string|min:2',
            'email_address' => 'required|string|email|min:3',
            'email_commits' => 'required|string|min:3',
        ]);
        $params =[
            'ip' => $request->ip(),
            'ua' => $request->header('user-agent'),
            'username' => $request->email_user,
            'email' => $request->email_address,
            'commits' => $request->email_commits
        ];
        FeedbackEmail::create($params);
        $mail = [
            'user' => $request->email_user,
            'to' => $request->email_address,
        ];
        FeedbackEmail::autoReply($mail);
        return redirect("/");
    }
}
