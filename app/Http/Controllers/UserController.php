<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersGroups;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $user_log = Auth::user();
        $users= User::orderBy('firstname')->paginate(20);
        return view('users.list', compact('user_log', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user_log = Auth::user();
        $formations = Formation::all();
        $roles = Role::all();
        return view('users.create', compact('user_log', 'formations',  'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $user_validator = Validator::make($request->all(), User::$rules);

        if($user_validator->fails()){
            return redirect()->back()->with("error", "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            if($request->input('role_id') == 2){
                $exist = User::where("formation_id", $request->input('formation_id'))->where("role_id", 2)->first();
                if(isset($exist)){
                    return redirect()->back()->with("error", "Un responsable existe déjà pour cette formation.")->withInput();
                } else {
                    $user = $this->storeUser($request);
                    return redirect('/users/list')->with('success', 'L\'utilisateur ' . $user->firstname . " " . $user->name . " a été ajouté avec succès.");
                }
            } else {
                $user = $this->storeUser($request);
                return redirect('/users/list')->with('success', 'L\'utilisateur ' . $user->firstname . " " . $user->name . " a été ajouté avec succès.");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id){
        $user_log = Auth::user();
        $user =  User::findOrFail($id);
        $grps = UsersGroups::where("user_id", $id)->first();

        if(isset($grps)){
            $grp = Group::where("id", $grps->group_id)->first();
            if(isset($grp)){
                $year = Year::where("id", $grp->year_id)->first();
                $formation = Formation::where("id", $grp->formation_id)->first();
                return view('users.show', compact('user_log', 'user', 'formation', 'year'));
            }
        } else {
            return view('users.show', compact('user_log', 'user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id){
        $user_log = Auth::user();
        $user = User::findOrFail($id);
        $formations = Formation::all();
        $roles = Role::all();
        return view('users.edit', compact('user_log', 'user', 'formations', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */

    public function update(Request $request, int $id){
        if($user->role->rle_name == "Admin"){
            return redirect()->back()->with('error', 'Malheureusement cet utilsateur ne peut pas être modifié.');
        } else {
            $user = User::find($id);
            $user->firstname = $request->input('firstname');
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role_id');
            $user->formation_id = $request->input('formation_id');
            $user->save();

            return redirect('/users/list')->with('success', 'L\'utilisateur ' . $user->firstname . " " . $user->name . " a été modifié avec succès.");
        }

    }


    private function storeUser(Request  $request){
        $user = new User();
        $user->firstname = $request->input('firstname');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id= $request->input('role_id');
        if(isset($formation)){
            $user->formation_id = $request->input('formation_id');
        } else {
            $user->formation_id = null;
        }
        $user->save();

        return $user;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id) {
        $user = User::findOrFail($id);
        if($user->role->rle_name == "Admin"){
            return redirect()->back()->with('error', 'Malheureusement cet utilsateur ne peut pas être supprimé.');
        } else {
            $user->delete();
            return redirect('/users/list')->with('success', 'L\'utilisateur ' . $user->firstname . " " . $user->name . " a été supprimé avec succès.");
        }
    }
}
