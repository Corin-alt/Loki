@extends('template')

@section('title') Séances - Éditer @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <div class="card">
                            <div class="card-header">{{ __('Modifier une séance') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('sessions.update', ['id' => $session->id]) }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('EC') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-subject" class="browser-default custom-select" name="subject_id" required>
                                                <option selected="selected" value="{{$session->subject->id}}">{{$session->subject->sbj_name}}</option>
                                                @foreach($years as $year)
                                                    <optgroup label="{{ $year->yrs_name }}">
                                                        @foreach($subjects->where('year_id', $year->id) as $sbj)
                                                            <option value="{{ $sbj->id }}">{{ $sbj->sbj_name }}</option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Groupe') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-subject" class="browser-default custom-select" name="group_id" required>
                                                <option selected="selected" value="{{$session->groups[0]->id}}">{{$session->groups[0]->grp_name}}</option>
                                                @foreach($years as $year)
                                                    <optgroup label="{{ $year->yrs_name }}">
                                                        @foreach($groups->where('year_id', $year->id) as $grp)
                                                            <option value="{{ $grp->id }}">{{ $grp->grp_name }}</option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div  class="form-group row">
                                        <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Enseignant') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-teacher" class="browser-default custom-select" name="user_id" required>
                                                <option selected="selected" value="{{$session->user->id}}">{{$session->user->firstname}}  {{$session->user->name}}</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->firstname }} {{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date_start" class="col-md-4 col-form-label text-md-right">{{ __('Date de début') }}</label>
                                        <div class="col-md-6">
                                            <input type="datetime-local" class="form-control" name="date_start" id="date_start" placeholder="Saisir la date de début de la séance" required/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date_end" class="col-md-4 col-form-label text-md-right">{{ __('Date de fin') }}</label>
                                        <div class="col-md-6">
                                            <input type="datetime-local" class="form-control" name="date_end" id="date_end" placeholder="Saisir la date de fin de la séance" required/>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Modifier') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour éditer une séance.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

