@extends('layouts.sidebar')
@section('title','Clinic Home')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/profile.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="./styles/index.css"> --}}
    {{-- <link rel="stylesheet" href="{{asset('/css/home.css')}}"> --}}


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
   {{-- For Animation --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
 {{-- Custom css --}}


    <style>
     .option_container {
    display: flex;
    justify-content: center; 
    flex-direction: column;
}

.option_card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; 
    gap: 20px;
    margin-top: 20px; 
}

.pet-options {
  align-items: center;
}

.pet-options div a img {
  width: 100px;
  margin-bottom: 11px;
  margin-left: 20px;
  margin-right: auto;
}
.card{
  margin-bottom: 30px;
}
.card a {
  padding: 17px 35px;
}
.pet-options div {
  margin: 20px;
  min-width: 162px;
}
.card:hover {
  border: 1px solid var(--secondary);
  color: var(--secondary);
}
.pet-options div h1 {
  color: var(--secondary);
}

         .hero-section-div {
            display: flex;
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            text-align: center; 
        }
    .custom-hero {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    #redirectBtn {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        
    }
    
   .btn-primary {
    background-color: hsl(273, 100%, 40%) !important; 
    border-color: hsl(273, 100%, 36%) !important;
}

.btn-primary:hover {
    background-color: hsl(273, 86%, 26%) !important; 
    border-color: hsl(273, 86%, 26%) !important;
}



    
</style>
    
@endsection

@section('content')

   
 
<section id="content" class="container-fluid">
    @if (session('status') === 'appointment_booked')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong>Appointment Form Submitted
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif

    
<div id="clinic">
    <div class="container-fluid d-flex align-items-center">
            <button type="button" id="sideBarCollapse" class="btn btn-secondary me-3"><i class="fa-solid fa-bars"></i></button>
            <h1 class="fw-bold">Clinic</h1>
        </div>
        <div class="hero-section">
        <div class="hero-section-div">
            <h1 class="animate__animated animate__fadeInDown">Online vet appointments.</h1>
            <p class="animate__animated animate__fadeInRight">VetCare connects pet owners to thousands of licenced veterinary surgeons & nurses ready to provide the
                best online vet services through video chat appointments 24/7.</p>
            <div id="redirectBtn">
                @if(session('user_id'))

   <a href="{{route('appointment_form')}}" class="btn btn-primary btn-lg animate__animated animate__heartBeat">
                            <i class="fa-solid fa-video"></i> Book an online vet now
             </a>
                @else
     <a href="{{route('appointment_form')}}" class="btn btn-primary btn-lg animate__animated animate__heartBeat">
                            <i class="fa-solid fa-video"></i> Book an online vet now
                        </a>
                @endif
            </div>
        </div>
        <div class="hero-section-img">
            <!-- Image content here -->
        </div>
    </div>
   <section class="option_container d-flex align-items-center justify-content-center pet-options">
  <div class="row">

        <div class="d-flex option_card-container flex-wrap">
<div class="col-xs-6 col-md-4">
            <div class="card">
                <a class="nav-link" href="{{route('appointment_list')}}"><img src="{{asset('/images/appointment_list.png')}}" alt="appointment_list">
                    <p class="text-center">Appointments</p>
                </a>
            </div>
</div>
<div class="col-xs-6 col-md-4">
            <div class="card">
                <a class="nav-link" href="{{route('connect')}}"><img src="{{asset('/images/video-call.png')}}" alt="video-call">
                    <p class="text-center">Appointment Online</p>
                </a>
            </div>
</div>

@if($user->is_admin)
<div class="col-xs-6 col-md-4">
            <div class="card">
                <a class="nav-link" href="{{route('admin_app_list.edit')}}"><img src="{{asset('/images/book_appointment.png')}}" alt="book_appointment">
                    <p class="text-center">Admin Appointment</p>
                </a>
            </div>
</div>

<div class="col-xs-6 col-md-4">
            <div class="card">
                <a class="nav-link" href="{{route('doctors.edit')}}"><img src="{{asset('/images/doctor.png')}}" alt="Doctor List">
                    <p class="text-center">Doctor List</p>
                </a>
            </div>
</div>
@endif
        </div>
  </div>
    </section>

</div>
</section>
@endsection

@section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{asset('/js/clinicHome.js')}}"></script>

           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

@endsection

