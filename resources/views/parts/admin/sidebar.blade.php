<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if(Auth::user()->user_type == '1x101')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/author-category/list') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Author Category</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/author/list') }}">
            <i class="fas fa-fw fa-pen"></i>
            <span>Author</span>
        </a>
    </li>
    @endif
    {{--<li class="nav-item dropdown">--}}
        {{--<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--<i class="fas fa-fw fa-folder"></i>--}}
            {{--<span>Author</span>--}}
        {{--</a>--}}
        {{--<div class="dropdown-menu" aria-labelledby="pagesDropdown">--}}
            {{--<h6 class="dropdown-header">Login Screens:</h6>--}}
            {{--<a class="dropdown-item" href="login.html">Login</a>--}}
            {{--<a class="dropdown-item" href="register.html">Register</a>--}}
            {{--<a class="dropdown-item" href="forgot-password.html">Forgot Password</a>--}}
            {{--<div class="dropdown-divider"></div>--}}
            {{--<h6 class="dropdown-header">Other Pages:</h6>--}}
            {{--<a class="dropdown-item" href="404.html">404 Page</a>--}}
            {{--<a class="dropdown-item active" href="blank.html">Blank Page</a>--}}
        {{--</div>--}}
    {{--</li>--}}
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>
</ul>