@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список комментариев</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group col-md-2">
                        <div class="input-group">
                            <form method="get">
                                <input value="{{old('search')}}" type="search" class="form-control" placeholder="Поиск по тексту" name="search">
                                <button type="submit" class="btn btn-success">Поиск</button>
                                <button type="reset" class="btn btn-default">Сбросить</button>
                            </form>
                            <span class="input-group-btn"></span>
                        </div>
                    </div>
                    @if(!count($comments))
                        <div class="col-md-8">
                            <h5 class="text-center">Данных по запросу не найдено</h5>
                        </div>
                    @else
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Текст</th>
                            <th>Название поста</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->text}}</td>
                            <td>@if ($comment->post)
                                <h3>Нет IIocta</h3>
                            @else
                            {{$comment->post->title}}</td>
                            @endif
                            <td>
                                <div class="btn-group-sm">
                                @if($comment->status == 1)
                                        <a href="/admin/comments/toggle/{{$comment->id}}" class="btn btn-default">
                                            <i class="fa fa-thumbs-o-up"></i></a>
                                @else
                                        <a href="/admin/comments/toggle/{{$comment->id}}" class="btn btn-default">
                                            <i class="fa fa-lock"></i></a>
                                @endif
                                    {{Form::open(['route'=>['comments.destroy', $comment->id], 'method'=>'delete'])}}
                                        <button onclick="return confirm('Вы уверены?')" type="submit" class="btn btn-danger">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                </div>
                                    {{Form::close()}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
            {{$comments->links()}}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection