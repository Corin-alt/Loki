@extends('template')

@section('title') Mon présentiel  @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Étudiant')
                            <h4> Mon présentiel</h4>
                            @foreach($all_subjects as $subject)
                                <h5 class="list-group-item list-group-item-success">{{$subject->sbj_name}}</h5>
                                @foreach($type_educations as $te)
                                    <h6 class="list-group-item list-group-item-primary">{{$te->te_name}}</h6>
                                    @foreach($user_log->groups->where('type_education_id', $te->id) as $group)
                                        @foreach($group->sessions->where('subject_id', $subject->id) as $session)
                                            <div class="table">
                                                <table class="table table-striped table-bordered mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-size: 15px;">Séance du {{strftime('%d/%m/%Y', strtotime($session->date_start))}}
                                                            de {{strftime('%H:%M', strtotime($session->date_start))}}
                                                            à {{strftime('%H:%M', strtotime($session->date_end))}}
                                                        </td>
                                                        <td>
                                                            @php $pre_user = $presences->where('session_id', $session->id)->where('user_id', $user_log->id)->first(); @endphp
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
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{$all_subjects->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Étudiant)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter vos séances.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

