<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 下記を追記する
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
// 上記までを追記する

class ImageController extends Controller
{
    // 下記を追記する
    public function input()
    {
        return view('images/input');
    }

    public function upload(Request $request)
    {

        $this->validate($request, [
            'file' => [
                // 空でないこと
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
        
            $file_name = $request->file('file')->getClientOriginalName(); // オリジナルファイルのファイル名の取得
            $file_path = Storage::putFile('/images', $request->file('file'), 'public'); // ファイルのアップロードとアップロードパスの取得

            $image_info = new Image();
            $image_info->file_path = $file_path;
            $image_info->file_name = $file_name;
            $image_info->save();

            return redirect('/');
        }else{
            return redirect(route('input'));
        }

    }
    // 上記までを追記する
}
