@extends('web.layout.main')

@section('title', 'Серебро')

@section('content')
    <div class="container" style="margin-top: 150px; background: #fff; padding-bottom: 50px;">
        <div class="row" style="border-bottom: 1px solid #000; background: #bfbfbf;">
            <div class="col-md-12">
                <div class="typography">
                    <h1 style="font-family: 'Russo One', serif; color: #000;">Продажа серебра - Лот №{{ $silverLot->getId() }}</h1>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-8" style="background: #f2f2f2;">
                <div>
                    <h3 class="mb-20" style="font-family: 'Russo One', serif; color: #000;">Предложение</h3>
                </div>
                <div>
                    <ul class="unordered-list">
                        <li><strong>Количество</strong> - {{ $silverLot->getAmount() }}кк</li>
                        <li><strong>Минимум для покупки</strong> - {{ $silverLot->getMinimum() }}кк</li>
                        <li><strong>Цена за миллион</strong> - {{ $silverLot->getPrice() }} ₽</li>
                        <li><strong>Тип</strong> - {{ $silverLot->getType() }}</li>
                        <li><strong>Локация</strong> - {{ $silverLot->getLocation() }}</li>
                        <li><strong>Сервер</strong> - {{ $silverLot->getServer() }}</li>
                    </ul>
                </div>
                @if($silverLot->getDescription())
                    <div style="margin-top: 10px;">
                        {{ $silverLot->getDescription() }}
                    </div>
                @endif
                <div style="margin-top: 10px; margin-bottom: 30px;">
                    <div>
                        <span style="font-size: 20px; font-weight: bold;">Сделка</span>
                    </div>
                    <div>
                        <input id="money" type="text" name="money" placeholder="Я заплачу в рублях" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Я заплачу в рублях'" required="" class="single-input">
                    </div>
                    <div style="margin-top: 5px;">
                        <input id="silver" type="text" name="silver" placeholder="Количество игровой валюты (Миллионы)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Количество игровой валюты (Миллионы)'" required="" class="single-input">
                    </div>
                    <div style="margin-top: 10px;">
                        <div style="display: none;" id="maxForBuyAlert" class="alert alert-info converter-alert">
                            Максимальная допустимая сумма для покупки - {{ $silverLot->getAmount() }}кк
                        </div>
                        <div style="display: none;" id="minimumAlert" class="alert alert-danger converter-alert">
                            Минимальная сумма серебра для покупки - {{ $silverLot->getMinimum() }}кк
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="background: #cbcbcb;">
                <div>
                    <h3 style="font-family: 'Russo One', serif; color: #000;">{{ $silverLot->getCreator()->getName() }}</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ $silverLot->getCreator()->getAvatar() }}" alt="" style="width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <div>
                            <span><strong>Статус</strong> - Онлайн</span>
                        </div>
                        <div>
                            <span><strong>Рейтинг</strong> - 5.0</span>
                        </div>
                        <div>
                            <span><strong>Кол-во сделок</strong> - 100</span>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 10px; margin-bottom: 10px;">
                    <button class="genric-btn primary" style="font-family: 'Russo One', serif; width: 100%; background: #189420;">Создать сделку</button>
                </div>
                <div style="margin-top: 10px; margin-bottom: 10px;">
                    <button class="genric-btn primary" style="font-family: 'Russo One', serif; width: 100%;">Открыть чат</button>
                </div>
                <div style="margin-top: 10px; margin-bottom: 10px;">
                    <button class="genric-btn danger" style="font-family: 'Russo One', serif; width: 100%;">Подать жалобу</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const ConverterElements = {
            money: '#money',
            silver: '#silver'
        }

        const Converter = {
            getMaxForBuy() {
                return {{ $silverLot->getAmount() }} * {{ $silverLot->getPrice() }}
            },
            moneyConverter(event) {
                $('.converter-alert').hide();

                let moneyValue = $(ConverterElements.money).val();
                if (!moneyValue.length) {
                    $(ConverterElements.silver).val('');
                }

                const correctValue = /^\d+$/.test(moneyValue);
                if (!correctValue) {
                    $(ConverterElements.silver).val('');
                    return false;
                }

                if (moneyValue > Converter.getMaxForBuy()) {
                    $(ConverterElements.money).val(Converter.getMaxForBuy());
                    $('#maxForBuyAlert').show();
                    $(ConverterElements.silver).val({{ $silverLot->getAmount() }})
                    return false;
                }

                let result = moneyValue / {{ $silverLot->getPrice() }};
                if (result < {{ $silverLot->getMinimum() }}) {
                    $('#minimumAlert').show();
                }

                $(ConverterElements.silver).val(result.toFixed(2));
            },
            silverConverter(event) {
                $('.converter-alert').hide();

                let silverValue = $(ConverterElements.silver).val();
                if (!silverValue.length) {
                    $(ConverterElements.money).val('');
                }

                const correctValue = /^\d+$/.test(silverValue);
                if (!correctValue) {
                    $(ConverterElements.money).val('');
                    return false;
                }

                if (silverValue > {{ $silverLot->getAmount() }}) {
                    $(ConverterElements.money).val(Converter.getMaxForBuy());
                    $('#maxForBuyAlert').show();
                    $(ConverterElements.silver).val({{ $silverLot->getAmount() }})
                    return false;
                }

                let result = silverValue * {{ $silverLot->getPrice() }};
                $(ConverterElements.money).val(result.toFixed(2));
            },
            init() {
                $(ConverterElements.money).keyup(e => {
                    Converter.moneyConverter(e);
                });
                $(ConverterElements.silver).keyup(e => {
                    Converter.silverConverter(e);
                });
            }
        }

        $(document).ready(e => {
            Converter.init();
        });
    </script>
@endsection
