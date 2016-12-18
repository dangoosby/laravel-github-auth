<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Redirection to Github authentication
     *
     * @return Response
     */
    public function redirectToProvider() {
      return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain user info from Github
     *
     * @return Response
     */
    public function handleProviderCallback() {
      try {
        $user = Socialite::driver('github')->user();
      } catch (Exception $e) {
        return Redirect::to('auth/github');
      }

      $authUser = $this->findOrCreateUser($user);

      Auth::login($authUser, true);

      return Redirect::to('home');
    }

    /**
     * Return users if exists; create and return if not
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser) {
      if ($authUser = User::where('github_id', $githubUser->id)->first()) {
        return $authUser;
      }

      return User::create([
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_id' => $githubUser->id,
        'avatar' => $githubUser->avatar
      ]);
    }
}
