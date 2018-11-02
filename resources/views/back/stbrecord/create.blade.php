@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ url('css/bootstrap-datetimepicker.min.css') }}">
    <fieldset>
        <legend>STB Record</legend>
        <a href="{{ url('stb-record') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-th-list"></span> List</a>
        <div class="clearfix"></div>
        <br>

        <form action="{{ $route }}" method="post" onsubmit="return validate()">
            {{ csrf_field() }}
            @if ($action == 'Edit')
                {{ method_field('PUT') }}
            @endif
            <table class="table table-striped">
                <tr>
                    <td class="col-md-2" align="right">STB No.: </td>
                    <td class="col-md-4">
                        <select name="stb_no" id="stb-no" class="form-control">
                            <option value="0">- Select Stb No. -</option>
                            @foreach ($stb as $val)
                                <option value="{{ $val->stb_id }}">{{ $val->stb_number }}</option>
                            @endforeach
                        </select>
                        <!--<input type="text" name="stb_no" id="stb-no" class="form-control" value="{{{ $detail->stb_no or '' }}}"></td>-->
                    <td class="col-md-2" align="right">STB Status: </td>
                    <td class="col-md-4"><input type="radio" value="1" name="stb_status" @if ($action == 'Edit' && $detail->stb_status == '1') checked @endif> Active <input type="radio" value="0" name="stb_status" @if ($action == 'Edit' && $detail->stb_status == '0') checked @endif> Inactive</td>
                </tr>
                <tr>
                    <td align="right">User: </td>
                    <td>
                        <select name="user_id" id="user-id" class="form-control">
                            <option value="0">- Select User -</option>
                            @foreach ($users as $val)
                                <option value="{{ $val->id }}" @if ($action == 'Edit' && $detail->user_id == $val->id) selected @endif>{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td align="right">Date: </td>
                    <td>
                        <div class="input-group date" id="datetimepicker1">
                            <input type="text" name="exec_date" id="exec-date" class="form-control" value="{{{ $detail->exec_date or $today }}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right">Start Date: </td>
                    <td>
                        <div class="input-group date" id="datetimepicker2">
                            <input type="text" name="start_date" id="start-date" class="form-control" value="{{{ $detail->start_date or $today }}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </td>
                    <td align="right">Expire Date: </td>
                    <td>
                        <div class="input-group date" id="datetimepicker3">
                            <input type="text" name="expire_date" id="expire-date" class="form-control" value="{{{ $detail->expire_date or $today }}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-2"> </td>
                    <td class="col-md-4" colspan="3">
                        <input type="submit" name="channel_submit" id="channel-acdata" class="btn btn-primary" value="Save">
                        <input type="reset" class="btn btn-default" value="Cancel">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>

@endsection

@section('extrajs')
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" ></script>
    <script src="{{ url('/js/moment.js') }}"></script>
    <script src="{{ url('/js/bootstrap-datetimepicker.js') }}"></script>
    <script>
        var jq = jQuery.noConflict();
        jq(function () {
            jq('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            jq('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            jq('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endsection