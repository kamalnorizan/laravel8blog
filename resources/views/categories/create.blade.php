@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @isset ($category)
                    Update category
                    @else
                    Create new category
                    @endisset
                </div>

                <div class="card-body">
                    @isset ($category)
                        {!! Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['method' => 'POST', 'route' => 'category.store']) !!}
                    @endisset


                       @include('categories._form')

                    @isset ($category)
                       <div class="btn-group pull-right">

                        {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
                        </div>
                    @else
                        <div class="btn-group pull-right">
                            {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                            {!! Form::submit("Create Category", ['class' => 'btn btn-success']) !!}
                        </div>
                    @endisset



                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

