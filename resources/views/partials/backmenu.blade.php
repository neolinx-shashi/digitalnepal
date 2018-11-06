<ul class="nav navbar-nav">
    &nbsp;@guest

    @else
        <li><a href="{{ url('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
        @if (Auth::user()->type == 'A')
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Modules <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('vendor') }}">Vendors</a></li>
                    <li><a href="{{ url('channel') }}">Channels</a></li>
                    <li><a href="{{ url('package') }}">Packages</a></li>
                    <li><a href="{{ url('stb') }}">STB</a></li>
                    <li><a href="{{ url('stb-record') }}">STB Record</a></li>
                    <li><a href="{{ url('purchase') }}">STB Purchases</a></li>
                    <li><a href="{{ url('deposit') }}">Deposit</a></li>
                    <li><a href="{{ url('wallet') }}">Wallet</a></li>
                    <li><a href="{{ url('commission') }}">Commission</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Config <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Tax</a></li>
                </ul>
            </li>
        @elseif (Auth::user()->type == 'D' || Auth::user()->type == 'F')
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Modules <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('vendor') }}">Vendors</a></li>
                    <li><a href="{{ url('stb-record') }}">STB Record</a></li>
                    <li><a href="{{ url('deposit') }}">Deposit</a></li>
                    <li><a href="{{ url('wallet') }}">Wallet</a></li>
                    <li><a href="{{ url('commission') }}">Commission</a></li>
                </ul>
            </li>
        @elseif (Auth::user()->type == 'S' || Auth::user()->type == 'G')
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Modules <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('vendor') }}">Subscriber</a></li>
                    <li><a href="{{ url('purchase') }}">STB Purchases</a></li>
                    <li><a href="{{ url('wallet') }}">Wallet</a></li>
                    <li><a href="{{ url('commission') }}">Commission</a></li>
                </ul>
            </li>
        @endif
    @endguest

</ul>