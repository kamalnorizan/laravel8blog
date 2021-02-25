@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td>Category</td>
                            <td>Author</td>
                            <td>Comment(Count)</td>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->title}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->comments->count()}}</td>
                        </tr>
                        @endforeach
                    </table>
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
