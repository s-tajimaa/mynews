<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use App\Profilehistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // データベースに保存する
        $profile->fill($form);
        $profile->save();

          return redirect('admin/profile/create');
    }

   public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['news_form' => $profile]);
  }

   
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();

     
      // 該当するデータを上書きして保存する
      $profile->fill($news_form)->save();
      
      $history = new Profilehistory();
      $history->profile_id = $profile->id;
      $history->edited_at = Carbon::now();
      $history->save();


      return redirect('admin/profile/create');
  }
}
