<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Http\FormRequest;

class RequestManager extends FormRequest
{


     public static function getRequest($queryString)
    {

        $accessToken = RequestManager::getBearerToken();
        return Http::withToken($accessToken)->get(env("API_BASE_URL") . $queryString)->json();

    }

    private static function getBearerToken()
    {

        $response = Http::post(env("API_TOKEN_URL"), [
            'grant_type' => 'client_credentials',
            'client_id' => env("CLIENT_ID"),
            'client_secret' => env("CLIENT_SECRET"),
        ]);

        return $response->json("access_token");

    }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
