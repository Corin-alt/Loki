@extends('template')

@section('title') Utilisateurs - Ajouter @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin')
                        <div class="card">
                            <div class="card-header">{{ __('Ajouter un utilisateur') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.post') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom de famille') }}</label>
                                        <div class="col-md-6">
                                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
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
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-role" class="browser-default custom-select" name="role_id" required>
                                                @foreach($roles as $role)
                                                    <option value={{$role->id}}>{{$role->rle_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id= "select-formation" style="display:none;" class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Formation') }}</label>
                                        <div class="col-md-6">
                                            <select id="select-role" class="browser-default custom-select" name="formation_id">
                                                @foreach($formations as $formation)
                                                    <option value="{{ $formation->id }}">{{ $formation->fmt_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmez le mot de passe') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour ajouter un utilisateur.</div>
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

        $(document).ready(function(){
            $('#select-role').on('change', function() {
                if(this.value != '1'){
                    $("#select-formation").show();
                } else {
                    $("#select-formation").hide();
                }
            });
        });

    </script>
@endsection

