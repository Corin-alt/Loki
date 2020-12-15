@extends('template')

@section('title') Groupes - Éditer @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <div class="card">
                            <div class="card-header">{{ __('Modifier un groupe') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('groups.update', ['id' => $group->id]) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="grp_name" class="col-md-4 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                                        <div class="col-md-6">
                                            <input id="grp_name" type="text" class="form-control @error('grp_name') is-invalid @enderror" name="grp_name" value="{{ $group->grp_name }}" required autocomplete="grp_name" autofocus>
                                            @error('grp_name')
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
                                                <option selected = "selected" >{{$user_log->formation->fmt_name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="year_id" class="col-md-4 col-form-label text-md-right">{{ __('Année') }}</label>
                                        <div class="col-md-6">
                                            <select class="browser-default custom-select" name="year_id" required>
                                                <option value={{$group->year->id}}>{{$group->year->yrs_name}}</option>
                                                @foreach($years as $year)
                                                    <option value={{$year->id}}>{{$year->yrs_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="type_education_id" class="col-md-4 col-form-label text-md-right">{{ __('Type d\'enseignement') }}</label>
                                        <div class="col-md-6">
                                            <select class="browser-default custom-select" name="type_education_id" required>
                                                <option value={{$group->type_education->id}}>{{$group->type_education->te_name}}</option>
                                                @foreach($type_educations as $type_education)
                                                    <option value={{$type_education->id}}>{{$type_education->te_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="usrs" class="col-md-4 col-form-label text-md-right">{{ __('Ajouter des utilisateurs') }}</label>
                                        <div class="col-md-6">
                                            <select class="mul-select" style="width: 100%;" name="usrs[]" multiple="true" required>
                                                @foreach($group->users as $usr)
                                                    <option selected ="selected" value = {{$usr->id}}>{{ $usr->firstname }} {{ $usr->name }}</option>
                                                @endforeach
                                                @foreach($roles as $role)
                                                    <optgroup label="{{ $role->rle_name }}">
                                                        @foreach($role->users->where('formation_id', $user_log->formation->id) as $user)
                                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->name }}</option>
                                                @endforeach
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
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour éditer un groupe.</div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".mul-select").select2({
                placeholder: "  Selectionnez les groupes",
                tags: true,
                tokenSeparators: ['/',',',';'," "]
            });
        })
    </script>
@endsection
