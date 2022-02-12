<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    public function authenticated(Request $request, $user) {

        if ( $user->hasRole('admin') || $user->hasRole('gerente') ) {
            return redirect()->route('admin.home');
        }

        return redirect($request->headers->get('referer'));
    }

    /**
    * Show the application login form.
    *
    * @return \Illuminate\Http\Response
    */
    public function showLoginForm()
    {
        if (!auth()->check()) {
            return view('auth.login', ['title' => 'Entrar']);
        } else {
            return redirect()->route('admin.home');
        }
    }

    /**
    * Redirect the user to the Google authentication page.
    *
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
    * Obtain the user information from Google.
    *
    * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();

        if(!$existingUser) {
            $newUser = new User([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'slug' => Str::slug($user->name, '-'),
            ]);

            $newUser->save();

            $newUser->slug = Str::slug($user->id . ' ' . $user->name, '-');

            $newUser->save();

            auth()->login($newUser, true);
        } else {
            auth()->login($existingUser, true);
        }

        return redirect()->to('/');
    }
}
