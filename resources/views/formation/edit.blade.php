@extends('template')

@section('title') Formations - Éditer @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin')
                        <div class="card">
                            <div class="card-header">{{ __('Modifer une formation') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('formations.update', ['id' => $formation->id]) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="fmt_name" class="col-md-4 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                                        <div class="col-md-6">
                                            <input id="fmt_name" type="text" class="form-control @error('grp_name') is-invalid @enderror" name="fmt_name" value="{{ $formation->fmt_name}}" required autocomplete="fmt_name" autofocus>
                                            @error('grp_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
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
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour éditer une formation.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
