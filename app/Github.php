<?php

namespace App;

use GuzzleHttp\Client;

class Github {

  protected $client;

  public function __construct() {
    $this->client = new Client([
      'base_uri' => 'http://api.github.com'
    ]);
  }

  private function fromJson($response) {
    return json_decode($response->getBody()->getContents(), true);
  }

  public function getProfile($githubUsername) {

    // Get Profile Info
    $data_profile = $this->fromJson($this->client->get("/users/{$githubUsername}"));

    // Get Repos
    $data_repos = $this->fromJson($this->client->get("/users/{$githubUsername}/repos"));

    // Get Issues for each Repo and append the repo array
    $data_repos_final = [];

    foreach ($data_repos as $repo) {
      $data_repo_issues = $this->fromJson($this->client->get("/repos/{$repo["full_name"]}/issues"));
      $repo["issues_list"] = $data_repo_issues;
      array_push($data_repos_final, $repo);
    }

    return [
      'avatar_url' => $data_profile['avatar_url'],
      'name' => $data_profile['name'],
      'nickname' => $data_profile['login'],
      'repo_count' => count($data_repos),
      'repos' => $data_repos_final,
    ];
  }
}
