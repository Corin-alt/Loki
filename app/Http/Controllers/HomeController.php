<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Session;
use App\Models\Subject;
use App\Models\TypeEducations;
use App\Models\UsersSubjects;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function general(){
        $user_log = Auth::user();
        return view('infos.general', compact('user_log'));
    }

    public function groups(){
        $user_log = Auth::user();
        return view('infos.groups', compact('user_log'));
    }

    public function sessions(){
        $user_log = Auth::user();
        $subjects = UsersSubjects::where('user_id', $user_log->id)->paginate(1);
        $all_subject = Subject::all();
        $all_sessions = Session::all();
        $presences = Presence::all();
        return view('infos.sessions', compact('user_log', 'all_sessions',  'all_subject', 'presences', 'subjects'));
    }

    public function presentiel(){
        $user_log = Auth::user();
        $all_sessions = Session::all();
        $presences = Presence::all();
        $type_educations = TypeEducations::all();


        if(isset($user_log->groups[0]->year->id)){
            $all_subjects = Subject::where('year_id', $user_log->groups[0]->year->id)->paginate(1);
            return view('infos.presentiel', compact('user_log', 'all_sessions', 'all_subjects', 'presences', 'type_educations'));
        } else {
            return redirect()->back()->with('warning', 'Vous n\'avez été affecté à aucun groupe pour le moment donc vous n\'avez pas de présentiel.');
        }
    }
}
