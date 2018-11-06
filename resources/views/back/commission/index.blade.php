@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <fieldset>
            <legend>Commission</legend>

            @include('partials.status')

            <div class="col-md-3 pull-right">
                <form>
                    <select name="commission_type" id="commission-type" class="form-control" onchange="getByType()">
                        <option value="0">- Select Commission Type -</option>
                        <option value="P">New Purchase</option>
                        <option value="T">Topup</option>
                    </select>
                </form>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-2 pull-right"><b>Total: Rs. {{ $total }}</b></div>
            <div class="clearfix"></div>
            <br>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>From</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @if ($count > 0)
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->commission_amount }}</td>
                            <td>@if ($val->purchase_type == 'P') New @else Topup @endif</td>
                            <td>{{ date("M d, Y", strtotime($val->created_at)) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr align="center"><td colspan="4">No Data.</td></tr>
                @endif

                @if ($count > 20)
                    <tr>
                        <td colspan="4" align="right">{{ $list->links() }}</td>
                    </tr>
                @endif
                </tbody>
            </table>


        </fieldset>
    </div>

@endsection

@section('extrajs')

    <script>
        function getByType() {
           var type = $('#commission-type').val();
            var url = "{{ url('commission-by-type') }}/" + type;

        }
    </script>

@endsection