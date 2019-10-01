<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;
use GuzzleHttp\Client;

class MohrSso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('user_id')) {
            $client = new Client([
                'base_uri' => env('MOHR_USER_SSO_API_URL', "http://ksmclan.mohr.gov.my/api/aduser/staff"),
                'query' => [
                    'ad_action' => 'authentication',
                    'ad_uid' => $request->query('user_id')
                ]
            ]);
            $response = $client->request('GET');

            $response = json_decode((string) $response->getBody());

            if ($response->status === 'success') {
                $user = User::where('username', $response->mail)->first();

                if ($user) {
                    Auth::guard()->login($user);
                    $request->session()->put('perananSemasa', Auth::user()->roles()->orderBy('priority')->first()->key);
                }
            }
        }
        return $next($request);
    }
}
