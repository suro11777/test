<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'surname' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $http = new Client();
        $response = $http->post(config('app.url').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('auth.passport.password.id'),
                'client_secret' => config('auth.passport.password.secret'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return $response->json(['status' => 200, 'user' => $user, (string) $response->getBody()]);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
//        return response()->json($e, 422);
        $http = new Client();
        if (auth()->attempt($credentials)) {
            $response = $http->post(config('app.url').'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('auth.passport.password.id'),
                    'client_secret' => config('auth.passport.password.secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } else {
            return response()->json(['error' => 'unauthorized'], 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuth(Request $request)
    {
        $user = $request->user('api');
        if ($user){
            return response()->json(['status' => 200, 'user' => $user]);
        }

        return response()->json(['status' => 500, 'user' => "not user"]);
    }

}
