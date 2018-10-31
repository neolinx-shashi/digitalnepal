@if (null != Session::get('status'))
    <div class="alert @if (Session::get('stat') == 1) alert-success @else alert-danger @endif" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ Session::get('status') }}</div>
@endif