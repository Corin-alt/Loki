@extends('template')

@section('title') Présentiel - Consulter @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Enseignant' || $user_log->role->rle_name == 'Responsable')
                        <br>
                        <h4> Présentiel du {{strftime('%d/%m/%Y', strtotime($session->date_start))}}
                            de {{strftime('%H:%M', strtotime($session->date_start))}}
                            à {{strftime('%H:%M', strtotime($session->date_end))}}
                            ({{$session->subject->sbj_name}} - {{$session->group->grp_name}})
                        </h4>
                        @csrf
                        <table class="table table-striped table-bordered mb-0">
                            <tbody>
                            <tr>
                                @foreach($session->group->users as $user)
                                    @if($user->role->rle_name == 'Étudiant')
                                        @php $pre_user = $presentiel->where('session_id', $session->id)->where('user_id', $user->id)->first(); @endphp
                                        <td><p>{{$user->firstname}} {{$user->name}}</p></td>
                                        <td>
                                            @if(isset($pre_user))
                                                @if($pre_user->state->stt_name == 'Présentiel')
                                                    <span class="badge badge-success">Présent</span>
                                                @elseif ($pre_user->state->stt_name == 'Distanciel')
                                                    <span class="badge badge-info">Distance</span>
                                                @elseif ($pre_user->state->stt_name == 'Justifiée')
                                                    <span class="badge badge-warning">Justifiée</span>
                                                @else
                                                    <span class="badge badge-danger">Absent</span>
                                                @endif
                                            @else
                                                <span class="badge badge-secondary">Non renseigné</span>
                                            @endif
                                        </td>
                                    @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable ou Enseignant)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter vos séances.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
