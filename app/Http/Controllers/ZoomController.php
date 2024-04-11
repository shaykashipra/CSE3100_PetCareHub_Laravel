<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use DateTimeZone;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function __construct()
    {

    }
    public function preZoomRedirect($id)
{
        $clientId = env("ZOOM_CLIENT_ID");
    $redirectUri = urlencode('http://localhost:8000/zoom/zoom-meeting-create');
    $state = 'id=' . $id; 

    $url = "https://zoom.us/oauth/authorize?response_type=code"
           . "&client_id={$clientId}"
           . "&redirect_uri={$redirectUri}"
           . "&state={$state}";

    return redirect()->away($url);

    // return redirect()->away('https://zoom.us/oauth/authorize?response_type=code&client_id=sD7q2GdnSDu8qKCsLi1htg&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fzoom%2Fzoom-meeting-create');
}

 
    //++++++++++++++++++++++++++++++++++++++++++++++++
    //++++++++++++++++++++++++++++++++++++++++++++++++
    public function index(Request $request)
    {             parse_str($request->state, $stateArray);

             $id = $stateArray['id'] ?? null;
            $appointment = Appointment::find($id);
    //         if (!$appointment) {
    //             // Handle the case where the appointment is not found
    //             return view('clinic.admin_appointment_list')->with('error', 'Appointment not found.');
    //         }

    $datetime = new DateTime($appointment->date . ' ' . $appointment->time, new DateTimeZone('Asia/Dhaka'));
    
    $datetime->setTimezone(new DateTimeZone('UTC')); 
        $datetime->add(new DateInterval('PT6H'));

    $start_time = $datetime->format(DateTime::ATOM);
   if (!$request->code) {
        $this->get_oauth_step_1();
    }
   
         else {
 
  
            $getToken         = $this->get_oauth_step_2($request->code);
            $get_zoom_details = $this->create_a_zoom_meeting([
        'topic'      => 'Appointment with '. $appointment->doctor->doctor_name,
         'start_time' => $start_time,
         //'start_time' => date('Y-m-dTh:i:00') . 'Z',
        'agenda'     => "Appointment with Vet Doctor PCH",
                'jwtToken'   => $getToken['access_token'],
            ]);

   
            $accessToken=$getToken['access_token'];
       $meetingDetails = [
            'start_url' => $get_zoom_details['response']['start_url'],
            'join_url' => $get_zoom_details['response']['join_url'],
            'meeting_id' => $get_zoom_details['response']['id'],
            'meeting_password' => $get_zoom_details['response']['password'],
        ]; 

            $appointment->start_url = $meetingDetails['start_url'];
            $appointment->join_url = $meetingDetails['join_url'];
            $appointment->meeting_id = $meetingDetails['meeting_id'];
            $appointment->meeting_password = $meetingDetails['meeting_password'];


        

    $appointment->save();
          
            // dd($request->idEdit);
return redirect()->route('admin_app_list.edit', ['id' => $id])->with([
    'respond' => json_encode($get_zoom_details),
    'meetingDetails' => $meetingDetails,
    'openModal' => true,
]);       }
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++
    //++++++++++++++++++++++++++++++++++++++++++++++++
    private function get_oauth_step_1()
    {
        //++++++++++++++++++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++
        $redirectURL = 'http://localhost:8000/zoom/zoom-meeting-create';
        $authorizeURL = 'https://zoom.us/oauth/authorize';
        //++++++++++++++++++++++++++++++++++++++++++++++++++
        $clientID     = env("ZOOM_CLIENT_ID");
        $clientSecret = env("ZOOM_CLIENT_SECRECT");
        //++++++++++++++++++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++
        // return redirect()->away('https://zoom.us/oauth/authorize?response_type=code&client_id=sD7q2GdnSDu8qKCsLi1htg&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fzoom%2Fzoom-meeting-create');

        $authURL = $authorizeURL . '?client_id=' . $clientID . '&redirect_uri=' . $redirectURL . '&response_type=code&scope=meeting:update:livestream:admin, meeting:read:list_registration_questions:admin, meeting:read:list_upcoming_meetings:admin, meeting:read:survey:admin, meeting:read:list_past_instances:admin, meeting:write:poll:admin, meeting:write:registrant:admin, meeting:read:list_templates:admin, meeting:update:status:admin, meeting:update:registrant_status:admin, meeting:read:list_meetings:admin, meeting:read:participant_sharing:admin, meeting:read:invitation:admin, meeting:update:in_meeting_controls:admin, meeting:delete:poll:admin, meeting:update:meeting:admin, meeting:write:batch_polls:admin, meeting:delete:meeting:admin, meeting:update:livestream_status:admin, meeting:read:alert:admin, meeting:read:registrant:admin, meeting:write:meeting:admin, meeting:delete:survey:admin, meeting:update:survey:admin, meeting:read:poll:admin, meeting:update:poll:admin, meeting:write:invite_links:admin, meeting:delete:registrant:admin, meeting:read:list_registrants:admin, meeting:read:list_poll_results:admin, meeting:read:list_polls:admin, meeting:read:livestream:admin, meeting:read:participant:admin, meeting:write:batch_registrants:admin, meeting:read:chat_message:admin, meeting:read:device:admin, meeting:read:participant_feedback:admin, meeting:read:meeting:admin, meeting:read:list_past_participants:admin, meeting:read:participant_callout:admin, meeting:read:risk_alert:admin, meeting:read:past_meeting:admin, meeting:update:registration_question:admin&state=xyz';
        header('Location: ' . $authURL);
        exit;
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++
    //++++++++++++++++++++++++++++++++++++++++++++++++
    private function get_oauth_step_2($code)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++
        $tokenURL    = 'https://zoom.us/oauth/token';
        $redirectURL = 'http://localhost:8000/zoom/zoom-meeting-create';
        //++++++++++++++++++++++++++++++++++++++++++++++++++
        $clientID     = env("ZOOM_CLIENT_ID");
        $clientSecret = env("ZOOM_CLIENT_SECRECT");
        //++++++++++++++++++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++
        $curl   = curl_init();
        $params = array(CURLOPT_URL => $tokenURL . "?"
            . "code=" . $code
            . "&grant_type=authorization_code"
            . "&client_id=" . $clientID
            . "&client_secret=" . $clientSecret
            . "&redirect_uri=" . $redirectURL,
            CURLOPT_RETURNTRANSFER      => true,
            CURLOPT_MAXREDIRS           => 10,
            CURLOPT_TIMEOUT             => 30,
            CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST       => "POST",
            CURLOPT_NOBODY              => false,
            CURLOPT_HTTPHEADER          => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "accept: *",
            ),
        );
        curl_setopt_array($curl, $params);
        $response = curl_exec($curl);
        //++++++++++++++++++++++++++++++++++++++++++++++++++
        $err = curl_error($curl);
        curl_close($curl);
        //++++++++++++++++++++++++++++++++++++++++++++++++++
        $response = json_decode($response, true);
        return $response;
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++
    //++++++++++++++++++++++++++++++++++++++++++++++++
    private function create_a_zoom_meeting($meetingConfig = [])
    {
        
if (isset($meetingConfig['start_time'])) {
    $datetime = new DateTime($meetingConfig['start_time'], new DateTimeZone('Asia/Dhaka'));
    $datetime->add(new DateInterval('PT6H'));
    $start_time = $datetime->format(DateTime::ATOM); // Converts to "2024-04-12T18:00:00+00:00"
} else {
    $datetime = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $start_time = $datetime->format(DateTime::ATOM);
}
        //++++++++++++++++++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++
        $requestBody = [
            'topic'      => $meetingConfig['topic'] ?? 'New Meeting General Talk',
            'type'       => $meetingConfig['type'] ?? 2,
            // 'start_time' => $meetingConfig['start_time'] ?? date('Y-m-dTh:i:00') . 'Z',
            'start_time' => $meetingConfig['start_time'] ?? $start_time,
            'duration'   => $meetingConfig['duration'] ?? 30,
            'password'   => $meetingConfig['password'] ?? mt_rand(),
            'timezone'   => 'Asia/Dhaka',
            'agenda'     => $meetingConfig['agenda'] ?? 'Interview Meeting',
            'settings'   => [
                'host_video'        => false,
                'participant_video' => true,
                'cn_meeting'        => false,
                'in_meeting'        => false,
                'join_before_host'  => true,
                'mute_upon_entry'   => true,
                'watermark'         => false,
                'use_pmi'           => false,
                'approval_type'     => 0,
                'registration_type' => 0,
                'audio'             => 'voip',
                'auto_recording'    => 'none',
                'waiting_room'      => false,
            ],
        ];
        //++++++++++++++++++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification
        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://api.zoom.us/v2/users/me/meetings",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode($requestBody),
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer " . $meetingConfig['jwtToken'],
                "Content-Type: application/json",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        //++++++++++++++++++++++++++++++++++++++++++++++++
        if ($err) {
            return [
                'success'  => false,
                'msg'      => 'cURL Error #:' . $err,
                'response' => null,
            ];
        } else {
            return [
                'success'  => true,
                'msg'      => 'success',
                'response' => json_decode($response, true),
            ];
        }
    }
}