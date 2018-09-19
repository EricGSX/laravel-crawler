<?php

namespace App;

use App\Model;

class Topic extends Model
{
    /**
     * TODO 属于这个专题的所有文章
     */
    public function posts()
    {
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }

    /**
     * TODO 专题文章数用于withcount
     * 专题下有多少文章
     */
    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }
}
