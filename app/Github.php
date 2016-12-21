<?php

namespace App;

class Github {

  public function getProfile($githubUsername)
  {
    // Get Profile Info
    $client_profile = new \GuzzleHttp\Client();
    $response_profile = $client_profile->request('GET', 'http://api.github.com/users/' . $githubUsername);
    $data_profile = json_decode($response_profile->getBody()->getContents(), true);

    // Get Repos
    $client_repos = new \GuzzleHttp\Client();
    $response_repos = $client_repos->request('GET', 'http://api.github.com/users/' . $githubUsername . '/repos');
    $data_repos = json_decode($response_repos->getBody()->getContents(), true);

    // Get Issues for each Repo and append the repo array
    $data_repos_final = [];
    foreach ($data_repos as $repo ) {
      $client_repo_issues = new \GuzzleHttp\Client();
      $response_repo_issues = $client_repo_issues->request('GET', 'http://api.github.com/repos/' . $repo["full_name"] . '/issues');
      $data_repo_issues = json_decode($response_repo_issues->getBody()->getContents(), true);
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
