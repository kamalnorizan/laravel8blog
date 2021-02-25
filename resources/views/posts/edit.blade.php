@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                   {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    {!! Form::label('category_id', 'Category') !!}
                                    {!! Form::select('category_id',$categories_opt, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }}">
                                    {!! Form::label('published_at', 'Publish Date') !!}
                                    {!! Form::date('published_at', date('Y-m-d',strtotime($post->published_at)), ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('published_at') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    {!! Form::label('title', 'Title') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            {!! Form::label('content', 'Content') !!}
                            {!! Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('content') }}</small>
                        </div>

                       <div class="btn-group pull-right">
                           {!! Form::submit("Update Post", ['class' => 'btn btn-success']) !!}
                       </div>

                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

