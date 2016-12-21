<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use View;
use \App\Github;

class AuthController extends Controller {

    protected $github;

    public function __construct(\App\Github $github) {
      $this->github = $github;
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
    public function handleProviderCallback(Github $github) {
      try {
        $githubUser = Socialite::driver('github')->user();
      } catch (Exception $e) {
        return Redirect::to('auth/github');
      }
      //
      // $authUser = $this->findOrCreateUser($user);
      //
      // Auth::login($authUser, true);

      $githubUsername = $githubUser->nickname;
      $githubProfile = $github->getProfile($githubUsername);
      $githubRepos = $github->getRepos($githubUsername);

      // dd($githubRepos);

      return View::make('dashboard')->with('githubProfile', $githubProfile);
    }

    /**
     * Return users if exists; create and return if not
     *
     * @param $githubUser
     * @return User
     */
    protected function findOrCreateUser($githubUser) {
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
