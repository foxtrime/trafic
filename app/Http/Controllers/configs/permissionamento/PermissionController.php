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

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return view('configs.permissionamento.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('configs.permissionamento.permission.create');
    }

    public function store(Request $request)
    {
        // if( ! Auth::user()->can('GERIR PERMISSÃO')  )
		// {
		// 	return back()->with('erro_seguranca', 'Esse usuário não tem permissão para acessar esse módulo.');    
		// };

        DB::beginTransaction();
		try {
			$permission = Permission::create(['name' => $request->name]);
		} catch (\Throwable $th) {
			DB::rollBack();
			//dd($th);
			return back()->withInput()->with('error', 'Falha ao Salvar a Permissão.');    
		}
		DB::commit();
		return redirect('permission')->with('sucesso', 'Permissão criada com sucesso!');
    }

    
}
