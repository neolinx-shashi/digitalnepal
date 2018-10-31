@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <fieldset>
            <legend>Wallet</legend>

            @include('partials.status')

            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th width="100">Actions</th>
                </tr>

                @if (count($list) > 0)
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->name }}</td>
                            <td align="right">{{ $val->wallet_amount }}</td>
                            <td>{{ date("M d, Y", strtotime($val->created_at)) }}</td>
                            <td>
                                <a href="{{ url('wallet/' . $val->wallet_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
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
                        <select name="wallet_to" id="wallet-to" class="form-control">
                            <option value="0">Select Subordinate</option>
                            @foreach ($subordinate as $key => $val)
                                <option value="{{ $val->id }}" @if ($action == 'Edit' && $detail->wallet_to == $val->id) selected @endif>{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="remaining">Remaining Deposit:</label>
                        <input type="text" readonly class="form-control" id="remaining" value="{{ $remaining }}">
                    </div>

                    <div class="form-group">
                        <label for="amount">Top-up Amount: </label>
                        <input type="number" name="wallet_amount" id="wallet-amount" class="form-control" value="{{{ $detail->wallet_amount or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="wallet_from" id="wallet-from" value="{{ $userId }}">
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
            var user = $('#wallet-to').val();
            var remaining = $('#remaining').val();
            var amount = $('#wallet-amount').val();
            var type = $('#deposit-type').val();
            var msg = 'This field can not be empty';
            var msg2 = 'Please select a value.';

            if (amount == '') {
                $('#wallet-amount').siblings('.error').text(msg);
                return false;
            } else {
                $('#wallet-amount').siblings('.error').text('');
            }
            if (user == '0') {
                $('#wallet-to').siblings('.error').text(msg2);
                return false;
            } else {
                $('#wallet-to').siblings('.error').text('');
            }

            if (amount > remaining) {
                $('#user-id').siblings('.error').text('Amount exceeded the deposit amount.');
                return false;
            } else {
                $('#user-id').siblings('.error').text('');
            }

        }


    </script>
@endsection