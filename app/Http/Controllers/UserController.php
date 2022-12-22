<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('user.index', compact('users'));
    }

    public function create()
    {

        return view('user.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
            $user->tipo = $request->tipo;
            
            $senha = retiraMascaraCPF($request->cpf);
            $user->password = bcrypt($senha);

            $user->save();

            DB::commit();
            return redirect()->route('user.index')->with('sucesso','Usuário criado com sucesso');

        } catch (Throwable $th) {
            
            DB::rollback();
			return redirect()->route('user.index')->with('erro', 'Houve um erro ao tentar criar um usuário.');
        }

        dd($request->all());
    }

    public function perm($id)
	{
		//$users 		= User::with('roles','permissions')->where('nome','marcelo miranda silva')->get();
		$user 			= User::where('id',$id)->with('roles','permissions')->first();
		$roles			= ModelsRole::orderBy('name')->get();
		$permissions	= Permission::orderBy('name')->get();
		//dd($user);
		return view('user.perm', compact('user','roles','permissions'));
	}

    public function permSave(Request $request, User $user)
	{
		//dd($request->all());

		//$user->syncPermissions(['edit articles', 'delete articles']);
		//$user->syncRoles(['writer', 'admin']);

		$roles=[];
		$permissions=[];
		
		if(isset($request->role)){
			foreach ($request->role as $key => $value) {
				array_push($roles, $key);
			}
		};

		//dd($roles);
		

		if(isset($request->permission)){
			foreach ($request->permission as $key => $value) {
				array_push($permissions, $key);
			}
		};

		//dd($permissions);

		$user	= User::find($request->id);


		//dd($user);
		//dd($request->all());

		try {
			$user->syncRoles($roles);
			$user->syncPermissions($permissions);

		} catch (\Throwable $th) {
			DB::rollBack();
			//dd($th);
		  // You can check get the details of the error using `errorInfo`:
			$errorInfo = $th->errorInfo;

			DB::rollBack();
			return back()->withInput()->with('error', 'Falha ao alterar o Usuário. cod:'. $errorInfo[0]);
		}

		DB::commit();
		return redirect('user')->with('sucesso', 'Usuario alterado com sucesso!');
	}

	public function AlteraSenha()
	{
		$usuario = Auth::user();
	
		return view('auth.altera_senha',compact('usuario'));    

		
	}

	public function SalvarSenha(Request $request)
	{
		// Validar
		$this->validate($request, [
			'password_atual'        => 'required',
			'password'              => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6'
		]);

		// Obter o usuário
		$usuario = User::find(Auth::user()->id);

		if (Hash::check($request->password_atual, $usuario->password))
		{

			$usuario->update(['password' => bcrypt($request->password)]);            

			return redirect('/')->with('sucesso','Senha alterada com sucesso.');
		}else{

			return back()->withErrors('Senha atual não confere');
		}

	}
}
