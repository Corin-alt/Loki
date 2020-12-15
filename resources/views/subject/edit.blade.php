@extends('template')

@section('title') EC - Éditer @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <div class="card">
                            <div class="card-header">{{ __('Modifier un EC') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('subjects.update', ['id' => $subject->id]) }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="sbj_name" class="col-md-4 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                                        <div class="col-md-6">
                                            <input id="sbj_name" type="text" class="form-control @error('sbj_name') is-invalid @enderror" name="sbj_name" value="{{ $subject->sbj_name }}" required autocomplete="sbj_name" autofocus>
                                            @error('sbj_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="formation_id" class="col-md-4 col-form-label text-md-right">{{ __('Formation') }}</label>
                                        <div class="col-md-6">
                                            <select class="browser-default custom-select" name="formation_id" disabled>
                                                <option selected = "selected" >{{$subject->formation->fmt_name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="year_id" class="col-md-4 col-form-label text-md-right">{{ __('Année') }}</label>
                                        <div class="col-md-6">
                                            <select class="browser-default custom-select" name="year_id" required>
                                                <option selected="selected" value="{{$subject->year->id}}">{{$subject->year->yrs_name}}</option>
                                                @foreach($years as $year)
                                                    <option value={{$year->id}}>{{$year->yrs_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Enseignants') }}</label>
                                        <div class="col-md-6">
                                            <select class="mul-select" style="width: 100%;" name="usrs[]" multiple="true" required>
                                                @foreach($subject->users as $usr)
                                                    <option selected = "selected" value={{$usr->id}}>{{$usr->firstname}} {{$usr->name}}</option>
                                                    @endforeach
                                                @foreach($teachers as $teacher)
                                                    <option value={{$teacher->id}}>{{$teacher->firstname}} {{$teacher->name}}</option>
                                                @endforeach
                                            </select>
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
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour éditer un EC.</div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".mul-select").select2({
                placeholder: "  Selectionnez les enseignants",
                tags: true,
                tokenSeparators: ['/',',',';'," "]
            });
        })
    </script>
@endsection
