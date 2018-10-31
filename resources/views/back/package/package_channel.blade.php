@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <fieldset>
        <legend>{{ $package->package_name }}</legend>

        <a href="{{ url('/package') }}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-th-list"></span> List</a>
        <div class="clearfix"></div>

        <div class="col-md-4">
            <h4>All Channels</h4>
            @foreach ($channel_list as $key => $val)
                @php $dis = ''; @endphp
                @foreach ($rc as $rval)
                    @if ($val->channel_id == $rval->channel_id)
                        @php $dis = 'disabled="disabled"'; @endphp
                    @endif
                @endforeach
                <div class="btn btn-primary col-md-12 channel-list pc-list" id="{{ $val->channel_id }}" {{ $dis }}>{{ $val->channel_name }}</div>
            @endforeach
        </div>
        <div class="col-md-4 package-channels">
            <h4>Package Channels</h4>
            @if ($count > 0)
                @foreach ($list as $key => $val)
                    <div class="btn btn-default col-md-12 pc-list pc-channel-list" id="{{ $val->channel_id }}">{{ $val->channel_name }}</div>
                @endforeach
            @endif
        </div>
        <div class="col-md-4">
            <br><br>
            <form action="{{ url('/packagedetail/'.$pid) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="pid" name="pid" value="{{ $pid }}">
                <input type="hidden" id="cid" name="cid">
                <input type="button" class="btn btn-success save" value="Save">
                <input type="button" class="btn btn-secondary cancel" value="Cancel">
            </form>
        </div>
    </fieldset>
</div>

@endsection

@section('extrajs')

    <script>
        $('.channel-list').click(function() {
            var id = $(this).attr('id');
            var name = $(this).text();
            var content = '<div class="btn btn-default col-md-12 pc-list pc-channel-list" id="'+ id +'" onclick="removeChannel(this, '+ id +')">'+ name +'</div>';
            var dis = $(this).attr('disabled');
            if (dis !== 'disabled') {
                $('.package-channels').append(content);
                $(this).attr('disabled', 'disabled');
            }
        });

        $('.pc-channel-list').click(function() {
            $(this).remove();
            var id = $(this).attr('id');
            $(".channel-list#"+id).removeAttr('disabled');
        });

        function removeChannel(ctrl, cid) {
            $(ctrl).remove();
            $(".channel-list#"+cid).removeAttr('disabled');
        }

        $('.cancel').click(function() {
            $('.package-channels').html('').html('<h4>Package Channels</h4>');
            $('.channel-list').removeAttr('disabled');
        });

        $('.save').click(function() {
            var cid = '';
            $('.package-channels .pc-channel-list').each(function(index) {
                cid += $(this).attr('id') + ',';
            });
            $('#cid').val(cid);
            $('form').submit();
        });
    </script>

@endsection