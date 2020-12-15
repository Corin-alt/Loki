@extends('template')

@section('title') Utilisateurs - Consulter @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin')
                        <br><h4>Information sur un utilisateur </h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Statut</th>
                                <td>
                                    <ul>{{$user->role->rle_name}}</ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Nom & Prenom</th>
                                <td>
                                    <ul>{{$user->firstname}} {{$user->name}}</ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>
                                    <ul> {{$user->email}} </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Formation</th>
                                <td>
                                    @if(isset($user->formation->fmt_name))<ul>{{$user->formation->fmt_name}}</ul>@endif
                                </td>
                            </tr>
                            @if($user->role->rle_name == "Étudiant")
                                <tr>
                                    <th scope="row">Année</th>
                                    <td>
                                        @if(isset($year))<ul>{{$year->yrs_name}}</ul>@endif
                                    </td>
                                </tr>
                            @endif
                            @if($user->role->rle_name == "Enseignant")
                                <tr>
                                    <th scope="row">EC</th>
                                    <td>
                                        <ul>
                                            @foreach($user->subjects as $sbj)
                                                <li>{{$sbj->sbj_name}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th scope="row">Groupe(s)</th>
                                <td>
                                    <ul>
                                        @foreach($user->groups as $grp)
                                            @if($user->role->rle_name == "Enseignant")
                                                <li>{{$grp->grp_name}} ({{$grp->year->yrs_name}})</li>
                                            @else
                                                <li>{{$grp->grp_name}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter un utilisateur.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
