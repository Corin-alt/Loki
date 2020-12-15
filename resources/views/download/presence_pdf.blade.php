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

<h2>Feuille de présence</h2>

<table style="width:100%">
    <tr>
        <th>Enseignant</th>
        <th>Matière</th>
        <th>Groupe</th>
        <th>Séance</th>
    </tr>
    <tr>
        <td>{{$session->user->firstname}} {{$session->user->name}}</td>
        <td>{{$session->subject->sbj_name}}</td>
        <td>{{$session->group->grp_name}}</td>
        <td>{{strftime('%d/%m/%Y', strtotime($session->date_start))}} de {{strftime('%H:%M', strtotime($session->date_start))}} à {{strftime('%H:%M', strtotime($session->date_end))}} </td>
    </tr>
</table>
<br><br>

<table style="width:100%">
    <tr>
        <th>N°</th>
        <th>Nom & Prénom</th>
        <th>Signature</th>
    </tr>
    <?php $i = 1;?>
    @foreach($session->group->users as $user)
        @if($user->role->rle_name == "Étudiant")
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->firstname}} {{$user->name}}</td>
                <td></td>
            </tr>
        @endif
    @endforeach
</table>
