@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список пользователей</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('users.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    @if(!count($users))
                        <h5 class="text-center">Данных по запросу не найдено</h5>
                    @else
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150">
                            </td>
                            <td>
                                {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete'])}}
                                <div class="btn-group-sm">
                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-default ">
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
            {{$users->links()}}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
