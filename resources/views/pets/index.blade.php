@extends('layouts.master')
@section('title','Pet Care Hub')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
@endsection

@section('content')
    <!-- Slider main container -->
    <main class="image-slider">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="./images/slider_1.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="./images/slider_2.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="./images/slider_3.jpg">
                </div>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </main>
         <div>
            {{-- <h1 class="fw-bold text-center">Find your new best friend</h1> --}}
            <h1 class="heading fw-bold m-0 p-3 text-center">Find your new best friend</h1>
        </div>
    <section class="container d-flex align-items-center justify-content-center pet-options">
        {{-- <div>
            <h1 class="fw-bold text-center">Find your new best friend</h1>
        </div> --}}
        <div class="d-flex card-container flex-wrap">
            <div class="card">
                <a class="nav-link" href="filter-pets?type=dog"><img src="./images/dog.png" alt="dog">
                    <p class="text-center">Dogs</p>
                </a>
            </div>
            <div class="card">
                <a class="nav-link" href="filter-pets?type=cat"><img src="./images/cat.png" alt="cat">
                    <p class="text-center">Cats</p>
                </a>
            </div>
            <div class="card">
                <a class="nav-link" href="filter-pets?type=bird"><img src="./images/paw.png" alt="other animals">
                    <p class="text-center">Other Animals</p>
                </a>
            </div>
                       <div class="card">
                <a class="nav-link" href="{{route('breeds')}}"><img src="./images/happy.png" alt="Cat">
                    <p class="text-center">Meow</p>
                </a>
            </div>
        </div>
    </section>


    <!-- Featured Pets -->
    <section class="container-fluid bg-white">
        <div class="container d-flex flex-column align-items-center">
            <div>
                <h1 class="heading fw-bold m-0 p-3">Featured Pets</h1>
            </div>

            <div class="d-flex flex-wrap featured-pet container justify-content-evenly p-0 pb-3">
                   @foreach ($pets as $pet)
                    <div class="featured-pet-card">
                    <a href="{{ route('pet-profile', [$pet['id'], 'profile']) }}" class="nav-link">
                        <div class="featured-pet-image">
                            <img src="{{asset('uploads/'.$pet['pet_image'])}}" width="230px" alt=""> 



                 @if(in_array($pet['id'], session('favourites', [])))

 <a href="{{ route('removefav', $pet['id']) }}" class="fa-solid fa-heart favourite-icon" id="{{ $pet['id'] }}">
    </a>
                @else
 <a href="{{ route('addfav', [$pet['id']]) }}" class="fa-regular fa-heart favourite-icon" id="{{ $pet['id'] }}">
    </a>
                @endif



                        </div>
                        <div class="featured-pet-content">
                            <h3 class="text-center fw-bold">{{$pet['pet_name']}}</h3>
                            <p class="text-center m-0">{{$pet['gender']}}</p>
                            <p class="text-center m-0">
                                @if ($pet['province'])
                                    {{$pet['province']}}
                                @endif
                            </p>
                        </div>
                    </a>
                </div>
                   @endforeach

      
            </div>
        </div>
    </section>

    <!-- Adoption Process -->
    <section class="container-fluid d-flex align-items-center justify-content-center flex-column adoption-process">
        <div>
            <h1 class="heading fw-bold m-0 p-3 text-center">Pet Adoption Process</h1>
        </div>
        <div class="d-flex flex-wrap justify-content-evenly w-100 pb-3">
            <div class="adopt-pet-card d-flex align-items-center flex-column bg-white">
                <img src="./images/adopt_process_1.jpg" alt="">
                <h3 class="fw-bold">Find your pet</h3>
            </div>
            <div class="adopt-pet-card d-flex align-items-center flex-column bg-white">
                <img src="./images/adopt_process_2.jpg" alt="">
                <h3 class="fw-bold">Know your pet</h3>
            </div>
            <div class="adopt-pet-card d-flex align-items-center flex-column bg-white">
                <img src="./images/adopt_process_3.jpg" alt="">
                <h3 class="fw-bold">Take your pet home</h3>
            </div>
        </div>
    </section>


    <!-- Achievement Section -->
    <section class="achievements bg-white">
        <div class="achievement-container container">
            <div>
                <h1 class="text-center fw-bold m-0 p-3 heading">Our Achievements</h1>
            </div>
            <div class="d-flex flex-wrap container justify-content-evenly pb-3">
                <div class="achievement-card p-4">
                    <img class="me-3 p-2" src="./images/achieve_1.png" alt="">
                    <div>
                        <h1 class="fw-bold fs-2 m-0" style="color: #fabe2c;">{{ $totalUsers }}</h1>
                        <h1 class="fs-5 m-0">Members</h1>
                    </div>
                </div>
                <div class="achievement-card p-4">
                    <img class="me-3 p-2" src="./images/achieve_2.png" alt="">
                    <div>
                        <h1 class="fw-bold fs-2 m-0" style="color:#458377;">{{ $totalPets }}</h1>
                        <h1 class="fs-5 m-0">Happy Pets</h1>
                    </div>
                </div>
                <div class="achievement-card p-4">
                    <img class="me-3 p-2" src="./images/achieve_3.png" alt="">
                    <div>
                        <h1 class="fw-bold fs-2 m-0" style="color:#e86581;">{{$totalDonations}}</h1>
                        <h1 class="fs-5 m-0">Donations</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        spaceBetween: 30,
        slidesPerView: 1,
        centeredSlides: true,
        loop: true,
        keyboard: {
            enabled: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        }
    });

//after loading in same position 
document.querySelectorAll('.favourite-icon').forEach(icon => {
    icon.addEventListener('click', () => {
        localStorage.setItem('scrollPosition', window.scrollY);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const savedScrollPos = localStorage.getItem('scrollPosition');
    if (savedScrollPos) {
        window.scrollTo(0, parseInt(savedScrollPos, 10));
        localStorage.removeItem('scrollPosition'); // Clear saved position
    }
});

</script>
<script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>
@endsection