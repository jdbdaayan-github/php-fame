<?php
namespace System\Http\Middleware;

use System\Http\Request;
use System\Http\Response;

class Cors
{
    /**
     * Handle the incoming request and add CORS headers.
     *
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response
    {
        $response = $next($request);

        // Set CORS headers
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN');
        $response->header('Access-Control-Allow-Credentials', 'true');

        // Handle preflight OPTIONS request
        if ($request->getMethod() === 'OPTIONS') {
            abort(204);
        }

        return $response;
    }
}
