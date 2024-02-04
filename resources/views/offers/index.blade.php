@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
    @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Запросы</h6>
                    </div>
                    <a href="offers/create" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Маршрут</th>
                            <th scope="col">Тип маршрута</th>
                            <th scope="col">Создатель маршрута</th>
                            <th scope="col">Заявка от</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                            <tr>
                                <td data-th="Id">{{$offer->id}}</td>
                                <td data-th="Маршрут">{{$offer->route->name}}</td>
                                <td data-th="Тип маршрута">{{$offer->route->route_type == 'sender' ? 'Отправлю' : 'Перевезу'}}</td>
                                <td data-th="Создатель маршрута">{{$offer->route->user->name}}</td>
                                <td data-th="Заявка от">{{$offer->requested_user->name}}</td>
                                <td data-th="Статус">{{ match($offer->status) { 'accepted' => 'Принят', 'rejected' => 'Отклонено', 'waiting' => 'В ожидании','completed' => 'Завершено', default => 'Неизвестный статус' } }}</td>
                                <td data-th="Дата создания">{{$offer->created_at}}</td>
                                <td data-th="Действие"> <a href="{{route('offer.edit',$offer->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    <form action="{{route('offer.delete',$offer->id) }}" method="post">
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
                    {{ $offers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
