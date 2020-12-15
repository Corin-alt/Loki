@extends('template')

@section('title') Utilisateurs - Éditer @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin')
                        <div class="card">
                            <div class="card-header">{{ __('Modifier un utilisateur') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                                    @csrf

                                    @if(Auth::user()->role->rle_name == 'Admin')
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom de famille') }}</label>
                                            <div class="col-md-6">
                                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>
                                                @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div id= "select-role" class="form-group row">
                                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                            <div class="col-md-6">
                                                <select class="browser-default custom-select" name="role_id">
                                                    <option selected="selected" value="{{$user->role->id}}">{{$user->role->rle_name}}</option>
                                                    @foreach($roles as $role)
                                                        @if($role->id != 1)<option value={{$role->id}}>{{$role->rle_name}}</option>@endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div id= "select-formation" class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Formation') }}</label>
                                            <div class="col-md-6">
                                                <select id="select-role" class="browser-default custom-select" name="formation_id">
                                                   @if(isset($user->formation->id)) <option selected="selected" value="{{$user->formation->id}}">{{$user->formation->fmt_name}}</option> @endif
                                                    @foreach($formations as $formation)
                                                        <option value="{{ $formation->id }}">{{ $formation->fmt_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    @elseif($user_log->role->rle_name == 'Responsable')
                                        <div id= "select-groups" class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Ajouter aux groupes') }}</label>
                                            <div class="col-md-6">
                                                <select class="mul-select" style="width: 100%;" name="grps[]" multiple="true">
                                                    @foreach($formations as $formation)
                                                        <optgroup label="{{ $formation->fmt_name }}">
                                                            @foreach(Group::where('formation_id', $formation->id)->orderBY('year_id', 'asc')->get() as $group)
                                                                <option value="{{ $group->id }}">{{ $group->grp_name }}</option>
                                                    @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

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
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour éditer un utilisateur.</div>
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


