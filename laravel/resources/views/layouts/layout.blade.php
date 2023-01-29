<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
      body {
        padding: 0px;
        margin: 0px;
        font-size: 14px;
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
    <header class="d-flex align-items-center justify-content-between bg-light p-3">
      <a class="navbar-brand" href="#">
        <img src="https://thestudentenergygroup.com/images/tseg-logo.png" height="40" alt="Logo">
      </a>
      <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.customer.index') }}">Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.meter.index') }}">Meters</a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                
                Logged in as {{ Auth::user()->name }}
                {{-- <i class="fas fa-user"></i> --}}
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <main>
      <div class="container">
        @yield('content')
      </div>
    </main>
    @livewireScripts
  </body>
</html>