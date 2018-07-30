<?php

namespace App;

use App\Model;

class Post extends Model
{
    //TODO 定义表 默认posts表
//    protected $table = "table_name";

//    protected $guarded = [];//不可注入字段
//    protected $fillable = ['title','content'];//可注入字段
    //TODO 文章关联用户
    public function user()
    {
        return $this->belongsTo('\App\User','user_id','id');
    }
}
