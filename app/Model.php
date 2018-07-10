<?php
/**
 * User: Administrator
 * Date: 2018/7/10/010
 * Time: 22:29
 */
namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];//不可以被注入的字段
}