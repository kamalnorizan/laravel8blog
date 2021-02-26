@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Roles</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Role</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>@foreach ($role->permissions as $permission)
                                <span class="badge badge-primary">{{$permission->name}}</span>
                                @endforeach</td>
                            <td>
                                <button data-role="{{$role}}" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#roleassignpermission">
                                Assign Permission
                              </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Permissions</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Role</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>


                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($users as $user)

                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge badge-primary">{{$role->name}}</span>
                                @endforeach
                            </td>
                            <td>{{$user->permissions}}</td>
                            <td>
                                <button type="button" data-user="{{$user}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assignroletouser">
                                    Assign Role
                                  </button>

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="assignroletouser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Role to User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'user.assignroletouser']) !!}
            <div class="modal-body">
                {!! Form::hidden('user_id', 'value', ['id'=>'user_id']) !!}
                <div class="form-group{{ $errors->has('role_id[]') ? ' has-error' : '' }}">
                    {!! Form::label('role_id[]', 'Role') !!}
                    {!! Form::select('role_id[]',$roles->pluck('name','id'), null, ['id' => 'role_id', 'class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                    <small class="text-danger">{{ $errors->first('role_id[]') }}</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="roleassignpermission" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Permission To Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'user.assignpermissiontorole']) !!}
            <div class="modal-body">
                {!! Form::hidden('role_id', 'value', ['id'=>'role_id_2']) !!}
                <div class="form-group{{ $errors->has('permission_id[]') ? ' has-error' : '' }}">
                    {!! Form::label('permission_id[]', 'Permissions') !!}
                    {!! Form::select('permission_id[]',$permissions->pluck('name','id'), null, ['id' => 'permission_id[]', 'class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                    <small class="text-danger">{{ $errors->first('permission_id[]') }}</small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#roleassignpermission').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var role = button.data('role');
            $('#role_id_2').val(role['id']);
        });

        $('#assignroletouser').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var user = button.data('user');
                $('#user_id').val(user['id']);
        });
    });
</script>
@endsection
