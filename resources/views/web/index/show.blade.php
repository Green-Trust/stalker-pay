@extends('web.layout.main')

@section('title', 'Главная')

@section('content')
    @include('web.widget.background')

    <div class="container" style="margin-top: 15%;">
        <h1>Hello, World!</h1>
    </div>
@endsection
