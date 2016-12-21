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

      $githubUsername = $githubUser->nickname;
      $githubProfile = $github->getProfile($githubUsername);

      return View::make('dashboard')->with('githubProfile', $githubProfile);
    }
}
