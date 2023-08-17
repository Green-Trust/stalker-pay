@extends('web.layout.main')

@section('title', 'Логин')

@section('content')
    <div class="container" style="margin-top: 10%;">
        <form id="login">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3 class="mb-30" style="color: #000;">Вход</h3>
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
                <div id="errorMessage" class="alert alert-danger" style="display: none;">

                </div>
            </div>
            <div id="loader" class="row" style="display: none;">
                @include('web.widget.loader')
            </div>
            <div class="row" style="margin-top: -50px;">
                <div class="button-group-area mt-40">
                    <button type="submit" class="genric-btn primary circle arrow" style="font-family: 'Comfortaa', cursive;">Вход</button>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div>
                    <a href="#" style="font-family: 'Comfortaa', cursive; font-weight: bold; color: #1f2b7b;">Восстановить пароль</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const LoginElement = {
            login: '#login',
            errorMessage: '#errorMessage',
            loader: '#loader'
        }

        const LoginManager = {
            _submitted: false,
            run() {
                $(LoginElement.errorMessage).hide();

                if (this._submitted) {
                    return;
                }

                this._submitted = true;

                $(LoginElement.loader).show();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('web_ajax_login') }}',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    data: {
                        email: $('[name="email"]').val(),
                        password: $('[name="password"]').val()
                    },
                    success: response => {
                        location.href = '{{ route('web_index') }}';
                    },
                    error: response => {
                        $(LoginElement.errorMessage).show();
                        $(LoginElement.errorMessage).text(response.responseJSON.message);
                    },
                    complete: response => {
                        $(LoginElement.loader).hide();
                        this._submitted = false;
                    }
                })
            }
        }

        $(document).ready(e => {
            $(LoginElement.login).validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'Поле обязательно для заполнения',
                        email: 'Некорректный формат почты'
                    },
                    password: {
                        required: 'Поле обязательно для заполнения'
                    }
                }
            })

            $(LoginElement.login).submit(e => {
                e.preventDefault();

                if (!$(LoginElement.login).valid()) {
                    return;
                }

                LoginManager.run();
            });
        });
    </script>
@endsection
