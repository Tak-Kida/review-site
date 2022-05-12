<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id(); // id
            $table->string('name'); // 出版社名
            $table->string('name_furigana'); // 出版社名ふりがな
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
        Schema::dropIfExists('publishers');
    }
}
