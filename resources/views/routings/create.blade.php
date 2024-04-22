@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="mb-3">

        </div>

        <div class="card border-0">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4>Добавление маршрута</h4>
                <br>
                <form action="{{ route('routing.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="route_type">Тип:</label>
                        <select name="route_type" id="route_type" class="form-control custom-input" required>
                            <option value="carrier">Отправка</option>
                            <option value="sender">Перевозка</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Имя:</label>
                        <input type="text" name="name" id="name" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control custom-input" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Цена:</label>
                        <input type="text" name="price" id="price" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="from_place">Откуда:</label>
                        <input type="text" name="from_place" id="from_place" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="to_place">Куда:</label>
                        <input type="text" name="to_place" id="to_place" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Начало:</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">Конец:</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="load_type">Тип груза:</label>
                        <input type="text" name="load_type" id="load_type" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="load_size">Размер груза:</label>
                        <input type="text" name="load_size" id="load_size" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="owners_id">От кого:</label>
                        <select name="owners_id" id="owners_id" class="form-control custom-input" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Статус:</label>
                        <select name="status" id="status" class="form-control custom-input" required>
                            <option value="accepted">Принято</option>
                            <option value="waiting">Ожидает</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Создать маршрут</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
