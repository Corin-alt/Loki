@extends('template')

@section('title') Les séances @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <br><h4> Les séances {{$user_log->formation->fmt_name}}<a href="{{ route('sessions.create') }}" class="btn btn-sm btn-success mb-1 ml-2">+</a></h4>
                        <div class="card">
                            <div class="table-responsive">
                                <table id= "mytable" class="table no-wrap user-table mb-0">
                                    <thead>
                                    <tr class="list-group-item-primary">
                                        <th scope="col" class="border-0 text-uppercase font-medium">Séance</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Début-Fin</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Groupe</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Enseignant</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($years as $year)
                                        <table align="center" class="table no-wrap user-table mb-0">
                                            <li class="list-group-item list-group-item-success">
                                                <div class="d-flex justify-content-between">
                                                    <span class="border-0 text-uppercase font-medium"> {{$year->yrs_name}} </span>
                                                </div>
                                            </li>
                                            <tbody align="center">
                                            @foreach($subjects->where("year_id", $year->id) as $sbj)
                                                <table align="center" class="table no-wrap user-table mb-0">
                                                    <li class="list-group-item list-group-item-warning">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="border-0 text-uppercase font-medium"> {{$sbj->sbj_name}} </span>
                                                        </div>
                                                    </li>
                                                    @foreach($sbj->sessions as $session)
                                                        <tr class="role_student" >
                                                            <td><span class="font-medium mb-0">{{strftime('%d/%m/%Y', strtotime($session->date_start))}}</span></td>
                                                            <td><span class="text-muted">{{strftime('%Hh%M', strtotime($session->date_start))}}-{{strftime('%Hh%M', strtotime($session->date_end))}}</span></td>
                                                            <td><span class="text-muted">{{$session->group->grp_name}}</span></td>
                                                            <td><span class="text-muted">{{$session->user->firstname}} {{$session->user->name}}</span></td>
                                                            <td>
                                                                <section>
                                                                    <div class="input-group">
                                                                        <a id="button-action"  class="btn btn-sm btn-primary" href="{{ route('sessions.show', ['id' => $session->id]) }}"><i class="fa fa-eye"></i></a>
                                                                        <a id="button-action" class="btn btn-sm btn-warning" href="{{ route('sessions.edit', ['id' => $session->id]) }}"><i class="fa fa-edit"></i></a>
                                                                        <form action="{{ route('sessions.delete', ['id' => $session->id]) }}" method="POST">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button id = "button-action" type="submit" onclick="return confirm('Êtes-vous sûr de supprimer cette séance ?')" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </section>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="mx-auto">
                                {{$years->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour accéder à la listes des séances.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
