<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id'); // 書籍ID
            $table->string('title'); // チャプタータイトル名
            $table->text('summary'); // チャプターの要約
            $table->timestamps();
            $table->boolean('deleted_flg')->default(0);  // 削除フラグ
            $table->dateTime('deleted_at')->nullable();  // 削除日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
