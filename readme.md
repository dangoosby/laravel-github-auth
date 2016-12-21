## Laravel Github Authorization

A Laravel 5 web application that utilizes the Github API for authorization and reading user's repository info.

This application satisfies:
- User can authenticate with GitHub
- User can view a list of his/her GitHub repositories
- User can view a list of issues for each of his/her GitHub repositories

Laravel Components Used:
- [Socialite](https://github.com/laravel/socialite)

3rd Party Components Used:
- [Guzzle](https://github.com/guzzle/guzzle)

### Prereqs
- [Install the latest version of PHP](http://php.net)
- [Laravel](https://laravel.com/docs/5.3/installation)
- [Composer](https://getcomposer.org/download/)
- [Register New Github Developer Application](https://github.com/settings/applications/new)

### Preparation
- In the root directory, create an _.env_ file (by copying the _.env.example_) and fill in the necessary globals _GITHUB_CLIENT_ID, GITHUB_SECRET, GITHUB_URL_ with the values from the newly registered Github application.
- In the root directory, run the command _php artisan key:generate_
- In the root directory, run the command _composer install_

### Running
- In the root directory, run the command _php artisan serve_
