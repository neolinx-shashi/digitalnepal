@extends('layouts.app')

@section('content')

<fieldset>
    <legend><a href="{{ url('channel') }}">Channels</a> &rarr; {{ $action }}</legend>
    <a href="{{ url('channel') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-th-list"></span> List</a>
    <div class="clearfix"></div>
    <br>

    <form action="{{ $route }}" method="post" onsubmit="return validate()">
        {{ csrf_field() }}
        @if ($action == 'Edit')
            {{ method_field('PUT') }}
        @endif
            <table class="table table-striped">
                <tr>
                    <td class="col-md-2" align="right">Name: </td>
                    <td class="col-md-4"><input type="text" name="channel_name" id="channel-id" class="form-control" value="{{{ $detail->channel_name or '' }}}"></td>
                    <td class="col-md-2" align="right">Type: </td>
                    <td class="col-md-4"><input type="radio" value="F" name="channel_type" @if ($action == 'Edit' && $detail->channel_type == 'F') checked @endif> Free <input type="radio" value="P" name="channel_type" @if ($action == 'Edit' && $detail->channel_type == 'P') checked @endif> Paid</td>
                </tr>
                <tr>
                    <td align="right">Record: </td>
                    <td><input type="radio" value="1" name="channel_record" @if ($action == 'Edit' && $detail->channel_record == '1') checked @endif> Yes <input type="radio" value="0" name="channel_record" @if ($action == 'Edit' && $detail->channel_record == '0') checked @endif> No</td>
                    <td align="right">Finger: </td>
                    <td><input type="radio" value="1" name="channel_finger" @if ($action == 'Edit' && $detail->channel_finger == '1') checked @endif> Yes <input type="radio" value="0" name="channel_finger" @if ($action == 'Edit' && $detail->channel_finger == '0') checked @endif> No</td>
                </tr>
                <tr>
                    <td align="right">Grade: </td>
                    <td><input type="radio" value="1" name="channel_grade" @if ($action == 'Edit' && $detail->channel_grade == '1') checked @endif> Yes <input type="radio" value="0" name="channel_grade" @if ($action == 'Edit' && $detail->channel_grade == '0') checked @endif> No</td>
                    <td align="right">Preview: </td>
                    <td><input type="radio" value="1" name="channel_preview" @if ($action == 'Edit' && $detail->channel_preview == '1') checked @endif> Yes <input type="radio" value="0" name="channel_preview" @if ($action == 'Edit' && $detail->channel_preview == '0') checked @endif> No</td>
                </tr>
                <tr>
                    <td class="col-md-2" align="right">Acdata: </td>
                    <td class="col-md-4"><input type="text" name="channel_acdata" id="channel-acdata" class="form-control" value="{{{ $detail->channel_acdata or '' }}}"></td>
                    <td class="col-md-2" align="right">Flag: </td>
                    <td class="col-md-4"><input type="radio" value="1" name="channel_flag" @if ($action == 'Edit' && $detail->channel_flag == '1') checked @endif> Yes <input type="radio" value="0" name="channel_flag" @if ($action == 'Edit' && $detail->channel_flag == '0') checked @endif> No</td>
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



@endsection