@extends('web.layout.main')

@section('title', 'Логин')

@section('content')
    <div class="container" style="margin-top: 10%;">
        <form>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="mb-30">Регистрация</h3>
                </div>
            </div>
            <div class="row">
                <div>
                    <label>
                        <input
                            type="text"
                            name="name"
                            placeholder="Имя"
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Имя (Отображается другим пользователям)'"
                            required
                            class="single-input"
                            style="border: 2px solid #000; border-radius: 10px;"
                        >
                    </label>
                </div>
            </div>
            <div class="row">
                <div>
                    <label>
                        <input
                            type="email"
                            name="email"
                            placeholder="Почта"
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Почта'"
                            required
                            class="single-input"
                            style="border: 2px solid #000; border-radius: 10px;"
                        >
                    </label>
                </div>
            </div>
            <div class="row">
                <div>
                    <label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Пароль"
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Пароль'"
                            required
                            class="single-input"
                            style="border: 2px solid #000; border-radius: 10px;"
                        >
                    </label>
                </div>
            </div>
            <div class="row">
                <div>
                    <label>
                        <input
                            type="password"
                            name="password_confirm"
                            placeholder="Повторите пароль"
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Повторите пароль'"
                            required
                            class="single-input"
                            style="border: 2px solid #000; border-radius: 10px;"
                        >
                    </label>
                </div>
            </div>
            <div class="row" style="margin-top: -50px;">
                <div class="button-group-area mt-40">
                    <a href="#" class="genric-btn primary circle arrow" style="font-family: 'Comfortaa', cursive;">Создать</a>
                </div>
            </div>
        </form>
    </div>
@endsection
