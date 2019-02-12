<?php
namespace App\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MohrUserApiProvider
{
    const SUCCESS = 'success';
    const OFFLINE = 'offline';
    const FAIL = 'fail';

    public static function retrieveByCredentials(array $credentials)
    {
        try {
            list($username, $domain) = explode('@', $credentials['email']);

            $client = new Client([
                'base_uri' => 'http://myhos.mohr.gov.my/api/',
                'json' => ['user_id' => $username, 'password' => $credentials['password']],
            ]);

            $response = $client->request('POST', 'ionic/index.php');

            return json_decode((string)$response->getBody());
        } catch (ClientException $e) {
            return json_decode("{\"status\" : \"" . self::OFFLINE . "\"}");
        }
    }
}