@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group col-md-12">
                        <a href="{{route('categories.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="input-group">
                            <form method="get">
                                <input value="{{old('search')}}" type="search" class="form-control" placeholder="Поиск по названию" name="search">
                                <button type="submit" class="btn btn-success">Поиск</button>
                                <button type="reset" class="btn btn-default">Сбросить</button>
                            </form>
                            <span class="input-group-btn">

                                </span>
                        </div>
                    </div>
                    @if(!count($categories))
                        <div class="col-md-8">
                        <h5 class="text-center">Данных по запросу не найдено</h5>
                        </div>
                    @else
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td>
                                        {{Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'delete'])}}
                                        <div class="btn-group-sm">
                                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-default ">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button onclick="return confirm('Вы уверены?')" type="submit" class="btn btn-danger  delete">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                        {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection