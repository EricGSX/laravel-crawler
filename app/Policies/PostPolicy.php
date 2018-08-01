<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 判断指定博客能否被用户更新
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user,Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * 判断指定博客能否被用户删除
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user,Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * 判断指定用户是否可以创建博客
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id;
    }
}
