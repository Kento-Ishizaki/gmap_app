<?php

namespace App\Http\Middleware;
use Closure;

class ForceHttpProtocol {

    public function handle($request, Closure $next) {
        if (config('app.env') === 'production' || config('app.env') === 'staging') { //本番環境のみhttpsに
            if ($_SERVER["HTTP_X_FORWARDED_PROTO"] != 'https') {
              return redirect()->secure($request->getRequestUri(), 301);
            }
          }

        return $next($request);
    }

}
