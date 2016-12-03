<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;

class AdminController extends Controller
{
    const RTL_ADJUST = 2;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('info');
        $this->http = new HttpClient;
        $this->client_id = env('CLIENT_ID',3);
        $this->client_secret = env('CLIENT_SECRET','vSzSAUk4TLvPX2FPDeem8bSrHdINhrqqyXtErFar');
        $this->redirect_uri = env('REDIRECT_URI','http://localhost:5003/callback');
        $this->apiTokenApiUrl = env('MEMBER_TOKEN_API_URL','http://localhost:5003/oauth/token');
        $this->memberInfoApiUrl = env('MEMBER_INFO_API_URL','http://localhost:5003/api/user');
        $this->passportLoginUrl = env('MEMBER_LOGIN_URL','http://localhost:5003/oauth/authorize');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $query = http_build_query([
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code',
            'scope' => '',
        ]);

        return redirect($this->passportLoginUrl.'?'.$query);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(Request $request)
    {
        $response = $this->http->post($this->apiTokenApiUrl, [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri' => $this->redirect_uri,
                'code' => $request->code,
            ],
        ]);

        $apiTokens= json_decode((string) $response->getBody(), true);
        $this->setTokenToSession($request, $apiTokens);
        return redirect('/myInfo');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function info(Request $request)
    {
        $accessToken = $this->getAccessToken($request);

        $response = $this->http->request('GET', $this->memberInfoApiUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getAccessToken(Request $request){

        $apiTokensFromSession = $request->session()->get('api_tokens');
        if ($apiTokensFromSession['expires_in'] > time()){
            return $apiTokensFromSession['access_token'];
        }
        $apiTokens = $this->getTokenFromRefreshToken($apiTokensFromSession);

        $this->setTokenToSession($request, $apiTokens);

        return $apiTokens['access_token'];
    }

    /**
     * @param $apiTokensFromSession
     * @return mixed
     */
    private function getTokenFromRefreshToken($apiTokensFromSession){
        $response = $this->http->post($this->apiTokenApiUrl, [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $apiTokensFromSession['refresh_token'],
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @param Request $request
     * @param $apiTokens
     */
    private function setTokenToSession(Request $request, $apiTokens){
        if(empty($apiTokens)){
            return false;
        }
        $apiTokens['expires_in'] = time() + $apiTokens['expires_in'] - self::RTL_ADJUST;
        $request->session()->put('api_tokens',$apiTokens);
    }
}
