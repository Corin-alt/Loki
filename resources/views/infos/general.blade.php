@extends('template')

@section('title') Informations - Général @endsection

@section('content')
    @if(Auth::check())
        <h4 class="text-center"><strong>Mes informations</strong></h4><br>
        <p class="text-center">
            Bienvenue {{ $user_log->firstname }} {{ $user_log->name }}.<br>
        </p>
        <br>

        <div class="container">
            @if($user_log->role->rle_name == 'Admin')
                <h3 class="text-center">Quel honneur vous êtes l'administateur de Loki :) </h3>
            @else
                <h3 class="mb-4">Formation:</h3>
                <p class="lead mb-2">Voici la formations dans laquelle vous êtes inscrit(e) :</p>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-dark">
                        <div class="d-flex justify-content-between">
                            <p>{{$user_log->formation->fmt_name}}</p>
                        </div>
                    </li>
                    @if($user_log->role->rle_name == 'Étudiant')
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                @if (isset($user_log->groups[0]))
                                    <p>Année: {{$user_log->groups[0]->year->yrs_name}}</p>
                                @endif
                            </div>
                        </li>
                    @elseif($user_log->role->rle_name == 'Responsable' || $user_log->role->rle_name == 'Enseignant')
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <p>Statut: {{$user_log->role->rle_name}}</p>
                            </div>
                        </li>
                    @endif
                </ul>
                <br> <br>
            @endif
        </div>
    @else
        <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter vos informations.</div>
    @endif
@endsection
