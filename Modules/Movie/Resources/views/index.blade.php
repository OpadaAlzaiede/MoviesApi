@extends('movie::layouts.master')

@section('content')
    <form action="/" method="POST">
        @csrf
        <input type="file" name="file" id="file"> <br>
        <input type="submit" value="upload">
    </form>
@endsection
