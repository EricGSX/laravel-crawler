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
        return $this->belongsTo('\App\User','user_id','id')->withDefault(['name'=>'游客']);
    }

    /**
     * TODO 一对多评论模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('\App\Comment','post_id','id')->orderBy('created_at','desc');
    }

    /**
     * TODO 和用户进行关联
     *
     * @param $user_id
     * @return $this
     */
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    /**
     * TODO 文章的所有赞
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }
}
