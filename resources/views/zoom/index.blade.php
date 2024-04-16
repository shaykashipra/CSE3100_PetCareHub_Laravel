<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoom Meeting Details</title>
</head>
<body>
    <h1>Zoom Meeting Details</h1>
    <a href="{{ url('start') }}">Make A Zoom Meeting Using OAuth2 And Laravel</a>
    <br><br>
  @if(session('status'=='zoom'))
    @php
    // Decode the $respond JSON string into an array
    $responseData = json_decode($respond, true);
    @endphp

    {{-- @if ($responseData['success'])
        <p>Meeting successfully created!</p>
        <p>Meeting Topic: {{ $responseData['response']['topic'] }}</p>
        <p>Meeting Start Time: {{ $responseData['response']['start_time'] }}</p>
        <p>Meeting Duration: {{ $responseData['response']['duration'] }} minutes</p>
        <p>Meeting Link: <a href="{{ $responseData['response']['join_url'] }}">{{ $responseData['response']['join_url'] }}</a></p>
        
        <!-- Display the access token -->
        <p>Access Token: {{ $accessToken }}</p>

    @else
        <p>Error creating meeting: {{ $responseData['msg'] }}</p>
    @endif --}}
        {{$respond}}

@endif
        {{$respond}}

</body>
</html>
