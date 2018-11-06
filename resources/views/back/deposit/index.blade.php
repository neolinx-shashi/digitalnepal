@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <fieldset>
            <legend>Deposit</legend>

            @include('partials.status')

            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Deposit Amount</th>
                    <th>Deposit Type</th>
                    <th>Date</th>
                    <th width="100">Actions</th>
                </tr>

                @if (count($list) > 0)
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->name }}</td>
                            <td align="right">{{ $val->deposit_amount }}</td>
                            <td>
                                @if ($val->deposit_type == 'T')
                                    Top up
                                @elseif ($val->deposit_type == 'D')
                                    Device
                                @elseif ($val->deposit_type == 'S')
                                    Security
                                @endif
                            </td>
                            <td>{{ date("M d, Y", strtotime($val->created_at)) }}</td>
                            <td>
                                <a href="{{ url('deposit/' . $val->deposit_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <!--<a href="{{ url('/deleteVendor/' . $val->id) }}" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>-->
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="4" align="center">No Data Fond.</td></tr>
                @endif

                @if ($count > 20)
                    <tr>
                        <td colspan="5" align="right">{{ $list->links() }}</td>
                    </tr>
                @endif
            </table>
        </fieldset>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ $action }} User</h3></div>
            <div class="panel-body">
                <form action="{{ $route }}" method="post" onsubmit="return validate()">
                    {{ csrf_field() }}
                    @if ($action == 'Edit')
                        {{ method_field('PUT') }}
                    @endif

                    <div class="form-group">
                        <label for="name">Name: </label>
                        <select name="user_id" id="user-id" class="form-control">
                            <option value="0">Select Vendor</option>
                            @foreach ($franchise as $key => $val)
                                <option value="{{ $val->id }}" @if ($action == 'Edit' && $detail->name == $val->name) selected @endif>{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="amount">Deposit Amount: </label>
                        <input type="number" name="deposit_amount" id="deposit-amount" class="form-control" value="{{{ $detail->deposit_amount or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="type">Deposit Type: </label>
                        <select name="deposit_type" id="deposit-type" class="form-control">
                            <option value="0">Select Deposit Type</option>
                            @foreach ($type as $key => $val)
                                <option value="{{ $key }}" @if ($action == 'Edit' && $key == $detail->deposit_type) selected="selected" @endif>{{ $val }}</option>
                            @endforeach
                        </select>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-primary">
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
            var user = $('#user-id').val();
            var deposit = $('#deposit-amount').val();
            var type = $('#deposit-type').val();
            var msg = 'This field can not be empty';
            var msg2 = 'Please select a value.';

            if (user == '') {
                $('#user-id').siblings('.error').text(msg);
                return false;
            } else {
                $('#user-id').siblings('.error').text('');
            }

            if (deposit == '') {
                $('#deposit-amount').siblings('.error').text(msg);
                return false;
            } else {
                $('#deposit-amount').siblings('.error').text('');
            }
            if (type == '0') {
                $('#deposit-type').siblings('.error').text(msg2);
                return false;
            } else {
                $('#deposit-type').siblings('.error').text('');
            }


        }
    </script>
@endsection