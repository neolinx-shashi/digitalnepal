@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <fieldset>
            <legend>Packages</legend>

            @include('partials.status')

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>S.No.</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Sage</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($count > 0)
                        @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->package_name }}</td>
                            <td>Rs. {{ $val->package_price }}</td>
                            <td>{{ $val->package_sage }}</td>
                            <td>
                                <a href="{{ url('package/' . $val->package_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ url('/deletePackage/' . $val->package_id) }}" class="mright" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="{{ url('/packagedetail/' . $val->package_id) }}" title="Channel List"><span class="glyphicon glyphicon-list-alt"></span></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    {{ $list->links() }}
                </tfoot>
            </table>
        </fieldset>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ $action }} Package</h3></div>
            <div class="panel-body">
                <form action="{{ $route }}" method="post" onsubmit="return validate()">
                    {{ csrf_field() }}
                    @if ($action == 'Edit')
                        {{ method_field('PUT') }}
                    @endif

                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text" name="package_name" id="package-name" class="form-control" value="{{{ $detail->package_name or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="Price">Price: </label>
                        <input type="text" name="package_price" id="package-price" class="form-control" value="{{{ $detail->package_price or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="Sage">Sage: </label>
                        <input type="text" name="package_sage" id="package-sage" class="form-control" value="{{{ $detail->package_sage or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="Order">Order: </label>
                        <input type="number" name="package_order" id="package-order" class="form-control" value="{{{ $detail->package_order or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="Status">Status: </label>
                        <input type="radio" name="package_status" class="package-status" value="1" @if ($action == 'Edit' && $detail->package_status == '1') checked @endif> Active
                        <input type="radio" name="package_status" class="package-status" value="0" @if ($action == 'Edit' && $detail->package_status == '0') checked @endif> Inactive
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                        <input type="reset" class="btn btn-default" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('extrajs')
    <script>
        function validate() {
            var name = $('#package-name').val();
            var price = $('#package-price').val();
            var sage = $('#package-sage').val();
            var order = $('#package-order').val();
            var status = $('.package-status').val();
        }
    </script>
@endsection