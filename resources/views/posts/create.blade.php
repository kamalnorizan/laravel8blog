@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create New Post</div>

                <div class="card-body">
                    <form action="{{route('posts.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                    {!! $errors->first('category_id','<small class="text-danger">:message</small>') !!}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="published_at">Publish At</label>
                                    <input type="date" class="form-control" name="published_at" id="published_at">
                                    @if ($errors->has('published_at'))
                                    {!! $errors->first('published_at','<small class="text-danger">:message</small>') !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="tajuk">Title</label>
                                  <input type="text"
                                    class="form-control" name="tajuk" id="tajuk">
                                    @if ($errors->has('tajuk'))
                                    {!! $errors->first('tajuk','<small class="text-danger">:message</small>') !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="content">Content</label>
                                  <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                                  @if ($errors->has('content'))
                                    {!! $errors->first('content','<small class="text-danger">:message</small>') !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

