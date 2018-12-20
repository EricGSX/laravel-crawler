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
    public function autoReply($data=[])
    {
        try{
            $message = $data['msg'];
            $to = $data['to'];
            $subject = '自动回复';
            $result = Mail::send(
                'emails.test',
                ['content' => $message],
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );
            if($result){
                return true;
            }else{
                return false;
            }
        }catch (\Throwable $e){
            return false;
        }
    }
}
