<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="shortcut icon" href="./assets/icons8-guide-dog-48.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="./css/clinicAppointmentForm.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
 .form-control.symptoms {
    height: 150px; /* or any other value */
}
 /* .login-image {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    width:50vw;
    height: 100vh; 
}

        
        .container {
            margin-right:.75rem;
        }
        
        @media (max-width: 768px) {
            .login-image {
                height: 200px;
              width:auto;
     background-image: url('https://i.pinimg.com/originals/f2/e2/5f/f2e25fa89ad3e970aeb994db60a81303.jpg');

            }
        } */
    </style>
</head>

<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <!-- Image Container -->
 <div class="appointment-image mb-4" id="appointmentImage" style="background-image: url(' https://images.unsplash.com/photo-1555169062-013468b47731?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
           
            <!-- Form Container -->
            <div class="form-container">
                <h1 class="title">Book Appointment</h1>
                <p class="mb-4">Please enter your appointment details.</p>
                
                <form method="POST" action="{{ route('appointment_form') }}" class="pt-4">
                    <!-- Form Fields -->
                    @csrf
                                   {{-- <div class="form-floating">
                    <x-text-input id="fname" class="form-control" type="text" name="fname" :value="old('fname')" required autofocus />
                    <label for="fname">First Name</label>
                    <span class="text-danger fst-italic d-none" id="floatingFirstNameSpan">Please enter valid first name</span>
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div> --}}
                    <div class="form-floating">
                       <x-text-input id="pet_name" class="form-control" type="text" name="pet_name" :value="old('pet_name')" autofocus />
                        <label for="name">Pet Name</label>
                    <span class="text-danger fst-italic d-none" id="floatingPetNameSpan">Please enter valid phone number</span>

                    <x-input-error :messages="$errors->get('pet_name')" class="mt-2" />

                    </div>
                
                    <div class="form-floating">
                       <x-text-input id="contact" class="form-control" type="text" name="contact" :value="old('contact')" autofocus />
                        <label for="contact">Contact No.</label>
                    <span class="text-danger fst-italic d-none" id="floatingContactSpan">Please enter valid phone number</span>
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                    </div>
                    <div class="form-floating">
                    <x-select-box class="form-control" id="doctor_id" name="doctor_id" required :value="old('doctor_id')">
                        <option value="">Select Doctor</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor['id'] }}">{{ $doctor['doctor_name'] }}</option>
                        @endforeach
                    </x-select-box>
                        <label for="doctor_id">Doctor Name</label>
                    <span class="text-danger fst-italic d-none" id="floatingDoctorIdSpan">Please enter Doctor Name</span>

                    <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />

                    </div>
                    <div class="form-floating">
                        <x-select-box class="form-control" id="category" required  name="category" :value="old('category')">
                            <option value="">Select Category</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="bird">Bird</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="other">Other</option>


                        </x-select-box>
                    <label for="category">Category</label>
                    <span class="text-danger fst-italic d-none" id="floatingCategorySpan">Please enter the Field</span>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                    <div class="form-floating">
                       <x-text-input id="date" class="form-control" type="date" name="date" :value="old('date')" autofocus  required/>
                        <label for="date">Date</label>
                   <span class="text-danger fst-italic d-none" id="floatingDateSpan">Please enter Future Date</span>
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>
                    <div class="form-floating">
                       <x-text-input id="time" class="form-control" type="time" name="time" :value="old('time')" autofocus required />

                    <label for="time">Time</label>
                         <span class="text-danger fst-italic d-none" id="floatingTimeSpan">Please enter Valid Time</span>
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </div>
                    <div class="form-floating">
                      <x-textarea-input class="form-control symptoms" id="symptoms" name="symptoms" style="height: 150px;" :value="old('sysmptoms')"></x-textarea-input>
                        <label for="symptoms">Symptoms</label>
                        {{-- <textarea class="form-control symptoms" id="symptoms" style="height: 150px;"></textarea> --}}
                             <span class="text-danger fst-italic d-none" id="floatingSymptomsSpan">Please enter Symptoms</span>
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </div>

                    <div class="d-grid mb-4">
                        {{-- <button type="submit" class="btn btn-primary">Book Now</button> --}}
                        <x-primary-button id="bookBtn" type="submit" class="btn btn-primary">{{ __('Book Now') }}</x-primary-button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script>
    function changeImage() {
        var imageDiv = document.getElementById('appointmentImage');
        
        if (window.innerWidth < 768) {
            imageDiv.style.backgroundImage = "url('https://i.pinimg.com/originals/f2/e2/5f/f2e25fa89ad3e970aeb994db60a81303.jpg')";
        } else {
            imageDiv.style.backgroundImage = "url('https://images.unsplash.com/photo-1555169062-013468b47731')";
        }
    }
    
    window.addEventListener('resize', changeImage);
    
    changeImage();
</script>

    <script src="js/validation.js"></script>
    <script src="js/appointment.js"></script>
</body>

</html>
