@extends('web.layout.main')

@section('title', 'Профиль')

@section('content')
    <div class="container" style="margin-top: 150px; background: #fff;">
        <div class="whole-wrap">
            <div class="container box_1170">
                <div class="section-top-border">
                    <h3 class="mb-30" style="font-family: 'Roboto Condensed', cursive; font-weight: bold; color: #000;">{{ $profileViewDto->getName() }}</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ $profileViewDto->getAvatar() }}" alt="" class="img-fluid" style="width: 100%;">
                        </div>
                        <div class="col-md-9 mt-sm-20">
                            <div class="row">
                                <h3 style="color: #000; background: {{ $profileViewDto->getUuidColor() }}; border-radius: 10px; padding: 10px;">UUID: {{ $profileViewDto->getUuid() }}</h3>
                            </div>
                            <div class="row">
                                <h5 style="color: #000;">Дата регистрации: {{ $profileViewDto->getRegistrationDate() }}</h5>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <a href="#" class="genric-btn info" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Сообщения</a>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <a href="#" class="genric-btn primary" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Настройки</a>
                            </div>
                            <div class="row">
                                <a href="#" class="genric-btn danger" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Logout User</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
