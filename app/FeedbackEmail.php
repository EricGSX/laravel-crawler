<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\Mail;

class FeedbackEmail extends Model
{
    /**
     * TODO 自动回复信息
     *
     * @param array $data
     * @return bool
     */
    public static function autoReply($data=[])
    {
        try{
            $message = $data['user'];
            $to = $data['to'];
            $subject = '自动回复';
            Mail::send(
                'emails.notice',
                ['user' => $message],
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );
            if(empty(Mail::failures())){
                return true;
            }else{
                return false;
            }
        }catch (\Throwable $e){
            return false;
        }
    }
}
