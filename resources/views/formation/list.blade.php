@extends('template')

@section('title') Les formations @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin')
                        <br><h4> Les formations<a href="{{ route('formations.create') }}" class="btn btn-sm btn-success mb-1 ml-2">+</a></h4>
                        <div class="card">
                            <div class="table-responsive">
                                <table align="center" class="table no-wrap user-table mb-0">
                                    <thead>
                                    <tr  align="center" class="list-group-item-primary">
                                        <th scope="col" class="border-0 text-uppercase font-medium">Intitulé</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody align="center">
                                    @foreach($formations as $formation)
                                        <tr align="center">
                                            <th >
                                                <span>{{$formation->fmt_name}}</span>
                                            </th>
                                            <td >
                                                <div class="input-group">
                                                    <a id= "button-action" class="btn btn-sm btn-primary" href="{{ route('formations.show', ['id' => $formation->id]) }}"><i class="fa fa-eye"></i></a>
                                                    <a id= "button-action" class="btn btn-sm btn-warning" href="{{ route('formations.edit', ['id' => $formation->id]) }}"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('formations.delete', ['id' => $formation->id]) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button id= "button-action" type="submit" onclick="return confirm('Êtes-vous sûr de supprimer cette formation ?')" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour accéder à la liste des formations.</div>
                @endif
            </div>

        </div>
    </div>
    <div class="d-flex">
        <div class="mx-auto">
            {{$formations->links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection
