<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id(); // id
            $table->string('name'); // 著者名
            $table->string('name_furigana'); // 著者名ふりがな
            $table->timestamps(); //登録、更新日時
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
        Schema::dropIfExists('authors');
    }
}
