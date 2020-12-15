<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Subject;
use App\Models\User;
use App\Models\UsersSubjects;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()  {
        $user_log = Auth::user();
        $years = Year::paginate(1);
        $subjects = Subject::all();
        return view('subject.list', compact( 'user_log' , 'years', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
        $user_log = Auth::user();
        $formations = Formation::all();
        $years = Year::all();
        $teachers = User::where('formation_id', $user_log->formation->id)->whereIn('role_id', [2,3])->get();
        return view('subject.create', compact('user_log', 'formations', 'years', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)  {
        $subject_validator = Validator::make($request->all(), Subject::$rules);
        if($subject_validator->fails()){
            return redirect()->back()->with('error', "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            $exist = Subject::where('sbj_name', $request->input('sbj_name'))->where("formation_id", Auth::user()->formation->id)->first();
            if (isset($exist)) {
                return redirect()->back()->with('error', "Un EC avec cet intitulé existe déjà pour cette formation.")->withInput();
            } else {
                $sbj = new Subject();
                $sbj->sbj_name = $request->input('sbj_name');
                $sbj->formation_id = Auth::user()->formation->id;
                $sbj->year_id = $request->input('year_id');
                $sbj->save();
                $this->addToCrossTableUsersSubjects($request, $sbj);

                return redirect('/subjects/list')->with('success', 'L\'EC ' . $sbj->sbj_name . " a été ajouté avec succès.");
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
        $subject = Subject::findOrFail($id);
        return view('subject.show', compact('user_log', "subject"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)  {
        $user_log = Auth::user();
        $years = Year::all();
        $subject = Subject::findOrFail($id);
        $teachers = User::where('formation_id', Auth::user()->formation->id)->whereIn('role_id', [2,3])->get();
        return view('subject.edit', compact('user_log', 'years', 'subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)  {
        $subject_validator = Validator::make($request->all(), Subject::$rules);
        if($subject_validator->fails()){
            return redirect()->back()->with('error', "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            UsersSubjects::where("subject_id", $id)->delete();

            $sbj = Subject::find($id);
            $sbj->sbj_name = $request->input('sbj_name');
            $sbj->formation_id = Auth::user()->formation->id;
            $sbj->year_id = $request->input('year_id');
            $sbj->save();
            $this->addToCrossTableUsersSubjects($request, $sbj);

            return redirect('/subjects/list')->with('success', 'L\'EC ' . $sbj->sbj_name . ' a été modifié avec succès.');

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id){
        $sbj = Subject::findOrFail($id);
        $sbj->delete();
        return redirect('/subjects/list')->with('success', 'L\'EC ' . $sbj->sbj_name . " a été supprimé avec succès.");
    }

    /**
     * Add the cross table.
     *
     * @param Request $request
     * @param Subject $subject
     */
    private function addToCrossTableUsersSubjects(Request $request, Subject $subject) : void {
        if(!empty($request->input('usrs'))){
            foreach ($request->input('usrs') as $usr){
                $usr_grp = new UsersSubjects();
                $usr_grp->user_id = $usr;
                $usr_grp->subject_id = $subject->id;
                $usr_grp->save();
            }
        }
    }
}
