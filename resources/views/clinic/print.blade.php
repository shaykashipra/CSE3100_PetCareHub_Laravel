

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }
        .prescription-wrapper {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .prescription-header, .patient-info, .prescription-body, .prescription-footer {
            margin-bottom: 20px;
        }
        .prescription-header img {
            width: 100px;
            height: auto;
        }
        .prescription-header {
            text-align: center;
        }
        .prescription-header h2 {
            margin: 0;
        }
        .patient-info h3 {
            margin: 0;
        }
        .prescription-body h3 {
            margin-bottom: 10px;
        }
        .prescription-footer {
            text-align: center;
        }
        .prescription-footer p {
            display: inline-block;
            margin: 0 20px;
        }
    </style>
</head>
<body onload="window.print();">


 <div class="prescription-wrapper">
                             <img src="{{ asset('images/logo.png') }}" height="50px" width="156px" class="img-fluid" alt="Clinic Image">

        <!-- Prescription Header -->
        <div class="prescription-header">
            

     <h5>
            <p>Mirpur 10,Dhaka Bangladesh </p>
            <p>{{$prescription->doctor->doctor_name }}</p>
            <p>{{$prescription->doctor->specialization}}</p>
            </h5>
        </div>

        <!-- Patient Information -->
        <div class="patient-info">
            <h3>Animal Name: {{ $prescription->pet_name }}</h3>
            <p><strong>Date:</strong> {{ $prescription->date }}</p>
            <!-- Other patient details -->
        </div>

        <!-- Prescription Body -->
        <div class="prescription-body">
            <h3>Prescription:</h3>
           <p>{{$prescription->prescription}}</p>
        </div>

        <!-- Prescription Footer -->
        <div class="prescription-footer">
            <p>Doctor's Signature: ___________________</p>
            <p>Date: {{  $prescription->date  }}</p>
        </div>
    </div>

    {{-- <!-- Include your scripts here -->
    <script>
        // Script to handle printing
        function printPrescription() {
            window.print();
        }
    </script> --}}
</body>
</html>
