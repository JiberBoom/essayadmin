<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_cates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('分类名称');
            $table->integer('parentid')->default(0);
            $table->string('path')->comment('分类的层级关系，从最高级到自己')->nullable();
            $table->integer('depth')->default(1)->comment('深度');
            $table->char('status',2)->default('1')->comment('1-正常，0-禁用');
            $table->string('priority')->default('0')->comment('排序的优先级');
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
        Schema::dropIfExists('note_cates');
    }
}
