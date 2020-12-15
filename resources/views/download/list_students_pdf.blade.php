<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }
</style>

<h2>Liste des étudiants de la formation {{$formation->fmt_name}}</h2>

<table style="width:100%">
    <tr>
        <th>N°</th>
        <th>Nom & Prénom</th>
        <th>Email</th>
    </tr>
    <?php $i = 1;?>
    @foreach($formation->users as $user)
        @if($user->role->rle_name == "Étudiant")
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->firstname}} {{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
        @endif
    @endforeach
</table>
