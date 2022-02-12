<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Address;
use App\Models\State;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'cellphone' => ['required', 'string', 'max:16', 'phone:BR'],
            'cpf' => ['required', 'string', 'max:14', 'cpf'],
            'birthdate' => ['required', 'date_format:d/m/Y', 'before:-18 years'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'postal_code' => ['required', 'string'],
            'public_place' => ['required', 'string'],
            'street_number' => ['required', 'string', 'numeric'],
            'neighborhood' => ['required', 'string'],
            'city_id' => ['required', 'string'],
            'state_id' => ['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'cellphone' => only_numbers($data['cellphone']),
            'birthdate' => \Carbon\Carbon::parse(str_replace('/', '-', $data['birthdate']))->format('Y-m-d'),
            'cpf' => only_numbers($data['cpf']),
            'password' => Hash::make($data['password']),
            'slug' => Str::slug($data['name'], '-'),
        ]);

        $user->save();

        $user->slug = Str::slug($user->id . ' ' . $user->name, '-');

        $user->save();

        $address = new Address([
            'postal_code' => only_numbers($data['postal_code']),
            'public_place' => $data['public_place'],
            'street_number' => $data['street_number'],
            'neighborhood' => $data['neighborhood'],
            'complement' => $data['complement'],
            'city_id' => $data['city_id'],
            'slug' => Str::slug($data['postal_code'].' '.$data['street_number'], '-')
        ]);

        $user->address()->save($address);
        $user->assignRole('cliente');

        return $user;
    }

    /**
    * Show the application registration form.
    *
    * @return \Illuminate\Http\Response
    */
    public function showRegistrationForm()
    {
        if (!auth()->check()) {
            $states = State::all();
            return view('auth.register', ['title' => 'Criar uma Conta', 'states' => $states]);
        } else {
            return redirect()->route('pets.index');
        }
    }
}
