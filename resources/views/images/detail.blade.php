<h1>画像の詳細</h1>

<img src="{{asset('storage/' . $image_info['file_path'])}}" alt="{{asset('storage/' . $image_info['file_path'])}}">
<br>
<a href="{{route('display', ['images_id' => $image_info['id']])}}">
    <button type="submit">表示</button>
</a>
{{-- 下記を追記 --}}
<br>
<form action="{{route('download')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$image_info['id']}}">
    <button type="submit">ダウンロード</button>
</form>
{{-- 上記までを追記 --}}
<ul>
    <li>ID: {{$image_info['id']}}</li>
    <li>アップロード日: {{$image_info['created_at']}}</li>
</ul>