@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <fieldset>
            <legend>Stbs</legend>

            @include('partials.status')

            <table class="table table-striped">
                <thead>
                <tr>
                    <td>S.No.</td>
                    <td>Stb Number</td>
                    <td>Status</td>
                    <!--<td>Actions</td>-->
                </tr>
                </thead>
                <tbody>
                @if ($count > 0)
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->stb_number }}</td>
                            <td>{{ $val->stb_status }}</td>
                            <!--<td>
                                <a href="{{ url('stb/' . $val->stb_id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ url('/deleteStb/' . $val->stb_id) }}" class="mright" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>-->
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
            <div class="panel-heading"><h3 class="panel-title">{{ $action }} Stb</h3></div>
            <div class="panel-body">
                <form action="{{ $route }}" method="post" enctype="multipart/form-data" onsubmit="return validate()">
                    {{ csrf_field() }}
                    @if ($action == 'Edit')
                        {{ method_field('PUT') }}
                    @endif

                    <!--
                    <div class="form-group">
                        <label for="Status">Status: </label>
                        <input type="radio" name="stb_status" class="stb-status" value="1" @if ($action == 'Edit' && $detail->stb_status == '1') checked @endif> Active
                        <input type="radio" name="stb_status" class="stb-status" value="0" @if ($action == 'Edit' && $detail->stb_status == '0') checked @endif> Inactive
                    </div>
                    -->

                     <div class="form-group">
                        <label for="Status">Import: </label>
                         <input type="file" name="stb_file" class="form-control">
                     </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Import">
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
            var status = $('.stb-status').val();
        }
    </script>
@endsection