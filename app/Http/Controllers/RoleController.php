<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Services\UserRightService;
use Exception;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    // public function __construct(
    //     UserRightService $userrightService
    // ) {
    //     $this->userrightService = $userrightService;
    // }
    public function index()
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("Roles");
        // if (!$rolesPermissions['view']) {
        //     abort(401);
        // }
        $roles = Role::orderBy('name', 'asc')->get();
        $roles = json_encode($roles);
        return view('role.index', compact('roles'));
    }

    public function getRoles()
    {
        $roles = Role::where('active', 1)->get();

        return $roles;
    }

    public function create()
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("Roles");
        // if (!$rolesPermissions['create']) {
        //     abort(401);
        // }
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);

        $created_at = \Carbon\Carbon::now();
        try {
            $role = Role::create([
                'name' => strtoupper($request->name),
                'description' => $request->description,
                'active' => $request->status,
                'created_at' => $created_at,
                'app'    => 'CAMM',
            ]);

            $returnedRole = Role::find($role->id);
            $data = [
                'app_role_id' => $role->id,
            ];
            $returnedRole->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("Roles");
        // if (!$rolesPermissions['edit']) {
        //     abort(401);
        // }
        $role = Role::where('id', $id)->first();
        return view('role.edit', compact('role'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $updated_at = \Carbon\Carbon::now();
        try {
            $role = Role::find($request->id);

            $data = [
                'name' => strtoupper($request->name),
                'description' => $request->description,
                'active'    => $request->active,
                'updated_at' => $updated_at
            ];

            $role->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    public function destroy(Role $role)
    {
        //
    }
    public function rolesList(Role $role)
    {
        $roles = $role->where('active', 1)->get();
        // $streamContext = stream_context_create([
        //     'ssl' => [
        //         'verify_peer'      => false,
        //         'verify_peer_name' => false
        //     ]
        // ]);
        // $roles = file_get_contents(config('app.api_path') . "roles-api.php", false, $streamContext);
        // dd($roles);
        return $roles;
    }

    public function rolesList_selected(Role $role)
    {
        $roles = $role->where('active', 1)->where([['app', '=', 'CAMM']])->get();
        return json_encode($roles);
    }
}
