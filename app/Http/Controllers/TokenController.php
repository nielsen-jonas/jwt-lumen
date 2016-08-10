<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

class TokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create()
    {
        $signer = new Sha256();
        $token = (new Builder())->setId('a1', true)
            ->setExpiration(time() + 3600)
            ->set('typ', 'test')
            ->set('uid', 1)
            ->sign($signer, env('JWT_SECRET'))
            ->getToken();
        return $token;
    }

    public function verify(Request $request)
    {
        return $request->get('token');
    }
}