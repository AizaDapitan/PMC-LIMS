<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Module;
// use App\Services\UserRightService;
use Illuminate\Support\Facades\Session;
use Exception;

class PermissionController extends Controller
{
    // public function __construct(
    //     UserRightService $userrightService
    // ) {
    //     $this->userrightService = $userrightService;
    // }
    public function index()
    {

        // $rolesPermissions = $this->userrightService->hasPermissions("Permissions");
        // if (!$rolesPermissions['view']) {
        //     abort(401);
        // }
        $permissions = Permission::orderBy('description', 'asc')->get();
        $permissions = json_encode($permissions);
        return view('permission.index', compact('permissions'));
    }

    public function getPermissions()
    {
        $permissions = Permission::where('active', 1)->get();
        return $permissions;
    }

    public function getPermission_selected()
    {
        // $permissions = Permission::select('permissions.*', 'm.description as module_description')
        //                 ->leftjoin('modules as m', 'permissions.module_type', '=', 'm.id')
        //                 ->orderBy('m.description ', 'asc')
        //                 ->orderBy('permissions.description', 'asc')
        //                 ->get();
        $permissions = Permission::where([['active', 1], ['application', 6]])->get();
        return $permissions;
    }

    public function create()
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("Permissions");
        // if (!$rolesPermissions['create']) {
        //     abort(401);
        // }
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_type' => 'required',
            'description' => 'required',

        ]);

        $created_at = \Carbon\Carbon::now();

        try {
            $permission = Permission::create([
                'module_type' => $request->module_type,
                'description' => $request->description,
                'active' => 1,
                'created_at' => $created_at
            ]);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit($id)
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("Permissions");
        // if (!$rolesPermissions['edit']) {
        //     abort(401);
        // }
        $permission = Permission::where('id', $id)->first();
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'module_type' => 'required',
            'description' => 'required',
        ]);
        try {
            $updated_at = \Carbon\Carbon::now();

            $permission = Permission::find($request->id);

            $data = [
                'module_type' => $request->module_type,
                'description' => $request->description,
                'active'    => $request->active,
                'updated_at' => $updated_at
            ];

            $permission->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    public function destroy(Permission $permission)
    {
        //
    }
    public function modulesList(Module $module)
    {
        $modules = $module->orderBy('description', 'asc')->get();
        return $modules;
    }
}
