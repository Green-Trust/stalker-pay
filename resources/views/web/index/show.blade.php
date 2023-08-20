@extends('web.layout.main')

@section('title', 'Главная')

@section('content')
    @include('web.widget.background')

    <div class="container" style="margin-top: 15%;">
        <div class="row">
            <div class="col-md-2">
                @if(\Illuminate\Support\Facades\Auth::user())
                    <button id="createLotWrapper" data-target="#createLotModal" class="btn btn-success" data-toggle="modal" style="background: #2962e5;">Создать лот</button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success" style="background: #2962e5;">Создать лот</a>
                @endif
            </div>
        </div>
        <div class="row" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="col-md-3">
                <div>
                    <button class="genric-btn primary e-large" style="width: 100%; font-family: 'Russo One', serif; font-size: 20px; background: #000000;">Серебро</button>
                </div>
                <div style="margin-top: 10px;">
                    <button class="genric-btn primary e-large" style="width: 100%; font-family: 'Russo One', serif; font-size: 20px; background: #000000;">Предметы</button>
                </div>
                <div style="margin-top: 10px;">
                    <button class="genric-btn primary e-large" style="width: 100%; font-family: 'Russo One', serif; font-size: 20px; background: #000000;">Аккаунты</button>
                </div>
                <div style="margin-top: 10px;">
                    <button class="genric-btn primary e-large" style="width: 100%; font-family: 'Russo One', serif; font-size: 20px; background: #000000;">Услуги</button>
                </div>
            </div>
            <div class="col-md-9">
                <div id="showLoader">
                    @include('web.widget.loader')
                </div>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Количество</th>
                        <th scope="col">Минимальный объем</th>
                        <th scope="col">Локация</th>
                        <th scope="col">Тип</th>
                        <th scope="col">Продавец</th>
                    </tr>
                    </thead>
                    <tbody id="silverLotTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="createLotModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Создать лот</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group-icon">
                        <div class="form-select" id="default-select">
                            <span>Тип слота</span>
                            <select>
                                <option value="1">Серебро</option>
                                <option value="1">Предмет</option>
                                <option value="1">Аккаунт</option>
                                <option value="1">Услуги</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div style="margin-top: 30px;">
                        <div>
                            <span>Форма</span>
                        </div>
                        <form id="silverLot" class="active-form" data-form-name="silver">
                            <div class="mt-10">
                                <input type="text" name="silverAmount" placeholder="Количество в миллионах"
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Количество в миллионах'" required
                                       class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="silverMinimum" placeholder="Минимальное допустимое к покупке"
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Минимальное допустимое к покупке'" required
                                       class="single-input-primary">
                            </div>
                            <div class="mt-10">
								<textarea name="silverDescription" class="single-textarea" placeholder="Описание (Не обязательно)" onfocus="this.placeholder = ''"
                                          onblur="this.placeholder = 'Описание (Не обязательно)'"></textarea>
                            </div>
                            <div class="input-group-icon mt-10">
                                <span>Тип сделки</span>
                                <div class="form-select" id="default-select">
                                    <select id="silverType">

                                    </select>
                                </div>
                            </div>
                            <div class="input-group-icon mt-10">
                                <span>Локация</span>
                                <div class="form-select" id="default-select">
                                    <select id="silverLocation">

                                    </select>
                                </div>
                            </div>
                            <div class="input-group-icon mt-10">
                                <span>Сервер</span>
                                <div class="form-select" id="default-select">
                                    <select id="silverServer">

                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div id="errorMessage" class="alert alert-danger" style="display: none; margin-left: 15px;">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="loader" style="display: none;">
                        @include('web.widget.loader')
                    </div>

                    <button id="create" type="button" class="genric-btn primary circle" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Создать</button>
                    <button type="button" class="genric-btn danger circle" data-dismiss="modal" style="font-family: 'Comfortaa', cursive; font-weight: bold;">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const LotElement = {
            errorMessage: '#errorMessage',
            loader: '#loader',
            showLoader: '#showLoader'
        }

        const LotCreateFormManager = {
            _loaded: false,
            _submitted: false,
            _injectSelect(selectSelector, data) {
                for (let key in data) {
                    $(selectSelector).append(`
                        <option value="${key}">${data[key]}</option>
                    `);
                }
            },
            _getSelected(selectSelector) {
                return $(selectSelector).next().find('.selected').data('value');
            },
            getCurrentFormName() {
                return $('.active-form').data('form-name');
            },
            create() {
                if (this.getCurrentFormName() === 'silver') {
                    this.createSilverLot();
                }
            },
            createSilverLot() {
                if (!$('#silverLot').valid()) {
                    return;
                }

                this._submitted = true;
                $('#loader').show();
                $('#errorMessage').hide();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('web_ajax_silver_create') }}',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    data: {
                        amount: $('[name="silverAmount"]').val(),
                        minimum: $('[name="silverMinimum"]').val(),
                        description: $('[name="silverDescription"]').val(),
                        type: this._getSelected('#silverType'),
                        location: this._getSelected('#silverLocation'),
                        server: this._getSelected('#silverServer')
                    },
                    success: response => {
                        location.href = `/lot/silver/${response.data.id}`;
                    },
                    error: response => {
                        $(LotElement.errorMessage).show();
                        $(LotElement.errorMessage).text(response.responseJSON.message);
                    },
                    complete: response => {
                        this._submitted = false;
                        $(LotElement.loader).hide();
                    }
                })
            },
            load() {
                if (this._loaded) {
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: '{{ route('web_ajax_form_info') }}',
                    success: response => {
                        LotCreateFormManager._injectSelect('#silverType', response.data.silver.type)
                        LotCreateFormManager._injectSelect('#silverLocation', response.data.common.locations)
                        LotCreateFormManager._injectSelect('#silverServer', response.data.common.servers)

                        $('select').niceSelect();

                        LotCreateFormManager._loaded = true;
                    }
                })
            }
        }

        const SilverLotShow = {
            load() {
                $(LotElement.showLoader).show();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('web_ajax_silver_show') }}',
                    success: response => {
                        response.data.data.forEach(lot => {
                            $('#silverLotTable').append(`
                                <tr data-silver-lot-id="${lot.id}" style="cursor: pointer;">
                                    <th>${lot.amount}</th>
                                    <td>${lot.minimum}</td>
                                    <td>${lot.location}</td>
                                    <td>${lot.type}</td>
                                    <td>${lot.creator}</td>
                                </tr>
                            `);
                        });
                    },
                    complete: response => {
                       $(LotElement.showLoader).hide();
                    }
                })
            }
        }

        $(document).ready(e => {
            $('#createLotWrapper').click(e => {
                LotCreateFormManager.load();
            });

            $('#create').click(e => {
                LotCreateFormManager.create();
            });

            SilverLotShow.load();

            $('#silverLot').validate({
                rules: {
                    silverAmount: {
                        required: true,
                        digits: true,
                        min: 1,
                    },
                    silverMinimum: {
                        required: true,
                        digits: true,
                        min: 1,
                    }
                },
                messages: {
                    silverAmount: {
                        required: 'Поле обязательно для заполнения',
                        digits: 'Поле должно содержать только число',
                        min: 'Минимальное количество валюты - 1кк'
                    },
                    silverMinimum: {
                        required: 'Поле обязательно для заполнения',
                        digits: 'Поле должно содержать только число',
                        min: 'Минимальное количество валюты - 1кк'
                    }
                }
            });
        });
    </script>
@endsection
