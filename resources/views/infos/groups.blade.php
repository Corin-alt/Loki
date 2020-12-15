@extends('template')

@section('title') Informations - Groupes @endsection

@section('content')
    @if(Auth::check())
        @if($user_log->role->rle_name == 'Étudiant')
            <h4 class="text-center"><strong>Mes groupes</strong></h4><br>
            <p class="text-center">Retrouvez ici vos groupes dans vos formations et dans chaque EC.</p>
            <br>
            <section>
                <div class="container">
                    <h3 class="mb-4">Mes groupes dans les EC</h3>
                    <p class="lead mb-2">Voici la liste des groupes dans lesquels vous êtes inscrit(e)s :</p>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-dark">
                            <div class="d-flex justify-content-between">
                                <span> Groupes </span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <ul>
                                    @foreach($user_log->groups as $grp)
                                        <li> {{$grp->grp_name}} ({{$grp->type_education->te_name}})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        @else
            <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Étudiant)</div>
        @endif
    @else
        <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter vos groupes.</div>
    @endif
@endsection

