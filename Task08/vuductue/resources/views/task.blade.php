<?php
?>

{{--Thua ke tu app.blade.php--}}
@extends('layouts.app');


{{--Noi dung trang con--}}
{{--Dung app.css--}}
@section('content')

    <div class="panel-body">
        {{--hien thi thong bao loi--}}
        @include('errors.503')

        {{--nhap thong tin moi--}}
        <form action="{{url('task')}}" method="post" class="form-horizontal">
            {{csrf_field()}}

            {{--ten Task--}}
            <div class="form-group">
                <label for="task" class="col-sm3 control-label">Task</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            {{--nut Task--}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i>Add Task
                        </button>
                </div>
            </div>
        </form>
    </div>
    @endsection
