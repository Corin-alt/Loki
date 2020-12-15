@extends('template')

@section('title') NoobMaster404 @endsection

@section('content')
    <h1 class="text-center"><strong>J'ai bien peur que Thanos ne soit passé par là...</strong></h1>
    <p class="text-center"><strong>(404)</strong></p>
   <section>
       <img class="rounded mx-auto d-block" src="{{ asset('img/thanos.gif') }}" alt="thanosVSLoki">
   </section>

@endsection

