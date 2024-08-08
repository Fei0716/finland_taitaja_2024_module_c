<header>
    <nav class="navbar navbar-expand bg-dark text-white mb-5" role="navigation">
        <div class="container-fluid d-flex justify-content-between">
            <a href="{{route('login')}}" class="navbar-brand text-white">Intranet</a>
            @if(Auth::user())
            <ul class="navbar-nav d-flex justify-content-center gap-2">
                    @if(Auth::user()->role == 'superuser')
                        <li><a href="{{route('users.index')}}" class=" btn btn-light">Users</a></li>
                        <li><a href="{{route('games.index')}}" class=" btn btn-light">Games</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" id="form-logout">
                                @csrf
                                <a href="#" class="btn btn-light" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
                            </form>
                        </li>
                    @elseif(Auth::user()->role == 'user')
                        <li><a href="{{route('games.index')}}" class=" btn btn-light">Games</a></li>
                        <li><a href="{{route('users.show' , Auth::user())}}" class=" btn btn-light">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" id="form-logout">
                                @csrf
                                <a href="#" class="btn btn-light" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
                            </form>
                        </li>
                    @endif
            </ul>
            <div class="text-white h4 my-auto">{{Auth::user()->name}}</div>
            @endif
        </div>
    </nav>
</header>
