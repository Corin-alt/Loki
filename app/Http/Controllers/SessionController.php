<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Session;
use App\Models\User;
use App\Models\Year;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()  {
        $user_log = Auth::user();
        $sessions = Session::all();
        $years = Year::paginate(1);
        $subjects= $user_log->formation->subjects;
        return view ('session.list', compact('user_log' , 'sessions', 'years', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()  {
        $user_log = Auth::user();
        $years = Year::all();
        $groups = $user_log->formation->groups;
        $subjects= $user_log->formation->subjects;
        $teachers = User::where('formation_id', $user_log->formation->id)->whereIn('role_id', [2,3])->get();

        return view('session.create', compact('user_log', 'years', 'subjects',  'groups', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)  {
        $session_validator = Validator::make($request->all(), Session::$rules);
        if($session_validator->fails()){
            return redirect()->back()->with('error', "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            $session = new Session();
            $session->user_id = $request->input('user_id');
            $session->subject_id = $request->input('subject_id');
            $session->group_id = $request->input('group_id');
            $session->date_start = $request->input('date_start');
            $session->date_end= $request->input('date_end');
            $session->save();

            return redirect('/sessions/list')->with('success', 'La séance a été ajouté avec succès.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id) {
        $user_log = Auth::user();
        $session = Session::findOrFail($id);
        return view('session.show', compact('user_log', 'session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)  {
        $user_log = Auth::user();
        $session = Session::findOrFail($id);
        $years = Year::all();
        $groups = $user_log->formation->groups;
        $subjects= $user_log->formation->subjects;
        $teachers = User::where('formation_id', $user_log->formation->id)->whereIn('role_id', [2,3])->get();
        return view('session.edit', compact('user_log', 'session','years', 'subjects',  'groups', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)  {
        $session = Session::findOrFail($id);
        $session->user_id = $request->input('user_id');
        $session->subject_id = $request->input('subject_id');
        $session->group_id = $request->input('group_id');
        $session->date_start = $request->input('date_start');
        $session->date_end= $request->input('date_end');
        $session->save();

        return redirect('/sessions/list')->with('success', 'La séance a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  $id
     * @return Response
     */
    public function destroy(int $id)  {
        $session = Session::findOrFail($id);
        $session->delete();
        return redirect('/sessions/list')->with('success', 'La séance a été supprimé avec succès.');
    }


    /**
     * Download the attendance list of a session.
     *
     * @param int $id
     * @return Response
     */
    public function download(int $id)  {
        if(Auth::user()->role->rle_name != "Responsable"){
            return redirect()->back()->with('error', "Vous n'avez pas la permission de télécharger la liste de présence.");
        } else {
            $session = Session::findOrFail($id);
            $date = strftime('%d/%m/%Y', strtotime($session->date_start));
            $subject = $session->subject->sbj_name;
            $file_name = 'presence_'.$subject.'_'.$date;
            $pdf = PDF::loadView('download.presence_pdf', compact('session'));
            return $pdf->download($file_name.'.pdf');
        }
    }
}
