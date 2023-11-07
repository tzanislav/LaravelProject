<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Upload Image to Amazon s3 cloud Storage Using laravel</title>
  </head>
  <body>
  <div class="uploadContainer">

        @if(isset($url))
            <p>Public URL: <a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
            <img src="{{ $url }}" alt="">
        @endif
        <h1>Upload File to S3</h1>
        <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Select File</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
  </body>
</html>