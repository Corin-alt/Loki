@extends('template')

@section('title') Mes séances @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Enseignant' || $user_log->role->rle_name == 'Responsable')
                        @foreach($subjects as $subject)
                            @php $sbj = $all_subject->where('id', $subject->subject_id)->first();@endphp
                            <br><h4> Séances de {{$sbj->sbj_name}}</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Groupe</th>
                                    <th>Séances</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_log->groups as $group)
                                    @php $exist = $all_sessions->where('user_id', $user_log->id)->where('group_id', $group->id)->where('subject_id', $sbj->id)->first(); @endphp
                                    @if(isset($exist))
                                    <tr>
                                        <td>{{$group->grp_name}}</td>
                                        <td>
                                            <ul>
                                                @foreach($all_sessions->where('user_id', $user_log->id)->where('subject_id', $sbj->id)->where('group_id', $group->id) as $session)
                                                    <li>
                                                        le {{strftime('%d/%m/%Y', strtotime($session->date_start))}} de {{strftime('%H:%M', strtotime($session->date_start))}} à {{strftime('%H:%M', strtotime($session->date_end))}}
                                                        @php $pr = $presences->where('session_id', $session->id)->first()@endphp
                                                        @if(isset($pr))
                                                            <a id="button-action" class="btn btn-sm btn-outline-primary" href="{{ route('presence.edit', ['id' => $session->id]) }}">Éditer / Consulter le présentiel</a>
                                                        @else
                                                            <a id="button-action" class="btn btn-sm btn-outline-danger" href="{{ route('presence.create', ['id' => $session->id]) }}">Saisir le présentiel</a>
                                                        @endif
                                                    </li><br>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        @endforeach
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{$subjects->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
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
