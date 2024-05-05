<nav id="navigation">
    <div class="container">
        <ol class="breadcrumb">
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
            @if (!Request::is('/'))
                <li class="{{ Request::routeIs('car.detail') ? 'active' : '' }}">Detail Mobil</li>
            @endif
        </ol>
    </div>
</nav>
