@extends('template')

@section('title') Les utilisateurs @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                    @if($user_log->role->rle_name == 'Admin')
                        <br><h4>Les utilisateurs<a href="{{ route('users.create') }}" class="btn btn-sm btn-success mb-1 ml-2">+</a></h4><br>
                        <label for="">Trier par: </label>
                        <select class="browser-default custom-select" style="width: 12%; margin-left: 5px; margin-bottom: 5px;" id="role">
                            <option value="all">Tous</option>
                            <option value="resp">Responsable</option>
                            <option value="student">Étudiant</option>
                            <option value="teacher">Enseignant</option>
                        </select>
                        <br>
                        <div class="card">
                            <div class="table-responsive">
                                <table id= "mytable" class="table no-wrap user-table mb-0">
                                    <thead>
                                    <tr class="list-group-item-primary">
                                        <th scope="col" class="border-0 text-uppercase font-medium">Nom & Prénom</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Role</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Formation</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Date d'ajout</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        @if($user->role->rle_name != 'Admin')
                                        <tr class={{$user->role->rle_name}} >
                                            <td><h5 class="font-medium mb-0">{{$user->firstname}} {{$user->name}}</h5></td>
                                            <td><span class="text-muted">{{ $user->role->rle_name }}</span></td>
                                            <td><span class="text-muted">{{$user->email}}</span></td>
                                            @if(isset($user->formation->fmt_name))
                                                <td><span class="text-muted">{{$user->formation->fmt_name}}</span></td>
                                            @else
                                                <td><span class="text-muted">-</span></td>
                                            @endif
                                            <td><span class="text-muted">{{$user->created_at}}</span><br></td>
                                            <td>
                                                <section>
                                                    <div class="input-group">
                                                        <a id="button-action"  class="btn btn-sm btn-primary" href="{{ route('users.show', ['id' => $user->id]) }}"><i class="fa fa-eye"></i></a>
                                                        <a id="button-action" class="btn btn-sm btn-warning" href="{{ route('users.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                                        <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST">
                                                            @method('delete')
                                                            <button id = "button-action" type="submit" onclick="return confirm('Êtes-vous sûr de supprimer cet utilisateur ?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </section>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="mx-auto">
                                {{$users->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger text-center">Vous n'avez pas la permission requise pour accéder à cette page. (Admin)</div>
                    @endif
                @else
                    <div class="alert alert-danger text-center">Veuillez vous connecter pour consulter la liste des utilisateurs.</div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#role').on('change', function() {
                switch(this.value){
                    case "all":
                        $(".Responsable").show();
                        $(".Enseignant").show();
                        $(".Étudiant").show();
                        break;
                    case "resp":
                        $(".Responsable").show();
                        $(".Enseignant").hide();
                        $(".Étudiant").hide();
                        break;
                    case "teacher":
                        $(".Responsable").hide();
                        $(".Enseignant").show();
                        $(".Étudiant").hide();
                        break;
                    case "student":
                        $(".Responsable").hide();
                        $(".Enseignant").hide();
                        $(".Étudiant").show();
                        break;
                }
            });
        });
    </script>
@endsection
