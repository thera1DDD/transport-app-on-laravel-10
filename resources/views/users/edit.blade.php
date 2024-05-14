@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">

        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px" > Редактирование пользователя</h6>
                </div>

                <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Имя:</label>
                        <input type="text" name="name" id="name" class="form-control custom-input" required value="{{ $user->name }}" >
                    </div>
                    <div class="form-group">
                        <label for="name">Фамилия:</label>
                        <input type="text" name="surname" id="name" class="form-control custom-input" required value="{{ $user->surname }}" >
                    </div>
                    <div class="form-group">
                        <label for="name">Город:</label>
                        <input type="text" name="city" id="name" class="form-control custom-input" required value="{{ $user->city }}" >
                    </div>
                    <div class="form-group">
                        <label for="name">Телефон:</label>
                        <input type="text" name="phone_number" id="name" class="form-control custom-input" required value="{{ $user->phone_number }}" >
                    </div>
                    <div class="form-group">
                        <label for="name">Фото</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="main_image" type="file" class="custom-file-input" id="exampleInputFile">
                            </div>
                        </div>
                        @error('main_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить пользователя</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
