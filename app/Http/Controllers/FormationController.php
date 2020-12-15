<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Group;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $user_log = Auth::user();
        $formations = Formation::paginate(15);
        return view('formation.list', compact('user_log','formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user_log = Auth::user();
        return view('formation.create', compact('user_log'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)  {
        $formation_validator= Validator::make($request->all(), Formation::$rules);

        if($formation_validator ->fails()){
            return redirect()->back()->with('error', "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            $exist = Formation::where("fmt_name", $request->input('fmt_name'))->first();
            if(isset($exist)){
                return redirect()->back()->with('error', "Il existe déjà une formation avec cet intitulé.")->withInput();
            } else {
                $formation = new Formation();
                $formation->fmt_name = $request->input('fmt_name');
                $formation->save();
                return redirect('/formations/list')->with('success', 'La formation ' .  $formation->fmt_name . " a été ajouté avec succès.");
            }
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
        $formation = Formation::findOrFail($id);
        $groups = Group::where('formation_id', $id)->orderBY('year_id', 'asc')->get();
        $responsable = $formation->users->where('role_id', 2)->first();
        $teachers = $formation->users->whereIn('role_id', [2,3]);
        $subjects = $formation->subjects;

        return view('formation.show', compact('user_log', 'formation', 'responsable', 'teachers', "groups", 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id) {
        $user_log = Auth::user();
        $formation = Formation::findOrFail($id);
        return view('formation.edit', compact('user_log', 'formation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)  {
        $formation_validator= Validator::make($request->all(), Formation::$rules);

        if($formation_validator ->fails()){
            return redirect()->back()->with('error', "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {

            $formation = Formation::findOrFail($id);
            $formation->fmt_name = $request->input('fmt_name');
            $formation->save();

            return redirect('/formations/list')->with('success', 'La formation ' .  $formation->fmt_name . " a été modifié avec succès.");

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)  {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return redirect('/formations/list')->with('success', 'La formation ' .  $formation->fmt_name . " a été supprimé avec succès.");
    }

    public function download(int$id){
        if(Auth::user()->role->rle_name != "Responsable"){
            return redirect()->back()->with('error', "Vous n'avez pas la permission de télécharger la liste de présence.");
        } else {
            $formation = Formation::findOrFail($id);
            $file_name = 'formation_'.$formation->fmt_name;
            $pdf = PDF::loadView('download.list_students_pdf', compact('formation'));
            return $pdf->download($file_name.'.pdf');
        }
    }
}
