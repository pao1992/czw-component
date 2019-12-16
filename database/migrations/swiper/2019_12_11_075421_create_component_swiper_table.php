<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentSwiperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_swiper', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 190)->comment('标题');
            $table->string('img_url', 190)->comment('图片地址');
            $table->integer('target_id')->comment('跳转目标id');
            $table->tinyInteger('sort')->comment('排序');
            $table->tinyInteger('type')->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_swiper');
    }
}
