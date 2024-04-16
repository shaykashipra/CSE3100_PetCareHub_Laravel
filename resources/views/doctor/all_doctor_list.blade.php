@extends('layouts.sidebar')

@section('title', 'Manage Doctors')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#doctor_table').DataTable();
        });
    </script>
@endsection

@section('content')
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editModalLabel">Edit Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('doctors.update') }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal-body row g-3">
                        <input type="hidden" name="idEdit" id="idEdit">
                        <div class="col-md-6">
                            <label for="nameEdit" class="form-label">Doctor Name</label>
                            <input type="text" class="form-control" id="nameEdit" name="nameEdit">
                            <span class="text-danger fst-italic d-none">Please enter valid  name</span>

                        </div>
                        <div class="col-md-6">
                            <label for="specializationEdit" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="specializationEdit" name="specializationEdit">
                        </div>
                        <div class="col-md-6">
                            <label for="genderEdit" class="form-label">Gender</label>
                            <select id="genderEdit" class="form-select" name="genderEdit">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="experienceEdit" class="form-label">Experience</label>
                            <input type="number" class="form-control" id="experienceEdit" name="experienceEdit">
                            <span class="text-danger fst-italic d-none">Please enter valid number</span>

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

    <div class="container-fluid d-flex align-items-center">
        <button type="button" id="sideBarCollapse" class="btn btn-secondary  me-3"><i class="fa-solid fa-bars"></i></button>
        <h1 class="fw-bold">Doctors</h1>
    </div>

    @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <p class="mb-0 text-danger">{{ $error }}</p>
                @endforeach
            </div>
        @endif

    <div class="container table-responsive py-5">
        <table class="table table-bordered table-hover" id="doctor_table">
            <thead>
                <tr>
                    <th class="d-none">ID</td>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Experience</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                <tr>
                    <td class="d-none">{{$doctor->id}}</td>
                    <td>{{ $doctor->doctor_name }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->gender }}</td>
                    <td>{{ $doctor->experience }}</td>
                    <td class="d-flex">
                    <button type="button" class="btn btn-primary edit me-2" title="Edit">Edit</button>
                        <form action="{{ route('doctors.destroy') }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" id="id" value="{{$doctor->id}}"> 

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection

@section('js')
    <!-- <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var specialization = button.data('specialization')
            var gender = button.data('gender')
            var experience = button.data('experience')

            var modal = $(this)
            modal.find('.modal-title').text('Edit Doctor: ' + name)
            modal.find('.modal-body #idEdit').val(id)
            modal.find('.modal-body #doctorNameEdit').val(name)
            modal.find('.modal-body #specializationEdit').val(specialization)
            modal.find('.modal-body #genderEdit').val(gender)
            modal.find('.modal-body #experienceEdit').val(experience)
        });
    </script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="{{asset('/js/doctors.js')}}"></script>
        <script src="{{asset('/js/validation.js')}}"></script>


@endsection
