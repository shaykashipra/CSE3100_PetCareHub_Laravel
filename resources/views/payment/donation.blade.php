@extends('layouts.master')
@section('title','Donation')
@section('head')
    <!-- Responsive Contact Us Form-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/contact.css')}}">
@endsection
@section('content')

<div class="container">
  @if(session('status')==='donation_successful')
 <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong>Transaction is Successful
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
@elseif(session('status')==='donation_unsuccessful')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success! </strong>Transaction is Unsuccessful
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
@endif

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
                <div class="topic-text">How Your Donation Helps</div>

            <p>Your donation supports our mission to care for and find homes for pets in need. Contributions go towards medical treatments, food, shelter upkeep, and our spay/neuter program.</p>
                <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
  
      {{-- <form action="{{ route('send-email', 'admin') }}" method="POST"> --}}
                    {{-- @csrf --}}
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />

             <div class="input-box">

                    @if (session()->has('user_id'))
                    <input type="text" placeholder="Enter your Full name" name="customer_name" id="customer_name" value="{{$user['fname']}} {{$user['lname']}}" required>
                    @else
                    <input type="text" placeholder="Enter your Full name" name="customer_name" id="customer_name" required>
                    @endif

             </div>
             <div class="input-box">
                        @if (session()->has('user_id'))
                            <input type="text" placeholder="Enter your mobile" name="customer_mobile" id="customer_mobile"  value="{{$user['phone']}}" required>
                            @else
                            <input type="text" placeholder="Enter your mobile" name="customer_mobile" id="customer_mobile" required>
                        @endif                  
            </div>
            <div class="input-box">
                        @if (session()->has('user_id'))
                            <input type="email" placeholder="Enter your email" name="customer_email" id="customer_email" value="{{$user['email']}}" required>
                            @else
                            <input type="email" placeholder="Enter your email" name="customer_email" id="customer_email" required>
                        @endif                  
            </div>
                    <div class="input-box">

                        <input type="number" placeholder="Donation Amount" name="amount" required min="1">
                    </div>
                    <div class="input-box message-box">
                        <textarea placeholder="Leave a Message (Optional)" name="message"></textarea>
                    </div>
                    <div class="button" style="background-color: rgba(0, 0, 0, 0.2)">
                    {{-- <input type="button" value="Send Now" onclick="this.form.submit();"> --}}
                <button class="btn btn-primary btn-lg btn-block" style="background-color: hsl(273, 100%, 40%)" type="submit">Donate</button>
   
                </div>
          <div class="back"> <br> Return home? <a class="nav-link fw-bold d-inline" href="/">Home</a></div>
                </form>




            </div>
        </div>
   
</div>


@endsection

@section('js')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u3ljzL98f6o+0OhKziEJvQHVbzULYP1KN0TPQGAF72wVqOwDvOCQz7+QIh3NQ3T9" crossorigin="anonymous"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var closeButtons = document.querySelectorAll('.btn-close');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.target.closest('.alert').remove(); // Removes the alert on click
        });
    });
});
</script>
@endsection