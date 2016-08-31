@extends('layouts.app')

@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form action="{{url('task')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Task</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button class="btn btn-default" type="submit"><i class="fa fa-plus"></i>Add Task</button>
                </div>
            </div>
        </form>
    </div>

    @if(count($tasks)>0)
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Current Tasks</div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Id</th>
                            <th>Task</th>
                            <th>User</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="table-text">
                                        <div><a href="{{url('/task/view/'.$task->id)}}">{{$task->id}}</a></div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$task->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{\App\User::find($task->user_id)->first()->name}}</div>
                                    </td>
                                    <td>
                                        <form action="{{url('task/'.$task->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger" type="submit" id="delete-task-{{$task->id}}">
                                                <i class="fa fa-btn fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

    @endif
@endsection
