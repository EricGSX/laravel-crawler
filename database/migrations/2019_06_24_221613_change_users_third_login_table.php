<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersThirdLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_img',200)->nullable()->after('remember_token');
            $table->integer('platform_uid')->nullable()->after('remember_token');
            $table->string('platform_type',100)->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_img');
            $table->dropColumn('platform_uid');
            $table->dropColumn('platform_type');
        });
    }
}
