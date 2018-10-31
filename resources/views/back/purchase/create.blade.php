@extends('layouts.app')

@section('content')

    <fieldset>
        <legend><a href="{{ url('purchase') }}">Purchases</a> &rarr; {{ $action }}</legend>
        <a href="{{ url('purchase') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-th-list"></span> List</a>
        <div class="clearfix"></div>
        <br>

        <form action="{{ $route }}" method="post" onsubmit="return validate()">
            {{ csrf_field() }}
            @if ($action == 'Edit')
                {{ method_field('PUT') }}
            @endif
            <table class="table table-striped">
                <tr>
                    <td class="col-md-2" align="right">Customer: </td>
                    <td class="col-md-4">
                        <select name="user_id" id="user-id" class="form-control">
                            <option value="0">Select Customer</option>
                            @foreach ($user as $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="col-md-2" align="right">STB: </td>
                    <td class="col-md-4">
                        <select name="stb_id" id="stb-id" class="form-control">
                            <option value="0">Select STB</option>
                            @foreach ($stb as $val)
                                <option value="{{ $val->stb_id }}">{{ $val->stb_no }}</option>
                            @endforeach    
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">Purchase Date: </td>
                    <td>
                        <div class="input-group date" id="datetimepicker2">
                            <input type="text" name="purchase_date" id="purchase-date" class="form-control" value="{{{ $detail->start_date or $today }}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </td>
                    <td align="right">Expire Date: </td>
                    <td>
                        <div class="input-group date" id="datetimepicker3">
                            <input type="text" name="purchase_expire" id="purchase-expire" class="form-control" value="{{{ $detail->expire_date or $today }}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="col-md-2"> </td>
                    <td class="col-md-4" colspan="3">
                        <input type="hidden" name="seller_id" value="{{ $uid }}">
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

            jq('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            jq('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>

@endsection