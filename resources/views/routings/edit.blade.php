@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px"> Редактирование маршрута</h6>
                </div>
                @include('layouts.errors')
                <form action="{{ route('routing.update', $routing->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="route_type">Тип:</label>
                        <select name="route_type" id="route_type" class="form-control custom-input" required>
                            <option value="sender" {{ $routing->route_type == 'sender' ? 'selected' : '' }}>Отправляю</option>
                            <option value="carrier" {{ $routing->route_type == 'carrier' ? 'selected' : '' }}>Перевожу</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Имя:</label>
                        <input type="text" name="name" id="name" class="form-control custom-input" required value="{{ $routing->name }}" >
                    </div>

                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control custom-input" rows="3" required>{{ $routing->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Цена:</label>
                        <input type="text" name="price" id="price" class="form-control custom-input" value="{{ $routing->price }}" required>
                    </div>

                    <div class="form-group">
                        <label for="from_place">Откуда:</label>
                        <input type="text" name="from_place" id="from_place" class="form-control custom-input" value="{{ $routing->from_place }}" required>
                    </div>

                    <div class="form-group">
                        <label for="to_place">Куда:</label>
                        <input type="text" name="to_place" id="to_place" class="form-control custom-input" value="{{ $routing->to_place }}" required>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Начало:</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control custom-input" value="{{ date('Y-m-d\TH:i', strtotime($routing->start_time)) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">Конец:</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control custom-input" value="{{ date('Y-m-d\TH:i', strtotime($routing->end_time)) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="load_type">Тип груза:</label>
                        <input type="text" name="load_type" id="load_type" class="form-control custom-input" value="{{ $routing->load_type }}" required>
                    </div>

                    <div class="form-group">
                        <label for="load_size">Размер груза:</label>
                        <input type="text" name="load_size" id="load_size" class="form-control custom-input" value="{{ $routing->load_size }}" required>
                    </div>

                    <div class="form-group">
                        <label for="owners_id">От кого:</label>
                        <select name="owners_id" id="owners_id" class="form-control custom-input" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $routing->owners_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Статус:</label>
                        <select name="status" id="status" class="form-control custom-input" required>
                            <option value="accepted" {{ $routing->status == 'accepted' ? 'selected' : '' }}>Принято</option>
                            <option value="waiting" {{ $routing->status == 'waiting' ? 'selected' : '' }}>Ожидает</option>
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
