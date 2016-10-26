<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 26/10/2016
 * Time: 11:39 AM
 */

namespace App\Apis;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use GuzzleHttp\HandlerStack;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Sainsburys\Guzzle\Oauth2\GrantType\RefreshToken;
use Sainsburys\Guzzle\Oauth2\GrantType\PasswordCredentials;
use Sainsburys\Guzzle\Oauth2\Middleware\OAuthMiddleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BluecatsApi
{

    public $client;
    public $handler;

    public function __construct()
    {
        //establishes connection
        $base_uri = 'https://api.bluecats.com';

        $this->handler = HandlerStack::create();
        $this->client = new Client(['handler'=> $this->handler, 'base_uri' => $base_uri, 'auth' => 'oauth2']);

        $config = [
            PasswordCredentials::CONFIG_USERNAME => 'ben.robey@ewn.com.au',
            PasswordCredentials::CONFIG_PASSWORD => 'Crown#2016',
            PasswordCredentials::CONFIG_CLIENT_ID => env('BLUECATS_CLIENT_ID'),
            PasswordCredentials::CONFIG_TOKEN_URL => '/token',
            PasswordCredentials::CONFIG_CLIENT_SECRET => env('BLUECATS_CLIENT_SECRET'),
            PasswordCredentials::GRANT_TYPE => 'client_credentials'
        ];

        $token = new PasswordCredentials($this->client, $config);
        $refreshToken = new RefreshToken($this->client, $config);
        $middleware = new OAuthMiddleware($this->client, $token, $refreshToken);

        $this->handler->push($middleware->onBefore());
        $this->handler->push($middleware->onFailure(5));
    }

    public function getAllBeacons() {
        return $this->client->request('GET', '/Beacons')->getBody();
    }

    public function getBeaconsForSite($siteId) {
        return $this->client->request('GET', '/Sites/'.$siteId.'/Beacons')->getBody();
    }

    public function getAllSites() {
        return $this->client->request('GET', '/Sites')->getBody();
    }

}