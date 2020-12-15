<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
        <a class="navbar-brand mb-1" href={{ route('welcome') }}>Accueil</a>
        <ul class="navbar-nav mb-1 ml-4">
            @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="section_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon espace
                    </a>
                    <div class="dropdown-menu" aria-labelledby="section_1">
                        <a class="dropdown-item" href={{ route('general.infos')}}>Mes informations</a>
                        @if(Auth::user()->role->rle_name === 'Admin')
                            <a class="dropdown-item" href={{ route('formations.list') }}>Les formations</a>
                            <a class="dropdown-item" href={{ route('users.list') }}>Les utilisateurs</a>

                        @elseif(Auth::user()->role->rle_name === 'Responsable')
                            <a class="dropdown-item" href={{ route('general.sessions')}}>Mes séances</a>
                            <a class="dropdown-item" href={{ route('formations.show', ["id"=> Auth::user()->formation->id]) }}>La formation</a>
                            <a class="dropdown-item" href={{ route('subjects.list') }}>Les EC</a>
                            <a class="dropdown-item" href={{ route('groups.list') }}>Les groupes</a>
                            <a class="dropdown-item" href={{ route('sessions.list') }}>Les séances</a>

                        @elseif(Auth::user()->role->rle_name === 'Enseignant')
                            <a class="dropdown-item" href={{ route('general.sessions')}}>Mes séances</a>

                        @else
                            <a class="dropdown-item" href={{ route('general.groups')}}>Mes groupes</a>
                            <a class="dropdown-item" href={{ route('general.presentiel')}}>Mon présentiel</a>
                        @endif
                    </div>
                </li>
            @endif
            <li class="nav-item active">
                @if(Auth::check())
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger mb-1 ml-4">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
                @endif
            </li>
        </ul>
    </div>
</nav>


