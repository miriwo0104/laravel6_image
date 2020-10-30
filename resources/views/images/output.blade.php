<h1>アップロードされた画像一覧</h1>

@foreach ($image_infos as $image_info)
    <hr>
    <img src="{{asset('storage/' . $image_info['file_path'])}}" alt="{{asset('storage/' . $image_info['file_path'])}}">
    <br>
    <a href="{{route('detail', ['images_id' => $image_info['id']])}}">
        <button type="submit">詳細</button>
    </a>
    <br>
    <a href="{{route('display', ['images_id' => $image_info['id']])}}">
        <button type="submit">表示</button>
    </a>
@endforeach