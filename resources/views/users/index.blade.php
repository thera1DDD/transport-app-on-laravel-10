@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
    @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Пользователи</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Город</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Фото</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td data-th="Id">{{$user->id}}</td>
                                <td data-th="Имя">{{$user->name}}</td>
                                <td data-th="Фамилия">{{$user->surname}}</td>
                                <td data-th="Город">{{$user->city}}</td>
                                <td data-th="Телефон">{{$user->phone_number}}</td>
                                <td data-th="Дата создания">{{$user->created_at}}</td>
                                <td data-th="Фото"><img  style="width: 130px" src="{{getImage($user->main_image)}}" alt="avatar"></td>

                                <td data-th="Действие"> <a href="{{route('user.edit',$user->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    <form action="{{route('user.delete',$user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button  type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
