<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->bigInteger('assignee_id')->unsigned()->nullable();

            $table->foreign('assignee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // カラムを削除するときは外部キー制約を解除してから（←学習のため）
            $table->dropForeign('tasks_assignee_id_foreign');
            $table->dropColumn('assignee_id');
        });
    }
};
