@extends('layouts.master')
@section('title','Find a Pet')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
    <link rel="stylesheet" href="{{asset('/css/Filter_pet.css')}}">
@endsection
@section('content')
<div class="filter-container sticky-top row g-0 p-3 ">
    <div class="col-md ps-2 pe-2">
      <div class="form-floating">
        <select class="form-select" id="type" aria-label="Floating label select example">
        <!-- <option selected value="any">Any</option> -->
          <option value="dog" {{ $selectedType == 'dog' ? 'selected' : '' }}>Dog</option>
          <option value="cat" {{ $selectedType == 'cat' ? 'selected' : '' }}>Cat</option>
          <option value="rabbit" {{ $selectedType == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
          <option value="bird" {{ $selectedType == 'bird' ? 'selected' : '' }}>Bird</option>
          <option value="horse" {{ $selectedType == 'horse' ? 'selected' : '' }}>Horse</option>
          <!-- <option value="barnyard">Barnyard</option> -->
        </select>
        <label for="floatingSelectGrid">Pet</label>
      </div>
    </div>
    <div class="col-md ps-2 pe-2">
      <div class="form-floating">
        <select class="form-select" id="gender" aria-label="Floating label select example">
          <!-- <option name="gender" value="any" selected>Any</option>
          <option name="gender" value="male">Male</option>
          <option name="gender" value="female">Female</option> -->
          <option value="any" {{ request('gender') == 'any' ? 'selected' : '' }} selected>Any</option>
          <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        <label for="floatingSelectGrid">Gender</label>
      </div>
    </div>
    <div class="col-md ps-2 pe-2">
      <div class="form-floating">
        <select class="form-select" id="age" aria-label="Floating label select example">
          <option value="any" {{ request('age') == 'any' ? 'selected' : '' }} selected >Any</option>
          <option value="baby" {{ request('age') == 'baby' ? 'selected' : '' }}>Baby</option>
          <option value="young" {{ request('age') == 'young' ? 'selected' : '' }}>Young</option>
          <option value="adult" {{ request('age') == 'adult' ? 'selected' : '' }}>Adult</option>
          <option value="senior" {{ request('age') == 'senior' ? 'selected' : '' }}>Senior</option>
        </select>
        <label for="floatingSelectGrid">Age</label>
      </div>
    </div>
    {{-- pb --}}
    {{-- <div class="col-md ps-2 pe-2">
      <div class="form-floating">
        <select class="form-select" id="breed" aria-label="Floating label select example">
          <option selected value="any">Any</option>
          @foreach ($breeds as $breed)
          <option value="{{$breed["name"]}}">{{$breed["name"]}}</option>
          @endforeach
        </select>
        <label for="floatingSelectGrid">Breed</label>
      </div>
    </div> --}}
    <div class="col-md ps-2 pe-2">
      <div class="form-floating">
        <select class="form-select" id="coat" aria-label="Floating label select example">
          <option selected value="any">Any</option>
          <option value="short">Short</option>
          <option value="medium">Medium</option>
          <option value="long">Long</option>
          <!-- <option value="wire">Wire</option> -->
          <option value="hairless">Hairless</option>
          <!-- <option value="curly">Curly</option> -->
        </select>
        <label for="floatingSelectGrid">Hair Length</label>
      </div>
    </div>
    <!-- <div class="col-md ps-2 pe-2">
      <div class="form-floating">
        <select class="form-select" id="city" aria-label="Floating label select example">
        <option selected value="any">Any</option>
        <option value="Dhaka">Dhaka</option>
        <option value="Chittagong">Chittagong</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Khulna">Khulna</option>
        <option value="Barisal">Barisal</option>
        <option value="Sylhet">Sylhet</option>
        <option value="Rangpur">Rangpur</option>
        <option value="Mymensingh">Mymensingh</option>

        </select>
        <label for="floatingSelectGrid">Near City</label>
      </div>
    </div> -->
  </div>

  <div class="container mt-3 d-flex flex-column align-items-center justify-content-center ">
  {{-- @php
      $pets=['cat','dog'];
  @endphp --}}
  @foreach ($pets as $pet)
  {{-- @if(empty($pet["description"]) || empty($pet["primary_photo_cropped"]) )
    @continue
  @endif --}}
  <div class="card mb-3 mt-3">
      <div class="row no-gutters">
        <div class="col-md-3">
                
                <img src="{{asset('uploads/'.$pet['pet_image'])}}" class="card-img" alt="{{$pet['pet_name']}}">

         @if(in_array($pet['id'], session('favourites', [])))

 <a href="{{ route('removefav', $pet['id']) }}" class=" fa-regular fa-heart favourite-icon" id="{{ $pet['id'] }}">
    </a>
                @else
 <a href="{{ route('addfav', [$pet['id']]) }}" class=" fa-solid fa-heart favourite-icon" id="{{ $pet['id'] }}">
    </a>
                @endif
        </div>

        <div class="col-md-6">
          <div class="card-body">
            
            <h5 class="card-title">{{$pet["pet_name"]}}</h5>
            <p class="card-text">{{$pet["description"]}} </p>
            <div class="d-flex justify-content-between">
              <small class=" text-muted">{{$pet["gender"]}}</small>
              {{-- <small class=" text-muted">{{$pet["breeds"]["primary"]}}</small> --}}
            </div>

            <div class="d-flex justify-content-between">
              <small class="text-muted">{{$pet["age"]}}</small>
              <small class="text-muted">{{$pet["coat"]}}</small>
            </div>

            <div lass="card-text">
              <small class="text-muted">{{$pet->users->city}}</small>
          <small class="text-muted">{{$pet["province"]}}</small>

       <small class="text-muted">{{$pet["street"]}}</small>

            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex flex-column align-items-center justify-content-center ">
        <button type="button" onclick="viewProfile('{{ route('pet-profile', [$pet['id'], 'profile']) }}')" class="btn btn-primary mb-4 col-sm-9">Profile</button>
<button type="button" onclick="contact('{{ route('pet-profile', [$pet['id'], 'contact']) }}')" class="btn btn-primary col-sm-9 mb-2">Contact</button>

          <!-- <button type="button" onClick="location.href='{{ route('pet-profile', [$pet['id'], 'profile']) }}'" class="btn btn-primary mb-4 col-sm-9 ">Profile</button>
          <button type="button" onClick="location.href='{{ route('pet-profile', [$pet['id'], 'contact']) }}'" class="btn btn-primary col-sm-9 mb-2">Contact</button> -->
        </div>
      </div>
    </div>
    @endforeach
    



  </div>

  <script src="js/filter-pet.js"></script>
  <script>
    //  document.querySelectorAll('#filterForm select').forEach(select => {
    //     select.addEventListener('change', function() {
    //         document.getElementById('filterForm').submit();
    //     });
    // })
  </script>
  <script>
    function viewProfile(url) {
        window.location.href = url;
    }

    function contact(url) {
        window.location.href = url;
    }
</script>


@endsection
