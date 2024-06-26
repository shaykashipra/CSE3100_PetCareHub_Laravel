@extends('layouts.master')
@section('title','Contact Us')
@section('head')
    <!-- Responsive Contact Us Form-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/contact.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="content">
        
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Mirpur 10</div>
          <div class="text-two">Dhaka</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+880 16260 52742</div>
          <div class="text-two">+880 19156 09241</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">triviatruism@gmail.com</div>
          <div class="text-two">shaykashipra@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
          @if (session('status') === 'email-sent')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong>Email has be sent to Admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        <div class="topic-text">Send us a message</div>
        <p>If you have any questions or inquiries, you can contact us by sending us a message. It will be our pleasure to help you.</p>
      <form action="{{ route('send-email', 'admin') }}" method="POST">
        @csrf
        <div class="input-box">
          @if (session()->has('user_id'))
          <input type="text" placeholder="Enter your name" name="name" value="{{$user['fname']}} {{$user['lname']}}" required>
          @else
          <input type="text" placeholder="Enter your name" name="name"  required>
          @endif
        </div>
        <div class="input-box">
          @if (session()->has('user_id'))
            <input type="text" placeholder="Enter your email" name="email" value="{{$user['email']}}" required>
            @else
            <input type="text" placeholder="Enter your email" name="email" required>
          @endif
        </div>
        <div class="input-box message-box">
        <textarea placeholder="Enter your message" name="message" required></textarea>
        </div>
        <div class="button" style="background-color: rgba(0, 0, 0, 0.2)">
          <input type="button" value="Send Now" onclick="this.form.submit();">
        </div>
        <div class="back"> <br> Return home? <a class="nav-link fw-bold d-inline" href="/">Home</a></div>
      </form>
    </div>
    </div>
  </div>
@endsection
@section('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
@endsection