@extends('template')

@section('title') Formations - Consulter @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin' || $user_log->role->rle_name == 'Responsable')
                        <br><h4> Information sur la formation</h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Intitulé</th>
                                <td>
                                    <ul>
                                        <p> {{$formation->fmt_name}}</p>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <th scope="row">Responsable</th>
                                <td>
                                    <ul>
                                        @if(isset($responsable))<p> {{$responsable->firstname}} {{$responsable->name}} @if($responsable->id == $user_log->id)<strong>(Vous)</strong>@endif</p>@endif
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Enseignants</th>
                                <td>
                                    <ul>
                                        @foreach($teachers as $teacher)
                                            @if (isset($teacher))
                                                <li>{{$teacher->firstname}} {{$teacher->name}} @if($teacher->id == $user_log->id)<strong>(Vous)</strong>@endif</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Étudiants</th>
                                <td>
                                    <ul>
                                        <a id="button-action" class="btn btn-outline-danger" href="{{ route('formations.download', ['id' => $formation->id]) }}">Télécharger la listes des étudiants</a>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Groupes</th>
                                <td>
                                    <ul>
                                        @foreach($groups as $group)
                                            @if (isset($group))
                                                <li>{{$group->grp_name}} ({{$group->year->yrs_name}})</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">EC</th>
                                <td>
                                    <ul>
                                        @foreach($subjects as $subject)
                                            @if (isset($subject))
                                                <li>{{$subject->sbj_name}} ({{$subject->year->yrs_name}})</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter une formation.</div>
                @endif
            </div>
        </div>
    </div>



@endsection
