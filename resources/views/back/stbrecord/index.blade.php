@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <fieldset>
            <legend>STB Record</legend>

            @include('partials.status')

            <a href="{{ url('/stb-record/create') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Add</a>
            <div class="clearfix"></div>
            <br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S. No.</th>
                    <th>STB No.</th>
                    <th>User</th>
                    <th>Executed Date</th>
                    <th>Start Date</th>
                    <th>Expire Date</th>
                    <th>Actions</th>
                </tr>
                </thead>

                @if ($count > 0)
                    <tbody>
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->stb_no }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->exec_date }}</td>
                            <td>{{ $val->start_date }}</td>
                            <td>{{ $val->expire_date }}</td>
                            <td>
                                <a href="{{ url('stb-record/' . $val->stb_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ url('/deleteStbRecord/' . $val->stb_id) }}" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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