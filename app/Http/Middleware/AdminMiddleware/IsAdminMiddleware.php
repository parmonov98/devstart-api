<?php

namespace App\Http\Middleware\AdminMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsAdminMiddleware {
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response {
        $user = $request->user();

        if (!$user->is_admin) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
