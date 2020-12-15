@extends('template')

@section('title') Séances - Consulter @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <br><h4>Information sur une séance</h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Enseignant</th>
                                <td>
                                    <ul>
                                        {{$session->user->firstname}}  {{$session->user->name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Date</th>
                                <td>
                                    <ul>
                                        {{strftime('%d/%m/%Y', strtotime($session->date_start))}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Heure de début et fin</th>
                                <td>
                                    <ul>
                                        {{strftime('%Hh%M', strtotime($session->date_start))}}-{{strftime('%Hh%M', strtotime($session->date_end))}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Groupe</th>
                                <td>
                                    <ul>
                                        {{$session->group->grp_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">EC</th>
                                <td>
                                    <ul>
                                        {{$session->subject->sbj_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Feuille de présence</th>
                                <td>
                                    <ul>
                                        <a id="button-action" class="btn btn-outline-danger" href="{{ route('sessions.download', ['id' => $session->id]) }}">Télécharger</a>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Voir le présentiel</th>
                                <td>
                                    <ul>
                                        <a id="button-action" class="btn btn-outline-primary" href="{{ route('presences.show', ['id' => $session->id]) }}">Voir le présentiel</a>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter une séance.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
