<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Address;
use App\Models\State;

class UsersController extends Controller
{
	public function edit()
	{
		$user = auth()->user();
		$states = State::all();

		return view('users.edit', ['title' => 'Dados Pessoais', 'user' => $user, 'states' => $states]);
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|unique:users,email,' . auth()->user()->id,
			'cellphone' => 'required|phone:BR',
			'gender' => 'required',
			'birthdate' => 'required|date_format:d/m/Y',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		],
    [
    	'email.unique' => 'Já existe uma conta com este endereço de e-mail.'
    ]);

		$user = User::find(auth()->user()->id);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->phone = only_numbers($request->get('phone'));
		$user->cellphone = only_numbers($request->get('cellphone'));
		$user->birthdate = \Carbon\Carbon::parse(str_replace('/', '-', $request->get('birthdate')))->format('Y-m-d');
		$user->gender = $request->get('gender');
		$user->cpf = only_numbers($request->get('cpf'));

		if ($request->hasFile('avatar')) {
			Storage::delete($request->get('current_file'));
			$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
		}

		$user->slug = Str::slug($request->get('name'), '-');
		$user->save();

		if (!$user->address) {
			$address = new Address();
		} else {
			$address = Address::find($user->address->id);
		}

		$address->postal_code = only_numbers($request->get('postal_code'));
		$address->public_place = $request->get('public_place');
		$address->street_number = $request->get('street_number');
		$address->neighborhood = $request->get('neighborhood');
		$address->city_id = $request->get('city_id');
		$address->complement = $request->get('complement');
		$address->slug = Str::slug($request->get('postal_code').' '.$request->get('street_number'), '-');

		$user->address()->save($address);

		return redirect()->route('users.edit')->with('success', 'Usuário salvo com sucesso');
	}

	// Change password

	public function edit_password()
	{
		$user = auth()->user();
		return view('users.edit_password', ['title' => 'Alterar Senha', 'user' => $user]);
	}

	public function update_password(Request $request)
	{
		$request->validate([
			'password' => ['required', 'string', 'min:8', 'confirmed']
		]);

		$user = User::find(auth()->user()->id);

		$user->password = bcrypt($request->get('password'));
		$user->save();

		return redirect()->route('users.edit_password')->with('success', 'Senha alterada com sucesso');
	}
}
