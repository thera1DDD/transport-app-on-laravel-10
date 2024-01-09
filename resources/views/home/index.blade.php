@extends('layouts.sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Главная</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- info box -->
                    <div class="info-box border-rectangle bg-info">
                        <span class="info-box-icon"><i class="ion ion-bag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Заявки</span>
                            <span class="info-box-number">5</span>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- info box -->
                    <div class="info-box border-rectangle bg-success">
                        <span class="info-box-icon"><i class="ion ion-stats-bars"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Маршруты</span>
                            <span class="info-box-number">6</span>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- info box -->
                    <div class="info-box border-rectangle bg-warning">
                        <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Пользователи</span>
                            <span class="info-box-number">5</span>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- info box -->
                    <div class="info-box border-rectangle bg-danger">
                        <span class="info-box-icon"><i class="ion ion-pie-graph"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Категории</span>
                            <span class="info-box-number">3</span>
                        </div>
                        <a href="#" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <style>
        .border-rectangle {
            border: 3px solid black;
            border-radius: 15px;
            padding: 15px;
            color: white;
            transition: transform 0.3s ease-in-out;
        }

        .border-rectangle:hover {
            transform: scale(1.05);
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .small-box-footer {
            color: #007bff;
            font-weight: bold;
        }

        .small-box-footer:hover {
            color: #0056b3;
        }
    </style>
@endsection
