@extends('template')

@section('title') Séances - Ajouter @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <div class="card">
                            <div class="card-header">{{ __('Ajouter une séance') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('sessions.post') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('EC') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-subject" class="browser-default custom-select" name="subject_id" required>
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
                                                @foreach($years as $year)
                                                    <optgroup label="{{ $year->yrs_name }}">
                                                        @foreach($groups->where('year_id', $year->id) as $grp)
                                                            <option value="{{ $grp->id }}">{{ $grp->grp_name }}</option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Enseignant') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-teacher" class="browser-default custom-select" name="user_id" required>
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
                                                {{ __('Ajouter') }}
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
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour ajouter une séance.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

