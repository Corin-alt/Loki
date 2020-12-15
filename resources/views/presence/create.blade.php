@extends('template')

@section('title') Présentiel - Saisir @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Enseignant' || $user_log->role->rle_name == 'Responsable')
                        <br>
                        <h4> Présentiel du {{strftime('%d/%m/%Y', strtotime($session->date_start))}}
                            de {{strftime('%H:%M', strtotime($session->date_start))}}
                            à {{strftime('%H:%M', strtotime($session->date_end))}} ({{$session->subject->sbj_name}} - {{$session->group->grp_name}})
                            <a href="{{ route('sessions.download', ['id' => $session->id]) }}" class="btn btn-sm btn-outline-danger mb-1 ml-2">Télécharger la feuille de présence</a>
                        </h4>
                        <form method="POST" action="{{ route('presence.post', ['id' => $session->id]) }}">
                            @csrf
                            <table class="table table-striped table-bordered mb-0">
                                <tbody>
                                <tr>
                                    @foreach($session->group->users as $user)
                                        @if($user->role->rle_name == 'Étudiant')
                                            <td>
                                                <p>{{$user->firstname}} {{$user->name}}</p>
                                            </td>
                                            @foreach($states as $state)
                                                <td>
                                                    <div class="form-check-inline">
                                                        <label class="checkbox-inline check">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="presentiel[{{$user->id}}]" value="{{$state->id}}">
                                                            @if($state->stt_name == 'Présentiel')
                                                                <span class="badge badge-success">Présent</span>
                                                            @elseif ($state->stt_name == 'Distanciel')
                                                                <span class="badge badge-info">Distance</span>
                                                            @elseif ($state->stt_name == 'Justifiée')
                                                                <span class="badge badge-warning">Justifiée</span>
                                                            @else
                                                                <span class="badge badge-danger">Absent</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </td>
                                            @endforeach
                                        @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="width: 70%; margin-top: 45px;" class="btn btn-primary">
                                        {{ __('Valider') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable ou Enseignant)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter vos séances.</div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $('input[type="checkbox"]').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
        });
    </script>
@endsection
