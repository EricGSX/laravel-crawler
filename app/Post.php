<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //TODO 定义表 默认posts表
//    protected $table = "table_name";

//    protected $guarded = [];//不可注入字段
//    protected $fillable = ['title','content'];//可注入字段

    /**
     * TODO 文章关联用户
     * withdefault是跟随belongsto使用的其他的不能使用
     *
     * @return $this
     */
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

    /**
     * TODO 属于某个作者的文章
     *
     * @param Builder $query
     * @param $user_id
     * @return mixed
     */
    public function scopeAuthorBy(Builder $query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }

    /**
     * TODO 文章对应的topic
     * 文章下有多少专题
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }

    /**
     * 文章下的所有专题
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(\App\Topic::class,'post_topics','post_id','topic_id');
    }

    /**
     * TODO 不属于某个专题的文章
     *
     * @param Builder $query
     * @param $topic_id
     * @return mixed
     */
    public function scopeTopicNotBy(Builder $query,$topic_id)
    {
        return $query->doesntHave('postTopics','and',function($q) use($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }


    /**
     * TODO 定义全局Scope用于过滤软删除的数据
     * 后期采用了软删除模型 没有适用全局Scope
     * @return [type] [description]
     */
    //public static function boot()
    //{
    //    parent::boot();
    //    static::addGlobalScope('myPost',function(Builder $builder){
    //        $builder->where('mark_status','<>',-1);
    //    });
    //}

}
