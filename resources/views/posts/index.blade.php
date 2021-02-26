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
                    - {{$comment->content}} ~ {{$comment->user->name}}

                    @if ($comment->user_id==Auth::user()->id)
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#editComment_mdl" data-comment="{{$comment}}"> Edit Comment </button>
                    @endif

                    <br>
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editComment_mdl" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'comment.update']) !!}
            <div class="modal-body">
                {!! Form::hidden('comment_id', 'value', ['id'=>'comment_id_mdl']) !!}
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    {!! Form::label('content', 'Comment') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'content_mdl']) !!}
                    <small class="text-danger">{{ $errors->first('content') }}</small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#editComment_mdl').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var data = button.data('comment');

            $('#comment_id_mdl').val(data['id']);
            $('#content_mdl').val(data['content']);
        });
    });
</script>
@endsection

