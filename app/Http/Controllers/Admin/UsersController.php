<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

use App\Models\User;

class UsersController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['role:admin'], ['except' => ['edit', 'update']]);
  }
  
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {
			$users = User::orderBy('created_at')->paginate(10);
		} else {
			$users = User::where('name', 'LIKE', '%'.$request->get('keyword').'%')->get();
		}

		return view('admin.users.index', ['title' => 'Usuários', 'users' => $users]);
	}

	public function create()
	{
		$roles = Role::get();
		return view('admin.users.create', ['title' => 'Novo Usuário', 'roles' => $roles]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => 'required|min:8|confirmed',
			'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = new User([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => bcrypt($request->get('password')),
			'phone' => only_numbers($request->get('phone')),
			'cellphone' => only_numbers($request->get('cellphone')),
			'birthdate' => !$request->get('birthdate') ? NULL : \Carbon\Carbon::parse(str_replace('/', '-', $request->get('birthdate')))->format('Y-m-d'),
			'gender' => $request->get('gender'),
			'cpf' => only_numbers($request->get('cpf')),
			'avatar' => !$request->hasFile('avatar') ? NULL : $request->avatar->store('uploads/users/' . Str::slug($request->get('name'), '-')),
			'slug' => Str::slug($request->get('name'), '-')
		]);

		$user->save();
		$user->assignRole($request->input('role'));

		return redirect()->route('admin.users.index')->with('success', 'Usuário salvo com sucesso');
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::get();
		return view('admin.users.edit', ['title' => 'Editar Usuário', 'user' => $user, 'roles' => $roles]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => 'nullable|min:8|confirmed',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = User::find($id);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		if ($request->get('password')) {
			$user->password = bcrypt($request->get('password'));	
		}
		$user->phone = only_numbers($request->get('phone'));
		$user->cellphone = only_numbers($request->get('cellphone'));
		$user->birthdate = !$request->get('birthdate') ? NULL : \Carbon\Carbon::parse(str_replace('/', '-', $request->get('birthdate')))->format('Y-m-d');
		$user->gender = $request->get('gender');
		$user->cpf = only_numbers($request->get('cpf'));

		if ($request->hasFile('avatar')) {
			Storage::delete($request->get('current_file'));
			$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
		}

		$user->slug = Str::slug($request->get('name'), '-');
		$user->save();

		if($request->input('role')) {
			foreach ($user->roles as $key => $user_role) {
				$user->removeRole($user_role);
			}
			$user->assignRole($request->input('role'));
		}

		if(!auth()->user()->hasRole('admin')) {
			return redirect()->route('admin.users.edit', $id)->with('success', 'Usuário salvo com sucesso');
		}

		return redirect()->route('admin.users.index')->with('success', 'Usuário salvo com sucesso');
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		return redirect()->route('admin.users.index')->with('success', 'Usuário apagado com sucesso');
	}

	public function show($slug)
	{
		return view('admin.users.show', ['user' => User::where('slug', $slug)->first()]);
	}

	// Custom methods

	public function pdf(Request $request, $id)
  {
  	$user = User::find($id);

  	$data = [
  		'user' => $user
  	];

    $pdf = PDF::loadView('admin.users.pdf', $data, [], [ 'default_font_size' => '10', 'margin_top' => 40, 'margin_bottom' => 40 ]);
    return $pdf->download(Str::slug($user->name, '-') . '.pdf');
  }
}
