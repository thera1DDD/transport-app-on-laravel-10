@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">

        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px" > Редактирование запроса</h6>
                </div>


                <form action="{{ route('offer.update', $offer->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="requested_users_id">Заявка от:</label>
                        <select name="requested_users_id" id="requested_users_id" class="form-control custom-input">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $offer->requested_users_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="routings_id">Маршруты:</label>
                        <select name="routings_id" id="routings_id" class="form-control custom-input">
                            @foreach($routings as $routing)
                                <option value="{{ $routing->id }}" {{ $routing->id == $offer->routings_id ? 'selected' : '' }}>{{ $routing->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Статус:</label>
                        <select name="status" id="status" class="form-control custom-input">
                            <option value="accepted" {{ $offer->status == 'accepted' ? 'selected' : '' }}> Принято</option>
                            <option value="waiting" {{ $offer->status == 'waiting' ? 'selected' : '' }}> Ожидает</option>
                            <option value="rejected" {{ $offer->status == 'rejected' ? 'selected' : '' }}> Отклонено</option>
                            <option value="completed" {{ $offer->status == 'completed' ? 'selected' : '' }}> Завершено</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить маршрут</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
