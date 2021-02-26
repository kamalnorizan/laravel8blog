@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('posts.create')}}" class="btn btn-primary btn-md float-right">Create Post</a>
        </div>
    </div>
    <br>
    @foreach ($posts as $post)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{$post->title}} ~ {{$post->user->name}}
                    @if ($post->user_id==Auth::user()->id)
                        <a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-info btn-sm float-right">Edit</a>
                    @endif
                </div>
                <div class="card-body">
                   {{$post->content}}
                    <hr>
                    <h3>Comments</h3>
                    {!! Form::open(['method' => 'POST', 'route' => 'comment.store']) !!}
                        {!! Form::hidden('post_id', $post->id, ['id'=>'post_id']) !!}
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            {!! Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required','rows'=>'3']) !!}
                            <small class="text-danger">{{ $errors->first('content') }}</small>
                        </div>

                        <div class="btn-group float-right">
                            {!! Form::submit("Submit", ['class' => 'btn btn-success']) !!}
                        </div>
                    {!! Form::close() !!}
                    <br><br>
                    <hr>
                    @forelse ($post->comments as $comment)
                        - {{$comment->content}} ~ {{$comment->user->name}} <br>
                    @empty
                        <p>No Comment</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    <br>
    @endforeach
    {{$posts->links()}}
</div>
@endsection

