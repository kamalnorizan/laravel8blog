@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories <a href="{{route('category.create')}}" class="btn btn-sm btn-primary float-right">Create New Category</a></div>

                <div class="card-body">
                   <table class="table">
                       <tr>
                           <td>#</td>
                           <td>Title</td>
                           <td>Action(s)</td>
                       </tr>
                       @foreach ($categories as $key=>$category)
                       <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$category->title}}</td>
                           <td>
                               <a href="{{route('category.edit',['category'=>$category->id])}}" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

