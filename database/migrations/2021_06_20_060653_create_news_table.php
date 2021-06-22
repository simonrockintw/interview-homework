<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255)->comment('標題')->nullable(false);
            $table->longText('content')->comment('內容')->nullable(false);
            $table->string('author_name', 255)->comment('作者名稱')->nullable(false);

            //----------------------------排序與顯示---------------------------
            $table->boolean('display')->comment('0:下架； 1：上架')->default(true);

            //----------------------------時間與軟刪---------------------------
            $table->timestamps();
            $table->timestamp('published_at')->comment('發佈時間')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
        });
        Schema::dropIfExists('news');
    }
}
