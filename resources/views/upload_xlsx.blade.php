@extends('layouts.main')

@section('content')
<form method="post" action="/" enctype="multipart/form-data">
    @csrf
    <label for="xlsx_file">XLSX file</label>
    <input type="file" name="xlsx_file" id="xlsx_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
    <button type="submit">Upload</button>
</form>
@endsection