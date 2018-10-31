@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <fieldset>
            <legend>Channels</legend>

            @include('partials.status')

            <a href="{{ url('/channel/create') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Add</a>
            <div class="clearfix"></div>
            <br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Record</th>
                    <th>Finger</th>
                    <th>Grade</th>
                    <th>Preview</th>
                    <th>Acdata</th>
                    <th>Flag</th>
                    <th>Actions</th>
                </tr>
                </thead>

                @if ($count > 0)
                <tbody>
                @foreach ($list as $key => $val)
                    <tr>
                        <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                        <td>{{ $val->channel_name }}</td>
                        <td>
                            @if ($val->channel_type == 'F') Free @else Paid @endif
                        </td>
                        <td>@if ($val->channel_record == '1') Yes @else No @endif</td>
                        <td>@if ($val->channel_finger == '1') Yes @else No @endif</td>
                        <td>@if ($val->channel_grade == '1') Yes @else No @endif</td>
                        <td>@if ($val->channel_preview == '1') Yes @else No @endif</td>
                        <td>{{ $val->channel_acdata }}</td>
                        <td>@if ($val->channel_flag == '1') Yes @else No @endif</td>
                        <td>
                            <a href="{{ url('channel/' . $val->channel_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="{{ url('/deleteChannel/' . $val->channel_id) }}" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot><tr><td>{{ $list->links() }}</td></tr></tfoot>
                @endif
            </table>
        </fieldset>
    </div>

@endsection

@section('extrajs')


@endsection