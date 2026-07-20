<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrustProxies
{
    /**
     * The trusted proxies for this application.
     * Diperlukan agar Laravel mendeteksi HTTPS dengan benar
     * saat berjalan di belakang reverse proxy (load balancer server pemerintah).
     */
    protected $proxies = '*';

    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;

    public function handle(Request $request, Closure $next)
    {
        // Trust semua proxy (safe untuk server internal pemerintah)
        $request->setTrustedProxies(
            ['*'],
            $this->headers
        );

        return $next($request);
    }
}
