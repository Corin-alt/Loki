@extends('template')

@section('title') Groupes - Consulter @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <br><h4> Information sur le groupe</h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Intitulé</th>
                                <td>
                                    <ul>
                                        {{$group->grp_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Formation</th>
                                <td>
                                    <ul>
                                        {{$group->formation->fmt_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Année</th>
                                <td>
                                    <ul>
                                        {{$group->year->yrs_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Enseignants</th>
                                <td>
                                    <ul>
                                        @foreach($teachers as $user)
                                            @if(isset($user))
                                                <li>{{$user->firstname}} {{$user->name}} ({{$user->email}})</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Étudiants</th>
                                <td>
                                    <ul>
                                        @foreach($students as $user)
                                            @if(isset($students))
                                                <li>{{$user->firstname}} {{$user->name}} ({{$user->email}})</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter un groupe.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
