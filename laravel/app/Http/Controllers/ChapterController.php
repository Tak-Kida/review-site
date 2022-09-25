<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;

class ChapterController extends Controller
{
    // 一覧をJSONで取得する
    public function getIndex(Request $request)
    {
        $chapters = Chapter::where('deleted_flg', '0')
                        ->where('book_id', $request->id)
                        ->get();
        return $chapters->toJson();
    }

    // 新しく登録された順に3件の要約をJSONで取得する
    public function getLatest()
    {
        $chapters = Chapter::where('deleted_flg', '0')
                        ->with('book')
                        ->orderBy('id', 'desc')
                        ->take(3)
                        ->get();
        return $chapters->toJson();
    }

    // 新規登録を行う
    public function create(Request $request)
    {
        $this->validate($request, Chapter::$rules);
        $chapter = new Chapter;
        $form = $request->all();
        unset($form['_token']);
        $chapter->fill([
            'book_id' => $form['book_id'],
            'title' => $form['new_chapter_title'],
            'summary' => $form['new_chapter_summary'],
        ])->save();
        return redirect('/book/edit/' . $request->book_id);
    }

    // 更新を行う
    public function update(Request $request)
    {
        $this->validate($request, Chapter::$rules);
        $chapter = Chapter::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        $chapter->fill([
            'title' => $form['chapter_title'],
            'summary' => $form['chapter_summary'],
        ])->save();
        return redirect('/book/detail/' . $chapter->book_id );
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $chapter = Chapter::where('id', $request->id)->first();
        $chapter->deleted_flg= 1;
        $chapter->deleted_at = date("Y-m-d H:i:s");
        $chapter->save();
        return redirect('/book/detail/' . $chapter->book_id );
    }
}
