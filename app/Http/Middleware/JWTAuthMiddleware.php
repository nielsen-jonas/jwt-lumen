<?php

namespace App\Http\Middleware;

//use Illuminate\Http\Request;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

use Closure;

class JWTAuthMiddleware
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
        try {
            $authorization = $request->header('Authorization');
            $prefix = 'JWT ';

            if (substr($authorization, 0, strlen($prefix)) == $prefix) {
                $authorization = substr($authorization, strlen($prefix));
            } 
            
            $token = (new Parser())->parse((string) $authorization);

            $signer = new Sha256();

            if ($token->verify($signer, env('JWT_SECRET'))) {
                $request->attributes->add(['token' => $token]);
                return $next($request);
            }

            return 'Unauthorized';
        } catch (Throwable $e) {
            return 'Unauthorized';
        }
    }
}
