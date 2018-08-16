<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   protected $fillable = [
       'name','email','password'
   ];

    /**
     * TODO 用户的文章列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   public function posts()
   {
       return $this->hasMany(\App\Post::class,'user_id','id');
   }

    /**
     * TODO 关乎我的Fan模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   public function fans()
   {
       return $this->hasMany(\App\Fan::class,'star_id','id');
   }

    /**
     * TODO 我关注的Fan模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   public function stars()
   {
       return $this->hasMany(\App\Fan::class,'fan_id','id');
   }

    /**
     * TODO 关注某人
     *
     * @param $uid
     * @return false|\Illuminate\Database\Eloquent\Model
     */
   public function doFan($uid)
   {
       $fan = new \App\Fan();
       $fan->star_id = $uid;
       return $this->stars()->save($fan);
   }

    /**
     * TODO 取消关注
     *
     * @param $uid
     * @return mixed
     */
   public function doUnfan($uid)
   {
       $fan = new \App\Fan();
       $fan->star_id = $uid;
       return $this->stars()->delete($fan);
   }

    /**
     * TODO 当前用户是否被uid关注了
     *
     * @param $uid
     * @return int
     */
   public function hasFan($uid)
   {
       return $this->fans()->where('fan_id',$uid)->count();
   }

    /**
     * TODO 当前用户是否关注了uid
     *
     * @param $uid
     * @return int
     */
   public function hasStar($uid)
   {
       return $this->stars()->where('star_id',$uid)->count();
   }
}
