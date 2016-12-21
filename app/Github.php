<?php

namespace App\Github;

class Github {

  public function getProfile($githubUsername)
  {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://api.github.com/users/' . $githubUsername);

    $data = json_decode($response->getBody()->getContents(), true);

    return [
      'avatar_url' => $data['avatar_url'],
      'name' => $data['name'],
    ];
  }

  public function getRepos($gitHubUserRepos)
  {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://api.github.com/users/' . $gitHubUserRepos . '/repos');

    $data = json_decode($response->getBody()->getContents(), true);

    return [
      'repo_count' => count($data),
      'repos' => $data,
    ];
  }
}
