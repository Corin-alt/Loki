@extends('template')

@section('title') Les EC @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Responsable')
                        <br><h4> Les EC {{$user_log->formation->fmt_name}}<a href="{{ route('subjects.create') }}" class="btn btn-sm btn-success mb-1 ml-2">+</a></h4>
                        <div class="card">
                            <div class="table-responsive">
                                <table align="center" class="table no-wrap user-table mb-0">
                                    <thead>
                                    <tr class="list-group-item-primary">
                                        <th scope="col" class="border-0 text-uppercase font-medium">Intitulé</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div class="table-responsive">
                                        @foreach($years as $year)
                                            <table align="center" class="table no-wrap user-table mb-0">
                                                <li class="list-group-item list-group-item-success">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="border-0 text-uppercase font-medium"> {{$year->yrs_name}} </span>
                                                    </div>
                                                </li>
                                                <tbody align="center">
                                                @foreach($subjects->where('year_id', $year->id) as $subject)
                                                    <tr>
                                                        <th>
                                                            <p>{{$subject->sbj_name}}</p>
                                                        </th>
                                                        <td>
                                                            <section>
                                                                <div class="input-group">
                                                                    <a id= "button-action"  class="btn btn-sm btn-primary" href="{{ route('subjects.show', ['id' => $subject->id]) }}"><i class="fa fa-eye"></i></a>
                                                                    <a id = "button-action" class="btn btn-sm btn-warning" href="{{ route('subjects.edit', ['id' => $subject->id]) }}"><i class="fa fa-edit"></i></a>
                                                                    <form action="{{ route('subjects.delete', ['id' => $subject->id]) }}" method="POST">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <button id ="button-action" type="submit" onclick="return confirm('Êtes-vous sûr de supprimer cet EC ?')" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></button>
                                                                    </form>
                                                                </div>
                                                            </section>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                @endforeach
                                            </table>
                                    </div>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{$years->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Responsable)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour accéder à la liste des EC.</div>
                @endif
            </div>
        </div>
@endsection
