@extends('layouts.app')

@section('content')
<div class="container">
    <h1>CSV File Upload</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="csv_file">Choose a CSV file:</label>
            <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv">
        </div>

        <button type="submit" class="btn btn-primary">Upload and Import</button>
    </form>
</div>
@endsection
