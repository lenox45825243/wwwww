@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(!count($posts))
                        <div class="box-body text-center"><h2>Не добавлено ни одного поста</h2></div>
                        <div class="box-footer text-center"><h1>:-(</h1></div>
                    @else
                    @foreach($posts as $post)
                    <article class="post">
                        <div class="post-thumb">
                            <a href="{{route('post.show', $post->slug)}}"><img src="{{$post->getImage()}}" alt=""></a>

                            <a href="{{route('post.show', $post->slug)}}" class="post-thumb-overlay text-center">
                                <div class="text-uppercase text-center">View Post</div>
                            </a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                @if($post->hasCategory())
                                <h6><a href="{{route('category.show', $post->category->slug)}}">{{$post->category ? $post->category->title : '-'}}</a></h6>
                                @endif
                                <h1 class="entry-title"><a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h1>
                            </header>
                            <div class="entry-content">
                                {!!str_limit($post->description, 70)!!}
                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="{{route('post.show', $post->slug)}}" class="more-link">Continue Reading</a>
                                </div>
                            </div>
                            <div class="social-share">
                                @if ($post->author == null)
                                    <span class="social-share-title pull-left text-capitalize">Нет автора {{$post->getDate()}}</span>
                                    <ul class="text-center pull-right">
                                        <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                @else
                                <span class="social-share-title pull-left text-capitalize">Выложил {{$post->author->name}} {{$post->getDate()}}</span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                    {{$posts->links()}}
                    @endif
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
