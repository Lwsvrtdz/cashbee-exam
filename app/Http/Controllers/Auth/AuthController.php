<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        $client = new Client();

        try {
            $response = $client->post(config('app.url') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('PASSWORD_GRANT_CLIENT_ID'),
                'client_secret' => env('PASSWORD_GRANT_CLIENT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
            ]);

            return response()->json(json_decode((string) $response->getBody(), true));
        } catch (ClientException $e) {
            if ($e->getCode() == 400) {
                return response()->json(['message' => 'Invalid login credentials.'], 400);
            }
            // Handle other 4xx errors if necessary
        } catch (\Exception $e) {
            // Handle other exceptions if necessary, e.g., timeouts or network issues
        }

        return response()->json(['message' => 'An unexpected error occurred.'], 500);
    }
}
