@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Маршруты</h6>
                    </div>
                    <a href="routes/create" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Откуда</th>
                            <th scope="col">Куда</th>
                            <th scope="col">Начало</th>
                            <th scope="col">Конец</th>
                            <th scope="col">Тип груза</th>
                            <th scope="col">Размер груза</th>
                            <th scope="col">От кого</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($routings as $route)
                            <tr>
                                <td data-th="Id">{{$route->id}}</td>
                                <td data-th="Тип">{{$route->route_type == 'sender' ? 'Отправлю' : 'Перевезу'}}</td>
                                <td data-th="Имя">{{$route->name}}</td>
                                <td data-th="Описание">{{$route->description}}</td>
                                <td data-th="Цена">{{$route->price}}</td>
                                <td data-th="Откуда">{{$route->from_place}}</td>
                                <td data-th="Куда">{{$route->to_place}}</td>
                                <td data-th="Начало">{{$route->start_time}}</td>
                                <td data-th="Конец">{{$route->end_time}}</td>
                                <td data-th="Тип груза">{{$route->load_type}}</td>
                                <td data-th="Размер груза">{{$route->load_size}}</td>
                                <td data-th="От кого">
                                    {{ $route->user->name ?? 'Удаленный пользователь' }}
                                </td>
                                <td data-th="Статус">{{$route->status == 'accepted' ? 'Принято' : 'Ожидает'}}</td>
                                <td data-th="Действие"> <a href="{{route('routing.edit',$route->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    <form action="{{route('routing.delete',$route->id) }}" method="post">
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
                    {{ $routings->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
