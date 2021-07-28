<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiKey;

class ApiAuth
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
        $apiKey = ApiKey::where('key', '=', $request->api_key)->first();
        if (!$apiKey) {
            return response()->json('Unathorized. Please enter valid API Key.', 401);
        }
        return $next($request);
    }
}
