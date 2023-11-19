<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class ProfileController extends Controller
{
    public function index($id = null)
    {
        $name = "Donald Trump";
        $age = "75";

        $data = [
            'id' => $id,
            'name' => $name,
            'age' => $age,
        ];

        $cookieName = 'access_token';
        $cookieValue = $id;
        $minutes = 1;
        $path = '/';
        $domain = $_SERVER['SERVER_NAME'];
        $secure = false;
        $httpOnly = true;

        $response = new Response('Profile data and cookie have been set.', 200);

        $response = $response->withCookie(
            Cookie::make($cookieName, $cookieValue, $minutes, $path, $domain, $secure, $httpOnly)
        );

        if (Cookie::has($cookieName)) {
            $cookieValue = Cookie::get($cookieName);

     
            echo "Cookie Value: " . $cookieValue."\n";
        } else {
            echo "Cookie is not set.";
        }
        return response()->json($data)->withCookie($cookieName, $cookieValue, $minutes, $path, $domain, $secure, $httpOnly);
    }
}
