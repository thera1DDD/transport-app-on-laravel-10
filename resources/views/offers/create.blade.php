@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">

        <div class="card border-0">
            <div class="card-body">
                <h6 style="font-size: 20px">Добавление запроса</h6>
                <br>
                <form action="{{ route('offer.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="requested_users_id">Заявка от:</label>
                        <select name="requested_users_id" id="requested_users_id" class="form-control custom-input">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="routings_id">Маршруты:</label>
                        <select name="routings_id" id="routings_id" class="form-control custom-input">
                            @foreach($routings as $routing)
                                <option value="{{ $routing->id }}">{{ $routing->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Статус:</label>
                        <select name="status" id="status" class="form-control custom-input">
                            <option value="accepted">Принято</option>
                            <option value="waiting">Ожидает</option>
                            <option value="rejected">Отклонено</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
