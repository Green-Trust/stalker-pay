@extends('web.layout.main')

@section('title', 'Логин')

@section('content')
    <div class="container" style="margin-top: 10%;">
        <form id="registration">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="mb-30" style="color: #000;">Регистрация</h3>
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
                            id="password"
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
                            name="password_confirmation"
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
            <div class="row">
                <div id="errorMessage" class="alert alert-danger" style="display: none;">

                </div>
            </div>
            <div id="loader" class="row" style="display: none;">
                @include('web.widget.loader')
            </div>
            <div class="row" style="margin-top: -50px;">
                <div class="button-group-area mt-40">
                    <button type="submit" href="#" class="genric-btn primary circle arrow" style="font-family: 'Comfortaa', cursive;">Создать</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const RegistrationElement = {
            registration: '#registration',
            errorMessage: '#errorMessage',
            loader: '#loader'
        }

        const RegistrationManager = {
            _submitted: false,
            run() {
                $(RegistrationElement.errorMessage).hide();

                if (this._submitted) {
                    return;
                }

                this._submitted = true;

                $(RegistrationElement.loader).show();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('web_ajax_registration') }}',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    data: {
                        name: $('[name="name"]').val(),
                        email: $('[name="email"]').val(),
                        password: $('[name="password"]').val(),
                        password_confirmation: $('[name="password_confirmation"]').val()
                    },
                    success: response => {
                        location.href = '{{ route('web_login') }}';
                    },
                    error: response => {
                        $(RegistrationElement.errorMessage).show();
                        $(RegistrationElement.errorMessage).text(response.responseJSON.message);
                    },
                    complete: response => {
                        $(RegistrationElement.loader).hide();
                        this._submitted = false;
                    }
                })
            }
        }

        $(document).ready(e => {
            $(RegistrationElement.registration).validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirm: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    name: {
                        required: 'Поле обязательно для заполнения',
                        minlength: 'Минимальная длина имени - 3 символа'
                    },
                    email: {
                        required: 'Поле обязательно для заполнения',
                        email: 'Некорректный формат почты'
                    },
                    password: {
                        required: 'Поле обязательно для заполнения',
                        minlength: 'Минимальная длина пароля - 8 символов'
                    },
                    password_confirmation: {
                        required: 'Поле обязательно для заполнения',
                        equalTo: 'Пароли не совпадают'
                    },
                }
            })

            $(RegistrationElement.registration).submit(e => {
                e.preventDefault();

                if (!$(RegistrationElement.registration).valid()) {
                    return;
                }

                RegistrationManager.run();
            });
        });
    </script>
@endsection
