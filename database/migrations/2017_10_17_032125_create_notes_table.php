<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->integer('parentid')->comment('笔记所属分类');
            $table->string('title')->comment('笔记标题');
            $table->text('content')->comment('笔记内容');
            $table->char('review',2)->default('0')->comment('1-审核通过,0-待审核，-1审核未通过');
            $table->string('source')->nullable()->comment('笔记来源或者来源链接');
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
        Schema::dropIfExists('notes');
    }
}
