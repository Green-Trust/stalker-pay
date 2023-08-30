@extends('admin.layout.main')

@section('title', 'Админ | Пользователи')

@section('content')
    <style>
        .text-sm.text-gray-700.leading-5 {
            margin-top: 10px;
        }
    </style>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Пользователи</h4>
                <p class="card-description">
                    Полный список пользователей проекта
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                UUID
                            </th>
                            <th>
                                Имя
                            </th>
                            <th>
                                Аватар
                            </th>
                            <th>
                                Статус
                            </th>
                            <th>
                                Действия
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reportContext->getUsers() as $user)
                            <tr>
                                <td class="py-1">
                                    {{ $user->getUuid() }}
                                </td>
                                <td>
                                    {{ $user->getName() }}
                                </td>
                                <td class="py-1">
                                    <img src="{{ $user->getAvatar() }}" alt="image"/>
                                </td>
                                <td>
                                    {{ $user->getStatus() }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Подробнее</a>
                                    <button data-action="{{ $user->getChangeStatusLink()->getUrl() }}" class="btn btn-danger change-status-btn {{ $user->getChangeStatusLink()->getClassName() }}">
                                        {{ $user->getChangeStatusLink()->getLabel() }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="margin-top: 30px;">
                        {{ $reportContext->getLinks() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(e => {
            $('.change-status-btn').click(e => {
                if (!confirm('Вы уверены, что хотите изменить статус пользователя?')) {
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: $(e.target).data('action'),
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    async: false,
                    success: response => {
                        window.location.reload();
                    },
                    error: response => {
                        console.error(response);
                    }
                })
            });
        });
    </script>
@endsection
