@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список постов</h3>
                    @include('pages.errors.errors_users_login')
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group col-md-12">
                        <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <div class="form-group col-md-2">
                            <div class="input-group">
                                <form method="get">
                                    <div class="form-group">
                                        <label>Категория</label>
                                        {{Form::select('category_id',
                                            $categories,
                                             null,
                                                     [
                                                        "class" => "form-control select2",
                                                        "placeholder" => "Выберете категорию"
                                                     ])
                                        }}
                                    </div>
                                    <input value="{{old('search')}}" type="search" class="form-control" placeholder="Поиск по названию" name="search">
                                    <button type="submit" class="btn btn-success">Поиск</button>
                                    <button type="reset" class="btn btn-default">Сбросить</button>
                                </form>
                                <span class="input-group-btn">

                                </span>
                            </div>
                    </div>
                    @if(!count($posts))
                        <div class="col-md-8">
                        <h5 class="text-center">Данных по запросу не найдено</h5>
                        </div>
                    @else
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Опубликован</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Картинка</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->getStatusTitle()}}</td>
                            <td>{{$post->getCategoryTitle()}}</td>
                            <td>{{$post->getTagsTitles()}}</td>
                            <td>
                                <img src="{{$post->getImage()}}" alt="" width="100">
                            </td>
                            <td>
                                {{Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'delete'])}}
                                <div class="btn-group-sm">
                                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-default ">
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
            {{$posts->links()}}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
