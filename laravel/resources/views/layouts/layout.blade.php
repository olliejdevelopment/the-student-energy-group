<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
      body {
        padding: 1rem;
      }
      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
      }
      nav {
        display: flex;
        align-items: center;
      }
      nav a {
        margin-right: 1rem;
        text-decoration: none;
        color: #333;
      }
    </style>
    @livewireStyles
  </head>
  <body>
    <header>
      <h1>{{ config('app.name') }}</h1>
      <nav>
        <a href="#">Home</a>
        <a href="#">Users</a>
        <a href="#">Meters</a>
        <a href="#">Meter Readings</a>
      </nav>
    </header>
    <main>
      @yield('content')
    </main>
    @livewireScripts
  </body>
</html>