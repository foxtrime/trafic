<?php

namespace App\Http\Controllers\configs\permissionamento;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = ModelsRole::with('permissions')->get();
        return view('configs.permissionamento.role.index',compact('roles'));
    }

    public function create()
    {
        return view('configs.permissionamento.role.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
		try {
			$role = ModelsRole::create(['name' => $request->name]);
		} catch (\Throwable $th) {
			DB::rollBack();
			//dd($th);
			return back()->withInput()->with('error', 'Falha ao Salvar a Role.');    
		}
		DB::commit();
		return redirect('role')->with('sucesso', 'Role criada com sucesso!');
    }

    public function update(Request $request, ModelsRole $role)
    {

		
        // DB::beginTransaction();
		// try {
			$role->name = $request->name;

			if(isset($request->permission)){
				$permissions=[];
				foreach ($request->permission as $key => $value) {
					array_push($permissions, $key);
				}
				$role->syncPermissions($permissions);
			};

			$role->save();

		// } catch (\Throwable $th) {
		// 	DB::rollBack();
		// 	//dd($th);
		// 	return back()->withInput()->with('error', 'Falha ao Salvar a Role.');    
		// }
		// DB::commit();
		return redirect('role')->with('sucesso', 'Role alterada com sucesso!');
        
    }

    public function rolePerm($id)
	{
		$role 			= ModelsRole::where('id',$id)->with('permissions')->first();
		$permissions	= Permission::orderBy('name')->get();
		return view('configs.permissionamento.role.perm', compact('role','permissions'));
	}


}
