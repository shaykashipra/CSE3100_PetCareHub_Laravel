<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/index.css')}}">
    <link rel="stylesheet" href="{{asset('/css/nav.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sidebar.css')}}">
    <title>@yield('title')</title>
    @yield('head')

</head>
<body>
    {{-- Header --}}
    <header class="bg-white">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo d-flex align-items-center">
                <a href="/" class="nav-link d-flex align-items-center">
                    <img src="{{asset('/images/logo.png')}}" class="img-fluid" alt="">
                    {{-- <h1 class="fs-3"></h1> --}}
                </a>
            </div>
            <div class="d-flex align-items-center">
                <div class="login-btn">
                    @if (session()->has('user_id'))
                    <a href="{{asset('/favourites')}}"><i class="fa-solid fa-heart" title="Favourites"></i></a>
                    <a href="{{ route('logout') }}">Logout</a>
                    @else
                    <a href="{{route('register')}}">SignUp</a>
                    <a href="{{route('login')}}">Login</a>
                    @endif
                </div>
                 @if (session()->has('user_id'))
                <div class="profile circular-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hello, {{ session('user_name') }} " >
                    <a class="navbar-brand" href="{{ url('/profile') }}">
                        
                        <img src="{{asset('uploads/'.session()->get('user_image','user.png'))}}" alt="">
                    </a>
                </div>
                @endif
            </div>
            </div>
        </div>
    </header>

    <div id="wrapper" class="d-flex">
        <!-- SideBar -->
        <nav id="sidebar">
            <ul class="navbar-nav">
                <li title="Profile" class="nav-item ps-2">
                    <a href="./profile" class="nav-link active text-white" aria-current="page">
                        <i class="fa-solid fa-user pe-3"></i>
                        <span class="sidebar-item pe-3">Profile<span>
                    </a>
                </li>
                @if(session()->has('user_id')&& session()->get('is_admin')==='1')
                 
                    <li title="Dashboard" class="nav-item ps-2">
                        <a href="./dashboard" class="nav-link active text-white" aria-current="page">
                            <i class="fa-solid fa-chart-column pe-3"></i>
                            <span class="sidebar-item pe-3">Dashboard<span>
                        </a>
                    </li>
                    <li title="Users" class="nav-item ps-2">
                        <a href="./users" class="nav-link active text-white" aria-current="page">
                            <i class="fa-solid fa-users pe-3"></i>
                            <span class="sidebar-item pe-3">Users<span>
                        </a>
                    </li>
                    <li title="Pets" class="nav-item ps-2">
                        <a href="{{asset('/pets')}}" class="nav-link active text-white" aria-current="page">
                            <i class="fa-solid fa-dog pe-3"></i>
                            <span class="sidebar-item pe-3">Pets<span>
                        </a>
                    </li>

                @endif
                <li title="Add a Pet" class="nav-item ps-2">
                    <a href="{{asset('/add-pet')}}" class="nav-link active text-white pe-3" aria-current="page">
                        <i class="fa-solid fa-paw pe-2"></i>
                        <span class="sidebar-item pe-3">Add a Pet</span>
                    </a>
                </li>
                <li title="Favourites" class="nav-item ps-2">
                    <a href="{{asset('/favourites')}}" class="nav-link active text-white pe-3" aria-current="page">
                        <i class="fa-solid fa-heart pe-2"></i>
                        <span class="sidebar-item pe-3">Favourites</span>
                    </a>
                </li>
                <li title="Clinic" class="nav-item ps-2">
                    <a href="{{route('clinic')}}" class="nav-link active text-white pe-3" aria-current="page">
                        <i class="fa-solid fa-house-medical pe-2"></i>
                        <span class="sidebar-item pe-3">Clinic</span>
                    </a>
                </li>
                <li title="Hospital" class="nav-item ps-2">
                @if(session()->has('user_id')&& session()->get('is_admin')==='1')
                <a href="{{route('donation.show')}}" class="nav-link active text-white pe-3" aria-current="page">
                 @else
                    <a href="{{route('donation')}}" class="nav-link active text-white pe-3" aria-current="page">
                @endif
                        <i class="fa-solid fa-hand-holding-medical pe-2"></i>
                        <span class="sidebar-item pe-3">Donation</span>
                    </a>
                </li>
                <li class="nav-item ps-2">
                    <a href="./settings" class="nav-link active text-white pe-3" aria-current="page">
                        <i title="Account Settings" class="fa-solid fa-gear pe-2"></i>
                        <span class="sidebar-item pe-3">Settings</span>
                    </a>
                </li>
                <li title="Logout" class="nav-item ps-2">
                    <a href="./logout" class="nav-link active text-white pe-3" aria-current="page">
                        <i class="fa-solid fa-right-from-bracket pe-2"></i>
                        <span class="sidebar-item pe-3">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        {{-- Content --}}
        @yield('content')
    </div>

    {{-- JavaScript --}}
    @yield('js')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>
</html>