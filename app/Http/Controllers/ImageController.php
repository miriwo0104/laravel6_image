<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
// 下記を追記
use ZipArchive;
use Illuminate\Support\Str;
// 上記までを追記

class ImageController extends Controller
{
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

    public function output()
    {
        $image_infos = Image::select('*')->get();
        return view('images.output', ['image_infos' => $image_infos]);
    }

    public function detail($image_id)
    {
        $image_info = Image::find($image_id);
        return view('images.detail', ['image_info' => $image_info]);
    }

    public function display($image_id)
    {
        $image_info = Image::find($image_id);
        return Storage::response($image_info['file_path'], $image_info['file_name']);
    }

    public function download(Request $request)
    {
        $image_info = Image::find($request['id']);
        return Storage::download($image_info['file_path'], $image_info['file_name']);
    }

    // 下記を追記
    public function zipDownload(Request $request)
    {
        $image_info = Image::find($request['id']);
        $zip_tmp_file_path = Storage::disk('local')->path('zip_tmp/');
        $zip_tmp_file_name = Str::random(40) . '.zip';
        $zip_tmp_file_full_path = $zip_tmp_file_path . $zip_tmp_file_name;

        $zip = new ZipArchive();
        $zip->open($zip_tmp_file_full_path, ZipArchive::CREATE);
        $zip->addFromString($image_info['file_name'], Storage::get($image_info['file_path']));
        $zip->close();

        ob_end_clean();

        $headers = ['Content-Type' => 'application/zip'];

        return response()->download($zip_tmp_file_full_path, 'image.zip', $headers)->deleteFileAfterSend(true);
    }
    // 上記までを追記
}
