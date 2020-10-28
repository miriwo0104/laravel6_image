<h1>画像ファイルのアップロード</h1>
<form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @error('file')
        {{$message}}
        <br>
    @enderror
    <label for="photo">画像ファイル:</label>
    <input type="file" class="form-control" name="file">
    <br>
    <input type="submit">
</form>
