@extends('template')

@section('title') EC - Consulter @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <br><h4> Information sur un EC </h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Intitulé</th>
                                <td>
                                    <ul>
                                        {{$subject->sbj_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Formation</th>
                                <td>
                                    <ul>
                                        {{$subject->formation->fmt_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Année</th>
                                <td>
                                    <ul>
                                        {{$subject->year->yrs_name}}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Enseignant(s)</th>
                                <td>
                                    <ul>
                                        @foreach($subject->users as $user)
                                            <li>{{$user->firstname}} {{$user->name}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter un EC.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
