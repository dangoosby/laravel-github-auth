<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Github Auth</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Open Sans', sans-serif;
                font-size: 18px;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 64px;
                font-family: 'Lato';
            }

            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <img src="{{ $githubProfile["avatar_url"]}}" width="200">
                <div class="title">{{ "github.com/" . $githubProfile["nickname"] }}</div>
                <table>
                  <tr>
                    <th>Repository Name</th>
                    <th>Repository Description</th>
                    <th>Issue Count</th>
                    <th>Issues List</th>
                  </tr>
                  @foreach ($githubProfile["repos"] as $repo)
                    <tr>
                      <td>{{ $repo["name"] }}</td>
                      <td>{{ $repo["description"] }}</td>
                      <td>{{ $repo["open_issues_count"] }}</td>
                      <td>
                        @foreach ($repo["issues_list"] as $issue)
                          <li> {{ $issue["title"] }} </li>
                        @endforeach
                      </td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
