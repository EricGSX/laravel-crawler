<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->default('');
            $table->string('description',200)->comment('摘要');
            $table->text('content');
            $table->tinyInteger('encoding_type')->default(1)->comment('1:富文本，2:markdown');
            $table->integer('view_count')->default(0)->comment('浏览数');
            $table->integer('user_id')->default(0);
            $table->tinyInteger('mark_status')->default(0)->comment('标记的状态，0默认-1软删除1标记');
            $table->timestamps();
            $table->softDeletes();
            $table->index('title');
            $table->index('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
