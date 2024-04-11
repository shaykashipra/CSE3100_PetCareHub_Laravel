@extends('layouts.sidebar')
@section('title','Users')
@section('head')
<style>
    
body{
    background-color: rgb(234, 234, 234);
    color: rgb(0, 0, 0);
    font-family: 'Poppins', sans-serif;
    margin: 0px;
}

#h1{
    font-size: 300%;
    text-align: center;
    /* margin-top: 110px; */
    /* border: 1px solid; */
}

#h2{
    text-align: center;
    /* margin-top: -20px; */
}

#wrapp{
    height: 90vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
/* @media only screen and (max-width: 600px) {
    #logo{
        width: 200%;
        margin: auto;
    }
  } */

  #logo2 {
    width: 100%;
}
#logoDiv{
    width: 12%;
    margin: auto;
    margin-bottom: 0;
    margin-top: 0;
    /* border: 1px solid wheat; */
}

#form{
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-top: 25px;
    /* border: 1px solid white; */
}

input{
    padding: 10px 20px;
    font-family: 'Poppins', sans-serif;
    margin-right: 10px;
    border-radius: 5px;
    border: none;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
}

button{
    padding: 10px 20px;
    background-color: #4f4f4f;
    font-family: 'Poppins', sans-serif;
    font-size: 20px;
    font-weight: 900;
    color: white;
    cursor: pointer;
    transition: .5s;
    border: none;
    border-radius: 5px;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
}

button:hover{
    background-color: hsl(273, 100%, 40%) ;
    color: #ffffff;
}


</style>
    {{-- <link rel="stylesheet" href="styles/appointment_list.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="./styles/navbar.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
@endsection

@section('content')

<div id="content" class="container-fluid">

        <div class="container-fluid d-flex align-items-center">
            <button type="button" id="sideBarCollapse" class="btn btn-secondary me-3"><i class="fa-solid fa-bars"></i></button>
            <h1 class="fw-bold">Appointment List</h1>
        </div>
         @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <p class="mb-0 text-danger">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    <div id="wrapp">
        <div id="logoDiv">
            <img id="logo2" src="https://mdbootstrap.com/img/Photos/new-templates/animal-shelter/logo.png" alt="logo">
        </div>
    <h1 id="h1">VetCare Virtual Meet </h1>
    <h2 id="h2">Enter Room ID to Connect</h2>

    
        <div id="form">
            <label for="meetingID"></label>
            <br>
            <input type="text" placeholder="Meeting ID" name="meetingID" id="meetingID" class="me-2"><br>
            <label for="meetingPassword"></label>
            <br>
            <input type="password" placeholder="Meeting Password" name="meetingPassword" id="meetingPassword" class="me-2"><br>
            <button id="joinMeeting">Connect</button>
        </div>
    </div> 

         <div id="meetingFrame" style="display:none; margin-top:20px;">
            <iframe id="zoomMeeting" width="720" height="405" frameborder="0" allowfullscreen></iframe>
        </div>
    
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
// Toggling the sidebar menu
$(document).ready(function () {
    $("#sideBarCollapse").on("click", function () {
        $("#sidebar").toggleClass("active");
    });
});

   $(document).ready(function () {
        $("#joinMeeting").click(function (e) {
            e.preventDefault();
            var meetingID = $("#meetingID").val();
            var meetingPassword = $("#meetingPassword").val();
            
           // Check if meeting ID and password are provided
    if (meetingID === '' || meetingPassword === '') {
        alert('Please enter both a meeting ID and a password.');
        return;
    }

    // Construct the meeting URL with encoded password
 var meetingURL = "https://us04web.zoom.us/j/" + encodeURIComponent(meetingID) + "?pwd=" + encodeURIComponent(meetingPassword);

// var meetingURL="https://zoom.us/wc/join/"+meetingID+"?pwd="+meetingPassword;   
     // var meetingURL="https://www.bing.com/videos/riverview/relatedvideo?&q=utube+video&&mid=FF71E3BDF35DC9F4AD97FF71E3BDF35DC9F4AD97&&FORM=VRDGAR";
            $("#zoomMeeting").attr("src", meetingURL);
            $("#meetingFrame").show();

            // Optionally, scroll to the iframe
            $('html, body').animate({
                scrollTop: $("#meetingFrame").offset().top
            }, 1000);
        });
        
        // Sidebar toggle
        $("#sideBarCollapse").on("click", function () {
            $("#sidebar").toggleClass("active");
        });
    });
</script>
    {{-- <script src="{{asset('/js/validation.js')}}"></script>
    <script src="{{asset('/js/users.js')}}"></script> --}}

@endsection


