@extends('layouts.master')
@section('title','Contact Owner')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/contact.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="right-side">
        <div class="topic-text" style="color: #6504b4; font-size:23px;"><strong> Interested in adopting this pet? Send owner a quick message. </strong></div>
        <p>If you have any questions or inquiries, you can contact the owner by sending a message.</p>
        <p><b>Owner Email: </b> {{ $owner['email'] }}</p>
        <form action="{{ route('send-email', 'owner') }}" method="POST">
            @csrf
            <input type="hidden" name="receiver_email" value="{{ $owner['email'] }}">
            <div class="input-box">
          @if (session()->has('user_id'))
          <input type="text" placeholder="Enter your name" name="name" value="{{$user['fname']}} {{$user['lname']}}" required>
          @else
          <input type="text" placeholder="Enter your name" name="name"  required>
          @endif            </div>
            <div class="input-box">
          @if (session()->has('user_id'))
            <input type="text" placeholder="Enter your email" name="email" value="{{$user['email']}}" required>
            @else
            <input type="text" placeholder="Enter your email" name="email" required>
          @endif            </div>
            <div class="input-box message-box">
            <textarea placeholder="Enter your message" name="message" required></textarea>
            </div>
            <div class="button" style="background-color: rgba(0, 0, 0, 0.2)">
                <input type="button" value="Send Now" onclick="this.form.submit();">
            </div>
            <div class="back"></br> Return home? <a href="/">Home</a></div>
        </form>
    </div>
    </div>
    </div>
@endsection