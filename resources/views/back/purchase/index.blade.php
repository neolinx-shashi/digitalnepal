@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <fieldset>
            <legend>STB Purchases</legend>

            @include('partials.status')

            <a href="{{ url('/purchase/create') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Add</a>
            <div class="clearfix"></div>
            <br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S. No.</th>
                    <th>STB No.</th>
                    <th>Package</th>
                    <th>Subscriber</th>
                    <th>Seller</th>
                    <th>Purchase Date</th>
                    <th>Expire Date</th>
                    <th>Actions</th>
                </tr>
                </thead>

                @if ($count > 0)
                    <tbody>
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->stb_number }}</td>
                            <td>{{ $val->package_name }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $uname }}</td>
                            <td>{{ $val->purchase_date }}</td>
                            <td>{{ $val->purchase_expire }}</td>

                            <td>
                                <a href="{{ url('purchase/' . $val->purchase_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ url('/deletePurchase/' . $val->purchase_id) }}" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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