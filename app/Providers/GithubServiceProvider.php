<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GithubServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // }

    /**
     * Register the application services.
     *
     * @return void
     */
    // public function register()
    // {
    //     $this->app->bind('app\Github', function($app) {
    //       return new App\Github($app);
    //     });
    // }
    public function register()
    {
        $this->app->bind(App\Github::class, function() {
          return new \App\Github;
        });
    }

    // public function getProfile($githubUsername)
    // {
    //   $client = new \GuzzleHttp\Client();
    //   $response = $client->request('GET', 'http://api.github.com/users/' . $githubUsername);
    //
    //   $data = json_decode($response->getBody()->getContents(), true);
    //
    //   return [
    //     'avatar_url' => $data['avatar_url'],
    //     'name' => $data['name'],
    //   ];
    // }
    //
    // public function getRepos($gitHubUserRepos)
    // {
    //   $client = new \GuzzleHttp\Client();
    //   $response = $client->request('GET', 'http://api.github.com/users/' . $gitHubUserRepos . '/repos');
    //
    //   $data = json_decode($response->getBody()->getContents(), true);
    //
    //   return [
    //     'repo_count' => count($data),
    //     'repos' => $data,
    //   ];
    // }
}
