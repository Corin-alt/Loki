<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Group;
use App\Models\Role;
use App\Models\TypeEducations;
use App\Models\UsersGroups;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $user_log = Auth::user();
        $years = Year::paginate(1);
        $groups = Group::all();
        $type_educations = TypeEducations::all();
        $users_groups= UsersGroups::all();
        return view('groups.list', compact( 'user_log', 'years', 'groups', 'type_educations', 'users_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user_log = Auth::user();
        $formations = Formation::all();
        $groups = Group::all();
        $type_educations = TypeEducations::all();
        $years = Year::all();
        $roles = Role::whereIn('id', [2,3,4])->get();

        return view('groups.create', compact('user_log', 'formations', 'groups', 'type_educations', 'years', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)  {
        $group_validator = Validator::make($request->all(), Group::$rules);
        if($group_validator->fails()){
            return redirect()->back()->with("error", "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            $exist = Group::where('grp_name', $request->input('grp_name'))->first();
            if(isset($exist)){
                return redirect()->back()->with("error", "Ce groupe existe déjà pour cette formation.")->withInput();
            } else {
                $grp = new Group();
                $grp->grp_name = $request->input('grp_name');
                $grp->type_education_id = $request->input('type_education_id');
                $grp->formation_id = Auth::user()->formation->id;
                $grp->year_id = $request->input('year_id');
                $grp->save();
                $this->addToCrossTableUsersGroups($request, $grp);
                return redirect('/groups/list')->with('success', 'Le groupe ' . $grp->grp_name . " a été ajouté avec succès.");
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id) {
        $user_log = Auth::user();
        $group= Group::findOrFail($id);
        $users = $group->users;
        $students = $users->where('role_id', 4);
        $teachers = $users->whereIn('role_id', [2,3]);

        return view('groups.show', compact('user_log', 'group', 'teachers', 'students'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id) {
        $user_log = Auth::user();
        $group = Group::findOrFail($id);
        $formations = Formation::all();
        $type_educations = TypeEducations::all();
        $years = Year::all();
        $roles = Role::whereIn('id', [2,3,4])->get();

        return view('groups.edit',compact('user_log', 'group', 'formations', 'years', 'type_educations', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id) {
        $group_validator = Validator::make($request->all(), Group::$rules);
        if($group_validator->fails()){
            return redirect()->back()->with("error", "Les valeurs entrées ne sont pas correcte.")->withInput();
        } else {
            UsersGroups::where('group_id', $id)->delete();
            $grp = Group::findOrFail($id);
            $grp->grp_name = $request->input('grp_name');
            $grp->type_education_id = $request->input('type_education_id');
            $grp->formation_id = Auth::user()->formation->id;
            $grp->year_id = $request->input('year_id');
            $grp->save();
            $this->addToCrossTableUsersGroups($request, $grp);
            return redirect('/groups/list')->with('success', 'Le groupe ' .  $grp->grp_name  . " a été modifié avec succès.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id) {
        $grp = Group::findOrFail($id);
        $grp->delete();
        return redirect('/groups/list')->with('success', 'Le groupe ' . $grp->grp_name . " a été supprimé avec succès.");
    }

    private function addToCrossTableUsersGroups(Request $request, Group $group) : void {
        if(!empty($request->input('usrs'))){
            foreach ($request->input('usrs') as $usr){
                $usr_grp = new UsersGroups();
                $usr_grp->user_id = $usr;
                $usr_grp->group_id = $group->id;
                $usr_grp->save();
            }
        }

    }
}
