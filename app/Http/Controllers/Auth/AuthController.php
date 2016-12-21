<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\GithubServiceProvider;
// use App\Github;

class AuthController extends Controller {

    // protected $github;
    //
    // public function __construct(\App\Providers\GithubServiceProvider $github) {
    //   $this->github = $github;
    // }

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
      // try {
      //   $user = Socialite::driver('github')->user();
      // } catch (Exception $e) {
      //   return Redirect::to('auth/github');
      // }
      //
      // $authUser = $this->findOrCreateUser($user);
      //
      // Auth::login($authUser, true);
      //
      // return Redirect::to('dashboard');
      $githubUser = Socialite::driver('github')->user();
      // $gitHubUserRepos = $githubUser->user["repos_url"];
      // $gitHubUserRepos = $github->getProfile($githubUser->name);

      // $client = new \GuzzleHttp\Client();
      // $response = $client->request('GET', $gitHubUserRepos);
      //
      // $data = json_decode($response->getBody()->getContents(), true);

      dd($githubUser);
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
