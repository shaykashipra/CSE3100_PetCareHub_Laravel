@extends('layouts.sidebar')
@section('title','Users')
@section('head')

    {{-- <link rel="stylesheet" href="styles/appointment_list.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="./styles/navbar.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

   <script>
$(document).ready(function() {
    $('#user_table').DataTable();
});
</script>
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
    <!-- Appointments List -->
    {{-- <div id="filter_box">
        <p>Filter by status</p>
        <select id="filter">
            <option value="">Please select...</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
    </div> --}}
 <div class="container table-responsive mb-3">
            <table class="table overflow-auto nowrap table-striped" id="user_table">
                <thead>
              <tr>
   
                <th scope="col">Doctor Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
                <th scope="col">Join_Url</th>
                <th scope="col">Meeting Id</th>
                <th scope="col">Password</th>
                <th scope="col">Prescription</th>





            </tr>
        </thead>
        <tbody>
            
        @if($appointments)
      @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->doctor->doctor_name }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
    <td class="
                @if($appointment->status == 'pending') bg-warning
                @elseif($appointment->status == 'approved') bg-success
                @elseif($appointment->status == 'rejected') bg-danger
                @endif
            ">
                {{ $appointment->status }}
            </td>  
            @if( $appointment->join_url)
            <td><a href="{{ $appointment->join_url }}">Join</a></td>
            @else
            <td>Not Provided</td>
            @endif
            <td>{{ $appointment->meeting_id }}</td>
            <td>{{ $appointment->meeting_password }}</td>
                  @if($appointment->prescription)
        <td>
            <form action="{{ route('printPrescription', $appointment->id) }}" method="Post">
                @csrf
    <button type="submit" class="btn btn-info">Print</button>
</form>

        </td>
        @else
           <td>Not Available</td>
        @endif

        </tr>
        @endforeach
        </tbody>
     </table>
    
    @else
     <div id="not_available_box" align="center">
        <h3 id="not_available">No Data Available</h3>
     </div>
     @endif
       </div>
    
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script src="{{asset('/js/validation.js')}}"></script>
    <script src="{{asset('/js/users.js')}}"></script>
@endsection


