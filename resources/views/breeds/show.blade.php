{{-- resources/views/breeds.blade.php --}}
@extends('layouts.master')
@section('title','Cats')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#user_table').DataTable();
        });
    </script>
        <style>
        #searchInput {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Animal Breeds</h1>
        <input type="text" id="searchInput" placeholder="Search for breed...">

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Bred For</th>
                <th>Breed Group</th>
                <th>Life Span</th>
                <th>Temperament</th>
                <th>Origin</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Image</th>
            </tr>
        </thead>
      
  
            @foreach ($breeds as $breed)
       <div class="card mb-3 mt-3">
    <div class="row no-gutters">
        <div class="col-md-6">
            <div class="card-body">    
            {{-- <tr> --}}
          <h2>{{ $breed['name'] }}</h2>
    <p><strong>ID:</strong> {{ $breed['id'] }}</p>
    <p><strong>Description:</strong> {{ $breed['description'] }}</p>
    <p><strong>Temperament:</strong> {{ $breed['temperament'] }}</p>
    <p><strong>Origin:</strong> {{ $breed['origin'] }}</p>
    <p><strong>Life Span:</strong> {{ $breed['life_span'] }}</p>
    <p><strong>Weight (Imperial):</strong> {{ $breed['weight']['imperial'] }}</p>
    <p><strong>Weight (Metric):</strong> {{ $breed['weight']['metric'] }}</p>
    @if(isset($breed['cfa_url']))
        <p><strong>CFA URL:</strong> <a href="{{ $breed['cfa_url'] }}" target="_blank">{{ $breed['cfa_url'] }}</a></p>
    @endif
    @if(isset($breed['vetstreet_url']))
        <p><strong>Vetstreet URL:</strong> <a href="{{ $breed['vetstreet_url'] }}" target="_blank">{{ $breed['vetstreet_url'] }}</a></p>
    @endif
    @if(isset($breed['vcahospitals_url']))
        <p><strong>VCA Hospitals URL:</strong> <a href="{{ $breed['vcahospitals_url'] }}" target="_blank">{{ $breed['vcahospitals_url'] }}</a></p>
    @endif
    <p><strong>Indoor:</strong> {{ $breed['indoor'] }}</p>
        @if(isset($breed['lap']))

    <p><strong>Lap:</strong> {{ $breed['lap'] }}</p>
    @endif
            {{-- <p><strong>Image URL:</strong> <a href="{{ $breed['image']['url'] }}" target="_blank">{{ $breed['image']['url'] }}</a></p> --}}
      
                {{-- <td><img src="https://cdn2.thedogapi.com/images/{{ $breed['reference_image_id'] }}.jpg" alt="image" style="width:100px;"></td> --}}
            {{-- </tr> --}}
            </div>
        </div>
    </div>
       </div>
            @endforeach
    </table>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        spaceBetween: 30,
        slidesPerView: 1,
        centeredSlides: true,
        loop: true,
        keyboard: {
            enabled: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        }
    });

//after loading in same position 
document.querySelectorAll('.favourite-icon').forEach(icon => {
    icon.addEventListener('click', () => {
        localStorage.setItem('scrollPosition', window.scrollY);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const savedScrollPos = localStorage.getItem('scrollPosition');
    if (savedScrollPos) {
        window.scrollTo(0, parseInt(savedScrollPos, 10));
        localStorage.removeItem('scrollPosition'); // Clear saved position
    }
});

</script>
<script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>


<script>
    function searchBreeds() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByTagName("table")[0];
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }

    // Add event listener to search input field
    document.getElementById("searchInput").addEventListener("keyup", searchBreeds);
    </script>
@endsection