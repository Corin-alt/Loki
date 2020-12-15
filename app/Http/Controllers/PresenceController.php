<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\Session;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class PresenceController extends Controller{


    public function create(int $id) {
        $user_log = Auth::user();
        $session = Session::findOrFail($id);
        $states = State::all();
        return view('presence.create', compact('user_log', 'session', 'states'));
    }

    public function store(Request $request, int $id){
        $this->storePresentiel($request, $id);
        return redirect('infos/sessions')->with('success', 'Le présentiel de cette séance a bien été enregistré');
    }


    public function show(int $id) {
        $user_log = Auth::user();
        $session = Session::findOrFail($id);
        $presentiel = Presence::all();
        return view('presence.show', compact('user_log', 'session', 'presentiel'));
    }



    public function edit(int $id) {
        $user_log = Auth::user();
        $session = Session::findOrFail($id);
        $states = State::all();
        $presentiel = Presence::all();

        $nb_pres = $presentiel->where('session_id', $session->id)->where('state_id', 1)->count();
        $nb_dist = $presentiel->where('session_id', $session->id)->where('state_id', 2)->count();
        $nb_just = $presentiel->where('session_id', $session->id)->where('state_id', 3)->count();
        $nb_abs = $presentiel->where('session_id', $session->id)->where('state_id', 4)->count();

        return view('presence.edit', compact('user_log', 'session', 'presentiel', 'states', 'nb_pres', 'nb_dist', 'nb_just', 'nb_abs'));
    }

    public function update(Request $request, int $id) {
        Presence::where('session_id', $id)->delete();
        $this->storePresentiel($request, $id);
        return redirect('infos/sessions')->with('success', 'Le présentiel de cette séance a bien été modifié');
    }

    private function storePresentiel(Request $request, int $id) {
        $tab_presentiel = $request->input('presentiel');
        $presentiel = array();
        foreach ([1, 2, 3, 4] as $state_id){
            $user_key = array_keys($tab_presentiel, $state_id);
            if(isset($presentiel)){
                foreach ($user_key as $user) {
                    $pr = new Presence();
                    $pr->session_id = $id;
                    $pr->user_id = $user;
                    $pr->state_id = $state_id;
                    $pr->save();
                }
            }
        }
    }
}
