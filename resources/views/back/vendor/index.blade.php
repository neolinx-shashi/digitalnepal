@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <fieldset>
            <legend>Users</legend>

            @include('partials.status')

            <div class="col-md-12">
                <form>
                    <div class="col-md-4 pull-right">
                        <select name="type_choose" id="type-choose" class="form-control" onchange="listByType(this)">
                            <option value="0">All</option>
                            @foreach ($type as $key => $val)
                                <option value="{{ $key }}" @if (isset($t) && $t == $key) selected @endif>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                </form>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th width="100">Actions</th>
                </tr>

                @if (count($list) > 0)
                    @foreach ($list as $key => $val)
                        <tr>
                            <td>{{ ($key + 1) * ($pageno + 1) }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->email }}</td>
                            <td>
                                @if ($val->type == 'F')
                                    Franchisee
                                @elseif ($val->type == 'D')
                                    Distributor
                                @elseif ($val->type == 'R')
                                    Subscriber
                                @elseif ($val->type == 'V')
                                    Vendor
                                @elseif ($val->type == 'S')
                                    Subvendor
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('vendor/' . $val->id . '/edit') }}" class="mright" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ url('/deleteVendor/' . $val->id) }}" onclick="return confirm('Delete this record?')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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
                        <input type="text" name="name" id="name" class="form-control" value="{{{ $detail->name or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" class="form-control" value="{{{ $detail->email or '' }}}">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="type">Type: </label>
                        <select name="type" id="type" class="form-control">
                            <option value="0">Select User Type</option>
                            @foreach ($type as $key => $val)
                                <option value="{{ $key }}" @if ($action == 'Edit' && $key == $detail->type) selected="selected" @endif>{{ $val }}</option>
                            @endforeach
                        </select>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm password">Confirm Password: </label>
                        <input type="password" id="cpassword" class="form-control">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary pull-right" onclick="generatePassword()" type="button">Generate Password</button>
                        <span class="show-password"></span>
                        <div class="clearfix"></div>
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
            var name = $('#name').val();
            var email = $('#email').val();
            var type = $('#type').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            var msg = 'This field can not be empty';
            var msg2 = 'Please select a value.';
            var action = "{{ $action }}";

            if (name == '') {
                $('#name').siblings('.error').text(msg);
                return false;
            } else {
                $('#name').siblings('.error').text('');
            }

            if (email == '') {
                $('#email').siblings('.error').text(msg);
                return false;
            } else if (validateEmail(email) == false) {
                $('#email').siblings('.error').text('Invalid Email.');
                return false;
            } else {
                $('#email').siblings('.error').text('');
            }
            if (type == '0') {
                $('#type').siblings('.error').text(msg2);
                return false;
            } else {
                $('#type').siblings('.error').text('');
            }

            if (action == 'Add') {
                if (password == '') {
                    $('#password').siblings('.error').text(msg);
                    return false;
                } else {
                    $('#password').siblings('.error').text('');
                }
                if (cpassword == '') {
                    $('#cpassword').siblings('.error').text(msg);
                    return false;
                } else {
                    $('#cpassword').siblings('.error').text('');
                }
            }

            if (password != cpassword) {
                $('#password, #cpassword').val('');
                $('#password').siblings('.error').text('Password does not match');
                return false;
            }
        }

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function generatePassword() {
            var url = "{{ url('/generate-password') }}";
            $.get(url, function(res) {
                $('#password, #cpassword').val(res);
                //$('.show-password').text(res);
            });
        }

        function listByType(ctrl) {
            var type = $(ctrl).val();
            var url = "{{ url('vendor-type') }}/" + type;
            window.location.href = url;
        }
    </script>
@endsection