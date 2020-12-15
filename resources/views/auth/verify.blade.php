@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifiez votre adresse mail.') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nouveau lien de vérification a été envoyé sur votre mail.') }}
                        </div>
                    @endif

                    {{ __('Vérifiez votre mail.') }}
                    {{ __('Si vous n\'avez pas reçu la mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Renvoyer un lien de vérification') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
