<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('info');
    }
    //
    public function login(Request $request)
    {
        $query = http_build_query([
            'client_id' => '3',
            'redirect_uri' => 'http://localhost:5003/callback',
            'response_type' => 'code',
            'scope' => '',
        ]);

        return redirect('http://localhost:5003/oauth/authorize?'.$query);
    }
    public function callback(Request $request)
    {
        $http = new HttpClient;

        $response = $http->post('http://localhost:5003/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'vSzSAUk4TLvPX2FPDeem8bSrHdINhrqqyXtErFar',
                'redirect_uri' => 'http://localhost:5003/callback',
                'code' => $request->code,
            ],
        ]);

        $apiTokens= json_decode((string) $response->getBody(), true);
        $request->session()->put('api_tokens',$apiTokens);
        return redirect('/myInfo');
    }
    public function info(Request $request)
    {
        $apiTokensFromSession = $request->session()->pull('api_tokens');
        $http = new HttpClient;

        $response = $http->post('http://localhost:5003/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $apiTokensFromSession['refresh_token'],
                'client_id' => '3',
                'client_secret' => 'vSzSAUk4TLvPX2FPDeem8bSrHdINhrqqyXtErFar',
                'scope' => '',
            ],
        ]);

        $apiTokens = json_decode((string) $response->getBody(), true);

        $accessToken = $apiTokens['access_token'];
        $request->session()->put('api_tokens',$apiTokens);

        $response = $http->request('GET', 'http://localhost:5003/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }
//vSzSAUk4TLvPX2FPDeem8bSrHdINhrqqyXtErFar
}
