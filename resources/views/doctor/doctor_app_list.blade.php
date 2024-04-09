@extends('layouts.masterDoc')
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
            <form action="{{route('doctor_app_list.update')}}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body row g-3">
                    <input type="hidden"  class="form-control" name="idEdit" id="idEdit">
                   

                    <div class="col-md-6">
                        <label for="statusEdit" class="form-label">Status</label>
                        <select id="statusEdit"  class="form-control" name="statusEdit">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                       <div class="col-md-6">
                        <label for="prescriptionEdit" class="form-label">Prescription</label>
                        <textarea id="prescriptionEdit" type="text" class="form-control" name="prescriptionEdit">
                          
                        </textarea>
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
            {{-- <button type="button" id="sideBarCollapse" class="btn btn-secondary me-3"><i class="fa-solid fa-bars"></i></button> --}}
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
                <th scope="col">Contact</th>
                <th scope="col">Email</th>               
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
                <th scope="col">Category</th>
                <th scope="col">Symptoms</th>
                <th scope="col">Prescription</th>
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
    <td>{{ $appointment->id }}</td>
    <td>{{ $appointment->pet_name }}</td>
    <td>{{ $appointment->contact }}</td>
    <td>{{ $appointment->patient->email }}</td>
    <td>{{ $appointment->date }}</td>
    <td>{{ $appointment->time }}</td>
    <td class="{{ 
            $appointment->status == 'pending' ? 'bg-warning' :
            ($appointment->status == 'approved' ? 'bg-success' : 
            ($appointment->status == 'rejected' ? 'bg-danger' : ''))
        }}">
        {{ $appointment->status }}
    </td>
    <td>{{ $appointment->category }}</td>
    <td>{{ $appointment->symptoms }}</td>
    
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
  
    <td>
        @if($appointment->join_url)
            <a href="{{ $appointment->join_url }}" target="_blank">Join</a>
        @else
            Not available
        @endif
    </td>
    <td>{{ $appointment->meeting_id }}</td>
    <td>{{ $appointment->meeting_password }}</td>
    <td class="d-flex">
        <button type="button" class="btn btn-primary edit me-2" title="Edit">Edit</button>
        <form action="{{route('doctor_app_list.destroy')}}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" name="id" value="{{ $appointment->id }}"> 
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
    <script src="{{asset('/js/appointment_list_doctor.js')}}"></script>

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


