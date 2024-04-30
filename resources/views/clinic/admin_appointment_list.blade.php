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
 <!-- Edit Modal for Appointments -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editModalLabel">Edit Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin_app_list.edit') }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body row g-3">
                    <input type="hidden"  class="form-control" name="idEdit" id="idEdit">
                    <div class="col-md-6">
                        <label for="doctorEdit" class="form-label">Doctor</label>
                        <select id="doctorEdit"  class="form-control" name="doctorEdit">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="dateEdit" class="form-label">Date</label>
                        <input type="date" class="form-control" id="dateEdit" name="dateEdit">
                    </div>
                    <div class="col-md-6">
                        <label for="timeEdit" class="form-label">Time</label>
                        <input type="time" class="form-control" id="timeEdit" name="timeEdit">
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="roomEdit" class="form-label">Room ID</label>
                        <a href="https://zoom.us/oauth/authorize?response_type=code&client_id=sD7q2GdnSDu8qKCsLi1htg&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fzoom%2Fzoom-meeting-create">Create</a>
            
                    </div> --}}
                    <div class="col-md-6">
                        <label for="statusEdit" class="form-label">Status</label>
                        <select id="statusEdit"  class="form-control" name="statusEdit">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="update-btn" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="content" class="container-fluid">
        @if (session('status') === 'appointment-deleted')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong>Appointment Deleted Successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('status') === 'appointment-deleted-failed')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>Appointment Deleted Failed
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
   
 <div class="container table-responsive mb-3">
            <table class="table overflow-auto nowrap table-striped" id="user_table">
                <thead>
              <tr>
                <th  scope="col">Id </th>
                <th scope="col">Pet </th>
                <th scope="col">User</th>    
                <th scope="col">Contact</th>
                <th scope="col">Email</th>               
                <th scope="col">Doctor</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Room ID</th>
                <th scope="col">Status</th>
                <th scope="col">Start URL</th>
                <th scope="col">Join URL</th> 
                <th scope="col">Meeting ID</th> 
                <th scope="col">Meeting Password</th> 
                 <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            
        @if($appointments)
      @foreach($appointments as $appointment)
        <tr>
            <td >{{ $appointment['id'] }}</td>

            <td>{{ $appointment->pet_name }}</td>
            <td>{{ $appointment->patient->fname }}  {{ $appointment->patient->lname }}</td>
            <td>{{ $appointment->contact }}</td>
            <td>{{ $appointment->patient->email }}</td>
            <td>{{ $appointment->doctor->doctor_name }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
            
{{-- <form action="{{ route('admin_app_list.edit2') }}" method="POST">
    @csrf --}}
    <td>
                    {{-- <input type="hidden"  class="form-control" name="idEdit" value="{{$appointment['id']}}"> --}}
        <!-- This button will now hit a Laravel route that pre-processes and redirects -->
<button type="button" onclick="window.location.href='{{ route('pre_zoom_redirect',['id' => $appointment['id']]) }}';" class="btn" style="background-color: rgb(238, 151, 245); border-color: rgb(238, 151, 245); color: black;">
    Create
</button>

        {{-- <a  href="https://zoom.us/oauth/authorize?response_type=code&client_id=sD7q2GdnSDu8qKCsLi1htg&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fzoom%2Fzoom-meeting-create"> --}}
        {{-- <input type="submit" class="btn" title="Create" 
        style="background-color: rgb(238, 151, 245); border-color: rgb(238, 151, 245); color: black;"> --}}
        {{-- Create
        <input type="submit" name="submit"> 
        </a>       --}}
    </td>
{{-- </form> --}}

    <td class="
                @if($appointment->status == 'pending') bg-warning
                @elseif($appointment->status == 'approved') bg-success
                @elseif($appointment->status == 'rejected') bg-danger
                @endif
            ">
                {{ $appointment->status }}
            </td>
            @if($appointment->start_url)
            <td><a href="{{ $appointment->start_url }}">Start</a></td> 
            @else
            <td>Not Yet</td>
            @endif
            @if($appointment->join_url)
            <td><a href="{{ $appointment->join_url }}">Join</a></td> 
            @else
            <td>Not Yet</td>
            @endif
            <td>{{ $appointment->meeting_id }}</td> 
            <td>{{ $appointment->meeting_password }}</td>
                <td class="d-flex">
                    <button type="button" class="btn btn-primary edit me-2" title="Edit">Edit</button>
                    <form action="{{route('admin_app_list.destroy')}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="id" value="{{ $appointment['id']}}"> 
                        <button type="submit" class="btn btn-danger" title="Delete">Delete</button>
                    </form>
                </td>
        
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
    <script src="{{asset('/js/appointment_list.js')}}"></script>

    {{-- <script src="{{asset('/js/users.js')}}"></script> --}}
    <script>
$(document).ready(function() {
    @if(session('openModal'))
    editModal.show();
    @endif
});

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
$(document).ready(function() {
    $('#user_table').DataTable();
});

@endsection


