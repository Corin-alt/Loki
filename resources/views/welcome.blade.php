@extends('template')

@section('title') Accueil @endsection

@section('content')
    <section>
        <img class="img-fluid" style="width: 100%;" src="{{ asset('img/bg.jpg') }}" alt="img-welcome1">
        <div class="container">

            <div class="row">
                <div class="col-xl-12">
                    <h1 class="text-center">Loki - The House of Results</h1>
                    <h2 class="text-center lead mb-5">URCA - UFR Sciences Inexactes et Artificielles</h2>

                </div>
            </div>
        </div>
    </section>
    <div style="margin-top: 50px;">
        <img class="rounded float-right" style="width: 50%; height: 20%;" src="{{ asset('img/amphi.jpg') }}" alt="img-welcome1">
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
            <h2>Présentation</h2>
            <p class="lead mb-85">
                Cette application est réservée pour les étudiants de l'UFR Sciences Inexactes et Artificielles.
                Ils peuvent y consulter leur présentiel.
            </p>
        </div>
    </div>
@endsection
